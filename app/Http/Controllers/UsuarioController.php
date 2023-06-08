<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;


/**
 * Controlador que maneja las peticiones relacionadas con los usuarios.
 *
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    /**
     * Procesa la petición para mostrar el formulario de inicio de sesión.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        $usuariosService = new UsuarioService($request);

        if ($usuariosService->isUserLogged()) {
            return redirect()->route('home');
        }

        return view('users.login');
    }

    /**
     * Procesa la petición para la autenticación de un usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $usuariosService = new UsuarioService($request);
        $login = $usuariosService->login();

        if ($login) {
            return redirect()->route('home');
        }

        $request->flash();

        return redirect()
            ->route('user.login.view')
            ->with(['errors' => $usuariosService->getLastActionErrors()]);
    }

    /**
     * Procesa la petición la cerrar la sesión del usuario actual.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $usuariosService = new UsuarioService($request);
        $logout = $usuariosService->logout();
        return redirect()->route('home');
    }
}
