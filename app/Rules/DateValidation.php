<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DateValidation implements Rule
{
      /**
       * Determine if the validation rule passes.
       *
       * @param  string  $attribute
       * @param  mixed  $value
       * @return bool
       */
      public function passes($attribute, $date)
      {
            $bookingDate = Carbon::createFromFormat("d/m/Y", $date);
            $today = Carbon::now();

            if ($bookingDate->isWeekday() && in_array($bookingDate->month, [6,7,8]) && $today->diffInYears($bookingDate) < 2) {
                  return true;
            }

            return false;
      }

      /**
       * Get the validation error message.
       *
       * @return string
       */
      public function message()
      {
            return config("constant.ERROR.DATE_ERROR");
      }
}
