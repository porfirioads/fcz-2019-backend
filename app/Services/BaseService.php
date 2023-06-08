<?php

namespace App\Services;

use Illuminate\Http\Request;


/**
 * Class BaseService
 *
 * Base de la cual se desprenden los demás servicios de interacción con los
 * datos.
 */
class BaseService
{
    protected $request;
    protected $lastActionErrors;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->lastActionErrors = [];
    }

    /**
     * Devuelve si hubo algún error en la última acción realizada con el
     * servicio.
     *
     * @return int
     */
    public function isLastActionErrors()
    {
        return count($this->lastActionErrors);
    }

    /**
     * Devuelve los errores ocurridos en la última acción realizada.
     *
     * @return array
     */
    public function getLastActionErrors()
    {
        return $this->lastActionErrors;
    }

    /**
     * Reinicia los errores ocurridos por la última acción realizada, para que
     * no se consideren parte de la siguiente acción a realizar.
     */
    public function resetLastActionErrors()
    {
        $this->lastActionErrors = [];
    }

}
