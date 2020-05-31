<?php

namespace Tests\Feature;

use App\Car;
use App\CarPark;
use App\User;
use Gardener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase;


    public function test_driver_can_see_car_list()
    {
        $this->createUserAndAssignRoleDriver();
        $response = $this->get('/car');
        $response->assertStatus(200);
    }


    public function test_driver_can_not_see_carpark_list()
    {
        $this->createUserAndAssignRoleDriver();
        $response = $this->get('/carpark');
        $response->assertStatus(403);
    }

    public function test_driver_can_create_car()
    {
        $this->createUserAndAssignRoleDriver();
        $this->post('/car', [
            'number' => 'test number',
            'driver' => 'name',
        ]);
        $this->assertCount(1, Car::all());
    }

    public function test_driver_can_edit_car()
    {
        $this->createUserAndAssignRoleDriver();
        $this->post('/car', [
            'number' => 'test number',
            'driver' => 'name',
        ]);
        $this->patch('/car/1', [
            'number' => 'edited number',
            'driver' => 'edited name',
        ]);
        $car = Car::where('number', 'edited number')->first();
        $this->assertNotEmpty($car);
    }

    public function test_driver_can_not_delete_car()
    {
        $this->createUserAndAssignRoleDriver();
        $this->post('/car', [
            'number' => 'test number',
            'driver' => 'name',
        ]);
        $this->delete('/car/1');
        $this->assertNotEmpty(Car::all());
    }

    protected function createUserAndAssignRoleDriver()
    {
        $user = factory(User::class)->create();
        Role::create(['name' => 'driver']);
        $this->actingAs($user->assignRole('driver'));
    }
}
