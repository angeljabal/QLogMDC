<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function complete()
    {
        $log = Log::where('user_id', auth()->user()->id)
            ->where('created_at', '>=', Carbon::today())
            ->where('status', '!=', 'completed')
            ->first();
        return view('public.complete', compact('log'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.queue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTransaction()
    {
        $purposes = Purpose::whereHas('offices')->get();
        return view('public.add-queue', compact('purposes'));
    }

    public function process(Request $request)
    {
        // $login = Auth::loginUsingId($request->id);
        // if (!$login) {
        //     return back();
        // }
        // // dd($login);
        // return redirect('queue/process');
        $userId = $request->id;
        return view('public.process', compact('userId'));
    }

    public function landing()
    {
        return view('public.process');
    }

    public function confirm($id)
    {
        // $purpose = Purpose::where('id', $id)->first();
        // $offices = $purpose->offices()->pluck('name')->toArray();
        // if ($purpose->hasDepartment) {
        //     $departments = Office::search('College of')->get();
        // }
        // return view('public.confirm-queue', compact('purpose', 'offices', 'departments'));
        return view('public.trans-confirmation', compact('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}