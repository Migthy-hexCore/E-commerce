<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type = '';
    public $description = '';
    public $region = '';
    public $reference = '';
    public $receiver = 1; // 1 = El usuario que solicito el envio recibira el paquete, 0 = Otra persona recibira el paquete
    public $receiver_info = [];
    public $default = false; // Si es la direccion por defecto del usuario 


}
