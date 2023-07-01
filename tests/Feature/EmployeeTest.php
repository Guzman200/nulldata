<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class EmployeeTest extends TestCase
{

    /**
     * Create a new employee
     *
     * @return void
     */
    public function test_create_employee()
    {

        $data = [
            'name' => 'Test',
            'email' => Str::random(5)  .'@gmail.com',
            'job' => 'Testing QA',
            'birthdate' => '2000-08-15',
            'residence' => 'Domicilio conocido',
            'skills'    => [
                ['id' => 1, 'calification' => 5],
                ['id' => 2, 'calification' => 6]
            ]
        ];

        $response = $this->post('/api/v1/employee',$data);

        $response->assertStatus(201);
    }

    /**
     * Create a new employee with format birthdate incorrect
     *
     * @return void
     */
    public function test_create_employee_with_format_birthdate_incorrect()
    {

        $data = [
            'name' => 'Test',
            'email' => Str::random(5)  .'@gmail.com',
            'job' => 'Testing QA',
            'birthdate' => '08-08-2000',
            'residence' => 'Domicilio conocido',
            'skills'    => [
                ['id' => 1, 'calification' => 5],
                ['id' => 2, 'calification' => 6]
            ]
        ];

        $this->json('POST', '/api/v1/employee',$data)->assertStatus(422);
    }

    /**
     * Get all employees with pagination test
     *
     * @return void
     */
    public function test_get_employees()
    {
        $response = $this->get('/api/v1/employee');

        $response->assertStatus(200);
    }

    /**
     * Get employee by id
     *
     * @return void
     */
    public function test_get_employee_by_id()
    {

        $employee = User::first();

        $response = $this->get('/api/v1/employee/' . $employee->id);

        $response->assertStatus(200);
    }

    /**
     * Delete employee by id
     *
     * @return void
     */
    public function test_delete_employee_by_id()
    {

        $employee = User::first();

        $response = $this->delete('/api/v1/employee/' . $employee->id);

        $response->assertStatus(200);
    }
}
