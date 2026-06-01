<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\EmployeeRequest;
use App\DataTables\EmployeeDataTable;

class EmployeeController extends Controller
{

    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('dashboard.employees.index');
    }


    public function create()
    {
        return view('dashboard.employees.create');
    }


    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->getSanitized());
        session()->flash('message', 'Employee Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.employees.edit', $employee);
    }


    public function show(Employee $employee)
    {
        //
    }


    public function edit(Employee $employee)
    {
        return view('dashboard.employees.edit', compact('employee'));
    }


    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->getSanitized());
        session()->flash('message', 'Employee Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'message' => 'Employee Deleted Successfully!'
        ]);
    }
}
