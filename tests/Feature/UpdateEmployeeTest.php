<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;
use Carbon\Carbon;

class UpdateEmployeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
    */
    
    protected $employee;

    public function setUp(): void
    {
        parent::setUp();

        // We create the employee
        $this->employee = Employee::create([
            'fullname' => 'Jorge Rincon',
            'email' => 'jrgeorge89@gmail.com',
            'area' => 'Tecnologia',
            'category_id' => '1',
            'company' => 'Tumipay',
            'url_logo' => 'Logo',
            'satisfaction' => '1',
            'favorite' => '1'
        ]);
    }

     /** 
     * @return void
     */
    public function test_employee_can_be_update(): void
    {
        // Arrange
        $updateData = [
            'fullname' => 'Nombre Actualizado',
            'email' => 'correoactualizado@gmail.com',
            'area' => 'Area Actualizada',
            'category_id' => '2',
            'company' => 'Tumipay Actualizada',
            'url_logo' => 'Logo Actualizado',
            'satisfaction' => '100',
            'favorite' => '0'
        ];

        // Act
        $response = $this->put('/api/employees/'. $this->employee->id, $updateData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('employees', $updateData);
    }
}
