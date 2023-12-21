<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\CategoriaInsumo;

class FormularioCategoriaInsumo extends Component
{
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
        'descripcion' => ''        
    ];

    public $posts;

    public $postEditId = '';

    public $open = false;

    public $postEdit = [        
        'nombre' => '',
        'descripcion' => ''
    ];

    public function rules(){
        return [
            'postCreate.nombre' => 'required',
            'postCreate.descripcion' => 'required'
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
        
        $categoriainsumo = CategoriaInsumo::create([
            'nombre' => $this->postCreate['nombre'],
            'descripcion' => $this->postCreate['descripcion']            
        ]);
        
        $this->reset(['postCreate']);

        $this->categoriainsumos = CategoriaInsumo::all();
    }

    public function edit($postId){

        $this->open = true;

        $this->postEditId = $postId;

        $categoriainsumo = CategoriaInsumo::find($postId);

        $this->postEdit['nombre'] = $categoriainsumo->nombre;
        $this->postEdit['descripcion'] = $categoriainsumo->descripcion;        
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
        

        $categoriainsumo = CategoriaInsumo::find($this->postEditId);

        $categoriainsumo->update([
            'nombre' => $this->postEdit['nombre'],
            'descripcion' => $this->postEdit['descripcion']            
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->categoriainsumos = CategoriaInsumo::all();
    }

    public function destroy($postId){
        $categoriainsumo = CategoriaInsumo::find($postId);

        $categoriainsumo->delete();

        $this->categoriainsumos = CategoriaInsumo::all();
    }

    public function render()
    {
        return view('livewire.formulario-categoria-insumo');
    }
}
