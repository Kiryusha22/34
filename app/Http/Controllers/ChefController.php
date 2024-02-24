<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\ShiftWorker;
use Illuminate\Http\Request;

class ChefController extends Controller
{
    // Добавление нового заказа
    public function createOrder(Request $request)
    {
        // Ваша логика создания нового заказа
        $order = new Order();
        $order->status = 'accepted'; // Например, при создании заказа его статус может быть сразу "принят"
        $order->save();

        return redirect()->route('chef.orders.show', $order)->with('success', 'New order created successfully');
    }

    // Просмотр конкретного выписанного заказа
    public function showOrder(Order $order)
    {
        return view('chef.orders.show', compact('order'));
    }

    // Просмотр списка принятых заказов за смену
    public function showShiftOrders(ShiftWorker $shift)
    {
        $orders = $shift->orders()->where('status', 'accepted')->get();
        return view('chef.orders.index', compact('orders'));
    }

    // Изменение статуса заказа
    public function updateOrderStatus(Order $order, Request $request)
    {
        // Валидация данных из запроса
        $this->validate($request, [
            'status' => 'required|in:preparing,ready,served,cancelled',
        ]);

        // Обновление статуса заказа
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    // Добавление позиции в заказ
    public function addOrderItem(Order $order, Request $request)
    {
        // Валидация данных из запроса
        $this->validate($request, [
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',

        ]);

        // Создание новой позиции в заказе
        $menuItem = Menu::findOrFail($request->menu_item_id);
        $orderItem = new Order([
            'menu_item_id' => $menuItem->id,
            'quantity' => $request->quantity,

        ]);
        $order->items()->save($orderItem);

        return redirect()->route('chef.orders.show', $order)->with('success', 'Item added to order successfully');
    }

    // Удаление позиции из заказа
    public function removeOrderItem(Order $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Order item removed successfully');
    }
}
