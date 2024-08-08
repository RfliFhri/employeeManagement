<?php

use App\Http\Controllers\EmployeesController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmployeesController::class, 'index'])->name('employees.index');
Route::post('/', [EmployeesController::class, 'store'])->name('employees.store');
