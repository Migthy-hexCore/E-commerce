<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.covers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-validation-errors class="mb-4" />
            <figure class="relative mb-4">
                <div class="absolute top-8 right-8">
                    <label
                        class="flex items-center px-4 py-2 rounded-lg bg-gray-500 cursor-pointer text-gray-200 text-sm">
                        <i class="fas fa-camera mr-2">
                            Agregar imagen
                            <input name="image" type="file" class="hidden" accept="image/*"
                                onchange="previewImage(event, '#imgPreview')">
                        </i>
                    </label>
                </div>
                <img id="imgPreview" src="{{ asset('img/image-no-avaliable-cover.png') }}"
                    class="aspect-[3/1] w-full object-cover object-center">
            </figure>

            <div class="mb-4">
                <x-label>
                    Nombre de la portada
                </x-label>
                <x-input name="title" value="{{ old('title') }}" class="w-full"
                    placeholder="Ingresa el nombre de la portada" />
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de inicio
                </x-label>
                <x-input type="date" name="start_at" value="{{ old('start_at', now()->format('Y-m-d')) }}"
                    class="w-full" placeholder="Ingresa el nombre de la portada" />
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de fin (opcional)
                </x-label>
                <x-input type="date" name="end_at" value="{{ old('end_at') }}" class="w-full"
                    placeholder="Ingresa el nombre de la portada" />
            </div>

            <div class="mb-4 flex space-x-4">
                <label>
                    <x-input type="radio" name="is_active" value="1" checked />
                    Activo
                </label>

                <label>
                    <x-input type="radio" name="is_active" value="0" />
                    Inactivo
                </label>
            </div>

            <div class="flex justify-end">
                <x-button class="bg-gray-700">
                    Guardar
                </x-button>

            </div>

        </form>
    </div>

    @push('js')
        <script>
            function previewImage(event, querySelector) {
                const input = event.target;
                $imgPreview = document.querySelector(querySelector);
                if (!input.files.length) return
                file = input.files[0];
                objectURL = URL.createObjectURL(file);
                $imgPreview.src = objectURL;
            }
        </script>
    @endpush

</x-admin-layout>
