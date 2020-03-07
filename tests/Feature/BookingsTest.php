<?php

namespace Tests\Feature;

use App\Enums\StatusCodeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BookingsTest extends TestCase
{
    use WithFaker;

    private function getBookingsData()
    {
        return [
            'title' => $this->faker->text
        ];
    }

    public function testCreate()
    {
        DB::beginTransaction();
        $data = $this->getBookingsData();
        $response = $this->post(route('create-booking'), $data);
        $response->assertStatus(StatusCodeEnum::CREATED);
    }

    public function testFindBooking()
    {
        $response = $this->get(route('find-booking', 1));
        $response->assertStatus(StatusCodeEnum::OK);
        DB::rollBack();
    }

    public function testUpdate()
    {
        $data = $this->getBookingsData();
        $data['title'] = $this->faker->text;
        $response = $this->patch(route('update-booking', 1), $data);
        $response->assertStatus(StatusCodeEnum::UPDATED);
    }


}
