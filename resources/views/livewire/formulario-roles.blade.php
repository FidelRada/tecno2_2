<div>
    @can('añadir un nuevo rol')
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
        <form wire:submit="save">

            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Nombre del Rol
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postCreate.nombre" />
                <x-input-error for="postCreate.nombre" />
            </div>

            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Permisos
                </x-label>
                <ul>
                    @foreach ($permisos as $permiso)
                        <li>
                            <label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                                <x-checkbox wire:model="postCreate.permisoslist" value="{{ $permiso->id }}" />
                                {{ $permiso->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
                <x-input-error for="postCreate.permisoslist" />
            </div>


            <div class="flex justify-end">
                <x-button>
                    Crear
                </x-button>
            </div>
        </form>
    </div>
    @endcan

    @can('ver lista de roles')
    <!--Formulario para ver los posts creados / En este se aplicara el can-->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <ul class="list-disc list-inside space-y-2">
            @foreach ($roles as $role)
                <li class="font-semibold text-sm dark:text-gray-200 leading-tight mb-3 flex justify-between"
                    wire:key="role--{{ $role->id }}">
                    {{ $role->name }}
                    <div>
                        @can('editar un rol')
                        <x-button wire:click="edit({{ $role->id }})">Editar</x-button>
                        @endcan
                        @can('eliminar un rol')
                        <x-danger-button wire:click="destroy({{ $role->id }})">Eliminar</x-danger-button>
                        @endcan
                        @can('ver lista de permisos')
                        <x-button wire:click="listPermissions({{ $role->id }})">Ver Permisos</x-button>
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
                        Nombre del Rol
                    </x-label>
                    <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                        wire:model="postEdit.nombre" />
                    <x-input-error for="postEdit.nombre" />
                </div>

                <div class="mb-4">
                    <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                        Permisos
                    </x-label>
                    <ul>
                        @foreach ($permisos as $permiso)
                            <li>
                                <label
                                    class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                                    <x-checkbox wire:model="postEdit.permisoslist" value="{{ $permiso->id }}" />
                                    {{ $permiso->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="postEdit.permisoslist" />
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



    <x-dialog-modal wire:model="open2">
        <x-slot name="title">
            Lista de Permisos
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Nombre del Rol
                </x-label>
                <x-input class="w-full font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                    wire:model="postEdit.nombre" disabled />
                <x-input-error for="postEdit.nombre" />
            </div>

            <div class="mb-4">
                <x-label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                    Permisos
                </x-label>
                <ul>
                    @foreach ($permisos as $permiso)
                        @if (in_array($permiso->id, $postEdit['permisoslist']))
                            <li>
                                <label
                                    class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">
                                    <x-checkbox wire:model="postEdit.permisoslist" value="{{ $permiso->id }}" disabled/>
                                    {{ $permiso->name }}
                                </label>
                            </li>
                        @endif
                        {{--
                        <li>                            
                            <label class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight mb-3">                                                                
                                <x-checkbox wire:model="postEdit.permisoslist" value="{{ $permiso->id }}" />
                                {{ $permiso->name }}
                            </label>
                        </li>
                        --}}
                    @endforeach
                </ul>
                <x-input-error for="postEdit.permisoslist" />
            </div>


        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end">
                <x-danger-button class="mr-2" wire:click="$set('open2', false)">
                    Atras
                </x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>



</div>
