<div>
    @can('añadir un nuevo empleado')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <form wire:submit="save">
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Nombre
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.name" />
                <x-input-error for="postCreate.name" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Apellido Paterno
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.apellidopaterno" />
                <x-input-error for="postCreate.apellidopaterno" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Apellido Materno
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.apellidomaterno" />
                <x-input-error for="postCreate.apellidomaterno" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Carnet de Identidad
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.ci" />
                <x-input-error for="postCreate.ci" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Telefono
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.telefono" />
                <x-input-error for="postCreate.telefono" />
            </div>
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Direccion
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.direccion" />
                <x-input-error for="postCreate.direccion" />
            </div>

            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Correo Electronico
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.email" />
                <x-input-error for="postCreate.email" />
            </div>

            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Password
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    type="password" wire:model="postCreate.password" />
                <x-input-error for="postCreate.password" />
            </div>

            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Cargo
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.cargo" />
                <x-input-error for="postCreate.cargo" />
            </div>

            
            <div class="flex justify-end">
                <x-button>
                    Crear
                </x-button>
            </div>
        </form>
    </div>
    @endcan
    
    @can('ver lista de empleados')
    <!--Formulario para ver los posts creados / En este se aplicara el can-->    
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <ul class="list-disc list-inside space-y-2">
                @foreach ($empleados as $empleado)
                    <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
                        wire:key="empleado--{{ $empleado->id }}">
                        {{ $empleado->name }}
                        <div>
                            @can('editar empleados')
                            <x-button wire:click="edit({{ $empleado->id }})">Editar</x-button>
                            @endcan
                            @can('eliminar empleados')
                            <x-danger-button wire:click="destroy({{ $empleado->id }})">Eliminar</x-danger-button>
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
                        wire:model="postEdit.name" />
                    <x-input-error for="postEdit.name" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Apellido Paterno
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.apellidopaterno" />
                    <x-input-error for="postEdit.apellidopaterno" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Apellido Materno
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.apellidomaterno" />
                    <x-input-error for="postEdit.apellidomaterno" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Carnet de Identidad
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.ci" />
                    <x-input-error for="postEdit.ci" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Telefono
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.telefono" />
                    <x-input-error for="postEdit.telefono" />
                </div>
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Direccion
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.direccion" />
                    <x-input-error for="postEdit.direccion" />
                </div>
    
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Correo Electronico
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.email" />
                    <x-input-error for="postEdit.email" />
                </div>
    
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Password
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        type="password" wire:model="postEdit.password" />
                    <x-input-error for="postEdit.password" />
                </div>
    
                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Cargo
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.cargo" />
                    <x-input-error for="postEdit.cargo" />
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

    {{--
    <ul class="list-disc list-inside space-y-2">
    @foreach ($clientes as $cliente)
        <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
            wire:key="cliente--{{ $cliente->id }}">
            {{ $cliente->nombre }}
            <div>
                <x-button wire:click="edit({{ $cliente->id }})">Editar</x-button>
                <x-danger-button wire:click="destroy({{ $cliente->id }})">Eliminar</x-danger-button>
            </div>
        </li>
    @endforeach
</ul>
    --}}

</div>

