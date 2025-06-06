<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidBrand implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected array $validBrands = [
            'Toyota',
            'Volkswagen',
            'Mercedes-Benz',
            'Hyunday',
            'Kia',
            'BMW',
            'Honda',
            'Ford',
            'Audi',
            'Tesla',
            'Volvo',
            'Nissan',
            'Renault',
            'General Motors',
            'Stellatins',
            'Geely',
            'Subaru',
            'Chevrolet',
            'Suzuki',
            'Lexus',
            'BYD',
            'Fiat'
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->validBrands, true)) {
            $fail('A marca informada não é válida.');
        }
    }

}
