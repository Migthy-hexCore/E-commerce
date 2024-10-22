<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button wire:click="markAsProcessing({{ $order->id }})" class="text-indigo-300 hover:underline">
                <a href="">
                    Listo para enviar
                </a>
            </button>
        @break

        @case(\App\Enums\OrderStatus::Processing)
            <button wire:click="assingDriver({{ $order->id }})" class="text-indigo-300 hover:underline">
                Asignar repartidor
            </button>
        @break

        @case(\App\Enums\OrderStatus::Failed)
            <button wire:click="markAsRefunded({{ $order->id }})" class="text-indigo-300 hover:underline">
                Marcar como devuelto
            </button>
        @break

        @default
    @endswitch
    <button class="underline text-red-300 hover:no-underline">
        Cancelar
    </button>
</div>
