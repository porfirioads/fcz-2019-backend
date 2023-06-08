<?php

namespace App\Validators;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Validador para la creación de un nuevo evento.
 *
 * Class NuevoEventoValidator
 * @package App\Validators
 */
class NuevoEventoValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'nombre' => ['required', 'max:100'],
            'fecha' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'tarjeta_frontal' => ['required', 'image', 'max:1024'],
            'tarjeta_trasera' => ['required', 'image', 'max:1024'],
            'categorias' => ['required', 'array', 'min:1']
        ];

        $validator = Validator::make($request->all(), $validations, $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;

    }
}
