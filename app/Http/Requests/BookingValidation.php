<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\DateValidation;
use App\Rules\SlotValidation;

class BookingValidation extends FormRequest
{
      /**
       * Determine if the user is authorized to make this request.
       *
       * @return bool
       */
      public function authorize()
      {
            return true;
      }

      /**
       * Get the validation rules that apply to the request.
       *
       * @return array
       */
      public function rules()
      {
            return [
                  "date" => [
                        "required","date_format:d/m/Y","after:today", new DateValidation()
                  ],
                  "numOfGuests" => ["required", "numeric", "max:8", "min:1", new SlotValidation()],
            ];
      }

      public function failedValidation($validator)
      {
            throw new HttpResponseException(apiResponse(false, config("constant.ERROR.VALIDATION_ERROR"), $validator->errors()));
      }
}
