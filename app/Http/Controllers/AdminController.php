<?php

namespace App\Http\Controllers;

use App\Models\ShiftWorker;
use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    // Просмотр списка всех сотрудников
    public function showEmployees()
    {
        $employees = User::all();
        return view('admin.employees.index', compact('employees'));
    }

    // Добавление новой карточки сотрудника
    public function createEmployee()
    {
        return view('admin.employees.create');
    }

    // Просмотр информации о конкретном сотруднике
    public function showEmployee( User $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    // Увольнение сотрудника
    public function deleteEmployee(User $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully');
    }


    // Добавление новой смены
    public function createShift(Request $request)
    {
        // Валидация данных из запроса
        $this->validate($request, [
            'name' => 'required|string',
            // другие необходимые правила валидации...
        ]);

        // Создание новой смены на основе полученных данных
        $shift = new ShiftWorker();
        $shift->name = $request->name;


        $shift->save();

        return redirect()->route('admin.shifts.index')->with('success', 'Shift created successfully');
    }

    // Просмотр всех смен
    public function showShifts()
    {
        $shifts = ShiftWorker::all();
        return view('admin.shifts.index', compact('shifts'));
    }

    // Закрытие смены
    public function closeShift(ShiftWorker $shift)
    {
        $shift->closed = true;
        $shift->save();
        return redirect()->route('admin.shifts.index')->with('success', 'Shift closed successfully');
    }

    // Открытие смены
    public function openShift(ShiftWorker $shift)
    {
        $shift->update(['closed' => false]);
        return redirect()->route('admin.shifts.index')->with('success', 'Shift opened successfully');
    }

    // Добавление сотрудников на смену
    public function addEmployeesToShift(Request $request, ShiftWorker $shift)
    {
        // Валидация данных из запроса
        $this->validate($request, [
            'employee_ids' => 'required|array',
            // другие необходимые правила валидации...
        ]);

        // Добавление сотрудников к смене
        $shift->employees()->attach($request->employee_ids);

        return redirect()->route('admin.shifts.index')->with('success', 'Employees added to shift successfully');
    }

    // Удаление сотрудника из смены
    public function removeEmployeeFromShift(ShiftWorker $shift, User $employee)
    {
        // Удаление сотрудника из смены
        $shift->employees()->detach($employee->id);

        return redirect()->route('admin.shifts.index')->with('success', 'Employee removed from shift successfully');
    }

    // Просмотр списка заказов за смену
    public function showShiftOrders(ShiftWorker $shift)
    {
        $orders = $shift->orders;
        return view('admin.orders.index', compact('orders'));
    }

}
