<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\CategoriaInsumo;
use App\Models\Insumo;
use App\Models\Egreso;
use App\Models\Ingreso;

class FormularioIngreso extends Component
{

    public $insumos;
    public $ingresos;

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
        'cantidadingresada' => '',
        'fechaingreso' => '',        
        'preciounitarioingreso' => '',
        'totalingreso' => '',        
        'insumo_id' => ''
    ];

    public $posts;

    public $postEditId = '';

    public $open = false;

    public $postEdit = [        
        'cantidadingresada' => '',
        'fechaingreso' => '',        
        'preciounitarioingreso' => '',
        'totalingreso' => '',        
        'insumo_id' => '',
        'proveedor_id' => ''
    ];

    public function rules(){
        return [
            'postCreate.cantidadingresada' => 'required',
            
            'postCreate.fechaingreso' => 'required',            
            'postCreate.preciounitarioingreso' => 'required',            
            
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
        $this->ingresos = Egreso::all();
        
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
        
        
        $ingreso = Ingreso::create([
            'insumo_id' => $this->postCreate['insumo_id'],
            'proveedor_id' => 111,
            'cantidadingresada' => $this->postCreate['cantidadingresada'],
            'fechaingreso' => $this->postCreate['fechaingreso'],
            'preciounitarioingreso' => $this->postCreate['preciounitarioingreso'],
            'totalingreso' => 0.0              
        ]);
        
        $this->reset(['postCreate']);

        $this->ingresos = Ingreso::all();
    }

    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $ingreso = Ingreso::find($postId);

        $this->postEdit['cantidadingresada'] = $ingreso->cantidadingresada;
        $this->postEdit['fechaingreso'] = $ingreso->fechaingreso;
        $this->postEdit['preciounitarioingreso'] = $ingreso->preciounitarioingreso;
        $this->postEdit['insumo_id'] = $ingreso->insumo_id;        
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
        

        $ingreso = Ingreso::find($this->postEditId);

        $ingreso->update([
            'insumo_id' => $this->postEdit['insumo_id'],
            'proveedor_id' => 111,
            'cantidadingresada' => $this->postEdit['cantidadingresada'],
            'fechaingreso' => $this->postEdit['fechaingreso'],
            'preciounitarioingreso' => $this->postEdit['preciounitarioingreso'],
            'totalingreso' => 0              
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->ingresos = Ingreso::all();
    }

    public function destroy($postId){
        $ingreso = Ingreso::find($postId);

        $ingreso->delete();

        $this->ingresos = Ingreso::all();
    }

    public function render()
    {
        return view('livewire.formulario-ingreso');
    }
}
