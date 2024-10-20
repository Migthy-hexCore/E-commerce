<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("N° Orden", "id")
                ->sortable(),

            Column::make('Ticket')->label(function ($row) {
                return view('admin.orders.ticket', ['order' => $row]);
            }),

            Column::make("F. Orden", "created_at")->format(function ($value) {
                return $value->format('d/m/Y');
            })->sortable(),

            Column::make('Total')->format(function ($value) {
                return '$MXN' . ' ' . number_format($value, 2);
            })->sortable(),

            Column::make('Cantidad', 'content')->format(function ($value) {
                return count($value);
            }),

            Column::make('Status')->format(function ($value) {
                return $value->name;
            }),

            Column::make('Acciones')->label(function ($row) {
                return view('admin.orders.actions', ['order' => $row]);
            })
        ];
    }

    public function downloadTicket(Order $order)
    {
        return Storage::download($order->pdf_path);
    }

    public function markAsProcessing(Order $order)
    {
        $order->status = OrderStatus::Processing;
        $order->save();
    }
}
