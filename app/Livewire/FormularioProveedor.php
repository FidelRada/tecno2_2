<?php

namespace App\Livewire;

use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormularioProveedor extends Component
{
    public $proveedors;

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
        'user_id' => '',
        'name' => '',
        'apellidopaterno' => '',
        'apellidomaterno' => '',
        'ci' => '',
        'telefono' => '',
        'direccion' => '',
        'nombreempresa' => '',
        'cargoproveedor' => '',
        'telefonoreferencia' => '',
    ];

    public $posts;

    public $postEditId = '';

    public $open = false;

    public $postEdit = [
        'user_id' => '',
        'name' => '',
        'apellidopaterno' => '',
        'apellidomaterno' => '',
        'ci' => '',
        'telefono' => '',
        'direccion' => '',
        'nombreempresa' => '',
        'cargoproveedor' => '',
        'telefonoreferencia' => '',
    ];

    public function rules()
    {
        return [
            'postCreate.name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'postCreate.name.required' => 'El Campo Nombre es requerido'
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

        $this->proveedors = Proveedor::all();
    }

    public function save()
    {
        $user = User::create([
            'name' => $this->postCreate['name'],
            'email' => $this->postCreate['email'],
            'password' => Hash::make($this->postCreate['password']),
        ]);

        //dd($user->id);

        $proveedor = Proveedor::create([
            'user_id' => $user->id,
            'name' => $this->postCreate['name'],
            'apellidopaterno' => $this->postCreate['apellidopaterno'],
            'apellidomaterno' => $this->postCreate['apellidomaterno'],
            'ci' => $this->postCreate['ci'],
            'telefono' => $this->postCreate['telefono'],
            'direccion' => $this->postCreate['direccion'],
            'nombreempresa' => $this->postCreate['nombreempresa'],
            'cargoproveedor' => $this->postCreate['cargoproveedor'],
            'telefonoreferencia' => $this->postCreate['telefonoreferencia'],
            
        ]);        

        // Asociar el proveedor y el usuario
        $proveedor->user()->associate($user);
        $proveedor->save();
        $user->assignRole('Proveedor');

        $this->reset(['postCreate']);

        $this->proveedors = Proveedor::all();
    }

    
    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $proveedor = Proveedor::find($postId);
        $userProveedor = User::find($proveedor->user_id);

        $this->postEdit['name'] = $proveedor->name;
        $this->postEdit['apellidopaterno'] = $proveedor->apellidopaterno;        
        $this->postEdit['apellidomaterno'] = $proveedor->apellidomaterno;
        $this->postEdit['ci'] = $proveedor->ci;
        $this->postEdit['telefono'] = $proveedor->telefono;
        $this->postEdit['direccion'] = $proveedor->direccion;
        $this->postEdit['email'] = $userProveedor->email;
        //$this->postEdit['password'] = $userCliente->password;
        $this->postEdit['nombreempresa'] = $proveedor->nombreempresa;
        $this->postEdit['cargoproveedor'] = $proveedor->cargoproveedor;
        $this->postEdit['telefonoreferencia'] = $proveedor->telefonoreferencia;
    }

    
    public function update(){ 
        
        //$this->validate([
            //'postEdit.title' => 'required',
            //'postEdit.content' => 'required',                
            //'postEdit.category_id' => 'required|exists:categories, id',
            //'postEdit.tags' => 'required|array'
        //]);        
        

        $proveedor = Proveedor::find($this->postEditId);
        $userProveedor = User::find($proveedor->user_id);

        $userProveedor->update([
            'name' => $this->postEdit['name'],
            'email' => $this->postEdit['email'],            
            'password' => $this->postEdit['password'],            
        ]);

        $proveedor->update([
            'user_id' => $userProveedor->id,
            'name' => $this->postEdit['name'],
            'apellidopaterno' => $this->postEdit['apellidopaterno'],
            'apellidomaterno' => $this->postEdit['apellidomaterno'],
            'ci' => $this->postEdit['ci'],
            'telefono' => $this->postEdit['telefono'],
            'direccion' => $this->postEdit['direccion'],
            'nombreempresa' => $this->postEdit['nombreempresa'],
            'cargoproveedor' => $this->postEdit['cargoproveedor'],
            'telefonoreferencia' => $this->postEdit['telefonoreferencia'],
            
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->proveedors = Proveedor::all();
    }
    


    public function destroy($postId){
        $proveedor = Proveedor::find($postId);
        $proveedorIdUser = $proveedor->user_id;
        $userDelete = User::find($proveedorIdUser);
        $userDelete->removeRole('Proveedor');
        $userDelete->delete();
        //$cliente->delete();
        
        

        $this->proveedors = Proveedor::all();
    }

    public function render()
    {
        return view('livewire.formulario-proveedor');
    }
}
