<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormularioEmpleado extends Component
{
    public $empleados;

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
        'cargo' => '',        
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
        'cargo' => '',        
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

        $this->empleados = Empleado::all();
    }

    public function save()
    {
        $user = User::create([
            'name' => $this->postCreate['name'],
            'email' => $this->postCreate['email'],
            'password' => Hash::make($this->postCreate['password']),
        ]);

        //dd($user->id);

        $empleado = Empleado::create([
            'user_id' => $user->id,
            'name' => $this->postCreate['name'],
            'apellidopaterno' => $this->postCreate['apellidopaterno'],
            'apellidomaterno' => $this->postCreate['apellidomaterno'],
            'ci' => $this->postCreate['ci'],
            'telefono' => $this->postCreate['telefono'],
            'direccion' => $this->postCreate['direccion'],
            'cargo' => $this->postCreate['cargo'],  
        ]);        

        // Asociar el empleado y el usuario
        $empleado->user()->associate($user);
        $empleado->save();
        $user->assignRole('Empleado');

        $this->reset(['postCreate']);

        $this->empleados = Empleado::all();
    }

    
    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $empleado = Empleado::find($postId);
        $userEmpleado = User::find($empleado->user_id);

        $this->postEdit['name'] = $empleado->name;
        $this->postEdit['apellidopaterno'] = $empleado->apellidopaterno;        
        $this->postEdit['apellidomaterno'] = $empleado->apellidomaterno;
        $this->postEdit['ci'] = $empleado->ci;
        $this->postEdit['telefono'] = $empleado->telefono;
        $this->postEdit['direccion'] = $empleado->direccion;
        $this->postEdit['email'] = $userEmpleado->email;
        //$this->postEdit['password'] = $userCliente->password;
        $this->postEdit['cargo'] = $empleado->cargo;        
    }

    
    public function update(){ 
        
        //$this->validate([
            //'postEdit.title' => 'required',
            //'postEdit.content' => 'required',                
            //'postEdit.category_id' => 'required|exists:categories, id',
            //'postEdit.tags' => 'required|array'
        //]);        
        

        $empleado = Empleado::find($this->postEditId);
        $userEmpleado = User::find($empleado->user_id);

        $userEmpleado->update([
            'name' => $this->postEdit['name'],
            'email' => $this->postEdit['email'],            
            'password' => $this->postEdit['password'],            
        ]);

        $empleado->update([
            'user_id' => $userEmpleado->id,
            'name' => $this->postEdit['name'],
            'apellidopaterno' => $this->postEdit['apellidopaterno'],
            'apellidomaterno' => $this->postEdit['apellidomaterno'],
            'ci' => $this->postEdit['ci'],
            'telefono' => $this->postEdit['telefono'],
            'direccion' => $this->postEdit['direccion'],
            'cargo' => $this->postEdit['cargo'],            
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->empleados = Empleado::all();
    }
    


    public function destroy($postId){
        $empleado = Empleado::find($postId);
        $empleadoIdUser = $empleado->user_id;
        $userDelete = User::find($empleadoIdUser);
        $userDelete->removeRole('Empleado');
        $userDelete->delete();
        //$cliente->delete();
        
        

        $this->empleados = Empleado::all();
    }

    public function render()
    {
        return view('livewire.formulario-empleado');
    }
}
