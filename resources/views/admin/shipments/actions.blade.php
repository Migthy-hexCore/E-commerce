@if ($shipment->status == \App\Enums\ShipmentStatus::Pending)
    <button wire:click="markAsCompleted({{ $shipment->id }})" class="text-indigo-300 hover:underline">
        Marcar como entregado
    </button>
    <br>
    <button wire:click="markAsFailed({{ $shipment->id }})" class="text-indigo-300 hover:underline">
        Marcar como error en la entrega
    </button>
@endif
