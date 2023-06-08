<?php

namespace App\Services;


use App\Usuario;
use App\Validators\LoginValidator;
use Illuminate\Http\Request;

/**
 * Servicio que controla las acciones de backend de los usuarios.
 *
 * Class UsuarioService
 * @package App\Services
 */
class UsuarioService extends BaseService
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Realiza la autenticación de un usuario.
     *
     * @return Usuario|null
     */
    public function login()
    {
        $this->resetLastActionErrors();
        $validator = new LoginValidator();
        $usuario = null;

        if ($validator->validate($this->request)) {
            $usuario = Usuario::where('usuario', '=', $this->request['usuario'])
                ->where('password', '=', sha1($this->request['password']))
                ->first();

            if ($usuario) {
                $this->request->session()->put('UserLogged', true);
                $this->request->session()->put('UserName', $usuario->usuario);
            } else {
                $this->lastActionSuccess = false;
                $this->lastActionErrors = ["Usuario o contraseña incorrectos"];
            }
        } else {
            $this->lastActionSuccess = false;
            $this->lastActionErrors = $validator->getValidationErrors();
        }

        return $usuario;
    }

    /**
     * Determina si hay una sesión iniciada en la request actual.
     *
     * @return mixed
     */
    public function isUserLogged()
    {
        $this->resetLastActionErrors();
        return ($this->request->session()->get('UserLogged', false));
    }

    /**
     * Cierra la sesión del usuario actual.
     *
     * @return mixed
     */
    public function logout()
    {
        $this->resetLastActionErrors();
        $userLogged = $this->isUserLogged();
        $this->request->session()->flush();
        return $userLogged;
    }
}
