<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query();

        if ($request->date) {
            $orders->whereDate('created_at', $request->date);
        }

        if ($request->status) {
            $orders->where('status_message', $request->status);
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
    public function show(int $orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            return view('admin.orders.view', compact('order')); // Pastikan tampilan menerima variabel 'order'
        } else {
            return redirect()->route('admin.orders')->with('message', 'There are no orders for goods');
        }
    }
    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect()->route('admin.orderDetails', ['orderId' => $orderId])->with('message', 'Order Status Updated');
        } else {
            return redirect()->route('admin.orders')->with('message', 'Order not found');
        }
    }
    public function viewInvoice(int $orderId) 
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }
    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice.'.$order->id.'.'.$todayDate.'.pdf');
    }

}
