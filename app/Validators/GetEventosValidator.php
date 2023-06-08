<?php

namespace App\Validators;


use App\Rules\CategoriaExistenteRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class GetEventosValidator
 * @package App\Validators
 *
 * Validador para la obtención de eventos.
 */
class GetEventosValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'categoria_id' => ['required', 'numeric', new CategoriaExistenteRule()],
            'fecha' => ['date', 'date_format:Y-m-d']
        ];

        $validator = Validator::make($request->all(), $validations,
            $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;
    }
}
