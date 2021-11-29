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
        $today = Carbon::now()->format('M d, Y');

        if(auth()->user()->hasRole('head')){
            $waiting = Log::where('facility_id', auth()->user()->facility->id)
                            ->where('status', "waiting")
                            ->where('created_at', '>=', Carbon::today())
                            ->count();

            $completed = Log::where('facility_id', auth()->user()->facility->id)
                            ->where('status', "completed")
                            ->where('created_at', '>=', Carbon::today())
                            ->count();

            $transactions = Log::where('facility_id', auth()->user()->facility->id)->count();

            return view('public.dashboard', compact('transactions', 'waiting', 'completed', 'today'));

        }else{
            $logs = Log::where('user_id', $this->id)
            ->where('created_at', '>=', Carbon::today()->subDays(2))
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

            $count = Log::distinct('facility_id')
                    ->where('user_id', $this->id)
                    ->where('created_at', '>=', Carbon::today())
                    ->count();

            return view('public.dashboard', compact('logs', 'count', 'today'));
        }
    }

    public function logs()
    {
        // $this->validate($request,[
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|before_or_equal:start_date',
        // ]);

        // $start = Carbon::parse($request->start_date);
        // $end = Carbon::parse($request->end_date);

        if(auth()->user()->hasRole('head')){
            $today = Carbon::now()->format('M d, Y');

            $logs = Log::where('facility_id', auth()->user()->facility->id)
                        ->where('status', 'completed')
                        ->where('created_at', '>=', Carbon::today())
                        ->orderBy('created_at', 'DESC')->paginate(10);
            $facility = auth()->user()->facility->name;
            return view('public.logs', compact('logs', 'facility', 'today'));
        }else{
            $logs = Log::where('user_id', $this->id)->orderBy('created_at', 'DESC')->paginate(10);
            return view('public.logs', compact('logs'));
        }
        
    }

    public function generate(){
        $user = User::with('profile')->where('id', auth()->user()->id)->first();

        $data = [
            'id'            => $user->id,
            'name'          =>  $user->name,
            'address'       => $user->profile->address,
            'phone_number'  => $user->profile->phone_number
        ];

        $jsonData = json_encode($data);
        $qrcode = QrCode::format('png')->size(300)->generate($jsonData);
        return view('public.generate-qrcode', compact('qrcode'));
    }
}
