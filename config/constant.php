<?php

return [
    "REDIS_KEY" => "booking_slots",
    "ERROR"=> [
      "REDIS_ERROR"=>"Sorry! we are not able to make booking at time, please try again later.",
      "VALIDATION_ERROR"=>"Validation errors",
      "DATE_ERROR"=>"Sorry! You selected a invalid date.",
      "SLOT_ERROR"=>"Sorry! These number of slots are not available."
    ],
    "SUCCESS"=> [
      "BOOKING_CREATED"=>"Booking created successfully!"
    ]
];

?>