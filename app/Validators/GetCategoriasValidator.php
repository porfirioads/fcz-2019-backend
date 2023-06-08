<?php

namespace App\Validators;

use App\Rules\CategoriaExistenteRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * Class GetCategoriasValidator
 *
 * Validador para la obtención de categorías.
 */
class GetCategoriasValidator extends BaseValidator
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validate(Request $request)
    {
        parent::validate($request);

        $validations = [
            'categoria_padre_id' => ['numeric', new CategoriaExistenteRule()]
        ];

        $validator = Validator::make($request->all(), $validations,
            $this->getValidationMessages());

        if (!$validator->passes()) {
            $this->validationErrors = $validator->errors()->all();
        }

        return count($this->validationErrors) == 0;

    }
}
