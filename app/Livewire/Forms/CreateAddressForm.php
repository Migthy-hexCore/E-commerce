<?php

namespace App\Livewire\Forms;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type = '';
    public $description = '';
    public $region = '';
    public $reference = '';
    public $receiver = 1; // 1 = El usuario que solicito el envio recibira el paquete, 2 = Otra persona recibira el paquete
    public $receiver_info = [];
    public $default = false; // Si es la direccion por defecto del usuario 

    public function rules()
    {
        return [
            'type' => 'required | in:2,3',
            'description' => 'required|string',
            'region' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => [
                new Enum(TypeOfDocuments::class)
            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',
            // 'default' => 'required|boolean',
        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => 'tipo de dirección',
            'description' => 'descripción',
            'region' => 'estado',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre',
            'receiver_info.last_name' => 'apellido',
            'receiver_info.document_type' => 'tipo de documento',
            'receiver_info.document_number' => 'número de documento',
            'receiver_info.phone' => 'teléfono',
        ];
    }

    public function save()
    {
        $this->validate();

        if (Auth::user()->addresses->count() === 0) {
            $this->default = true;
        }

        Address::create([
            'type' => $this->type,
            'description' => $this->description,
            'region' => $this->region,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
            'user_id' => Auth::id(),
        ]);
        $this->reset();
        $this->receiver_info = [
            'name' => Auth::user()->name,
            'last_name' => Auth::user()->last_name,
            'document_type' => Auth::user()->document_type,
            'document_number' => Auth::user()->document_number,
            'phone' => Auth::user()->phone,
        ];
    }
}
