<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormularioCliente extends Component
{

    public $clientes;

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
        'nit' => '',
        'nrotarjetadecredito' => '',
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
        'nit' => '',
        'nrotarjetadecredito' => '',
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

        $this->clientes = Cliente::all();
    }

    public function save()
    {
        $user = User::create([
            'name' => $this->postCreate['name'],
            'email' => $this->postCreate['email'],
            'password' => Hash::make($this->postCreate['password']),
        ]);

        //dd($user->id);

        $cliente = Cliente::create([
            'user_id' => $user->id,
            'name' => $this->postCreate['name'],
            'apellidopaterno' => $this->postCreate['apellidopaterno'],
            'apellidomaterno' => $this->postCreate['apellidomaterno'],
            'ci' => $this->postCreate['ci'],
            'telefono' => $this->postCreate['telefono'],
            'direccion' => $this->postCreate['direccion'],
            'nit' => $this->postCreate['nit'],
            'nrotarjetadecredito' => $this->postCreate['nrotarjetadecredito'],
            
        ]);        

        // Asociar el cliente y el usuario
        $cliente->user()->associate($user);
        $cliente->save();
        $user->assignRole('Cliente');

        $this->reset(['postCreate']);

        $this->clientes = Cliente::all();
    }

    
    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $cliente = Cliente::find($postId);
        $userCliente = User::find($cliente->user_id);

        $this->postEdit['name'] = $cliente->name;
        $this->postEdit['apellidopaterno'] = $cliente->apellidopaterno;        
        $this->postEdit['apellidomaterno'] = $cliente->apellidomaterno;
        $this->postEdit['ci'] = $cliente->ci;
        $this->postEdit['telefono'] = $cliente->telefono;
        $this->postEdit['direccion'] = $cliente->direccion;
        $this->postEdit['email'] = $userCliente->email;
        //$this->postEdit['password'] = $userCliente->password;
        $this->postEdit['nit'] = $cliente->nit;
        $this->postEdit['nrotarjetadecredito'] = $cliente->nrotarjetadecredito;
    }

    
    public function update(){ 
        
        //$this->validate([
            //'postEdit.title' => 'required',
            //'postEdit.content' => 'required',                
            //'postEdit.category_id' => 'required|exists:categories, id',
            //'postEdit.tags' => 'required|array'
        //]);        
        

        $cliente = Cliente::find($this->postEditId);
        $userCliente = User::find($cliente->user_id);

        $userCliente->update([
            'name' => $this->postEdit['name'],
            'email' => $this->postEdit['email'],            
            'password' => $this->postEdit['password'],            
        ]);

        $cliente->update([
            'user_id' => $userCliente->id,
            'name' => $this->postEdit['name'],
            'apellidopaterno' => $this->postEdit['apellidopaterno'],
            'apellidomaterno' => $this->postEdit['apellidomaterno'],
            'ci' => $this->postEdit['ci'],
            'telefono' => $this->postEdit['telefono'],
            'direccion' => $this->postEdit['direccion'],
            'nit' => $this->postEdit['nit'],
            'nrotarjetadecredito' => $this->postEdit['nrotarjetadecredito'],
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->clientes = Cliente::all();
    }
    


    public function destroy($postId){
        $cliente = Cliente::find($postId);
        $clienteIdUser = $cliente->user_id;
        $userDelete = User::find($clienteIdUser);
        $userDelete->removeRole('Cliente');
        $userDelete->delete();
        //$cliente->delete();
        

        $this->clientes = Cliente::all();
    }

    public function render()
    {
        return view('livewire.formulario-cliente');
    }
}
