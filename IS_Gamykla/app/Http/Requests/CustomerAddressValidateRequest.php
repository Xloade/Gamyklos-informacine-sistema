<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressValidateRequest extends FormRequest
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
            'salis' => 'required|string|min:5|alpha',
            'miestas' => 'required|string|min:2|alpha',
            'gatve' => 'required|string|min:5',
            'buto_nr' => 'required|string|min:2',
        ];
    }
    public function messages()
    {
        return [
            'salis.required' => 'Įrašykite šalį',
            'salis.min' => 'Per mažai simbolių',
            'salis.alpha' => 'Šalis rašosi tik iš raidžių',
            'miestas.required' => 'Įrašykite miestą',
            'miestas.min' => 'Per mažai simbolių',
            'miestas.alpha' => 'Miestas rašosi tik iš raidžių',
            'gatve.required' => 'Įrašykite gatvę',
            'gatve.min' => 'Per mažai simbolių',
            'buto_nr.required' => 'Įrašykite buto numerį',
            'buto_nr.min' => 'Per mažai simbolių',
        ];
    }
}
