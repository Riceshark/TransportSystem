<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParcelsRequest extends FormRequest
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
            
            'state' => 'required',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'delivery_type' => 'required',
            'cost' => 'nullable|numeric',
            'location_address'=>'required',
            'location_latitude'=>'required',
            'location_longitude'=>'required',
            'origin_address'=>'required',
            'origin_latitude'=>'required',
            'origin_longitude'=>'required',
            'destination_address'=>'required',
            'destination_latitude'=>'required',
            'destination_longitude'=>'required',
            'priority' => 'min:1|max:5|required|numeric',
            'delivery_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
        ];
    }
}
