<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Tag;
use Illuminate\Http\Request;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $posts = Blog::where("status", "=", true)->get();

    return view('pages.blog.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();
    $tags = Tag::all();
    
    return view('pages.blog.create', compact('categories', 'tags'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    
    $request->validate([
      'title' => 'required',
    ]);

    $post = new Blog();

    if ($request->hasFile("imagen")) {

      $manager = new ImageManager(new Driver());

      $nombreImagen = Str::random(10) . '_' . $request->file('imagen')->getClientOriginalName();

      $img =  $manager->read($request->file('imagen'));

      //seteamos el tamaño de que deben de tener las imagenes que se suban
      $qwidth = 808;
      $qheight = 445;

      // Obtener las dimensiones de la imagen que se esta subiendo
      $width = $img->width();
      $height = $img->height();

      if ($width > $height) {
        //dd('Horizontal');
        //si es horizontal igualamos el alto de la imagen a alto que queremos
        $img->resize(height: 445)->crop(808, 445);
      } else {
        //dd('Vertical');
        //En caso sea vertical la imagen
        //gualamos el ancho y cropeamos
        $img->resize(width: 808)->crop(808, 445);
      }


      $ruta = storage_path() . '/app/public/images/posts/';

      $img->save($ruta . $nombreImagen);


      $post->url_image = $ruta;
      $post->name_image = $nombreImagen;
    }

    $post->category_id = $request->category_id;
    $post->title = $request->title;
    $post->description = $request->description;
    $post->status = 1;
    $post->visible = 1;



    $post->save();

    return redirect()->route('blog.index')->with('success', 'Publicación creado exitosamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Blog $blog)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  //public function edit(Blog $blog, $id)

  public function edit(Blog $blog)
  {
    $categories = Category::all();

    return view('pages.blog.edit', compact('blog', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {

    $old_name = Blog::find($request->id)->name_image;

    $post = Blog::find($request->id);


    if ($request->hasFile("imagen")) {

      $manager = new ImageManager(new Driver());


      $ruta = storage_path() . '/app/public/images/posts/' . $old_name;

      // dd($ruta);
      if (File::exists($ruta)) {
        File::delete($ruta);
      }

      $rutanueva = storage_path() . '/app/public/images/posts/';
      $nombreImagen = Str::random(10) . '_' . $request->file('imagen')->getClientOriginalName();

      $img =  $manager->read($request->file('imagen'));

      $width = $img->width();
      $height = $img->height();

      $qwidth = 808;
      $qheight = 445;

      if ($width > $height) {
        //dd('Horizontal');
        //si es horizontal igualamos el alto de la imagen a alto que queremos
        $img->resize(height: 445)->crop(808, 445);
      } else {
        //dd('Vertical');
        //En caso sea vertical la imagen
        //igualamos el ancho y cropeamos
        $img->resize(width: 808)->crop(808, 445);
      }


      $img->save($rutanueva . $nombreImagen);


      $post->url_image = $rutanueva;
      $post->name_image = $nombreImagen;
    }

    $post->category_id = $request->category_id;
    $post->title = $request->title;
    $post->description = $request->description;


    $post->update();

    return redirect()->route('blog.index')->with('success', 'Post actualizado');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Blog $blog)
  {
    //
  }


  public function deleteBlog(Request $request)
  {
    //Recupero el id mandado mediante ajax
    $id = $request->id;
    //Busco el servicio con id como parametro
    $service = Blog::findOrfail($id);
    //Modifico el status a false
    $service->status = false;
    //Guardo 
    $service->save();

    // Devuelvo una respuesta JSON u otra respuesta según necesites
    return response()->json(['message' => 'Post eliminado.']);
  }



  public function updateVisible(Request $request)
  {
    // Lógica para manejar la solicitud AJAX
    //return response()->json(['mensaje' => 'Solicitud AJAX manejada con éxito']);
    $id = $request->id;

    $field = $request->field;

    $status = $request->status;

    $service = Blog::findOrFail($id);

    $service->$field = $status;

    $service->save();

    return response()->json(['message' => 'Servicio eliminado.']);
  }
}
