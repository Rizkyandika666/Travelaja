<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RuteStoreRequest;
use App\Rute;
use App\Town;
use App\Airport;
use App\Partner;
use DataTables;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Rute::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editRute"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deleteRute"><i class="mdi mdi-delete"></i></a>';
                        return $btn;  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function page_rute(){
        $towns = Town::all();
        $partners = Partner::all();
        $airports = Airport::all();
        // return view('layouts.jadwal')->with(['towns', $towns);
        return view('layouts.jadwal',compact(
            'towns',$towns,
            'airports',$airports,
            'partners',$partners));
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
    public function store(RuteStoreRequest $request)
    {
        // $validateData = $request->validate([
        //     'transportasi'  => 'required',
        //     'asal'          => 'required',
        //     'tujuan'        => 'required',
        //     'jalur'         => 'required',
        //     'berangkat'     => 'required',
        //     // 'pulang'        => 'required',
        //     'durasi'        => 'required',
        // ]);

        $validateData = $request->validated();

        // dd($request->all());

        Rute::updateOrCreate(['id' => $request->id_rute],
        [   
            'transportasi'  => $request->transportasi,
            'asal'          => $request->asal,
            'tujuan'        => $request->tujuan,
            'jalur'         => $request->jalur,
            'berangkat'     => $request->berangkat,
            'pulang'        => $request->pulang,
            'durasi'        => $request->durasi]);

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
        $rute = Rute::find($id);
        return response()->json($rute);
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
        Rute::find($id)->delete();

        return response()->json(['success' => "Data deleted"]);
    }
}
