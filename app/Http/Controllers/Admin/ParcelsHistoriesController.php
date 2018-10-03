<?php

namespace App\Http\Controllers\Admin;

use App\ParcelsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParcelsHistoriesRequest;
use App\Http\Requests\Admin\UpdateParcelsHistoriesRequest;

class ParcelsHistoriesController extends Controller
{
    /**
     * Display a listing of ParcelsHistory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('parcels_history_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('parcels_history_delete')) {
                return abort(401);
            }
            $parcels_histories = ParcelsHistory::onlyTrashed()->get();
        } else {
            $parcels_histories = ParcelsHistory::all();
        }

        return view('admin.parcels_histories.index', compact('parcels_histories'));
    }

    /**
     * Show the form for creating new ParcelsHistory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('parcels_history_create')) {
            return abort(401);
        }
        
        $parcels = \App\Parcel::get()->pluck('state', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.parcels_histories.create', compact('parcels'));
    }

    /**
     * Store a newly created ParcelsHistory in storage.
     *
     * @param  \App\Http\Requests\StoreParcelsHistoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParcelsHistoriesRequest $request)
    {
        if (! Gate::allows('parcels_history_create')) {
            return abort(401);
        }
        $parcels_history = ParcelsHistory::create($request->all());



        return redirect()->route('admin.parcels_histories.index');
    }


    /**
     * Show the form for editing ParcelsHistory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('parcels_history_edit')) {
            return abort(401);
        }
        
        $parcels = \App\Parcel::get()->pluck('state', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $parcels_history = ParcelsHistory::findOrFail($id);

        return view('admin.parcels_histories.edit', compact('parcels_history', 'parcels'));
    }

    /**
     * Update ParcelsHistory in storage.
     *
     * @param  \App\Http\Requests\UpdateParcelsHistoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParcelsHistoriesRequest $request, $id)
    {
        if (! Gate::allows('parcels_history_edit')) {
            return abort(401);
        }
        $parcels_history = ParcelsHistory::findOrFail($id);
        $parcels_history->update($request->all());



        return redirect()->route('admin.parcels_histories.index');
    }


    /**
     * Display ParcelsHistory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('parcels_history_view')) {
            return abort(401);
        }
        $parcels_history = ParcelsHistory::findOrFail($id);

        return view('admin.parcels_histories.show', compact('parcels_history'));
    }


    /**
     * Remove ParcelsHistory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('parcels_history_delete')) {
            return abort(401);
        }
        $parcels_history = ParcelsHistory::findOrFail($id);
        $parcels_history->delete();

        return redirect()->route('admin.parcels_histories.index');
    }

    /**
     * Delete all selected ParcelsHistory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('parcels_history_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ParcelsHistory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ParcelsHistory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('parcels_history_delete')) {
            return abort(401);
        }
        $parcels_history = ParcelsHistory::onlyTrashed()->findOrFail($id);
        $parcels_history->restore();

        return redirect()->route('admin.parcels_histories.index');
    }

    /**
     * Permanently delete ParcelsHistory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('parcels_history_delete')) {
            return abort(401);
        }
        $parcels_history = ParcelsHistory::onlyTrashed()->findOrFail($id);
        $parcels_history->forceDelete();

        return redirect()->route('admin.parcels_histories.index');
    }
}
