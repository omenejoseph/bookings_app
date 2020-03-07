<?php

namespace Tests\Feature;

use App\Enums\StatusCodeEnum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

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
        $response = $this->post(route('create-user'), $data);
        $response->assertStatus(StatusCodeEnum::CREATED);
    }

    public function testFindUser()
    {
        $response = $this->get(route('find-user', 1));
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
        $response = $this->patch(route('update-user', 1), $data);
        $response->assertStatus(StatusCodeEnum::UPDATED);
        DB::rollBack();
    }

    public function testListUsers()
    {
        $response = $this->get('/api/v1/users');
        $response->assertStatus(StatusCodeEnum::OK);
    }

}
