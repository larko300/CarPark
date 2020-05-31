<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarPark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarParkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carParks = CarPark::all()->sortByDesc('id');
        return view('carpark/index', compact('carParks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carpark/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'min:3'],
            'working_hours' => ['nullable', 'string', 'min:3'],
            'new_car_number.*' => ['nullable', 'string', 'min:3'],
            'new_car_driver.*' => ['nullable', 'string', 'min:3']
        ]);
        $carPark = new CarPark();
        $carPark->name = $attributes['name'];
        $carPark->address = $attributes['address'];
        isset($attributes['working_hours']) ? $carPark->working_hours = $attributes['working_hours'] : '';
        $carPark->save();
        if (isset($attributes['new_car_number'])) {
            $carId = Car::createOrSkipExist(array_slice($attributes, -2));
            $carPark->cars()->attach($carId);
        }
        return redirect()->route('carpark.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carPark = CarPark::findOrFail($id);
        return view('carpark/edit', compact('carPark'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'min:3'],
            'working_hours' => ['nullable','string'],
            'exist_car_number.*' => ['nullable', 'string', 'min:3'],
            'exist_car_driver.*' => ['nullable', 'string', 'min:3'],
            'new_car_number.*' => ['nullable', 'string', 'min:3'],
            'new_car_driver.*' => ['nullable', 'string', 'min:3']
        ]);
        $carPark = CarPark::findOrFail($id);
        $carPark->name = $attributes['name'];
        $carPark->address = $attributes['address'];
        isset($attributes['working_hours']) ? $carPark->working_hours = $attributes['working_hours'] : '';
        $carPark->save();
        if (isset($attributes['exist_car_number'])) {
            Car::editExist($attributes['exist_car_number'], $attributes['exist_car_driver']);
        }
        if (isset($attributes['new_car_number'])) {
            $carId = Car::createOrSkipExist(array_slice($attributes, -2));
        }
        isset($carId) ? $carPark->cars()->attach($carId) : '';
        return redirect()->route('carpark.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carPark = CarPark::findOrFail($id);
        $carPark->delete();
        return back();
    }
}
