<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;


/**
 * Controlador para la administración de la pantalla principal del dashboard.
 *
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Procesa la petición para ir a la pantalla de inicio.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showHomeScreen(Request $request)
    {
        $usuariosService = new UsuarioService($request);

        if (!$usuariosService->isUserLogged()) {
            return redirect()->route('user.login.view');
        }

        return view('home');
    }
}
