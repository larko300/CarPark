<?php

namespace Tests\Feature;

use App\Car;
use App\CarPark;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_see_car_list()
    {
        $this->createUserAndAssignRoleManager();
        $response = $this->get('/car');
        $response->assertStatus(200);
    }

    public function test_manager_can_see_carpark_list()
    {
        $this->createUserAndAssignRoleManager();
        $response = $this->get('/carpark');
        $response->assertStatus(200);
    }

    public function test_manager_can_create_car()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/car', [
            'number' => 'test number',
            'driver' => 'name',
        ]);
        $this->assertCount(1, Car::all());
    }

    public function test_manager_can_edit_car()
    {
        $this->createUserAndAssignRoleManager();
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

    public function test_manager_can_delete_car()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/car', [
            'number' => 'test number',
            'driver' => 'name',
        ]);
        $this->delete('/car/1');
        $this->assertEmpty(Car::all());
    }

    public function test_manager_can_create_carpark()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/carpark', [
            'name' => 'test name',
            'address' => 'test address',
            'working_time' => 'test'
        ]);
        $this->assertCount(1, CarPark::all());
    }

    public function test_manager_can_edit_carpark()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/carpark', [
            'name' => 'test name',
            'address' => 'test address',
            'working_time' => 'test'
        ]);
        $this->patch('/carpark/1', [
            'name' => 'edited name',
            'address' => 'edited address',
            'working_time' => 'edited'
        ]);
        $carParl = CarPark::where('name', 'edited name')->first();
        $this->assertNotEmpty($carParl);
    }

    public function test_manager_can_delete_carpark()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/carpark', [
            'name' => 'test name',
            'address' => 'test address',
            'working_time' => 'test'
        ]);
        $this->delete('/carpark/1');
        $this->assertEmpty(Car::all());
    }

    public function test_manager_can_create_carpark_with_cars()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/carpark', [
            'name' => 'test name',
            'address' => 'test address',
            'working_time' => 'test',
            'new_car_number' => ['test number'],
            'new_car_driver' => ['test driver']
        ]);
        $carPark = CarPark::where(['name' => 'test name'])->first();
        $this->assertNotEmpty($carPark);
        $this->assertNotEmpty($carPark->cars());
    }

    public function test_manager_can_edit_carpark_with_cars()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/carpark', [
            'name' => 'test name',
            'address' => 'test address',
            'working_time' => 'test',
            'new_car_number' => ['test number'],
            'new_car_driver' => ['test driver']
        ]);
        $this->patch('/carpark/1', [
            'name' => 'edited name',
            'address' => 'edited address',
            'working_time' => 'edited',
            'exist_car_number' => [1 => 'edited numbera'],
            'exist_car_driver' => [1 => 'edited drivera'],
        ]);
        $carPark = CarPark::where(['name' => 'edited name'])->first();
        $car = Car::where(['number' => 'edited numbera'])->first();
        $this->assertNotEmpty($carPark);
        $this->assertNotEmpty($car);
    }

    public function test_manager_can_edit_carpark_with_cars_and_add_new_cars()
    {
        $this->createUserAndAssignRoleManager();
        $this->post('/carpark', [
            'name' => 'test name',
            'address' => 'test address',
            'working_time' => 'test',
            'new_car_number' => ['test number'],
            'new_car_driver' => ['test driver']
        ]);
        $this->patch('/carpark/1', [
            'name' => 'edited name',
            'address' => 'edited address',
            'working_time' => 'edited',
            'exist_car_number' => [1 => 'edited numbera'],
            'exist_car_driver' => [1 => 'edited drivera'],
            'new_car_number' => ['testa number'],
            'new_car_driver' => ['testa driver']
        ]);
        $carPark = CarPark::where(['name' => 'edited name'])->first();
        $carEdited = Car::where(['number' => 'edited numbera'])->first();
        $carNew = Car::where(['number' => 'testa number'])->first();
        $this->assertNotEmpty($carPark);
        $this->assertNotEmpty($carEdited);
        $this->assertNotEmpty($carNew);
    }

    protected function createUserAndAssignRoleManager()
    {
        $user = factory(User::class)->create();
        Role::create(['name' => 'manager']);
        $this->actingAs($user->assignRole('manager'));
    }
}
