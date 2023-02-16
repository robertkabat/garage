<?php

namespace App\Http\Requests;

class CreateBooking extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:200',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:60',
            'make' => 'required|max:60',
            'model' => 'required|max:60',
            'date' => 'required',
            'timeSlotId' => 'required|exists:time_slots,id',
        ];
    }
}
