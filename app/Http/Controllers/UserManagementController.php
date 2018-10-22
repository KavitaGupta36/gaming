<?php

namespace App\Http\Controllers;

use Session;
use App\Level;
use App\UserManagement;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    
    public function __construct(UserManagement $user_management)
    {
        $this->user_management = $user_management;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user_management->all();
        return view('adminlte::user_list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        return view('adminlte::user_add', compact('levels'));
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
            'no_of_user' => 'required',
        ]);
        $this->user_management->create($request->all());
        Session::flash('flash_message', 'User successfully added!');
        return redirect('/user_management');
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
        $details = $this->user_management->findOrFail($id);
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
               'no_of_user' => 'required',
           ]);
        $input = $request->all();
        $user = $this->user_management->findorfail($id);
        $updateNow = $user->update($input);

       Session::flash('flash_message', 'Task successfully Uddated!');
       return redirect('/user_management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user_management->find($id);
        $user->delete();  
        return redirect('/user_management');
    }
}
