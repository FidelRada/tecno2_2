<div>
    @can('añadir una nueva categoria de diseño')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <form wire:submit="save">
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Nombre
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.nombre" />
                <x-input-error for="postCreate.nombre" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Descripcion
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.descripcion" />
                <x-input-error for="postCreate.descripcion" />
            </div>
            <div class="flex justify-end">
                <x-button>
                    Crear
                </x-button>
            </div>
        </form>
    </div>
    @endcan

    @can('ver lista de categorias de diseño')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <ul class="list-disc list-inside space-y-2">
            @foreach ($categoriaDiseño as $categoria)
                <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
                    wire:key="servicio--{{ $categoria->id }}">
                    {{ $categoria->nombre }} || {{ $categoria->descripcion }}

                    <div>
                        @can('editar una categoria de diseño')
                        <x-button wire:click="edit({{ $categoria->id }})">Editar</x-button>
                        @endcan
                        @can('eliminar una categoria de diseño')
                        <x-danger-button wire:click="destroy({{ $categoria->id }})">Eliminar</x-danger-button>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    @endcan

    <form wire:submit="update">
        <x-dialog-modal wire:model="open">
            <x-slot name="title">
                Actualizar Post
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Nombre
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.nombre" />
                    <x-input-error for="postEdit.nombre" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Descripcion
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.descripcion" />
                    <x-input-error for="postEdit.descripcion" />
                </div>

            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end">
                    <x-danger-button class="mr-2" wire:click="$set('open', false)">
                        Cancelar
                    </x-danger-button>
                    <x-button>
                        Actualizar
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
