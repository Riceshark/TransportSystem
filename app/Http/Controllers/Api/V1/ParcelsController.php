<?php

namespace App\Http\Controllers\Api\V1;

use App\Parcel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParcelsRequest;
use App\Http\Requests\Admin\UpdateParcelsRequest;

class ParcelsController extends Controller
{
    public function index()
    {
        return Parcel::all();
    }

    public function show($id)
    {
        return Parcel::findOrFail($id);
    }

    public function update(UpdateParcelsRequest $request, $id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->update($request->all());
        

        return $parcel;
    }

    public function store(StoreParcelsRequest $request)
    {
        $parcel = Parcel::create($request->all());
        

        return $parcel;
    }

    public function destroy($id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->delete();
        return '';
    }
}
