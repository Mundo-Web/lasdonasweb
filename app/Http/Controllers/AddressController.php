<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoDe\Extend\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function save(Request $request)
    {

        $response = new Response();
        $response->status = 200;
        $response->message = 'Operacion correcta';

        $data = $request->all();
        $datafull = $request->except('coordinates');

        // dump($data)  ;  

        $body = [];
        $body['user_id'] = Auth::user()->id;
        $fullname = Auth::user()->name . ' ' . Auth::user()->lastname;
        $body['address_full'] = $data['fulladdress'] . ', ' . $data['department'] . ', ' . $data['province'] . ', ' . $data['district'];
        $body['address_owner'] = $fullname;
        $body['address_zipcode'] = $data['postal_code'];
        $body['address_latitude'] = $data['coordinates']['latitude'];
        $body['address_longitude'] = $data['coordinates']['longitude'];
        $body['address_data'] = $datafull;
        $body['price_amount'] = $data['price'];
        $body['is_default'] = false;


        
        
        $jpa = Address::find($request->id);
        if (!$jpa) {
            $body['status'] = true;
            Address::create($body);
        } else {
            $jpa->update($body);
        }

        return \response($response->toArray(), $response->status);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function delete(Request $request, string $id)
    {
        $response = new Response();
        try {
            $deleted = Address::where('id', $id)->delete();
            if ($deleted == 0) throw new Exception('No hay registros a eliminar');

            $response->status = 200;
            $response->message = 'Operacion correcta';
        } catch (\Throwable $th) {
            $response->status = 400;
            $response->message = $th->getMessage();
        } finally {
            return response(
                $response->toArray(),
                $response->status
            );
        }
    }

    public function markasfavorite(Request $request)
    {

        Address::where('user_id', Auth::user()->id)
            ->where('is_default', true)
            ->update([
                'is_default' => false
            ]);

        $address = Address::findOrfail($request->id);
        $address->is_default = true;
        $address->save();

        return response()->json(['message' => 'Direccion marcada como favorito']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
