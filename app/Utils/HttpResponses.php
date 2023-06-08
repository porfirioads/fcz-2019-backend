<?php

namespace App\Utils;


/**
 * Class HttpResponses
 *
 * Administra las responses HTTP que se devolverán a los clientes de la API.
 */
class HttpResponses
{
    /**
     * Crea una respuesta http de tipo JSON con el código de estatus y cuerpo
     * dados.
     *
     * @param $code
     * @param $params
     * @return \Illuminate\Http\JsonResponse
     */
    public static function jsonResponse($code, $params)
    {
        $jsonResponse = response()->json($params);
        $jsonResponse->setStatusCode($code);
        return $jsonResponse;
    }

    /**
     * Crea una respuesta http de tipo JSON para una excepción.
     *
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public static function exceptionResponse(\Exception $exception)
    {
        return self::jsonResponse(400, [
            'errors' => [$exception->getMessage()]
        ]);
    }
}

