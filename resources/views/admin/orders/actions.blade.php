<div class="flex flex-col space-y-2">
    @switch($order->status)
        @case(\App\Enums\OrderStatus::Pending)
            <button wire:click="markAsProcessing({{$order->id}})" class="underline text-indigo-300 hover:no-underline">
                <a href="">
                    Listo para enviar
                </a>
            </button>
        @break

        @case(\App\Enums\OrderStatus::Processing)
            <button class="underline text-indigo-300 hover:no-underline">
                <a href="">
                    Asignar repartidor
                </a>
            </button>
        @break

        @default
    @endswitch
    <button class="underline text-red-300 hover:no-underline">
        <a href="">
            Cancelar
        </a>
    </button>
</div>
