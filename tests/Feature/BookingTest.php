<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class BookingTest extends TestCase
{
      /**
       * A basic feature test example.
       *
       * @return void
       */
      public function test_get_booking_list()
      {
            $response = $this->getJson("/api/bookings/read");
            $response->assertStatus(200);
      }

      /**
       * try to book today's slots
       *
       * @return void
       */
      public function test_create_today_booking()
      {
            $date = Carbon::now()->format("d/m/Y");
            $response = $this->post("/api/bookings/create", ["date" => $date, "numOfGuests" => 1])->getContent();
            $success = json_decode($response)->success;
            $this->assertTrue($success === false);
      }

      /**
       * try to book weekends's slots
       *
       * @return void
       */
      public function test_create_weekend_booking()
      {
            $date = "03/06/2023";
            $response = $this->post("/api/bookings/create", ["date" => $date, "numOfGuests" => 1])->getContent();
            $success = json_decode($response)->success;
            $this->assertTrue($success === false);
      }
      
      /**
       * try to book more than 8 slots
       *
       * @return void
       */
      public function test_create_morethan_8_booking()
      {
            $date = "01/06/2023";
            $response = $this->post("/api/bookings/create", ["date" => $date, "numOfGuests" => 9])->getContent();
            $success = json_decode($response)->success;
            $this->assertTrue($success === false);
      }

      /**
       * try to book other months for example jan, feb or march
       *
       * @return void
       */
      public function test_create_other_month_booking()
      {
            $date = "01/01/2023";
            $response = $this->post("/api/bookings/create", ["date" => $date, "numOfGuests" => 1])->getContent();
            $success = json_decode($response)->success;
            $this->assertTrue($success === false);
      }

      /**
       * try to add a booking with proper valid date
       *
       * @return void
       */
      public function test_create_weekday_booking()
      {
            $date = "01/06/2023";
            $response = $this->post("/api/bookings/create", ["date" => $date, "numOfGuests" => 1])->getContent();
            $success = json_decode($response)->success;
            $this->assertTrue($success === true);
      }
}
