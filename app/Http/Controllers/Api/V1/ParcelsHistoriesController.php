<?php

namespace App\Http\Controllers\Api\V1;

use App\ParcelsHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParcelsHistoriesRequest;
use App\Http\Requests\Admin\UpdateParcelsHistoriesRequest;

class ParcelsHistoriesController extends Controller
{
    public function index()
    {
        return ParcelsHistory::all();
    }

    public function show($id)
    {
        return ParcelsHistory::findOrFail($id);
    }

    public function update(UpdateParcelsHistoriesRequest $request, $id)
    {
        $parcels_history = ParcelsHistory::findOrFail($id);
        $parcels_history->update($request->all());
        

        return $parcels_history;
    }

    public function store(StoreParcelsHistoriesRequest $request)
    {
        $parcels_history = ParcelsHistory::create($request->all());
        

        return $parcels_history;
    }

    public function destroy($id)
    {
        $parcels_history = ParcelsHistory::findOrFail($id);
        $parcels_history->delete();
        return '';
    }
}
