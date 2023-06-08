<?php

namespace App\Validators;


use App\Rules\EventoExistenteRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CalificarEventoValidator
 * @package App\Validators
 *
 * Validador para la calificación de los eventos.
 */
class CalificarEventoValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'procedencia' => ['required', 'max:25'],
            'sexo' => ['required', 'max:10'],
            'edad' => ['required', 'max:15'],
            'evento_id' => ['required', 'numeric', new EventoExistenteRule()],
            'calificacion' => ['required', 'numeric', 'between:1,5'],
            'comentario' => ['max:300']
        ];

        $validator = Validator::make($request->all(), $validations,
            $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;

    }
}
