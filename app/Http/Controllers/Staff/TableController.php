<?php

namespace App\Http\Controllers\Staff;

use App\DataTables\TableDataTable;
use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TableDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('staff.table.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'status' => ['required', 'boolean']
        ]);
        $table = new Table();
        $table->name = $request->name;
        $table->status = $request->status;
        $table->save();

        toastr()->success('Created Successfully');

        return to_route('staff.table.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $table = Table::findOrFail($id);
        return view('staff.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'status' => ['required', 'boolean']
        ]);
        $table = Table::findOrFail($id);
        $table->name = $request->name;
        $table->status = $request->status;
        $table->save();

        toastr()->success('Created Successfully');

        return to_route('staff.table.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $table = Table::findOrFail($id);
            $table->delete();

            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
