<div>
    @can('añadir un nuevo egreso')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <form wire:submit="save">
            
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Cantidad Egresada
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.cantidadegresada" />
                <x-input-error for="postCreate.cantidadegresada" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Fecha de Egreso
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.fechaegreso" />
                <x-input-error for="postCreate.fechaegreso" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Precio Unitario del Egreso
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.preciounitarioegreso" />
                <x-input-error for="postCreate.preciounitarioegreso" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Insumo
                </x-label>
                <x-select class="w-full" wire:model="postCreate.insumo_id">

                    <option value="" disabled>Seleccione un Insumo</option>

                    @foreach ($insumos as $insumo)
                        <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.insumo_id" />
            </div>
            
            <div class="flex justify-end">
                <x-button>
                    Crear
                </x-button>
            </div>
        </form>
    </div>
    @endcan
    
    
    <!--Formulario para ver los posts creados / En este se aplicara el can-->
    @can('ver lista de egresos')
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <ul class="list-disc list-inside space-y-2">
                @foreach ($egresos as $egreso)
                    <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
                        wire:key="egreso--{{ $egreso->id }}">
                        {{ $egreso->fechaegreso }}
                        <div>
                            <x-button wire:click="edit({{ $egreso->id }})">Editar</x-button>
                            <x-danger-button wire:click="destroy({{ $egreso->id }})">Eliminar</x-danger-button>
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
                        Cantidad Egresada
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.cantidadegresada" />
                    <x-input-error for="postEdit.cantidadegresada" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Fecha de Egreso
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.fechaegreso" />
                    <x-input-error for="postEdit.fechaegreso" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Precio Unitario del Egreso
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.preciounitarioegreso" />
                    <x-input-error for="postEdit.preciounitarioegreso" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Insumo
                    </x-label>
                    <x-select class="w-full" wire:model="postEdit.insumo_id"> 
    
                        <option value="" disabled>Seleccione un Insumo</option>
    
                        @foreach ($insumos as $insumo)
                            <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="postEdit.insumo_id" />
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


