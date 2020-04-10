<?php

namespace App\Http\Controllers;

use App\Stasiun;
use App\Town;
use DataTables;
use Illuminate\Http\Request;

class StasiunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Stasiun::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStasiun"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteStasiun"><i class="mdi mdi-delete"></i></a>';
                        return $btn;  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function page_stasiun(){
        $towns = Town::all();

        return view('layouts.k_stasiun')->with('towns', $towns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stasiun::updateOrCreate(['id'   => $request->id_stasiun],
        [
            'town_id'   => $request->town_id,
            'nama_stasiun'   => $request->nama_stasiun,
            'kode'   => $request->kode,
            'status'   => $request->status]);

        return response()->json(['success'  => "Data saved"]);
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
        $stasiun = Stasiun::find($id);

        return response()->json($stasiun);
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
        Stasiun::find($id)->delete();

        return response()->json(['success' => "Data deleted"]);
    }
}
