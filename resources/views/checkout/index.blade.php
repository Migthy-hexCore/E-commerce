<x-app-layout>
    <div class="-mb-16 text-gray-300" x-data="{
        pago: 1,
    }">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="col-span-1 bg-gray-700">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pr-8 sm:pl-6 lg:pl-8 ml-auto">
                    <h1 class="text-2xl mb-2">
                        Pago
                    </h1>

                    <div class="shadow rounded-lg overflow-hidden border border-gray-400">
                        <ul class="divide-y divide-gray-600">
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" value="1" x-model ="pago">

                                    <span class="ml-2">
                                        Tarjeta de crédito o débito
                                    </span>

                                    <img src="{{ Storage::url('checkout\credit-cards.png') }}" class="h-6 ml-auto">
                                </label>

                                <div class="p-4 bg-gray-500 text-center border-t border-gray-800" x-show="pago == 1">
                                    <i class="fa-regular fa-credit-card text-9xl"></i>
                                    <p class="mt-2">
                                        Luego de hacer clic en "Pagar ahora", serás redirigido a la pasarela de pago
                                        para
                                        completar tu compra.
                                    </p>
                                </div>
                            <li>
                                <label class="p-4 flex items-center">
                                    <input type="radio" value="2" x-model ="pago">
                                    <span class="ml-2">
                                        Depósito bancario
                                    </span>
                                </label>

                                <div class="p-4 bg-gray-500 flex justify-center border-t border-gray-800"
                                    x-show="pago == 2" x-cloak>
                                    <div>
                                        <p>1. Pago por depósito o tranferencia bancaria</p>

                                        <p>- BBVA: 789-987654321-87</p>

                                        <p>- CCI 002 - 789-987654321</p>

                                        <p>- Razón social: Ecommer SA. C.V</p>

                                        <p>- RUC: 741852963</p>

                                        <p>2. Pago con Codi</p>

                                        <p>- Codi numero: 462 284 7897 (Ecommer SA. C.V)</p>

                                        <p>
                                            Enviar el comprobante de pago al 462 284 7897 o al correo
                                        </p>
                                    </div>
                                </div>

                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-span-1">
                <div class="lg:max-w-[40rem] py-12 px-4 lg:pl-8 sm:pr-6 lg:pr-8 mr-auto">
                    <ul class="space-y-4 mb-4">
                        @foreach (Cart::instance('shopping')->content() as $item)
                            <li class="flex items-center space-x-4 mb-8">
                                <div class="flex-shrink-0 relative">
                                    <img src="{{ $item->options->image }}" class="h-16 aspect-square">
                                    <div
                                        class="flex justify-center items-center h-6 w-6 bg-gray-200 bg-opacity-70 rounded-full absolute -right-2 -top-2">
                                        <span class="text-gray-700 font-semibold">
                                            {{ $item->qty }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex 1">
                                    <p>
                                        {{ $item->name }}
                                    </p>
                                </div>

                                <div class="flex-shrink-0">
                                    <p>
                                        {{ $item->price }} $MXN
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between">
                        <p>
                            Subtotal
                        </p>
                        <p>
                            {{ Cart::instance('shopping')->subtotal() }} $MXN
                        </p>

                    </div>

                    <div class="flex justify-between">
                        <p>
                            Precio de envio
                            <i class="fas fa-info-circle" title="El precio de envio es de 99.00 $MXN"></i>
                        </p>
                        <p>
                            99.00 $MXN
                        </p>
                    </div>

                    <hr class="my-3">
                    <div class="flex justify-between mb-4">
                        <p class="text-lg font-semibold">
                            Total
                        </p>

                        <p>
                            {{ Cart::instance('shopping')->subtotal() + 99 }} $MXN
                        </p>
                    </div>

                    <div>
                        <button class="btn btn btn-teal w-full" onclick=" VisanetCheckout.open();">
                            Pagar ahora
                        </button>
                    </div>

                    @if (session('niubiz'))
                        @php
                            $niubiz = session('niubiz');
                            $response = $niubiz['response'];
                            $purchaseNumber = $niubiz['purchaseNumber'];
                        @endphp
                        @isset($response['data'])
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 mt-8"
                                role="alert">
                                <p class="mb-4">
                                    {{ $response['data']['ACTION_DESCRIPTION'] }}
                                </p>

                                <p>
                                    <b>Número de pedido</b>
                                    {{ $purchaseNumber }}
                                </p>

                                <p>
                                    <b>Fecha y hora del pedido</b>
                                    {{ now()->createFromFormat('ymdHis', $response['data']['TRANSACTION_DATE'])->format('d-m-Y H:i:s') }}
                                </p>
                                @isset($response['data']['CARD'])
                                    <p>
                                        <b>Tarjeta</b>
                                        {{ $response['data']['CARD'] }} - ({{ $response['data']['BRAND'] }})
                                    </p>
                                @endisset

                            </div>
                        @endisset
                    @endif

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {

                let purchasenumber = Math.floor(Math.random() * 1000000000);
                let amount = {{ Cart::instance('shopping')->subtotal() + 99 }};
                let merchantid = "{{ config('services.niubiz.merchant_id') }}";

                VisanetCheckout.configure({
                    sessiontoken: '{{ $session_token }}',
                    channel: 'web',
                    merchantid: merchantid,
                    purchasenumber: purchasenumber,
                    amount: amount,
                    expirationminutes: '20',
                    timeouturl: 'about:blank',
                    merchantlogo: 'img/comercio.png',
                    formbuttoncolor: '#000000',
                    action: "{{ route('checkout.paid') }}?amount=" + amount + "&purchaseNumber=" +
                        purchasenumber,
                    complete: function(params) {
                        alert(JSON.stringify(params));
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
