<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {

        return view('admin.drivers.index');
    }

    public function create()
    {
        $users = User::all();
        return view('admin.drivers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required|exists:users,id',
                'type' => 'required | in:1,2',
                'plate_number' => 'required | string',
            ],
            [
                'user_id.required' => 'El usuario es requerido.',
                'user_id.exists' => 'El usuario no existe.',
                'type.required' => 'El tipo de unidad es requerido.',
                'type.in' => 'El tipo de unidad no es válido.',
                'plate_number.required' => 'El número de placa es requerido.',
            ]
        );

        Driver::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Conductor registrado!',
            'text' => 'El conductor ha sido registrado correctamente.'
        ]);

        return redirect()->route('admin.drivers.index');
    }

    public function show(Driver $driver, Request $request)
    {
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $users = User::all();
        return view('admin.drivers.edit', compact('driver', 'users'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate(
            [
                'user_id' => 'required|exists:users,id',
                'type' => 'required | in:1,2',
                'plate_number' => 'required | string',
            ],
            [
                'user_id.required' => 'El usuario es requerido.',
                'user_id.exists' => 'El usuario no existe.',
                'type.required' => 'El tipo de unidad es requerido.',
                'type.in' => 'El tipo de unidad no es válido.',
                'plate_number.required' => 'El número de placa es requerido.',
            ]
        );

        $driver->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Conductor actualizado!',
            'text' => 'El conductor ha sido actualizado correctamente.'
        ]);

        return redirect()->route('admin.drivers.index');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Conductor eliminado!',
            'text' => 'El conductor ha sido eliminado correctamente.'
        ]);

        return redirect()->route('admin.drivers.index');
    }
}
