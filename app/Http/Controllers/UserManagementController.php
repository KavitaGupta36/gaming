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
        try {
            $users = $this->user_management->with('levelName')->get();
            return view('adminlte::user_list', compact('users'));
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $levels = Level::all();
            return view('adminlte::user_add', compact('levels'));
        } catch (Exception $e) {
            dd($e);
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
        try {
            $this->validate($request, [
                'level_name' => 'required',
                'no_of_user' => 'required',
            ]);
            $this->user_management->create($request->all());
            Session::flash('flash_message', 'User successfully added!');
            return redirect('/user_management');
        } catch (Exception $e) {
            dd($e);
        }
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
        try {
            $levels = Level::all();
            $details = $this->user_management->findOrFail($id);
            return view('adminlte::user_edit', compact('levels', 'details'));
        } catch (Exception $e) {
            dd($e);
        }
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
        try {
            $this->validate($request, [
                   'level_name' => 'required',
                   'no_of_user' => 'required',
               ]);
            $user = $this->user_management->findorfail($id);
            $updateNow = $user->update($request->all());

           Session::flash('flash_message', 'User successfully Updated!');
           return redirect('/user_management');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = $this->user_management->find($id);
            $user->delete();  
            return redirect('/user_management');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Check level that record are inserted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check_level(Request $request)
    {
        $data = $this->user_management->where('level_name', $request->level_id)->get()->count();
        return response()->json($data);
    }
}
