<?php

namespace App\Http\Controllers\Admin;

use App\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParcelsRequest;
use App\Http\Requests\Admin\UpdateParcelsRequest;

class ParcelsController extends Controller
{
    /**
     * Display a listing of Parcel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('parcel_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('parcel_delete')) {
                return abort(401);
            }
            $parcels = Parcel::onlyTrashed()->get();
        } else {
            $parcels = Parcel::all();
        }

        return view('admin.parcels.index', compact('parcels'));
    }

    /**
     * Show the form for creating new Parcel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('parcel_create')) {
            return abort(401);
        }
        return view('admin.parcels.create');
    }

    /**
     * Store a newly created Parcel in storage.
     *
     * @param  \App\Http\Requests\StoreParcelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParcelsRequest $request)
    {
        if (! Gate::allows('parcel_create')) {
            return abort(401);
        }
        $parcel = Parcel::create($request->all());



        return redirect()->route('admin.parcels.index');
    }


    /**
     * Show the form for editing Parcel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('parcel_edit')) {
            return abort(401);
        }
        $parcel = Parcel::findOrFail($id);

        return view('admin.parcels.edit', compact('parcel'));
    }

    /**
     * Update Parcel in storage.
     *
     * @param  \App\Http\Requests\UpdateParcelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParcelsRequest $request, $id)
    {
        if (! Gate::allows('parcel_edit')) {
            return abort(401);
        }
        $parcel = Parcel::findOrFail($id);
        $parcel->update($request->all());



        return redirect()->route('admin.parcels.index');
    }


    /**
     * Display Parcel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('parcel_view')) {
            return abort(401);
        }
        $parcels_histories = \App\ParcelsHistory::where('parcel_id', $id)->get();

        $parcel = Parcel::findOrFail($id);

        return view('admin.parcels.show', compact('parcel', 'parcels_histories'));
    }


    /**
     * Remove Parcel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('parcel_delete')) {
            return abort(401);
        }
        $parcel = Parcel::findOrFail($id);
        $parcel->delete();

        return redirect()->route('admin.parcels.index');
    }

    /**
     * Delete all selected Parcel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('parcel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Parcel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Parcel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('parcel_delete')) {
            return abort(401);
        }
        $parcel = Parcel::onlyTrashed()->findOrFail($id);
        $parcel->restore();

        return redirect()->route('admin.parcels.index');
    }

    /**
     * Permanently delete Parcel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('parcel_delete')) {
            return abort(401);
        }
        $parcel = Parcel::onlyTrashed()->findOrFail($id);
        $parcel->forceDelete();

        return redirect()->route('admin.parcels.index');
    }
}
