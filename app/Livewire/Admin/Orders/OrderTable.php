<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Models\Driver;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public $drivers;

    public $new_shipment = [
        'openModal' => false,
        'order_id' => '',
        'driver_id' => '',
    ];

    public function mount()
    {
        $this->drivers = Driver::all();
    }

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

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'Todos',
                    2 => 'Procesando',
                    3 => 'Enviado',
                    4 => 'Completado',
                    5 => 'Fallido',
                    6 => 'Reembolsado',
                    7 => 'Cancelado',
                ])->filter(function ($query, $value) {
                    $query->where('status', $value);
                }),
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

    public function customView(): string
    {
        return 'admin.orders.modal';
    }

    public function assingDriver(Order $order)
    {
        $this->new_shipment['order_id'] = $order->id;
        $this->new_shipment['openModal'] = true;
    }

    public function saveShipment()
    {
        $this->validate([
            'new_shipment.driver_id' => 'required|exists:drivers,id',
        ]);

        $order = Order::find($this->new_shipment['order_id']);
        $order->status = OrderStatus::Shipped;
        $order->save();

        $order->shipments()->create([
            'driver_id' => $this->new_shipment['driver_id'],
        ]);
        $this->reset('new_shipment');
    }

    public function markAsRefunded(Order $order)
    {
        $order->status = OrderStatus::Refunded;
        $order->save();
    }
}
