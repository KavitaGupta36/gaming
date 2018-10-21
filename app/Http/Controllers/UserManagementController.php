<?php

namespace App\Http\Controllers;

use Session;
use App\Level;
use App\UserManagement;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserManagement::all();
        return view('adminlte::userlist', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        return view('adminlte::useradd', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'level_name' => 'required',
            'voucher_number' => 'required',
        ]);
        USerManagement::create($request->all());
        Session::flash('flash_message', 'User successfully added!');
        return redirect()->back();
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
        $levels = Level::all();
        $details = UserManagement::findOrFail($id);
        return view('adminlte::user_edit', compact('levels', 'details'));
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
        $this->validate($request, [
               'level_name' => 'required',
               'voucher_number' => 'required',
           ]);
        $input = $request->all();
        $user = UserManagement::findorfail($id);
        $updateNow = $user->update($input);

       Session::flash('flash_message', 'Task successfully Uddated!');
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserManagement::find($id);
        $user->delete();  
        return redirect()->back();
    }
}
