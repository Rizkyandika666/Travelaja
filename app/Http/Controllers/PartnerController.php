<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;
use DataTables;
use File;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if($request->ajax()){
            $data = Partner::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPartner"><i class="mdi mdi-pen"></i></a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete btn btn-danger btn-sm deletePartner"><i class="mdi mdi-delete"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function page_partner(){
        return view('layouts.d_partner');
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

        // dd($request->all());

        $image_name = $request->hidden_image;
        $image = $request->file('image');

        if($image){
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
        }else if($image_name){
            $new_name = $image_name;
        }

        // save data

        Partner::updateOrCreate(['id' => $request->id],
        [
            'nama' => $request->nama,
            'image' => $new_name,
            'detail' => $request->detail
        ]);

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
        $partner = Partner::find($id);
        return response()->json($partner);
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
        // dd($request->all());

        $data = Partner::find($id);
        $image_name = $request->hidden_image;
        $image = $request->file('image');


        if ($image) {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            if (file_exists('storage/app/public/'.$image_name)) {
                $del = Storage::delete($image_name );
            }

        }else {
            $new_name = $image_name ;
        }

        $data->nama = $request->nama;
        $data->image = $new_name;
        $data->detail = $request->detail;
        $data->save();


     return response()->json([['success' => 'Data updated']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $partner = Partner::find($id)->delete();
        $partner = Partner::find($id);
        $image_path = public_path().'/images/'.$partner->image;
        unlink($image_path);
        $partner->delete();
        return response()->json(['success' => 'Data deleted']);
    }
}
