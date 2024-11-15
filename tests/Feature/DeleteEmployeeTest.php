<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;
use Carbon\Carbon;

class DeleteEmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_employee_can_be_delete(): void
    {
        // Arrange
        $employee = Employee::create([
            'fullname' => 'Jorge Rincon',
            'email' => 'jrgeorge89@gmail.com',
            'area' => 'Tecnologia',
            'category_id' => '1',
            'company' => 'Tumipay',
            'url_logo' => 'Logo',
            'satisfaction' => '1',
            'favorite' => '1',
        ]);

        // Act
        $response = $this->delete('/api/employees/'. $employee->id);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
