<?php

namespace App\Http\Controllers;

use Session;
use App\Level;
use App\GameManagement;
use Illuminate\Http\Request;

class GameController extends Controller
{
    
    public function __construct(GameManagement $game_management)
    {
        $this->game_management = $game_management;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games  = $this->game_management->all();
        return view('adminlte::game_list', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        return view('adminlte::game_add', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'level_id'      => 'required',
            'no_voucher'    => 'required',
            'voucher_price' => 'required',
            'no_user_point' => 'required',
            'no_of_user'    => 'required',
            'remaining_user'=> 'required'
        ]);
        $this->game_management->create($request->all());
        Session::flash('flash_message', 'Task successfully added!');
        return redirect('/game');
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
        $details = $this->game_management->findOrFail($id);
        return view('adminlte::game_edit', compact('levels','details'));
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
        dd($request->all());
        $this->validate($request, [
            'level_id'      => 'required',
            'no_voucher'    => 'required',
            'voucher_price' => 'required',
            'no_user_point' => 'required',
            'no_of_user'    => 'required',
            'remaining_user'=> 'required'
        ]);
        $input = $request->all();
        $user = $this->game_management->findorfail($id);
        $updateNow = $user->update($input);

       Session::flash('flash_message', 'Task successfully Uddated!');
       return redirect('/game')->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vocher = $this->game_management->find($id);
        $vocher->delete();  
        return redirect('/game');
    }
}
