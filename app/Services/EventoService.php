<?php

namespace App\Services;


use App\Categoria;
use App\CategoriaEvento;
use App\Encuesta;
use App\Evento;
use App\Utils\Logger;
use App\Validators\CalificarEventoValidator;
use App\Validators\EditarEventoValidator;
use App\Validators\GetEventoByIdValidator;
use App\Validators\GetEventosValidator;
use App\Validators\NuevoEventoValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class EventoService
 * @package App\Services
 *
 * Servicio que controla las acciones de backend de los eventos.
 */
class EventoService extends BaseService
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Obtiene todos los eventos.
     *
     * @return Evento[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllEventos()
    {
        $this->resetLastActionErrors();
        return Evento::all();
    }

    /**
     * Obtiene el listado de eventos pertenecientes a la categoría dada.
     *
     * @return array
     * @throws \Exception
     */
    public function getEventos()
    {
        $this->resetLastActionErrors();
        $validator = new GetEventosValidator();

        $eventos = [];

        if ($validator->validate($this->request)) {

            $categoriaId = $this->request['categoria_id'];

            /**
             * TODO: El campo nombre_campo_orden debería estar en la tabla
             *       categoría, para que no haya tanta redundancia como ahora
             *       que se encuentra en la tabla categoria_evento, por
             *       cuestiones de tiempo ya se dejará así, pero a futuro se
             *       debería cambiar para tener un mejor diseño en el sistema.
             */

            $campoOrden = CategoriaEvento
                ::where('categoria_id', '=', $categoriaId)
                ->select('nombre_campo_orden')
                ->first();

            if ($campoOrden) {
                $campoOrden = $campoOrden->nombre_campo_orden;
            } else {
                $campoOrden = 'nombre';
            }

            $whereClauses = [
                ['ce.categoria_id', '=', $categoriaId]
            ];

            if ($this->request->has('fecha')) {
                array_push($whereClauses, ['e.fecha', '>=', $this->request['fecha'] . " 00:00:00"]);
                array_push($whereClauses, ['e.fecha', '<=', $this->request['fecha'] . " 23:59:59"]);
            }

            $eventos = DB::table('evento as e')
                ->join('categoria_evento as ce', 'e.id', '=', 'ce.evento_id')
                ->where($whereClauses)
                ->orderBy("e.$campoOrden")
                ->select('e.*')
                ->get();
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }

        return $eventos;
    }

    /**
     * Crea una nuevo evento.
     *
     * @return bool
     */
    public function createEvent()
    {
        $this->resetLastActionErrors();

        $validator = new NuevoEventoValidator();

        if ($validator->validate($this->request)) {
            $evento = new Evento();
            $evento->nombre = $this->request['nombre'];
            $evento->fecha = $this->request['fecha'];
            $evento->save();


            $frontalExtension = $this->request->tarjeta_frontal->extension();
            $traseraExtension = $this->request->tarjeta_trasera->extension();
            $folder = 'uploads';
            $tarjetaFrontalName = "evento_$evento->id" . "_frontal.$frontalExtension";
            $tarjetaTraseraName = "evento_$evento->id" . "_trasera.$traseraExtension";

            $evento->tarjeta_frontal = "$folder/$tarjetaFrontalName";
            $evento->tarjeta_trasera = "$folder/$tarjetaTraseraName";;
            $evento->save();

            $this->request->tarjeta_frontal->storeAs($folder, $tarjetaFrontalName, 'public_folder');
            $this->request->tarjeta_trasera->storeAs($folder, $tarjetaTraseraName, 'public_folder');

            foreach ($this->request->categorias as $categoria) {
                $categoriaObject = Categoria::find($categoria);
                $campoOrden = $categoriaObject->nombre == 'Artistas' ? 'nombre' : 'fecha';
                $categoriaEvento = new CategoriaEvento();
                $categoriaEvento->evento_id = $evento->id;
                $categoriaEvento->categoria_id = $categoria;
                $categoriaEvento->nombre_campo_orden = $campoOrden;
                $categoriaEvento->save();
            }

            return true;
        }

        $this->lastActionErrors = $validator->getValidationErrors();
        return false;
    }

    public function updateEvent()
    {
        $this->resetLastActionErrors();

        $validator = new EditarEventoValidator();

        if ($validator->validate($this->request)) {
            $evento = Evento::find($this->request['evento_id']);
            $evento->nombre = $this->request['nombre'];
            $evento->fecha = $this->request['fecha'];
            $evento->nombre = $this->request['nombre'];

            CategoriaEvento
                ::where('evento_id', '=', $this->request['evento_id'])
                ->delete();

            foreach ($this->request->categorias as $categoria) {
                $categoriaObject = Categoria::find($categoria);
                $campoOrden = $categoriaObject->nombre == 'Artistas' ? 'nombre' : 'fecha';
                $categoriaEvento = new CategoriaEvento();
                $categoriaEvento->evento_id = $evento->id;
                $categoriaEvento->categoria_id = $categoria;
                $categoriaEvento->nombre_campo_orden = $campoOrden;
                $categoriaEvento->save();
            }

            $evento->save();

            $folder = 'uploads';

            if ($this->request->tarjeta_frontal) {
                $frontalExtension = $this->request->tarjeta_frontal->extension();
                $tarjetaFrontalName = "evento_$evento->id" . "_frontal.$frontalExtension";
                $this->request->tarjeta_frontal->storeAs($folder, $tarjetaFrontalName, 'public_folder');
            }

            if ($this->request->tarjeta_trasera) {
                $traseraExtension = $this->request->tarjeta_trasera->extension();
                $tarjetaTraseraName = "evento_$evento->id" . "_trasera.$traseraExtension";
                $this->request->tarjeta_trasera->storeAs($folder, $tarjetaTraseraName, 'public_folder');
            }

            return true;
        }

        $this->lastActionErrors = $validator->getValidationErrors();
        return false;
    }

    public function deleteEvento()
    {
        $this->resetLastActionErrors();
        $validator = new GetEventoByIdValidator();

        if ($validator->validate($this->request)) {
            CategoriaEvento
                ::where('evento_id', '=', $this->request['evento_id'])
                ->delete();

            Encuesta
                ::where('evento_id', '=', $this->request['evento_id'])
                ->delete();

            Evento::where('id', '=', $this->request['evento_id'])->delete();
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }
    }

    public function calificarEvento()
    {
        $this->resetLastActionErrors();
        $validator = new CalificarEventoValidator();

        if ($validator->validate($this->request)) {
            $encuesta = new Encuesta($this->request->all());
            $encuesta->save();
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }
    }

    public function getEventoById()
    {
        $this->resetLastActionErrors();
        $validator = new GetEventoByIdValidator();
        $evento = null;

        if ($validator->validate($this->request)) {
            $evento = Evento::find($this->request['evento_id']);
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }

        return $evento;
    }

    public function getCategoriasOfEventoById()
    {
        $this->resetLastActionErrors();
        $validator = new GetEventoByIdValidator();
        $categoriasIds = [];

        if ($validator->validate($this->request)) {
            $categorias = CategoriaEvento::where('evento_id', '=', $this->request['evento_id'])
                ->select('categoria_id')
                ->get();

            foreach ($categorias as $categoria) {
                array_push($categoriasIds, $categoria->categoria_id);
            }

            Logger::writeInfoObject('Categorías', $categoriasIds);
        } else {
            $this->lastActionErrors = $validator->getValidationErrors();
        }

        return $categoriasIds;
    }
}
