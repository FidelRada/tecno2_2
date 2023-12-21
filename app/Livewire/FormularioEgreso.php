<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\CategoriaInsumo;
use App\Models\Insumo;
use App\Models\Egreso;

class FormularioEgreso extends Component
{
    public $insumos;
    public $egresos;

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
        'cantidadegresada' => '',
        'fechaegreso' => '',        
        'preciounitarioegreso' => '',
        'totalegreso' => '',        
        'insumo_id' => ''
    ];

    public $posts;

    public $postEditId = '';

    public $open = false;

    public $postEdit = [        
        'cantidadegresada' => '',
        'fechaegreso' => '',        
        'preciounitarioegreso' => '',
        'totalegreso' => '',        
        'insumo_id' => ''
    ];

    public function rules(){
        return [
            'postCreate.cantidadegresada' => 'required',
            
            'postCreate.fechaegreso' => 'required',            
            'postCreate.preciounitarioegreso' => 'required',            
            
            'insumo_id' => 'required|exists:insumos, id'
        ];
    }
    /*
    public function messages(){
        return [
            'postCreate.nombre.required' => 'El Campo Nombre es requerido'
        ];
    }
    */

    /*
    public function validationAttributes(){
        return [
            'postCreate.category_id' => 'categoria'
        ];
    }
    */
    
    
    public function mount(){
        
        $this->insumos = Insumo::all();
        $this->egresos = Egreso::all();
        
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

        //dd($this->postCreate);
        
        
        $egreso = Egreso::create([
            'insumo_id' => $this->postCreate['insumo_id'],
            'cantidadegresada' => $this->postCreate['cantidadegresada'],
            'fechaegreso' => $this->postCreate['fechaegreso'],
            'preciounitarioegreso' => $this->postCreate['preciounitarioegreso'],
            'totalegreso' => 0.0              
        ]);
        
        $this->reset(['postCreate']);

        $this->egresos = Egreso::all();
    }

    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $egreso = Egreso::find($postId);

        $this->postEdit['cantidadegresada'] = $egreso->cantidadegresada;
        $this->postEdit['fechaegreso'] = $egreso->fechaegreso;
        $this->postEdit['preciounitarioegreso'] = $egreso->preciounitarioegreso;
        $this->postEdit['insumo_id'] = $egreso->insumo_id;        
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
        

        $egreso = Egreso::find($this->postEditId);

        $egreso->update([
            'insumo_id' => $this->postEdit['insumo_id'],
            'cantidadegresada' => $this->postEdit['cantidadegresada'],
            'fechaegreso' => $this->postEdit['fechaegreso'],
            'preciounitarioegreso' => $this->postEdit['preciounitarioegreso'],
            'totalegreso' => 0              
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->egresos = Egreso::all();
    }

    public function destroy($postId){
        $egreso = Egreso::find($postId);

        $egreso->delete();

        $this->egresos = Egreso::all();
    }

    public function render()
    {
        return view('livewire.formulario-egreso');
    }
}

