<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purpose;
use Illuminate\Http\Request;

class ShowPurposesController extends Controller
{
    public function show(){
        $purposes = Purpose::orderBy('title')->whereHas('facilities')
                    ->with('facilities:id,name')->get();

        return response()->json([
            'success'       => true,
            'purposes'      => $purposes
        ], 202);
    }
}
