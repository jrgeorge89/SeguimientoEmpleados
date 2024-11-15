<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;
use Carbon\Carbon;

class ReadEmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_employee_can_be_read(): void
    {
        //Arrange
        Employee::create([
            'fullname' => 'Jorge Rincon',
            'email' => 'jrgeorge89@gmail.com',
            'area' => 'Tecnologia',
            'category_id' => '1',
            'company' => 'Tumipay',
            'url_logo' => 'Logo',
            'satisfaction' => '1',
            'favorite' => '1'
        ]);
        
        Employee::create([
            'fullname' => 'Andrea Rivera',
            'email' => 'andrea@gmail.com',
            'area' => 'Administracion',
            'category_id' => '1',
            'company' => 'La Colina',
            'url_logo' => 'Logo',
            'satisfaction' => '80',
            'favorite' => '1'
        ]);

        //Act
        $response = $this->get('/api/employees');

        //Assert
        $response->assertStatus(200);

        $response->assertSee('Jorge Rincon');
        $response->assertSee('Andrea Rivera');

    }
}
