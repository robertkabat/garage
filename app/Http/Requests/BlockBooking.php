<?php

namespace App\Http\Requests;

class BlockBooking extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required',
            'timeSlotIds' => 'sometimes'
        ];
    }
}
