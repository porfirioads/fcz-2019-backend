<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Utils\HttpResponses;
use App\Utils\Logger;
use Illuminate\Http\Request;


/**
 * Class CategoriaController
 * @package App\Http\Controllers
 *
 * Maneja las peticiones relacionadas con las categorías.
 */
class CategoriaController extends Controller
{
    public function getListaCategorias(Request $request)
    {
        $categoriaService = new CategoriaService($request);
        $categorias = $categoriaService->getCategorias();

        //Logger::writeInfoObject('Categorías', $categorias);

        if ($categoriaService->isLastActionErrors()) {
            return HttpResponses::jsonResponse(400,
                $categoriaService->getLastActionErrors());
        }

        return HttpResponses::jsonResponse(200, $categorias);
    }
}
