<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purpose;

class ShowPurposesController extends Controller
{
    public function show(){
        $purposes = Purpose::orderBy('title')
                        ->whereHas('facilities',  function ($query) {
                            $query->where('isOpen', true);
                        })->get();

        return response()->json([
            'success'       => true,
            'purposes'      => $purposes
        ], 202);
    }
}
