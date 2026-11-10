<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('last_name')->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|max:50|unique:employees,employee_id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:employees,email',
            'department' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'basic_salary' => 'required|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_id' => [
                'required', 'string', 'max:50',
                Rule::unique('employees', 'employee_id')->ignore($employee->getKey(), $employee->getKeyName()),
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('employees', 'email')->ignore($employee->getKey(), $employee->getKeyName()),
            ],
            'department' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'basic_salary' => 'required|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
