<div>
    @can('añadir un nuevo ingreso')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <form wire:submit="save">
            
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Cantidad Ingresada
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.cantidadingresada" />
                <x-input-error for="postCreate.cantidadingresada" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Fecha de Ingreso
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.fechaingreso" />
                <x-input-error for="postCreate.fechaingreso" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Precio Unitario del Ingreso
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.preciounitarioingreso" />
                <x-input-error for="postCreate.preciounitarioingreso" />
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
    @can('ver lista de ingresos')
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <ul class="list-disc list-inside space-y-2">
                @foreach ($ingresos as $ingreso)
                    <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
                        wire:key="ingreso--{{ $ingreso->id }}">
                        {{ $ingreso->fechaingreso }}
                        <div>
                            <x-button wire:click="edit({{ $ingreso->id }})">Editar</x-button>
                            <x-danger-button wire:click="destroy({{ $ingreso->id }})">Eliminar</x-danger-button>
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
                        Cantidad Ingresada
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.cantidadingresada" />
                    <x-input-error for="postEdit.cantidadingresada" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Fecha de Ingreso
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.fechaingreso" />
                    <x-input-error for="postEdit.fechaingreso" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Precio Unitario del Ingreso
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.preciounitarioingreso" />
                    <x-input-error for="postEdit.preciounitarioingreso" />
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



