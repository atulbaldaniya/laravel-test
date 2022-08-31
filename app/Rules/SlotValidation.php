<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SlotValidation implements Rule
{
      /**
       * Determine if the validation rule passes.
       *
       * @param  string  $attribute
       * @param  mixed  $value
       * @return bool
       */
      public function passes($attribute, $value)
      {
            $date = request()->get("date");
            $redisData = getAllBokingList();

            $bookingGuest = isset($redisData[$date]) ? $redisData[$date] : 0;
            $totalGuest = $bookingGuest + $value;

            return $totalGuest <= 8;
      }

      /**
       * Get the validation error message.
       *
       * @return string
       */
      public function message()
      {
            return config("constant.ERROR.SLOT_ERROR");
      }
}
