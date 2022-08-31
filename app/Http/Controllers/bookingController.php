<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingValidation;
use Carbon\Carbon;

class bookingController extends Controller
{
      /**
       * function to get the list of bookings for all dates.
       *
       */
      public static function read()
      {
            $bookingList =  getAllBokingList();
            return apiResponse(true, "", $bookingList);
      }

      /**
       * function to create a new booking. 
       * BookingValidation will validate all conditions for bookings
       * @param Request $request
       * @return 
       */
      public function create(BookingValidation $request)
      {
            $redisData = getRedisData();
            $currentBookings = $redisData ? $redisData : [];
            $today = Carbon::now()->format("d/m/Y h:i:s");

            $data = (object) array("date" => $request->date, "numOfGuests" => $request->numOfGuests, "updatedAt" => $today);
            $currentBookings[] = $data;

            // update new booking data in redis
            setRedisData($currentBookings);

            return apiResponse(true, config("constant.SUCCESS.BOOKING_CREATED"), $data);
      }
}
