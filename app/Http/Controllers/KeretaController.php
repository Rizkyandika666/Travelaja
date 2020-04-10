<?php

namespace App\Http\Controllers;

use App\Kereta;
use DataTables;
use Illuminate\Http\Request;

class KeretaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Kereta::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editKereta"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteKereta"><i class="mdi mdi-delete"></i></a>';
                        return $btn;  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function page_kereta(){
        return view('layouts.k_kereta');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kereta::updateOrCreate(['id' => $request->id_kereta],
        [
            'nama_kereta'  => $request->nama_kereta,
            'partner'       => $request->partner,
            'kode_kereta'  => $request->kode_kereta,
            'harga'         => $request->harga,
            'kursi_ekonomi' => $request->kursi_ekonomi,
            'kursi_bisnis'  => $request->kursi_bisnis,
            'kursi_vip'     => $request->kursi_vip,
            'status'        => $request->status]);

       return response()->json(['success' => 'Data saved']);
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
        $kereta = Kereta::find($id);
        return response()->json($kereta);
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
        Kereta::find($id)->delete();

        return response()->json(['Success'  => 'Data deleted']);
    }
}
