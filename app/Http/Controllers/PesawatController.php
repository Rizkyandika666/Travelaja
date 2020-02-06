<?php

namespace App\Http\Controllers;

use App\Pesawat;
use DataTables;
use Illuminate\Http\Request;

class PesawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Pesawat::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPesawat"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deletePesawat"><i class="mdi mdi-delete"></i></a>';
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

    public function page_pesawat(){
        return view('layouts.p_pesawat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Pesawat::updateOrCreate(['id' => $request->id_pesawat],
        [
            'nama_pesawat'  => $request->nama_pesawat,
            'partner'  => $request->partner,
            'kode_pesawat'  => $request->kode_pesawat,
            'harga'  => $request->harga,
            'kursi_ekonomi'  => $request->kursi_ekonomi,
            'kursi_bisnis'  => $request->kursi_bisnis,
            'kursi_vip'  => $request->kursi_vip,
            'status'  => $request->status]);

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
        $pesawat = Pesawat::find($id);
        return response()->json($pesawat);
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
        Pesawat::find($id)->delete();

        return response()->json(['Success' => 'Date deleted']);
    }
}
