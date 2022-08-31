<?php

use Illuminate\Support\Facades\Redis;

/**
 * Get stored data from the redis server
 *
 * @return void
 */
function getRedisData()
{
      $storeData = Redis::get(config("constant.REDIS_KEY"));
      return json_decode($storeData, true);
}

/**
 * get all bookings as per the date, date as a key and bookings as a value in  array object format.
 *
 * @return void
 */
function getAllBokingList()
{
      $storeData = Redis::get(config("constant.REDIS_KEY"));
      $bookingList = json_decode($storeData, true);
      $result = [];

      if (is_array($bookingList) && count($bookingList) > 0) {
            $result = array_reduce($bookingList, function ($res, $row) {
                  $res[$row['date']] = ($res[$row['date']] ?? 0) + $row['numOfGuests'];
                  return $res;
            });
      }

      return $result;
}


/**
 * set the data in the redis state, it update the current data
 *
 * @param [type] $newBookings
 * @return void
 */
function setRedisData($newBookings)
{
      return Redis::set(config("constant.REDIS_KEY"), json_encode($newBookings));
}

/**
 * api response format, it will response same structure for success and error
 *
 * @param [type] $success
 * @param [type] $message
 * @param [type] $data
 * @return void
 */
function apiResponse($success, $message, $data)
{
      return response()->json([
            "success"   => $success,
            "message"   => $message,
            "data"      => $data
      ]);
}
