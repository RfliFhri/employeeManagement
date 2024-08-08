<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('position', 'like', "%{$request->search}%");
        }

        if ($request->has('sort_by')) {
            $query->orderBy($request->sort_by, $request->sort_order ?? 'asc');
        }

        $employees = $query->get()->all();

        return view('employees.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'hire_date' => 'required|date',
            'position' => 'required',
        ]);
        $hireDate = \DateTime::createFromFormat('m/d/Y', $request->hire_date)->format('Y-m-d');

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'hire_date' => $hireDate,
            'position' => $request->position,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

}
