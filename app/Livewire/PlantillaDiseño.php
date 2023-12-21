<?php

namespace App\Livewire;

use App\Models\categoria_diseño;
use App\Models\plantilla_diseño;
use Livewire\Attributes\Rule;

use Livewire\Component;

class PlantillaDiseño extends Component
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
        'URI_IMG' => '',
        'categoria_id' => ''
    ];

    public $categoriaDiseño;
    public $platillaDiseño;
    
    public $postEditId = '';

    public $open = false;

    public $postEdit = [
        'nombre' => '',
        'descripcion' => '',
        'URI_IMG' => '',
        'categoria_id' => ''
    ];

    public function rules()
    {
        return [
            'postCreate.nombre' => 'required',
            'postCreate.descripcion' => 'required',
            'postCreate.URI_IMG' => 'required',
            'postCreate.categoria_id' => 'required|exists:categoria_diseños,id'
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

        $this->categoriaDiseño = categoria_diseño::wherenotnull('categoria')->get(); 
        $this->platillaDiseño = plantilla_diseño::all();
    }

    public function save()
    {
        //dd($this->postCreate['categoria']);
        
        //dd($this->postCreate);
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
        $plantillla = plantilla_diseño::create([
            'nombre' => $this->postCreate['nombre'],
            'descripcion' => $this->postCreate['descripcion'],
            'URI_IMG' => $this->postCreate['URI_IMG'],
            'categoria_id' => $this->postCreate['categoria_id']
        ]);
        
        //$post->tags()->attach($this->postCreate['tags']);

        $this->reset(['postCreate']);

        $this->platillaDiseño= plantilla_diseño::all();
    }

    public function edit($servicioID)
    {

        $this->open = true;

        $this->postEditId = $servicioID;

        $plantilla = plantilla_diseño::find($servicioID);

        $this->postEdit['nombre'] = $plantilla->nombre;
        $this->postEdit['descripcion'] = $plantilla->descripcion;
        $this->postEdit['URI_IMG'] = $plantilla->URI_IMG;
        $this->postEdit['categoria_id'] = $plantilla->categoria_id;
    }

    public function update()
    {

        $this->validate([
            'postEdit.nombre' => 'required',
            'postEdit.descripcion' => 'required',
            'postEdit.URI_IMG' => 'required',
            'postEdit.categoria_id' => 'required',
        ]);


        $post = plantilla_diseño::find($this->postEditId);

        //dd($this->postEdit);

        $post->update([
            'nombre' => $this->postEdit['nombre'],
            'descripcion' => $this->postEdit['descripcion'],
            'URI_IMG' => $this->postEdit['URI_IMG'],
            'categoria' => $this->postEdit['categoria_id']
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->platillaDiseño = plantilla_diseño::all();
    }

    public function destroy($plantillaDiseñoId)
    {

        $post = plantilla_diseño::find($plantillaDiseñoId);

        $post->delete();

        $this->platillaDiseño = plantilla_diseño::all();
    }

    public function render()
    {
        return view('livewire.plantilla-diseño');
    }
}
