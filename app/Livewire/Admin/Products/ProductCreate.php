<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;


    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {
            if($validator->fails()){
                $this->dispatch('swal',[
                    'title' => 'Error al crear el producto',
                    'icon' => 'error',
                    'text' => 'Por favor, revisa los campos del formulario.'
                ]);
            }
        });
    }

    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->product['subcategory_id'] = '';
    }

    public function updatedCategoryId($value)
    {
        $this->product['subcategory_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:1',
            'product.subcategory_id' => 'required|exists:subcategories,id',
        ],
        [
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no debe pesar más de 1MB.',
            'product.sku.required' => 'El SKU es obligatorio.',
            'product.sku.unique' => 'El SKU ya está en uso.',
            'product.name.required' => 'El nombre es obligatorio.',
            'product.name.max' => 'El nombre no debe superar los 255 caracteres.',
            'product.price.required' => 'El precio es obligatorio.',
            'product.price.numeric' => 'El precio debe ser un número.',
            'product.price.min' => 'El precio debe ser mayor a 0.',
            'product.subcategory_id.required' => 'La subcategoría es obligatoria.',
            'product.subcategory_id.exists' => 'La subcategoría seleccionada no es válida.',
        ]
    );


        $this->product['image_path'] = $this->image->store('products');
        $product =  Product::create($this->product);
        session()->flash('message', [
            'icon' => 'success',
            'title' => 'Producto creado',
            'message' => 'El producto ha sido creado correctamente.',
        ]);
        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
