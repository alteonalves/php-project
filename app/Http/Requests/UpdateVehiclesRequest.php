<?php

namespace App\Http\Requests;

use App\Rules\ValidBrand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehiclesRequest extends FormRequest
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
            'vehicle' => ['sometimes', 'string', 'max:50',
                Rule::unique('vehicles')
                ->where(fn ($q) => $q->where('brand', $this->brand)->where('year', $this->year))
                ->ignore($this->route('vehicle')),
            ],
            'brand' => ['sometimes', 'string', 'max:40', new ValidBrand()],
            'year' => ['sometimes', 'integer'],
            'sold' => ['sometimes', 'boolean'],
            'description' => ['nullable', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle.unique' => 'Já existe um veículo com essa marca e ano.',
        ];
    }

}
