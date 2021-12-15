<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreateLogController extends Controller
{
    public function store(Request $request){
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
                $purposes = implode(", ",$facility->purposes->pluck("title")->toArray());
                $log = Log::where('user_id', $request->user_id)
                        ->where('facility_id', $facility->id)
                        ->where('created_at', '>=', Carbon::today())
                        ->where('status', '!=', 'completed')
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
            $this->walkIn($request);
        }
    }

    public function walkIn(Request $request){
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

    public function responseLogs($log){
        return [
            'name'      => $log->user->name,
            'facility'  => $log->facility->name ?? null,
            'queue_no'  => $log->queue_no,
            'purpose'   => $log->purpose,
            'status'    => $log->status
        ];
    }
}
