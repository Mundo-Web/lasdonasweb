<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use App\Http\Requests\StoreGreetingRequest;
use App\Http\Requests\UpdateGreetingRequest;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\GreaterThan;

class GreetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $greetings = Greeting::where("status", true)->get();
        return view('pages.greetings.index', compact('greetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $greeting = new Greeting();
        return view('pages.greetings.save', compact('greeting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        $body = $request->all();
        unset($body['_token']);
        $jpa = Greeting::find($request->id);
        if (!$jpa) {
            $jpa = Greeting::create($body);
        } else {
            $jpa->update($body);
        }
        return redirect()->route('greetings.index')->with('success', 'Mensaje guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Greeting $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $greetingId)
    {
        $greeting = Greeting::where('id', $greetingId)->first();
        return view('pages.greetings.save', compact('greeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $tag = Greeting::where('id', $id)->first();

        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success', 'Categoria modificada');
    }


    public function destroy(Request $request, string $id)
    {
        $category = Greeting::findOrfail($id);
        $category->status = false;
        $category->save();
        return response()->json(['message' => 'Mensaje elminado']);
    }



    public function updateVisible(Request $request)
    {
        // Lógica para manejar la solicitud AJAX

        $id = $request->id;

        $field = $request->field;

        $status = $request->status;

        $category = Greeting::findOrFail($id);

        $category->$field = $status;

        $category->save();

        return response()->json(['message' => 'Tag modificada']);
    }
}
