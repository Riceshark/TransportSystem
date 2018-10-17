<?php

namespace App\Http\Controllers\Api\V1;

use App\Truck;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParcelsRequest;
use App\Http\Requests\Admin\UpdateParcelsRequest;

class TrucksController extends Controller
{
    public function index()
    {
        return Truck::all();
    }

    public function show($id)
    {
        return Truck::findOrFail($id);
    }

    public function update(UpdateParcelsRequest $request, $id)
    {
        $truck = Truck::findOrFail($id);
        $truck->update($request->all());


        return $truck;
    }

    public function store(StoreParcelsRequest $request)
    {
        $truck = Truck::create($request->all());


        return $truck;
    }

    public function destroy($id)
    {
        $truck = Truck::findOrFail($id);
        $truck->delete();
        return '';
    }
}
