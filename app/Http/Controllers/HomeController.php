<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;

class HomeController extends Controller
{
    private $id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id = auth()->id();
            return $next($request);
       });

    }

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('public.dashboard');
    }

    public function loginAsAdmin(){
        if(Session::has('admin_id')){
            $admin = User::findOrFail(Session::get('admin_id'));
            if($admin->hasRole('admin')){
                Auth::loginUsingId(Session::get('admin_id'));
                Session::forget('admin_id');
            }
        }
        return redirect('/dashboard');
    }

    public function logs()
    {
        if(auth()->user()->hasRole('head')){
            $logs = Log::where('facility_id', auth()->user()->facility->id)
                        ->where('status', 'completed')
                        ->where('created_at', '>=', Carbon::today())
                        ->orderBy('created_at', 'DESC')->paginate(10);
            $facility = auth()->user()->facility->name;
            return view('public.logs', compact('logs', 'facility'));
        }else if(auth()->user()->hasRole('admin')){
            $logs = Log::where('status', 'completed')
                        ->where('created_at', '>=', Carbon::today())
                        ->orderBy('created_at', 'DESC')->paginate(10);
            return view('public.logs', compact('logs'));
        }else{
            $logs = Log::where('user_id', $this->id)->orderBy('created_at', 'DESC')->paginate(10);
            return view('public.logs', compact('logs'));
        }
        
    }

    public function generate(){
        $user = User::with('profile')->where('id', auth()->user()->id)->first();

        $data = [
            'id'            => $user->id,
            'name'          => $user->name
        ];

        $jsonData = json_encode($data);
        $qrcode = QrCode::format('png')->size(300)->generate($jsonData);
        return view('public.generate-qrcode', compact('qrcode'));
    }
}
