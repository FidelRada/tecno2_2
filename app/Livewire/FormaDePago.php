<?php

namespace App\Livewire;

use App\Models\forma_de_pago;

use Livewire\Component;

class FormaDePago extends Component
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
        'descripcion' => ''
    ];

    public $formaDePagos;

    public $postEditId = '';

    public $open = false;

    public $postEdit = [
        'nombre' => '',
        'descripcion' => ''
    ];

    public function rules()
    {
        return [
            'postCreate.nombre' => 'required',
            'postCreate.descripcion' => 'required'
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

        $this->formaDePagos = forma_de_pago::all();
    }

    public function save()
    {

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

        $formaDePago = forma_de_pago::create([
            'nombre' => $this->postCreate['nombre'],
            'descripcion' => $this->postCreate['descripcion']
        ]);

        //$post->tags()->attach($this->postCreate['tags']);

        $this->reset(['postCreate']);

        $this->formaDePagos = forma_de_pago::all();
    }

    public function edit($formaDePagoID)
    {

        $this->open = true;

        $this->postEditId = $formaDePagoID;

        $formaDePago = forma_de_pago::find($formaDePagoID);

        $this->postEdit['nombre'] = $formaDePago->nombre;
        $this->postEdit['descripcion'] = $formaDePago->descripcion;
    }

    public function update()
    {

        $this->validate([
            'postEdit.nombre' => 'required',
            'postEdit.descripcion' => 'required'
        ]);


        $post = forma_de_pago::find($this->postEditId);

        $post->update([
            'nombre' => $this->postEdit['nombre'],
            'descripcion' => $this->postEdit['descripcion']
        ]);

        $this->reset(['postEditId', 'postEdit', 'open']);

        $this->formaDePagos = forma_de_pago::all();
    }

    public function destroy($formaDePagoID)
    {
        $post = forma_de_pago::find($formaDePagoID);

        $post->delete();

        $this->formaDePagos = forma_de_pago::all();
    }
    public function render()
    {
        return view('livewire.forma-de-pago');
    }
}
