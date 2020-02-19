<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transportasi'  => 'required',
            'asal'          => 'required',
            'tujuan'        => 'required',
            'jalur'         => 'required',
            'berangkat'     => 'required',
            // 'pulang'        => 'required',
            'durasi'        => 'required'
        ];
    }

    public function message(){
        return[
            'transportasi.required' => 'transportasi is required',
            'asal.required'         => 'asal is required',
            'tujuan.required'       => 'tujuan is required',
            'jalur.required'        => 'jalur is required',
            'berangkat.required'    => 'berangkat is required',
            'durasi.required'       => 'durasi is required'
        ];
    }
}
