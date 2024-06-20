<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faqs::where("status", "=", true)->get();
        return view('pages.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Faqs::create($request->all());
        return redirect()->route('faqs.index')->with('success', 'FAQS creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faqs $faqs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faqs = Faqs::find($id);
        return view('pages.faqs.edit', compact('faqs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string  $id)
    {
        $faqs = Faqs::find($id);
        $faqs->update($request->all());
        return redirect()->route('faqs.index')->with('success', 'FAQS actualizada exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function borrar(Request $request)
    {
      //softdelete
      $product = Faqs::find($request->id);
      $product->status = 0 ; 
      $product->save();
  
    }
    public function updateVisible(Request $request){
        $id = $request->id; 
        $stauts = $request->status; 
        $staff = Faqs::find($id);
        $staff->visible = $stauts; 

        $staff->save();
        return response()->json(['message'=> 'registro actualizado']);
    }
    
}
