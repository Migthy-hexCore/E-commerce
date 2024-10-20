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
        'name' => $driver->user->name,
    ],
]">

    <div class="bg-slate-600 rounded-lg shadow-lg p-8">
        <x-validation-errors class="mb-4" />
        <form action="{{ route('admin.drivers.update', $driver) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-label class="mb-1">
                    Usuario:
                </x-label>

                <x-select class="w-full" name="user_id">
                    <option value="" selected disabled>
                        Selecciona un usuario
                    </option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == old('user_id', $driver->user_id))>
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

                        <option value="1" @selected(old('type', $driver->type) == 1)>
                            Motocicleta
                        </option>

                        <option value="2" @selected(old('type', $driver->type) == 2)>
                            Automóvil
                        </option>
                    </x-select>

                </div>

                <div>
                    <x-label class="mb-1">
                        Placa
                    </x-label>

                    <x-input name="plate_number" value="{{ old('plate_number', $driver->plate_number) }}" class="w-full"
                        placeholder="Ingrese la placa del vehiculo" />
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button>
                    Actualizar
                </x-button>
            </div>

        </form>
    </div>

    <form action="{{ route('admin.drivers.destroy', $driver) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "Estás seguro?",
                    text: "No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminarlo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
