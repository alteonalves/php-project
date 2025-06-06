<?php

namespace App\Http\Requests;

use App\Rules\ValidBrand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehiclesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'vehicle' => ['required', 'string', 'max:50',
                Rule::unique('vehicles')->where(function ($query) {
                    return $query->where('vehicle', $this->vehicle)
                                ->where('brand', $this->brand)
                                ->where('year', $this->year);
                }),
            ],
            'brand' => ['required', 'string', 'max:40', new ValidBrand()],
            'year' => ['required', 'int'],
            'sold' => ['required', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle.unique' => 'Já existe um veículo com essa marca e ano.',
            'brand.in' => 'Nome de marca inválido',
        ];
    }

}
