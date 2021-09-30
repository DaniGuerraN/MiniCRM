<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Employee;
use App\Models\Company;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker; 
class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    
    /**
     * index of EmployeeController, get all companies.
     *
     * @return void
     */
    public function test_can_get_employees()
    {
        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        $this->json('GET','api/employee')->assertStatus(200);
    }

    /**
     * store of EmployeeController, create a employee;
     *
     * @return void
     */
    public function test_can_create_employee()
    {
        $faker = Faker::create();

        User::factory(1)->create();
        $user = User::find(1);

        $this->actingAs($user);

        Company::factory(1)->create();

        $company = Company::find(1);

        $employee = Employee::factory(1)->create();

        $employee = $employee[0];


        $data = [
            'first_name'=>$employee["first_name"],
            'last_name'=>$employee["last_name"],
            'company_id'=>$company->id,
            'email'=>$faker->freeEmail(),
            'phone_number'=>$employee["phone_number"]
        ];


        $this->json('POST','api/employee',$data)->assertStatus(200);
    }

        
    /**
     * show of EmployeeController, get a employee.
     *
     * @return void
     */
    public function test_can_show_employee()
    {
        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        Company::factory(1)->create();

        $employee = Employee::factory(1)->create();

        $this->json('GET','api/employee/'.Employee::find(1)->id)->assertStatus(200);
    }


    /**
     * update of EmployeeController, update a employee.
     *
     * @return void
     */
    public function test_can_update_Employee()
    {
        $faker = Faker::create();

        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        Company::factory(1)->create();

        $company = Company::find(1);

        $employee = Employee::factory(1)->create();

        $employee = Employee::find(1);

        $data = [
            'first_name'=>$employee["first_name"],
            'company_id'=>$company->id,
            'email'=>$faker->freeEmail(),
            'phone_number'=>$employee["phone_number"]
        ];

        $this->json('PUT','api/employee/'.$employee->id,$data)->assertStatus(200);

    }


    /**
     * delete of EmployeeController, delete a employee.
     *
     * @return void
     */
    public function test_can_delete_employee()
    {
        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        Company::factory(1)->create();

        $employee = Employee::factory(1)->create();

        $this->json('DELETE','api/employee/'.Employee::find(1)->id)->assertStatus(200);
    }
}
