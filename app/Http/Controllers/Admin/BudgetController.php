<?php

namespace App\Http\Controllers\Admin;

use App\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{

    public function index()
    {
        if (! Gate::allows('budget_access')) {
            return abort(401);
        }

        $budgets = Budget::all();

        return view('admin.budgets.index', compact('budgets'));
    }

    public function create()
    {
        if (! Gate::allows('budget_create')) {
            return abort(401);
        }
        return view('admin.budgets.create');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('budget_create')) {
            return abort(401);
        }

        $budget = Budget::create($request->all());

        return redirect()->route('admin.budgets.index');
    }


    public function edit($id)
    {
        if (! Gate::allows('budget_edit')) {
            return abort(401);
        }
        $budget = Budget::findOrFail($id);

        return view('admin.budgets.edit', compact('budget'));
    }


    public function update(Request $request, $id)
    {
        if (! Gate::allows('budget_edit')) {
            return abort(401);
        }

        $budget = Budget::findOrFail($id);
        $budget->update($request->all());

        return redirect()->route('admin.budgets.index');
    }


    public function show($id)
    {
        if (! Gate::allows('budget_view')) {
            return abort(401);
        }

        $budget = Budget::findOrFail($id);

        return view('admin.budgets.show', compact('budget'));
    }

    public function destroy($id)
    {
        if (! Gate::allows('budget_delete')) {
            return abort(401);
        }
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('admin.budgets.index');
    }

    public function massDestroy(Request $request)
    {
        if (! Gate::allows('budget_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Budget::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
