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

    public function walkInLog(Request $request){
        $purpose = "Walk-in";
        $request->validate([
            'user_id'         => 'required'
        ]);
        $exists = Log::where('user_id', $request->user_id)->where('purpose',$purpose)
                ->where('created_at', '>=', Carbon::today())->exists();
        if(!$exists) {
            Log::create([
                'user_id'       => $request->user_id,
                'facility_id'   => null,
                'purpose'       => $purpose
            ]);
        }
        return response()->json(['message'   =>  'Added Successfully'], 202);
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

        $purposeList = explode(",", $request->purposes);
        
        $facilities = Facility::whereHas('purposes', function($q) use($purposeList) {
                    $q->whereIn('title', $purposeList);
                    })
                    ->where('isOpen', true)
                    ->select('id','name')
                    ->with('purposes:title')->get();

        $facilitiesUnique = $facilities->unique('id');
        foreach($purposeList as $purpose){
             
        }

        if($request->purposes!='Walk-in' && isset($facilitiesUnique)){
            foreach($facilitiesUnique as $facility){
                $count = Log::where('facility_id', $facility->id)
                        ->where('created_at', '>=', Carbon::today())
                        ->count();

                $purposes = implode(", ",$facility->purposes()->pluck("title")->toArray());
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
        $logs[] = [
            'name'      => $log->user->name,
            'facility'  => $log->facility->name ?? null,
            'queue_no'  => $log->queue_no,
            'purpose'   => $log->purpose
        ];
        return $logs;
    }

    public function showPurposes(){
        try{
            $purposes = Purpose::orderBy('title')->whereHas('facilities')->get();

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
        $purposeIds = explode(",", $request->id);

        $facilities = Facility::whereHas('purposes', function($q) use($purposeIds) {
            $q->whereIn('id', $purposeIds);
            })
            ->where('isOpen', true)
            ->select('id','name')->get();

        $facilitiesUnique = $facilities->unique('id');
        return response()->json([
            'success'       => true,
            'facilities'    => $facilitiesUnique
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

    public function loadUsers(Request $request){
        $request->validate([
            'name'      => 'required|min:2'
        ]);

        $users = User::search($request->name)
                    ->select('id', 'name', 'type')
                    ->with('profile')
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
}
