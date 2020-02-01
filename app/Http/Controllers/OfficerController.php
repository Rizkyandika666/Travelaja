<?php

namespace App\Http\Controllers;

use App\Officer;
use Illuminate\Http\Request;
use DataTables;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Officer::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_petugas.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editOfficer"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_petugas.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteOfficer"><i class="mdi mdi-delete"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function page_officer(){
        return view('layouts.d_officer');
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
        Officer::updateOrCreate(['id_petugas' => $request->id_petugas],
        [   'nama_petugas' => $request->nama_petugas,
            'email' => $request->email,
            'password' => $request->password,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat]);

        return response()->json(['success' => 'Data Saved']);
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
        $officer = Officer::find($id);
        return response()->json($officer);
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
        Officer::find($id)->delete();

        return response()->json(['success' => "Data deleted"]);
    }
}
