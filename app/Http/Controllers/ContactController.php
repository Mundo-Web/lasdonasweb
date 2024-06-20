<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reglasValidacion = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cellphone' => 'required|integer|max:99999999999',
            'typeservice' => 'required|string|max:255',
            'typecontact' => 'required|string|max:255',
            'hourcontact' => 'required|string|max:20',
        ];
    
        $mensajes = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no puede tener más de :max caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
            'cellphone.required' => 'El campo teléfono es obligatorio.',
            'cellphone.integer' => 'El campo teléfono debe ser un número entero.',
            'typeservice.required' => 'El campo tipo de proyecto es obligatorio.',
            'typeservice.max' => 'El campo tipo de proyecto no puede tener más de :max caracteres.',
            'message.required' => 'El campo mensaje es obligatorio.',
            'typecontact.required' => 'El campo tipo de contacto es obligatorio.',
            'typecontact.max' => 'El campo tipo de contacto no puede tener más de :max caracteres.',
            'hourcontact.required' => 'El campo hora de contacto es obligatorio.',
            'hourcontact.date_format' => 'El formato de la hora de contacto no es válido.',
        ];


        $request->validate($reglasValidacion, $mensajes);

        $contact = Contact::create($request->all());
       
        return redirect()->route('xxxxx', $contact)->with('mensaje','Mensaje enviado exitoso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
