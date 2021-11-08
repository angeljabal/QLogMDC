<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    private $id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id = auth()->user()->id;
            return $next($request);
       });

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $logs = Log::where('user_id', $this->id)
                ->where('created_at', '>=', Carbon::today()->subDays(2))
                ->paginate(10);

        $count = Log::distinct('facility_id')
                ->where('user_id', $this->id)
                ->where('created_at', '>=', Carbon::today())
                ->count();
        return view('public.dashboard', compact('logs', 'count'));
    }

    public function logs()
    {
        // $this->validate($request,[
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|before_or_equal:start_date',
        // ]);

        // $start = Carbon::parse($request->start_date);
        // $end = Carbon::parse($request->end_date);

        $logs = Log::where('user_id', $this->id)->paginate(10);
        return view('public.logs', compact('logs'));
    }

    public function generate(){
        $user = User::with('profile')->where('id', auth()->user()->id)->first();
        $first_name = $last_name = '';
        try{
            $splitName = explode(' ', $user->name, 2);
            $first_name = $splitName[0];
            $last_name = !empty($splitName[1]) ? $splitName[1] : '';

        }catch(Exception $ex){
            $ex->getMessage();

        }

        $data = [
            'lName'         => $first_name,
            'fName'         => $last_name,
            'address'       => $user->profile->address,
            'phone_number'  => $user->profile->phone_number
        ];

        $jsonData = json_encode($data);
        $qrcode = QrCode::format('png')->size(300)->generate($jsonData);
        return view('public.generate-qrcode', compact('qrcode'));
    }
}
