<?php

namespace App\Validators;


use App\Rules\EventoExistenteRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Validador para la actualización de eventos.
 *
 * Class EditarEventoValidator
 * @package App\Validators
 */
class EditarEventoValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'evento_id' => ['required', 'numeric', new EventoExistenteRule()],
            'nombre' => ['required', 'max:100'],
            'fecha' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'tarjeta_frontal' => ['image', 'max:1024'],
            'tarjeta_trasera' => ['image', 'max:1024'],
            'categorias' => ['required', 'array', 'min:1']
        ];

        $validator = Validator::make($request->all(), $validations, $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;

    }
}
