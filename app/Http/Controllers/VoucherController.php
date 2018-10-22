<?php

namespace App\Http\Controllers;

use Session;
use App\VoucherManagement;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    public function __construct(VoucherManagement $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = $this->voucher->all();
        return view('adminlte::voucher_list', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlte::voucher_add');
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
            'name' => 'required',
            'desc' => 'required',
            'amount' => 'required',
            'link_code' => 'required'
        ]);
        $this->voucher->create($request->all());
        Session::flash('flash_message', 'Task successfully added!');
        return redirect('/voucher');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $details = $this->voucher->findOrFail($id);
        //dd($details);
        return view('adminlte::voucher_edit', compact('details'));
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
        //dd($request->all());
        $this->validate($request, [
               'name' => 'required',
               'desc' => 'required',
               'amount' => 'required',
               'link_code' => 'required'
           ]);
        $input = $request->all();
        $user = $this->voucher->findorfail($id);
        $updateNow = $user->update($input);

       //VoucherManagement::update($request->all());
       Session::flash('flash_message', 'Task successfully Uddated!');
       return redirect('/voucher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vocher = $this->voucher->find($id);
        $vocher->delete();  
        return redirect('/voucher');
    }
}
