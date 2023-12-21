<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\CategoriaInsumo;
use App\Models\Insumo;

class FormularioInsumo extends Component
{
    public $insumos;
    public $categoriainsumos;

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
        'marca' => '',        
        'descripcion' => '',
        'preciocompra' => '',        
        'porcentajeventa' => '',
        'precioventa' => '',
        'cantidaddisponible' => '',
        'categoria_insumo_id' => ''
    ];

    public $posts;

    public $postEditId = '';

    public $open = false;

    public $postEdit = [        
        'nombre' => '',
        'marca' => '',        
        'descripcion' => '',
        'preciocompra' => '',        
        'porcentajeventa' => '',
        'precioventa' => '',
        'cantidaddisponible' => '',
        'categoria_insumo_id' => ''
    ];

    public function rules(){
        return [
            'postCreate.nombre' => 'required',
            'postCreate.marca' => 'required',            
            'postCreate.descripcion' => 'required',
            'postCreate.preciocompra' => 'required',
            'postCreate.porcentajeventa' => 'required',
            'postCreate.cantidaddisponible' => 'required',
            'categoria_insumo_id' => 'required|exists:categoriainsumos, id'
        ];
    }

    public function messages(){
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
    
    
    public function mount(){
        
        $this->insumos = Insumo::all();
        $this->categoriainsumos = CategoriaInsumo::all();
        
    }
    
    

    public function save(){

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
        
        
        $insumo = Insumo::create([
            'categoria_insumo_id' => $this->postCreate['categoria_insumo_id'],
            'nombre' => $this->postCreate['nombre'],
            'marca' => $this->postCreate['marca'],
            'descripcion' => $this->postCreate['descripcion'],
            'preciocompra' => $this->postCreate['preciocompra'],  
            'precioventa' => 0,            
            'porcentajeventa' => $this->postCreate['porcentajeventa'],
            'cantidaddisponible' => $this->postCreate['cantidaddisponible']            
        ]);
        
        $this->reset(['postCreate']);

        $this->insumos = Insumo::all();
    }

    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $insumo = Insumo::find($postId);

        $this->postEdit['nombre'] = $insumo->nombre;
        $this->postEdit['marca'] = $insumo->marca;
        $this->postEdit['descripcion'] = $insumo->descripcion;
        $this->postEdit['preciocompra'] = $insumo->preciocompra;        
        $this->postEdit['porcentajeventa'] = $insumo->porcentajeventa;
        $this->postEdit['cantidaddisponible'] = $insumo->cantidaddisponible;
        $this->postEdit['categoria_insumo_id'] = $insumo->categoria_insumo_id;        
    }

    public function update(){ 
        /*         
        $this->validate([
            'postEdit.title' => 'required',
            'postEdit.content' => 'required',                
            'postEdit.category_id' => 'required|exists:categories, id',
            'postEdit.tags' => 'required|array'
        ]);
        */
        

        $insumo = Insumo::find($this->postEditId);

        $insumo->update([
            'categoria_insumo_id' => $this->postEdit['categoria_insumo_id'],
            'nombre' => $this->postEdit['nombre'],
            'marca' => $this->postEdit['marca'],
            'descripcion' => $this->postEdit['descripcion'],
            'preciocompra' => $this->postEdit['preciocompra'],            
            'porcentajeventa' => $this->postEdit['porcentajeventa'],
            'precioventa' => 0,            
            'cantidaddisponible' => $this->postEdit['cantidaddisponible']            
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->insumos = Insumo::all();
    }

    public function destroy($postId){
        $insumo = Insumo::find($postId);

        $insumo->delete();

        $this->insumos = Insumo::all();
    }

    public function render()
    {
        return view('livewire.formulario-insumo');
    }
}
