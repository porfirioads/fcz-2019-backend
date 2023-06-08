<?php

namespace App\Validators;


use App\Rules\CategoriaEsSedeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class GetSedeValidator
 * @package App\Validators
 *
 * Validador para la obtención de la sede a partir de su categoría asociada.
 */
class GetSedeValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'categoria_id' => ['required', 'numeric', new CategoriaEsSedeRule()]
        ];

        $validator = Validator::make($request->all(), $validations,
            $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;

    }
}
