<?php

namespace App\Services;


use App\Sede;
use App\Utils\Logger;
use App\Validators\GetSedeValidator;
use Illuminate\Http\Request;

/**
 * Class SedeService
 * @package App\Services
 *
 * Servicio que controla las acciones de backend de las sedes.
 */
class SedeService extends BaseService
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function getDetalleSede()
    {
        $this->resetLastActionErrors();
        $validator = new GetSedeValidator();
        $sede = null;

        if ($validator->validate($this->request)) {
            $sede = Sede::where('categoria_id', '=', $this->request['categoria_id'])
                ->first();
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }

        return $sede;
    }
}
