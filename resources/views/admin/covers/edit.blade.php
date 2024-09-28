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
        'name' => 'Editar',
    ],
]">

    <div class="card">
        <form action="{{ route('admin.covers.update', $cover) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                <img id="imgPreview" src="{{ $cover->image }}" class="aspect-[3/1] w-full object-cover object-center">
            </figure>

            <div class="mb-4">
                <x-label>
                    Nombre de la portada
                </x-label>
                <x-input name="title" value="{{ old('title', $cover->title) }}" class="w-full"
                    placeholder="Ingresa el nombre de la portada" />
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de inicio
                </x-label>
                <x-input type="date" name="start_at" value="{{ old('start_at', $cover->start_at->format('Y-m-d')) }}"
                    class="w-full" placeholder="Ingresa el nombre de la portada" />
            </div>

            <div class="mb-4">
                <x-label>
                    Fecha de fin (opcional)
                </x-label>
                <x-input type="date" name="end_at"
                    value="{{ old('end_at', $cover->end_at ? $cover->end_at->format('Y-m-a') : '') }}" class="w-full"
                    placeholder="Ingresa el nombre de la portada" />
            </div>

            <div class="mb-4 flex space-x-4">
                <label>
                    <x-input type="radio" name="is_active" value="1" :checked="$cover->is_active == 1" />
                    Activo
                </label>

                <label>
                    <x-input type="radio" name="is_active" value="0" :checked="$cover->is_active == 0" />
                    Inactivo
                </label>
            </div>

            <div class="flex justify-end">
                <x-button class="bg-gray-700">
                    Actualizar
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
