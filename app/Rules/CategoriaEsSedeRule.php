<?php

namespace App\Rules;

use App\Sede;
use Illuminate\Contracts\Validation\Rule;

class CategoriaEsSedeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Sede::where('categoria_id', '=', $value)->first() != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La categoría no está asociada a una sede.';
    }
}
