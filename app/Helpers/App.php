<?php

namespace App\Helpers;

class App
{
    /**
     * @param $input
     * @param string|null $type
     * @return mixed
     */
    public static function sanitizeInput($input, $type = null)
    {
        switch ($type)
        {
            case 'INT':
                $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
                break;

            case 'EMAIL':
                $input = filter_var($input, FILTER_SANITIZE_EMAIL);
                break;

            default:
                $input = filter_var($input, FILTER_SANITIZE_STRING);
                break;
        }

        $input = self::clean($input);

        return $input;
    }

    /**
     * @param $input
     * @return string
     */
    public static function clean($input) :string
    {
        $detagged 	= strip_tags($input);
        $deslashed 	= stripslashes($detagged);

        return html_entity_decode( $deslashed, null, 'UTF-8' );
    }

    /**
     * @param string $date
     * @param string $fromFormat
     * @param string $format
     * @return string
     */
    public static function formatDate(string $date, string $fromFormat = 'Y-m-d', string $format = 'd M Y')
    {
        $createDateFromFormat = \DateTime::createFromFormat($fromFormat, $date);
        $dateFormatted = $createDateFromFormat ? $createDateFromFormat->format($format) : $date;

        return $dateFormatted;
    }
}