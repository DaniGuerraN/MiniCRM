<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Company;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker; 
class CompanyTest extends TestCase 
{ 
    use RefreshDatabase;

    
    /**
     * index of CompanyController, get all companies.
     *
     * @return void
     */
    public function test_can_get_companies()
    {
        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        $this->json('GET','api/company')->assertStatus(200);
    }

    /**
     * store of CompanyController, create a company;
     *
     * @return void
     */
    public function test_can_create_company()
    {
        $faker = Faker::create();

        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        $company = Company::factory(1)->create();

        $company = Company::find(1);


        $data = [
            'name'=>$company["name"],
            'email'=>$faker->freeEmail(),
            'image'=>UploadedFile::fake()->image('avatar.jpg', 200, 200),
            'web_site'=>$company["web_site"]
        ];


        $this->json('POST','api/company',$data)->assertStatus(200);
    }

        
    /**
     * show of CompanyController, get a company.
     *
     * @return void
     */
    public function test_can_show_company()
    {
        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        $company = Company::factory(1)->create();
        $this->json('GET','api/company/'.Company::find(1)->id)->assertStatus(200);
    }


    /**
     * update of CompanyController, update a company.
     *
     * @return void
     */
    public function test_can_update_company()
    {
        $faker = Faker::create();

        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        $company = Company::factory(1)->create();

        $company = Company::find(1);

        $data = [
            'name'=>$company["name"] . 2,
            'email'=>$faker->freeEmail(),
            'web_site'=>$company["web_site"]
        ];

        $this->json('PUT','api/company/'.$company->id,$data)->assertStatus(200);

    }


    /**
     * delete of CompanyController, delete a company.
     *
     * @return void
     */
    public function test_can_delete_company()
    {
        User::factory(1)->create();
        $user = User::find(1);
        $this->actingAs($user);

        $company = Company::factory(1)->create();

        $this->json('DELETE','api/company/'.Company::find(1)->id)->assertStatus(200);
    }


}
