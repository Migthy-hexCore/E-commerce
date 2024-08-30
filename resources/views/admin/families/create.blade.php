<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.families.store') }}" method="POST">
            @csrf
            <x-validation-errors class="mb-4" :errors="$errors"/>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre:
                </x-label>
                
                <x-input class="w-full"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Ingrese el nombre de la familia">
                </x-input>
            </div>
            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
