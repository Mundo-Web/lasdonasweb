<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::where('status', '=', true)->get();

        return view('pages.categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    public function saveImg($file, $route, $nombreImagen)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);
        // $img->coverDown(672, 700, 'center');
        if (!file_exists($route)) {
            mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
        }
        $img->save($route . $nombreImagen);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $routeImg = 'storage/images/categories/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            $this->saveImg($file, $routeImg, $nombreImagen);

            $category->url_image = $routeImg;
            $category->name_image = $nombreImagen;
        } else {
            $routeImg = 'images/img/';
            $nombreImagen = 'noimagenslider.jpg';

            $category->url_image = $routeImg;
            $category->name_image = $nombreImagen;
        }

        $slug = strtolower(str_replace(' ', '-', $request->name));

        if (Category::where('slug', $slug)->exists()) {
            $slug .= '-' . rand(1, 1000);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $slug;
        $category->status = 1;
        $category->visible = 1;
        $category->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {
        $category = Category::findOrfail($id);

        return view('pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $routeImg = 'storage/images/categories/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            if ($category->url_image !== 'images/img/') {
                File::delete($category->url_image . $category->name_image);
            }

            $this->saveImg($file, $routeImg, $nombreImagen);

            $category->url_image = $routeImg;
            $category->name_image = $nombreImagen;
        }

        $slug = strtolower(str_replace(' ', '-', $request->name));

        if (Category::where('slug', $slug)->exists()) {
            $slug .= '-' . rand(1, 1000);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $slug;
        $category->save();

        return redirect()->route('categorias.index')->with('success', 'Categoria modificada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->id;

        $category = Category::findOrfail($id);

        $category->status = false;

        $category->save();

        return response()->json(['message' => 'Categoría eliminada']);
    }

    public function updateVisible(Request $request)
    {
        $id = $request->id;

        $field = $request->field;

        $status = $request->status;

        $cantidad = $this->contarCategoriasDestacadas();

        if ($field == 'destacar') {
            if ($cantidad >= 3 && $request->status == 1) {
                return response()->json(['message' => 'Solo puedes destacar 3 categorias'], 409);
            }
        }

        $category = Category::findOrFail($id);

        $category->$field = $status;

        $category->save();

        $cantidad = $this->contarCategoriasDestacadas();

        return response()->json(['message' => 'Categoría modificada', 'cantidad' => $cantidad]);
    }

    public function contarCategoriasDestacadas()
    {
        $cantidad = Category::where('destacar', '=', 1)->count();

        return $cantidad;
    }
}
