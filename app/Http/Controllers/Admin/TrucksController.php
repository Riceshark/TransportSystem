<?php

namespace App\Http\Controllers\Admin;

use App\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrucksRequest;
use App\Http\Requests\Admin\UpdateTrucksRequest;

class TrucksController extends Controller
{
    /**
     * Display a listing of Truck.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('truck_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('truck_delete')) {
                return abort(401);
            }
            $trucks = Truck::onlyTrashed()->get();
        } else {
            $trucks = Truck::all();
        }

        return view('admin.trucks.index', compact('trucks'));
    }

    /**
     * Show the form for creating new Truck.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('truck_create')) {
            return abort(401);
        }
        return view('admin.trucks.create');
    }

    /**
     * Store a newly created Truck in storage.
     *
     * @param  \App\Http\Requests\StoreTrucksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrucksRequest $request)
    {
        if (! Gate::allows('truck_create')) {
            return abort(401);
        }
        $truck = Truck::create($request->all());



        return redirect()->route('admin.trucks.index');
    }


    /**
     * Show the form for editing Truck.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('truck_edit')) {
            return abort(401);
        }
        $truck = Truck::findOrFail($id);

        return view('admin.trucks.edit', compact('truck'));
    }

    /**
     * Update Truck in storage.
     *
     * @param  \App\Http\Requests\UpdateTrucksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrucksRequest $request, $id)
    {
        if (! Gate::allows('truck_edit')) {
            return abort(401);
        }
        $truck = Truck::findOrFail($id);
        $truck->update($request->all());



        return redirect()->route('admin.trucks.index');
    }


    /**
     * Display Truck.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('truck_view')) {
            return abort(401);
        }

        $truck = Truck::findOrFail($id);

        return view('admin.trucks.show', compact('truck'));
    }


    /**
     * Remove Truck from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('truck_delete')) {
            return abort(401);
        }
        $truck = Truck::findOrFail($id);
        $truck->delete();

        return redirect()->route('admin.trucks.index');
    }

    /**
     * Delete all selected Truck at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('truck_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Truck::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Truck from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('truck_delete')) {
            return abort(401);
        }
        $truck = Truck::onlyTrashed()->findOrFail($id);
        $truck->restore();

        return redirect()->route('admin.trucks.index');
    }

    /**
     * Permanently delete Truck from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('truck_delete')) {
            return abort(401);
        }
        $truck = Truck::onlyTrashed()->findOrFail($id);
        $truck->forceDelete();

        return redirect()->route('admin.trucks.index');
    }
}
