<?php

namespace App\Http\Controllers;

use App\Services\SedeService;
use App\Utils\HttpResponses;
use Illuminate\Http\Request;


/**
 * Class SedeController
 * @package App\Http\Controllers
 *
 * Maneja las peticiones relacionadas con las sedes.
 */
class SedeController extends Controller
{
    public function getDetalleSede(Request $request) {
        $sedeService = new SedeService($request);
        $sede = $sedeService->getDetalleSede();

        if ($sedeService->isLastActionErrors()) {
            return HttpResponses::jsonResponse(400,
                $sedeService->getLastActionErrors());
        }

        return HttpResponses::jsonResponse(200, $sede);
    }
}
