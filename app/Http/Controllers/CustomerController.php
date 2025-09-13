<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'DNI' => 'required|string|max:20|unique:customers,DNI',
            'email' => 'required|email|unique:customers,email',
            'celular' => 'required|string|max:20|unique:customers,celular',
            'direccion' => 'required|string|max:255',
        ]);

        Customer::create($request->all());

        
        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente creado exitosamente.');
    } catch (\Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Error al crear el cliente: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'DNI' => 'required|string|max:20|unique:customers,DNI,' . $customer->id,
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'celular' => 'required|string|max:20|unique:customers,celular,' . $customer->id,
            'direccion' => 'required|string|max:255',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Cliente actualizado exitosamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Cliente eliminado exitosamente :(');
    }
}
