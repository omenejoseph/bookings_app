<?php

namespace Tests\Feature;

use App\Enums\StatusCodeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Faker\Generator as Faker;

class CreateUserTest extends TestCase
{
    use WithFaker;

    private $user;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }



    public function testCreateUser()
    {
        DB::beginTransaction();
        $data = $this->userData();
        \Log::info($data);
        $response = $this->post('/api/v1/user', $data);
        $response->assertStatus(StatusCodeEnum::CREATED);
    }

    public function testFindUser()
    {
        $response = $this->get('/api/v1/user?id=1');
        $response->assertStatus(StatusCodeEnum::OK);
    }

    private function userData()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'gender' => 'male',
            'title' => $this->faker->title,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'username' => $this->faker->userName,
            'role' => 'admin',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
    }

    public function testUpdateUser()
    {
        $data = $this->userData();
        $data['last_name'] = $this->faker->title;
        $response = $this->get('/api/v1/user?id=1');
        $user = optional(json_decode($response->getContent()))->data;
        $response = $this->patch('/api/v1/user?id='.$user->id, $data);
        $response->assertStatus(StatusCodeEnum::UPDATED);
        DB::rollBack();

    }

}
