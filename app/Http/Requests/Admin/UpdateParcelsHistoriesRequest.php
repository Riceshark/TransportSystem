<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParcelsHistoriesRequest extends FormRequest
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
            
            'enter_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'leave_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'parcel_id' => 'required',
            'location_address'=>'required',
            'location_latitude'=>'required',
            'location_longitude'=>'required',
        ];
    }
}
