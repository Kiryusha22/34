<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Маршруты для сотрудников
Route::get('/employees', [AdminController::class, 'showEmployees'])->name('admin.employees.index');
Route::get('/employees/create', [AdminController::class, 'createEmployee'])->name('admin.employees.create');
Route::post('/employees', [AdminController::class, 'storeEmployee'])->name('admin.employees.store');
Route::get('/employees/{employee}', [AdminController::class, 'showEmployee'])->name('admin.employees.show');
Route::delete('/employees/{employee}', [AdminController::class, 'deleteEmployee'])->name('admin.employees.delete');

// Маршруты для смен
Route::get('/shifts', [AdminController::class, 'showShifts'])->name('admin.shifts.index');
Route::post('/shifts/create', [AdminController::class, 'createShift'])->name('admin.shifts.create');
Route::put('/shifts/{shift}/open', [AdminController::class, 'openShift'])->name('admin.shifts.open');
Route::put('/shifts/{shift}/close', [AdminController::class, 'closeShift'])->name('admin.shifts.close');
Route::post('/shifts/{shift}/employees', [AdminController::class, 'addEmployeesToShift'])->name('admin.shifts.addEmployees');
Route::delete('/shifts/{shift}/employees/{employee}', [AdminController::class, 'removeEmployeeFromShift'])->name('admin.shifts.removeEmployee');

Route::prefix('chef')->group(function () {
    // Создание нового заказа
    Route::post('{{host}}/api-cafe/order', [ChefController::class, 'createOrder'])->name('chef.orders.create');

    // Просмотр конкретного заказа
    Route::get('{{host}}/api-cafe/order/1', [ChefController::class, 'showOrder'])->name('chef.orders.show');

    // Просмотр списка принятых заказов за смену
    Route::get('/shifts/{shift}/orders', [ChefController::class, 'showShiftOrders'])->name('chef.shifts.orders.index');

    // Изменение статуса заказа
    Route::put('/orders/{order}/update-status', [ChefController::class, 'updateOrderStatus'])->name('chef.orders.updateStatus');

    // Добавление позиции в заказ
    Route::post('/orders/{order}/items/add', [ChefController::class, 'addOrderItem'])->name('chef.orders.items.add');

    // Удаление позиции из заказа
    Route::delete('/orders/items/{item}', [ChefController::class, 'removeOrderItem'])->name('chef.orders.items.remove');
});

// Маршруты для заказов
Route::get('/shifts/{shift}/orders', [AdminController::class, 'showShiftOrders'])->name('admin.shifts.orders.index');
