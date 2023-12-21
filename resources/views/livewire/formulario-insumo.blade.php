<div>
    @can('añadir un nuevo insumo')
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
                    Marca
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.marca" />
                <x-input-error for="postCreate.marca" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Descripcion
                </x-label>
                <x-textarea class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.descripcion"></x-textarea>
                <x-input-error for="postCreate.descripcion" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Precio de Compra:
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.preciocompra" />
                <x-input-error for="postCreate.preciocompra" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Porcentaje de Venta:
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.porcentajeventa" />
                <x-input-error for="postCreate.porcentajeventa" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Cantidad Disponible:
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.cantidaddisponible" />
                <x-input-error for="postCreate.cantidaddisponible" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Categoria de Insumo
                </x-label>
                <x-select class="w-full" wire:model="postCreate.categoria_insumo_id">

                    <option value="" disabled>Seleccione una Categoria de Insumo</option>

                    @foreach ($categoriainsumos as $categoriainsumo)
                        <option value="{{ $categoriainsumo->id }}">{{ $categoriainsumo->nombre }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.categoria_insumo_id" />
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
    @can('ver lista de insumos')
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <ul class="list-disc list-inside space-y-2">
                @foreach ($insumos as $insumo)
                    <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
                        wire:key="insumo--{{ $insumo->id }}">
                        {{ $insumo->nombre }}
                        <div>
                            @can('editar un insumo')
                            <x-button wire:click="edit({{ $insumo->id }})">Editar</x-button>
                            @endcan
                            @can('eliminar un insumo')
                            <x-danger-button wire:click="destroy({{ $insumo->id }})">Eliminar</x-danger-button>
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
                        Marca
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.marca" />
                    <x-input-error for="postEdit.marca" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Descripcion
                    </x-label>
                    <x-textarea class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.descripcion"></x-textarea>
                    <x-input-error for="postEdit.descripcion" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Precio de Compra:
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.preciocompra" />
                    <x-input-error for="postEdit.preciocompra" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Porcentaje de Venta:
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.porcentajeventa" />
                    <x-input-error for="postEdit.porcentajeventa" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Cantidad Disponible:
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.cantidaddisponible" />
                    <x-input-error for="postEdit.cantidaddisponible" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Categoria de Insumo
                    </x-label>
                    <x-select class="w-full" wire:model="postEdit.categoria_insumo_id">
    
                        <option value="" disabled>Seleccione una Categoria de Insumo</option>
    
                        @foreach ($categoriainsumos as $categoriainsumo)
                            <option value="{{ $categoriainsumo->id }}">{{ $categoriainsumo->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="postEdit.categoria_insumo_id" />
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
