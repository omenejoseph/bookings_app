<?php

namespace Tests\Feature;

use App\Enums\StatusCodeEnum;
use App\Facade\AppUtils;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BookingsTest extends TestCase
{
    use WithFaker;

    private function getBookingsData()
    {
        return [
            'title' => substr($this->faker->text, 0, 30)
        ];
    }

    public function testCreate()
    {
        DB::beginTransaction();
        $data = $this->getBookingsData();
        $response = $this->post(route('create-booking'), $data, AppUtils::generateTestTokenHeader());
        $response->assertStatus(StatusCodeEnum::CREATED);
    }

    public function testFindBooking()
    {
        $response = $this->get(route('find-booking', 1), AppUtils::generateTestTokenHeader());
        $response->assertStatus(StatusCodeEnum::OK);
        DB::rollBack();
    }

    public function testUpdate()
    {
        $data = $this->getBookingsData();
        $data['title'] = $this->faker->text;
        $response = $this->patch(route('update-booking', 1), $data, AppUtils::generateTestTokenHeader());
        $response->assertStatus(StatusCodeEnum::UPDATED);
    }


}
