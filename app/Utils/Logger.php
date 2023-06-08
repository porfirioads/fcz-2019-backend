<?php

namespace App\Utils;

use DateTime;
use Illuminate\Support\Facades\File;


/**
 * Contiene utilidades para registrar logs personalizados en un archivo de
 * texto.
 *
 * @author Porfirio Díaz
 */
class Logger
{
    /**
     * Escribe un objeto en un log con la etiqueta INFO.
     *
     * @param string $title Es el título del log.
     * @param object $object Es el objeto que se escribirá en el log.
     * @throws \Exception
     */
    public static function writeInfoObject(string $title, $object)
    {
        $objectJson = json_encode($object, JSON_PRETTY_PRINT);
        $content = "$title\n\n$objectJson";
        self::write('INFO', $content);
    }

    /**
     * Escribe un mensaje en un log con la etiqueta INFO.
     *
     * @param string $message Es el mensaje que se escribirá en el log.
     * @throws \Exception
     */
    public static function writeInfoMessage(string $message)
    {
        self::write('INFO', $message);
    }

    /**
     * Escribe un objeto en un log con la etiqueta ERROR.
     *
     * @param string $title Es el título del log.
     * @param object $object Es el objeto que se escribirá en el log.
     * @throws \Exception
     */
    public static function writeErrorObject(string $title, $object)
    {
        $objectJson = json_encode($object, JSON_PRETTY_PRINT);
        $content = "$title\n\n$objectJson";
        self::write('ERROR', $content);
    }

    /**
     * Escribe un mensaje en un log con la etiqueta ERROR.
     *
     * @param string $message Es el mensaje que se escribirá en el log.
     * @throws \Exception
     */
    public static function writeErrorMessage(string $message)
    {
        self::write('ERROR', $message);
    }

    /**
     * Escribe un log.
     *
     * @param string $tag Es la etiqueta del log.
     * @param string $content Es el contenido del log.
     */
    private static function write(string $tag, string $content)
    {
        try {
            $file = '../storage/logs/app.log';
            $date = (new DateTime())->format('d/m/Y H:i:s');
            File::append($file, "[$date] $tag\n\n$content\n\n");
        } catch (\Exception $e) {
        }
    }
}
