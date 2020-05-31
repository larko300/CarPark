<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function carParks()
    {
        return $this->belongsToMany('App\CarPark');
    }

    /**
     * Create new car/cars or skip already exist and return car's id in array
     *
     * @param array $carData
     * @return array
     */
    public static function createOrSkipExist(array $carData): array
    {
        $id = array();
        for ($i = 0; $i < count($carData['new_car_number']); $i++) {
            $carExist = Car::where('number', $carData['new_car_number'][$i])->first();
            if ($carExist === null) {
                $car = new Car();
                $car->number = $carData['new_car_number'][$i];
                $car->driver = $carData['new_car_driver'][$i];
                $car->owner_id = auth()->id();
                $car->save();
                $id[] = $car->id;
            } else {
                $id[] = $carExist->id;
            }
        }
        return $id;
    }

    /**
     * @param array $carNumber
     * @param array $carDriver
     */
    public static function editExist(array $carNumber, array $carDriver)
    {
        foreach ($carNumber as $key => $value) {
            $car = self::findOrFail($key);
            $car->number = $value;
            $car->driver = $carDriver[$key];
            $car->save();
        }
    }
}
