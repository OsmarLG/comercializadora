<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showProducts', 'search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();

        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * $products->perPage());
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $products = Product::where('name', 'LIKE', "%{$search}%")->paginate(12);
        
        return view('product.show_all', compact('products'));
    }

    public function showProducts()
    {
        $products = Product::paginate(12); // Obtener todos los productos
        return view('product.show_all', compact('products')); // Retornar la vista con los productos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        return view('product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Product::$rules);
    
        $productData = $request->all();
    
        // Verifica si la solicitud tiene un archivo para la clave 'image'.
        if ($request->hasFile('image')) {
            // Guarda la imagen en el disco público y genera un nombre único para ella.
            $imagePath = $request->file('image')->store('product_images', 'public');
    
            // Agrega la ruta de la imagen al array de datos del producto.
            $productData['image'] = $imagePath;
        }
    
        // Crea el producto con los datos, incluida la imagen.
        $product = Product::create($productData);
    
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate(Product::$rules);
    
        $productData = $request->all();
    
        if ($request->hasFile('image')) {
            // Borra la imagen antigua si existe
            if ($product->image) {
                Storage::delete($product->image);
            }
    
            // Guarda la nueva imagen y actualiza la ruta de la imagen
            $imagePath = $request->file('image')->store('product_images', 'public');
            $productData['image'] = $imagePath;
        } else {
            // Si no se carga una nueva imagen, conserva la antigua
            $productData['image'] = $product->image;
        }
    
        $product->update($productData);
    
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }
    

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
