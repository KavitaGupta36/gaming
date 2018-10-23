<?php

namespace App\Http\Controllers;

use Session;
use App\Level;
use App\GameManagement;
use App\UserManagement;
use App\VoucherManagement;
use Illuminate\Http\Request;

class GameController extends Controller
{
    
    public function __construct(GameManagement $game_management, UserManagement $user_management, VoucherManagement $voucher_management){

        $this->game_management      = $game_management;
        $this->user_management      = $user_management;
        $this->voucher_management   = $voucher_management;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games  = $this->game_management->with('levelName')->get();
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
        $this->validate($request, [
            'level_id'      => 'required',
            'no_voucher'    => 'required',
            'voucher_price' => 'required',
            'no_user_point' => 'required',
            'no_of_user'    => 'required',
            'remaining_user'=> 'required'
        ]);

        if($request->voucher_price){
            $this->CheckVoucher($request->voucher_price, $request->no_voucher);
        }

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
        $this->validate($request, [
            'level_id'      => 'required',
            'no_voucher'    => 'required',
            'voucher_price' => 'required',
            'no_user_point' => 'required',
            'no_of_user'    => 'required',
            'remaining_user'=> 'required'
        ]);
        if($request->voucher_price){
            $this->CheckVoucher($request->voucher_price, $request->no_voucher);
        }
        $input = $request->all();
        $user = $this->game_management->findorfail($id);
        $updateNow = $user->update($input);

       Session::flash('flash_message', 'Task successfully Uddated!');
       return redirect('/game');
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

    public function get_level(Request $request)
    {
        $data = $this->user_management->where('level_name', $request->level_id)->get();
        return response()->json($data);
    }

    public function check_level_exit(Request $request)
    {
        $data = $this->game_management->where('level_id', $request->level_id)->get()->count();
        return response()->json($data);
    }


    public function CheckVoucher($amount, $no_voucher)
    {
       $voucher = $this->voucher_management->where('amount',$amount)->get();
        if($voucher->count() == 0){
            Session::flash('flash_error', "No record found for this Voucher Price");
            return redirect()->back();
        }

        if($voucher->count() < $no_voucher){
            Session::flash('flash_error', "Please select voucher record less than ".$voucher->count()." or equal");
            return redirect()->back();
        }
    }
}
