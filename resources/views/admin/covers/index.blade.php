<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
    ],
]">

    <x-slot name="action">
        <a href="{{ route('admin.covers.create') }}" class="btn btn-blue">
            Nueva Portada
        </a>
    </x-slot>

    <ul class="space-y-4" id="covers">
        @foreach ($covers as $cover)
            <li class="bg-slate-700 rounded-lg shadow-lg overflow-hidden lg:flex cursor-move"
                data-id="{{ $cover->id }}">
                <img src="{{ $cover->image }}" class="w-full lg:w-64 aspect-[3/1] object-cover object-center">
                <div class="p-4 flex-1 flex justify-between items-center">
                    <div>
                        <h1 class="font-semibold text-white">{{ $cover->title }}</h1>
                        <p>
                            @if ($cover->is_active)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Activo</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Inactivo</span>
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">Fecha inicio:</p>
                        <p class="text-gray-400">{{ $cover->start_at->format('d/m/Y') }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">Fecha finalizacion:</p>
                        <p class="text-gray-400 text-center">
                            {{ $cover->end_at ? $cover->end_at->format('d/m/Y') : '-' }}</p>
                    </div>

                    <div>
                        <a class="text-white btn btn-blue" href="{{ route('admin.covers.edit', $cover) }}">
                            Editar
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'blue-background-class',
                store: {
                    set: (sortable) => {
                        const sorts = sortable.toArray();
                        axios.post("{{ route('api.sort.covers') }}", {
                            sorts: sorts
                        }).catch((error) => {
                            console.log(error);
                        });
                    }
                }
            });
        </script>
    @endpush

</x-admin-layout>
