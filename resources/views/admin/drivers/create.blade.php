<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Conductores',
        'route' => route('admin.drivers.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <div class="bg-slate-600 rounded-lg shadow-lg p-8">
        <x-validation-errors class="mb-4" />
        <form action="{{ route('admin.drivers.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label class="mb-1">
                    Usuario:
                </x-label>

                <x-select class="w-full" name="user_id">
                    <option value="" selected disabled>
                        Selecciona un usuario
                    </option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == old('user_id'))>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-label class="mb-1">
                        Tipo de unidad
                    </x-label>

                    <x-select name="type" class="w-full">
                        <option value="" selected disabled>
                            Selecciona un tipo de unidad
                        </option>

                        <option value="1" @selected(old('type') == 1)>
                            Motocicleta
                        </option>

                        <option value="2" @selected(old('type') == 2)>
                            Automóvil
                        </option>
                    </x-select>

                </div>

                <div>
                    <x-label class="mb-1">
                        Placa
                    </x-label>

                    <x-input name="plate_number" value="{{ old('plate_number') }}" class="w-full"
                        placeholder="Ingrese la placa del vehiculo" />
                </div>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>

        </form>
    </div>

</x-admin-layout>
