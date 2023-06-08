<?php

namespace App\Services;

use App\Categoria;
use App\Utils\Logger;
use App\Validators\GetCategoriasValidator;
use Illuminate\Http\Request;


/**
 * Class CategoriaService
 *
 * Servicio que controla las acciones de backend de las categorías.
 */
class CategoriaService extends BaseService
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Obtiene el listado de subcategorías pertenecientes a la categoría dada.
     *
     * @return array
     * @throws \Exception
     */
    public function getCategorias()
    {
        $this->resetLastActionErrors();
        $validator = new GetCategoriasValidator();
        $categorias = [];

        if ($validator->validate($this->request)) {
            $categoriaPadreId = $this->request['categoria_padre_id'];

            $categorias = Categoria::where('categoria_padre_id', '=',
                $categoriaPadreId)
                ->orderBy("id")
                ->get();
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }

        return $categorias;
    }

    /**
     * Obtiene el listado de todas las categorías.
     *
     * @return Categoria[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategorias()
    {
        $this->resetLastActionErrors();
        return Categoria::orderBy("nombre")
            ->get();
    }
}
