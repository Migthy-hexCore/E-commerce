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
                                        Luego de hacer clic en "Pagar ahora", serás redirigido a la pasarela de pago para
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

                                <div class="p-4 bg-gray-500 flex justify-center border-t border-gray-800" x-show="pago == 2" x-cloak>
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
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt est, dolore perferendis
                        placeat
                        iure voluptatum illo ipsa nisi unde fugiat, ipsum dolor aliquid non illum odio a nulla
                        necessitatibus hic.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
