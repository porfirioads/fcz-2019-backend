<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Services\EventoService;
use App\Utils\HttpResponses;
use App\Utils\Logger;
use Illuminate\Http\Request;


/**
 * Class EventoController
 * @package App\Http\Controllers
 *
 * Maneja las peticiones relacionadas con los eventos.
 */
class EventoController extends Controller
{
    public function getListaEventos(Request $request)
    {
        $eventoService = new EventoService($request);
        $eventos = $eventoService->getEventos();

        if ($eventoService->isLastActionErrors()) {
            return HttpResponses::jsonResponse(400,
                $eventoService->getLastActionErrors());
        }

        return HttpResponses::jsonResponse(200, $eventos);
    }

    public function showListaEventos(Request $request)
    {
        $eventoService = new EventoService($request);
        $eventos = $eventoService->getAllEventos();

        return view('eventos.list', [
            'eventos' => $eventos,
        ]);
    }

    public function showCreateEventoForm(Request $request)
    {
        $categoriaService = new CategoriaService($request);

        return view('eventos.create', [
            'categorias' => $categoriaService->getAllCategorias()
        ]);
    }

    public function createEvento(Request $request)
    {
        $eventoService = new EventoService($request);
        $evento = $eventoService->createEvent();

        if (!$eventoService->isLastActionErrors()) {
            return redirect()
                ->route('evento.list.view')
                ->with(['info' => "Evento creado correctamente"]);
        }

        $request->flash();

        return redirect()
            ->route('evento.create.view')
            ->with(['errors' => $eventoService->getLastActionErrors()]);
    }

    public function showEditEventoForm(Request $request)
    {
        $categoriaService = new CategoriaService($request);
        $eventoService = new EventoService($request);
        $evento = $eventoService->getEventoById();
        $categoriasEvento = $eventoService->getCategoriasOfEventoById();

        if ($eventoService->isLastActionErrors()) {
            return redirect()
                ->route('evento.list.view')
                ->with(['errors' => $eventoService->getLastActionErrors()]);
        }


        return view('eventos.edit', [
            'categorias' => $categoriaService->getAllCategorias(),
            'categorias_seleccionadas' => $categoriasEvento,
            'evento' => $evento
        ]);
    }

    public function editEvento(Request $request)
    {
        $eventoService = new EventoService($request);
        $evento = $eventoService->updateEvent();

        if (!$eventoService->isLastActionErrors()) {
            return redirect()
                ->route('evento.list.view')
                ->with(['info' => "Evento actualizado correctamente"]);
        }

        $request->flash();

        return redirect()
            ->route('evento.edit.view')
            ->with(['errors' => $eventoService->getLastActionErrors()]);
    }

    public function deleteEvento(Request $request)
    {
        Logger::writeInfoMessage("Delete evento");
        $eventoService = new EventoService($request);
        $eventoService->deleteEvento();

        if (!$eventoService->isLastActionErrors()) {
            return redirect()
                ->route('evento.list.view')
                ->with(['info' => "Evento eliminado correctamente"]);
        }

        return redirect()
            ->route('evento.list.view')
            ->with(['errors' => $eventoService->getLastActionErrors()]);
    }

    public function calificarEvento(Request $request)
    {
        $eventoService = new EventoService($request);
        $eventoService->calificarEvento();

        if ($eventoService->isLastActionErrors()) {
            return HttpResponses::jsonResponse(400,
                $eventoService->getLastActionErrors());
        }

        return HttpResponses::jsonResponse(200, [
            'mensaje' => 'Evento calificado correctamente'
        ]);
    }
}
