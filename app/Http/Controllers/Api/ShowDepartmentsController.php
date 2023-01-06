<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class ShowDepartmentsController extends Controller
{
    public function show(){
        $departments = Facility::where('name', 'like', '%college of%')->where('isOpen', true)
                                ->select('id','name','code')->get();

        return response()->json([
            'success'       => true,
            'departments'   => $departments
        ], 202);
    }
}
