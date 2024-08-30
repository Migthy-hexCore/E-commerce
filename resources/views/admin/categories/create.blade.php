<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="card">
            <x-validation-errors class="mb-4" :errors="$errors"/>
            <div class="mb-4">
                <x-label class="mb-2">
                    Familia:
                </x-label>
                <x-select class="w-full" name="family_id">
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}"
                            @selected(old('family_id') == $family->id)>
                            {{ $family->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre:
                </x-label>

                <x-input class="w-full" name="name" value="{{ old('name') }}"
                    placeholder="Ingrese el nombre de la categoria">
                </x-input>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>
    </form>

</x-admin-layout>
