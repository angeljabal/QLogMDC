<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Log;
use App\Models\Purpose;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'         => 'required',
            'purpose'         => 'required'
        ]);
        
        if(!empty($request->facilities)){
            $facilities = explode(",", $request->facilities);

            foreach($facilities as $facility){
                $facilityId = Facility::where('name', $facility)->select('id')->first();
                $count = Log::where('facility_id', $facilityId->id)
                        ->where('created_at', '>=', Carbon::today())
                        ->count();

                try{
                    $log = Log::create([
                        'user_id'       => $request->user_id,
                        'facility_id'   => $facilityId->id,
                        'queue_no'      => ++$count,
                        'purpose'       => $request->purpose
                    ]);
    
                }catch(Exception $ex) {
                    return response()->json([
                        'success'   =>  false,
                        'error'     =>  $ex->getMessage()
                    ],500);
                }

                $logs[] = [
                    'name'      => $log->user->name,
                    'facility'  => $log->facility->name,
                    'queue_no'  => $log->queue_no,
                    'purpose'   => $log->purpose
                ];
            }
            return response()->json([
                'success'   => true,
                'log'       => $logs
            ], 202);
        }else{

            try{
                $log = Log::create([
                    'user_id'       => $request->user_id,
                    'facility_id'   => null,
                    'purpose'       => $request->purpose
                ]);
                return response()->json([
                    'success'   => true,
                    'log'       => $log
                ], 202);
            }catch(Exception $ex) {
                return response()->json([
                    'success'   =>  false,
                    'error'     =>  $ex->getMessage()
                ],500);
            }
            
        }
    }

    public function showPurposes(){
        try{
            $purposes = Purpose::orderBy('title')->select('title')->get();
            return response()->json([
                'success'   => true,
                'purposes'  => $purposes
            ], 202);
        }catch(Exception $ex){
            return response()->json([
                'success'   =>  false,
                'error'     =>  $ex->getMessage()
            ],500);
        }

    }

    public function showFacilities(Request $title){
        $facilities = Facility::whereHas('purposes', function($q) use($title) {
            $q->whereIn('title', $title);
        })->where('isOpen', true)->select('id','name')->get();

        $others = Facility::whereNotIn('id', $facilities->pluck('id')->toArray())
            ->where('isOpen', true)->select('id','name')->get();

        return response()->json([
            'success'       => true,
            'facilities'    => $facilities,
            'others'        => $others
        ], 202);

    }

    public function showLogs()
    {
        $logs = Log::where('facility_id', auth()->guard('api')->user()->facility->id)
                    ->where('created_at', '>=', Carbon::today())
                    ->select('user_id', 'queue_no', 'purpose')
                    ->get();
        foreach($logs as $l){
            $log[] = [
                'name'      => $l->user->name,
                'queue_no'  => $l->queue_no,
                'purpose'   => $l->purpose
            ];
        }
        return response()->json([
            'success'       => true,
            'logs'          => $log
        ], 202);
    }

    public function findUser(Request $request){
        $user = User::where('name',  $request->name)
                    ->select('id', 'name')
                    ->with('profile')->first();

        if(isset($user)){
            return response()->json([
                'success'       => true,
                'user'          => $user
            ], 202);
        }else{
            return response()->json([
                'success'       => false
            ], 404);
        }
    }
}
