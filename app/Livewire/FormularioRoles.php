<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class FormularioRoles extends Component
{
    public $roles;
    public $permisos;


    /*
    #[Rule([
        'postCreate.title' => 'required',
        'postCreate.content' => 'required',                
        'postCreate.category_id' => 'required|exists:categories, id',
        'postCreate.tags' => 'required|array'
    ], [], [
        'postCreate.title' => 'titulo',
        'postCreate.content' => 'contenido',                
        'postCreate.category_id' => 'categoria',
        'postCreate.tags' => 'etiquetas'
    ])]
    */
    public $postCreate = [
        'nombre' => '',
        'permisoslist' => []
    ];

    public $posts;

    public $postEditId = '';

    public $open = false;
    public $open2 = false;

    public $postEdit = [
        'nombre' => '',
        'permisoslist' => []
    ];

    public function rules()
    {
        return [
            'postCreate.nombre' => 'required',
            'postCreate.permisoslist' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'postCreate.nombre.required' => 'El Campo Nombre es requerido'
        ];
    }

    /*
    public function validationAttributes(){
        return [
            'postCreate.category_id' => 'categoria'
        ];
    }
    */


    public function mount()
    {

        $this->roles = Role::all();
        $this->permisos = Permission::all();
    }



    public function save()
    {

        //$this->validate();
        //Primera Forma
        /*
        $this->validate([            
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories, id',
            'selectedTags' => 'required|array'
        ], [
            'title.required' => 'El Campo titulo es requerido',
            
            // 'content' => 'required',
            // 'category_id' => 'required|exists:categories, id',
            // 'selectedTags' => 'required|array'
            
        ],[
            'category_id' => 'categoria'
        ]);
        */



        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //dd($this->postCreate);

        $role = Role::create([
            'name' => $this->postCreate['nombre'],
            'guard_name' => 'web',
        ]);


        /*
        foreach ($this->postCreate['permisoslist'] as $permisoId) {
            // Especifica el guard 'sanctum' al buscar el permiso
            $permiso = Permission::find($permisoId);
            $permiso1 = Permission::where('name', $permiso->name)->where('guard_name', 'sanctum')->first();
        
            if ($permiso1) {
                $role->givePermissionTo($permiso1->name);
            } else {
                // Trata el caso en el que el permiso no se encuentra
                echo "Permiso no encontrado para ID: $permisoId";
            }
        }
        */

        foreach ($this->postCreate['permisoslist'] as $permisoId) {
            $permiso = Permission::find($permisoId);

            //dd(gettype($permiso->name));
            //$permisoString = (string) $permiso->name;

            //$role->givePermissionTo($permisoString);            
            //$role->givePermissionTo('ver lista de usuarios');
            //dd($permiso->name);                      
            $role->givePermissionTo($permiso->name);
        }


        $this->reset(['postCreate']);
        $this->roles = Role::all();
    }



    public function edit($postId)
    {

        $this->open = true;

        $this->postEditId = $postId;

        $role = Role::find($postId);

        $this->postEdit['nombre'] = $role->name;

        //$this->postEdit['permisoslist'] = $role->pluck('id')->toArray();
        //$this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
        $this->postEdit['permisoslist'] = $role->permissions()->pluck('permissions.id')->toArray();
    }

    public function update()
    {

        //$this->validate([
        //'postEdit.title' => 'required',
        //'postEdit.content' => 'required',                
        //'postEdit.category_id' => 'required|exists:categories, id',
        //'postEdit.tags' => 'required|array'
        //]);


        /*    
        $categoriainsumo = CategoriaInsumo::find($this->postEditId);

        $categoriainsumo->update([
            'nombre' => $this->postEdit['nombre'],
            'descripcion' => $this->postEdit['descripcion']            
        ]);
        */

        $role = Role::find($this->postEditId);

        $role->update([
            'nombre' => $this->postEdit['nombre'],
            'guard_name' => 'web',
        ]);

        $rolePermissionId =  $role->permissions->pluck('name');

        foreach ($rolePermissionId as $roleId) {
            //$permiso = Permission::find($roleId);
            //dd($roleId);
            $role->revokePermissionTo($roleId);
            //dd($role->permissions->pluck('name'));
            //dd(gettype($permiso->name));
            //$permisoString = (string) $permiso->name;

            //$role->givePermissionTo($permisoString);            
            //$role->givePermissionTo('ver lista de usuarios');
            //dd($permiso->name);                      
            //$role->givePermissionTo($permiso->name);
        }

        //$rolePermissionId2 =  $role->permissions->pluck('name');
        //dd($rolePermissionId2);

        foreach ($this->postEdit['permisoslist'] as $permisoId) {
            $permiso = Permission::find($permisoId);

            //dd(gettype($permiso->name));
            //$permisoString = (string) $permiso->name;

            //$role->givePermissionTo($permisoString);            
            //$role->givePermissionTo('ver lista de usuarios');
            //dd($permiso->name);                      
            $role->givePermissionTo($permiso->name);
        }


        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->roles = Role::all();
    }

    public function destroy($postId)
    {
        $role = Role::find($postId);

        $role->delete();

        $this->roles = Role::all();
        
    }

    public function listPermissions($postId)
    {
        /*

        $this->open2 = true;

        $this->postEditId = $postId;

        $role = Role::find($postId);        

        $this->postEdit['nombre'] = $role->name;
        
        //$this->postEdit['permisoslist'] = $role->pluck('id')->toArray();
        //$this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
        $this->postEdit['permisoslist'] = $role->permissions()->pluck('permissions.id')->toArray();
        */
        
        $this->open2 = true;
        $this->postEditId = $postId;

        $role = Role::find($postId);

        $this->postEdit['nombre'] = $role->name;

        // Obtén solo los permisos relacionados con el rol específico
        $this->postEdit['permisoslist'] = $role->permissions->pluck('id')->toArray();
        //dd($this->postEdit);
    }


    public function render()
    {
        return view('livewire.formulario-roles');
    }
}
