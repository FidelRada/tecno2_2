<?php

namespace App\Livewire;

use App\Models\categoria_diseño;
use Livewire\Attributes\Rule;


use Livewire\Component;

class SubCategoria extends Component
{
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
        'descripcion' => '',
        'categoria' => ''
    ];

    public $categoriaDiseño;
    public $subCategoriaDiseño;
    

    public $postEditId = '';

    public $open = false;

    public $postEdit = [
        'nombre' => '',
        'descripcion' => '',
        'categoria' => ''
    ];

    public function rules()
    {
        return [
            'postCreate.nombre' => 'required',
            'postCreate.descripcion' => 'required',
            'postCreate.categoria' => 'required|exists:categoria_diseños,id'
        ];
    }

    public function messages()
    {
        return [
            'postCreate.nombre.required' => 'El Campo nombre es requerido'
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
        //$this->categories = Category::all();
        //$this->tags = Tag::all();

        $this->categoriaDiseño = categoria_diseño::wherenull('categoria')->get(); 
        $this->subCategoriaDiseño = categoria_diseño::wherenotnull('categoria')->get(); 
    }

    public function save()
    {
        //dd($this->postCreate['categoria']);

        $this->validate();
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
        $categoria = categoria_diseño::create([
            'nombre' => $this->postCreate['nombre'],
            'descripcion' => $this->postCreate['descripcion'],
            'categoria' => $this->postCreate['categoria']
        ]);

        //$post->tags()->attach($this->postCreate['tags']);

        $this->reset(['postCreate']);

        $this->subCategoriaDiseño= categoria_diseño::wherenotnull('categoria')->get();//all();
    }

    public function edit($servicioID)
    {

        $this->open = true;

        $this->postEditId = $servicioID;

        $categoria = categoria_diseño::find($servicioID);

        $this->postEdit['nombre'] = $categoria->nombre;
        $this->postEdit['descripcion'] = $categoria->descripcion;
        $this->postEdit['categoria'] = $categoria->categoria;
    }

    public function update()
    {

        $this->validate([
            'postEdit.nombre' => 'required',
            'postEdit.descripcion' => 'required',
            'postEdit.categoria' => 'required',
        ]);


        $post = categoria_diseño::find($this->postEditId);

        $post->update([
            'nombre' => $this->postEdit['nombre'],
            'descripcion' => $this->postEdit['descripcion'],
            'categoria' => $this->postEdit['categoria']
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        //$this->subCategoriaDiseño = categoria_diseño::all();
        $this->subCategoriaDiseño= categoria_diseño::wherenotnull('categoria')->get();//all();
    }

    public function destroy($categoriaId)
    {
        //categoria_diseño::where('categoria', $categoriaId)->update(['categoria' => null]);

        $post = categoria_diseño::find($categoriaId);

        $post->delete();

        //$this->subCategoriaDiseño = categoria_diseño::all();
        $this->subCategoriaDiseño= categoria_diseño::wherenotnull('categoria')->get();//all();
    }

    public function render()
    {
        return view('livewire.sub-categoria');
    }
}
