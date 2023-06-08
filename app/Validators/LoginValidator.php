<?php

namespace App\Validators;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Validador para la autenticación de usuarios.
 *
 * Class LoginValidator
 * @package App\Validators
 */
class LoginValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'usuario' => ['required', 'max:50'],
            'password' => ['required', 'max:20']
        ];

        $validator = Validator::make($request->all(), $validations,
            $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;
    }
}
