<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class ShowFacilitiesController extends Controller
{
    public function show(Request $request){
        // $facilities = Facility::whereHas('purposes', function($q) use($request) {
        //     $q->whereIn('id', $request);
        //     })
        //     ->where('isOpen', true)
        //     ->select('id','name', 'code')->get();
        $facilities = Facility::whereHas('purposes', function($q) use($request) {
                            $q->whereIn('title', $request);
                        })->get();
        return response()->json([
            'success'       => true,
            'facilities'    => $facilities
        ], 202);
    }
}
