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

    public function createLog(Request $request)
    {
        $purposes = $request->purposes;
        return array_column($purposes, 'facilityIds');
        $data = array_column($purposes, 'facilityIds');
        return array_unique($data);

        // $purposes = [
        //     'Title 1' => [
        //         'id'=> 1,
        //         'facilityIds' => [1,2,3],
        //     ],
        //     'Title 2' => [
        //         'id'=> 2,
        //         'facilityIds' => [1,3],
        //     ]
        // ]

        $uniqueFacilityIds = [];
        foreach($purposes as $purpose => $value)
        {
            $facilityIds = $value['facilityIds'];
            $uniqueFacilityIds[] = array_unique(array_merge($uniqueFacilityIds,$facilityIds));

        }
    }

    public function log(Request $request){
        $request->validate([
            'user_id'         => 'required'
        ]);
        if(isset($request->purposes)){
            $purposeId = explode(",", $request->purposes);
            $facilities = Facility::whereHas('purposes', function($q) use($purposeId) {
                $q->whereIn('id', $purposeId);
                })
                ->where('isOpen', true)
                ->select('id','name')
                ->with(['purposes'=>function($q) use($purposeId) {
                    $q->whereIn('id', $purposeId);
            }])->get();

            foreach($facilities as $facility){
                $count = Log::where('facility_id', $facility->id)
                        ->where('created_at', '>=', Carbon::today())
                        ->count();
                $purposes = implode(",",$facility->purposes->pluck("title")->toArray());
                $log = Log::where('user_id', $request->user_id)
                        ->where('facility_id', $facility->id)
                        ->where('created_at', '>=', Carbon::today())
                        ->first();


                if($log){
                    $logs[] = $this->responseLogs($log);
                    continue;
                }
                $log = Log::create([
                    'user_id'       => $request->user_id,
                    'facility_id'   => $facility->id,
                    'queue_no'      => ++$count,
                    'purpose'       => $purposes,
                    'status'        => "waiting"
                ]);
                $logs[] = $this->responseLogs($log);
            }
            return response()->json([
                'success'   => true,
                'log'       => $logs
            ], 202);
        }else{
            $log = Log::create([
                'user_id'       => $request->user_id,
                'facility_id'   => null,
                'purpose'       => "Walk-in"
            ]);
            return response()->json([
                'success'   => true,
                'log'       => $this->responseLogs($log)
            ], 202);
        }
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
            'purposes'        => 'required'
        ]);
        // $this->walkInLog($request);

        $purposeId = explode(",", $request->purposes);
        
        $facilities = Facility::whereHas('purposes', function($q) use($purposeId) {
                    $q->whereIn('id', $purposeId);
                    })
                    ->where('isOpen', true)
                    ->select('id','name')
                    ->with(['purposes'=>function($q) use($purposeId) {
                        $q->whereIn('id', $purposeId);
                    }])->get();

        // foreach($purposeList as $purpose){
             
        // }

        if($request->purposes!='Walk-in' && isset($facilities)){
            foreach($facilities as $facility){
                $count = Log::where('facility_id', $facility->id)
                        ->where('created_at', '>=', Carbon::today())
                        ->count();
                $purposes = implode(",",$facility->purposes()->pluck("title")->toArray());
                $log = Log::where('user_id', $request->user_id)
                            ->where('facility_id', $facility->id)
                            ->where('created_at', '>=', Carbon::today())
                            ->first();
                try{
                    if($log){
                        $logs[] = $this->responseLogs($log);
                        continue;
                    }
                    $log = Log::create([
                        'user_id'       => $request->user_id,
                        'facility_id'   => $facility->id,
                        'queue_no'      => ++$count,
                        'purpose'       => $purposes
                    ]);
                    $logs[] = $this->responseLogs($log);
                }catch(Exception $ex) {
                    return response()->json([
                        'success'   =>  false,
                        'error'     =>  $ex->getMessage()
                    ],500);
                }
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
                    'purpose'       => $request->purposes
                ]);
                return response()->json([
                    'success'   => true,
                    'log'       => $this->responseLogs($log)
                ], 202);
            }catch(Exception $ex) {
                return response()->json([
                    'success'   =>  false,
                    'error'     =>  $ex->getMessage()
                ],500);
            }
        }
    }

    public function responseLogs($log){
        $logs = [
            'name'      => $log->user->name,
            'facility'  => $log->facility->name ?? null,
            'queue_no'  => $log->queue_no,
            'purpose'   => $log->purpose,
            'status'    => $log->status
        ];
        return $logs;
    }

    public function showPurposes(){
        try{
            $purposes = Purpose::orderBy('title')->whereHas('facilities')
                        ->with('facilities:id,name')->get();

            return response()->json([
                'success'       => true,
                'purposes'      => $purposes
            ], 202);
        }catch(Exception $ex){
            return response()->json([
                'success'   =>  false,
                'error'     =>  $ex->getMessage()
            ],500);
        }

    }

    public function showFacilities(Request $request){
        $facilities = Facility::whereHas('purposes', function($q) use($request) {
            $q->whereIn('id', $request);
            })
            ->where('isOpen', true)
            ->select('id','name', 'code')->get();
        
        return response()->json([
            'success'       => true,
            'facilities'    => $facilities
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

    public function loadUsers(){

        $users = User::select('id', 'name', 'type')
                    ->with('profile:user_id,address,phone_number')
                    ->get();

        if(isset($users)){
            return response()->json([
                'success'       => true,
                'users'         => $users
            ], 202);
        }else{
            return response()->json([
                'success'       => false
            ], 404);
        }
    }

    public function loadDepartments(){
        $departments = Facility::where('name', 'like', '%college of%')->where('isOpen', true)
                                ->select('id','name','code')->get();

        return response()->json([
            'success'       => true,
            'departments'   => $departments
        ], 202);
    }
}
