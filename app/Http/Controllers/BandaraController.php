<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Town;
use DataTables;
use Illuminate\Http\Request;

class BandaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Airport::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                       $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editAirport"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteAirport"><i class="mdi mdi-delete"></i></a>';
                        return $btn;  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function page_bandara(){
        $towns = Town::all();
        // dd($town);

        return view('layouts.p_bandara')->with('towns', $towns);
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

        Airport::updateOrCreate(['id' => $request->id_bandara],
        [   
            'town_id'  => $request->town_id,
            'nama_bandara'  => $request->nama_bandara,
            'kode'  => $request->kode,
            'status'  => $request->status]);

        return response()->json(['success' => "Data saved"]);
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
        $bandara = Airport::find($id);
        return response()->json($bandara);
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
        Airport::find($id)->delete();

        return response()->json(['success' => "Data deleted"]);
    }
}
