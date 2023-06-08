<?php

namespace App\Validators;

use Illuminate\Http\Request;


/**
 * Class BaseValidator
 *
 * Base para la implementación de los validadores para las acciones de los
 * servicios.
 */
class BaseValidator
{
    protected $validationErrors = [];

    public function __construct()
    {
        $this->validationErrors = [];
    }

    /**
     * Determina si la request recibida es válida.
     *
     * @param Request $request
     * @return bool
     */
    public function validate(Request $request)
    {
        $this->validationErrors = [];
        return true;
    }

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * Devuelve el mensaje de error correspondiente para un campo requerido.
     *
     * @param string $field
     * @param bool $male
     * @param bool $singular
     * @return string
     */
    public function getRequiredMessage(string $field, bool $male, bool $singular)
    {
        if ($male && $singular)
            return "El $field es obligatorio";
        if ($male && !$singular)
            return "Los $field son obligatorios";
        if (!$male && $singular)
            return "La $field es obligatoria";
        if (!$male && !$singular)
            return "Las $field son obligatorias";
        return "";
    }

    /**
     * Devuelve el mensaje de error correspondiente para un campo cuya longitud
     * está limitada.
     *
     * @param string $field
     * @param bool $male
     * @param bool $singular
     * @param int $maxLength
     * @return string
     */
    public function getMaxLengthMessage(string $field, bool $male, bool $singular, int $maxLength)
    {
        if ($male && $singular)
            return "El $field debe tener máximo $maxLength caracteres";
        if ($male && !$singular)
            return "Los $field deben tener máximo $maxLength caracteres";
        if (!$male && $singular)
            return "La $field debe tener máximo $maxLength caracteres";
        if (!$male && !$singular)
            return "Las $field deben tener máximo $maxLength caracteres";
        return "";
    }

    /**
     * Devuelve el mensaje de error correspondiente para un campo que debe ser
     * único.
     *
     * @param string $field
     * @param bool $male
     * @param bool $singular
     * @return string
     */
    public function getExistingMessage(string $field, bool $male, bool $singular)
    {
        if ($male && $singular)
            return "El $field ya existe";
        if ($male && !$singular)
            return "Los $field ya existen";
        if (!$male && $singular)
            return "La $field ya existe";
        if (!$male && !$singular)
            return "Las $field ya existen";
        return "";
    }

    /**
     * Devuelve el mensaje de error correspondiente para un campo cuyo valor es
     * inválido.
     *
     * @param string $field
     * @param bool $male
     * @param bool $singular
     * @return string
     */
    public function getInvalidMessage(string $field, bool $male, bool $singular)
    {
        if ($male && $singular)
            return "El $field es inválido";
        if ($male && !$singular)
            return "Los $field son inválidos";
        if (!$male && $singular)
            return "La $field es inválida";
        if (!$male && !$singular)
            return "Las $field son inválidas";
        return "";
    }

    /**
     * Devuelve el mensaje de error para un archivo que debe ser específicamente
     * una imagen.
     *
     * @param string $field
     * @param bool $male
     * @param bool $singular
     * @return string
     */
    public function getImageFileMessage(string $field, bool $male, bool $singular)
    {
        if ($male && $singular)
            return "El $field debe ser una imagen";
        if ($male && !$singular)
            return "Los $field deben ser imágenes";
        if (!$male && $singular)
            return "La $field debe ser una imagen";
        if (!$male && !$singular)
            return "Las $field deben ser imágenes";
        return "";
    }

    /**
     * Devuelve el mensaje de error para un archivo que tiene un límite de
     * tamaño.
     *
     * @param string $field
     * @param bool $male
     * @param bool $singular
     * @param $max
     * @return string
     */
    public function getMaxFileSizeMessage(string $field, bool $male, bool $singular, $max)
    {
        if ($male && $singular)
            return "El $field no debe exeder $max kilobytes";
        if ($male && !$singular)
            return "Los $field no deben exeder $max kilobytes";
        if (!$male && $singular)
            return "La $field no debe exeder $max kilobytes";
        if (!$male && !$singular)
            return "Las $field no deben exeder $max kilobytes";
        return "";
    }

    /**
     * Obtiene los mensajes de errores de validación.
     *
     * @return array
     */
    protected function getValidationMessages()
    {
        return [
            'categoria_padre_id.numeric' => $this->getInvalidMessage('id de la categoría padre', true, true),
            'categoria_id.required' => $this->getRequiredMessage('id de la categoría', true, true),
            'categoria_id.numeric' => $this->getInvalidMessage('id de la categoría', true, true),
            'fecha.required' => $this->getRequiredMessage('fecha', false, true),
            'fecha.date_format' => $this->getInvalidMessage('fecha', false, true),
            'nombre.max' => $this->getMaxLengthMessage('nombre', true, true, 100),
            'nombre.required' => $this->getRequiredMessage('nombre', true, true),
            'tarjeta_frontal.required' => $this->getRequiredMessage('tarjeta frontal', false, true),
            'tarjeta_frontal.image' => $this->getImageFileMessage('tarjeta frontal', true, true),
            'tarjeta_frontal.max' => $this->getMaxFileSizeMessage('tarjeta frontal', true, true, 1024),
            'tarjeta_trasera.required' => $this->getRequiredMessage('tarjeta trasera', false, true),
            'tarjeta_trasera.image' => $this->getImageFileMessage('tarjeta trasera', true, true),
            'tarjeta_trasera.max' => $this->getMaxFileSizeMessage('tarjeta trasera', true, true, 1024),
            'categorias.required' => $this->getRequiredMessage('categorías', false, false),
            'procedencia.required' => $this->getRequiredMessage('procedencia', false, true),
            'procedencia.max' => $this->getMaxLengthMessage('procedencia', false, true, 25),
            'sexo.required' => $this->getRequiredMessage('sexo', true, true),
            'sexo.max' => $this->getMaxLengthMessage('sexo', true, true, 10),
            'edad.required' => $this->getRequiredMessage('edad', false, true),
            'edad.max' => $this->getMaxLengthMessage('edad', false, true, 15),
            'evento_id.required' => $this->getRequiredMessage('id del evento', true, true),
            'calificacion.required' => $this->getRequiredMessage('calificación', false, true),
            'calificacion.between' => 'La calificación debe ser entre 1 y 5'
        ];
    }

}
