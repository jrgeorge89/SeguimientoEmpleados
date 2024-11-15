<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Employee;
use Carbon\Carbon;

class CreateEmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_employee_can_be_created(): void
    {
        $createData = [
            'fullname' => 'Jorge Rincon',
            'email' => 'jrgeorge89@gmail.com',
            'area' => 'Tecnologia',
            'category_id' => '1',
            'company' => 'Tumipay',
            'url_logo' => 'Logo',
            'satisfaction' => '1',
            'favorite' => '1'
        ];

        $response = $this->post('/api/employees', $createData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('employees', $createData);
        
    }

}
