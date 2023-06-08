<?php

namespace App\Validators;


use App\Rules\EventoExistenteRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Validador para obtener evento por medio de su id.
 *
 * Class GetEventoByIdValidator
 * @package App\Validators
 */
class GetEventoByIdValidator extends BaseValidator
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
        ];

        $validator = Validator::make($request->all(), $validations,
            $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;

    }
}
