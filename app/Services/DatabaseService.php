<?php

namespace App\Services;

use App\Interfaces\Services;

final class DatabaseService implements Services
{
    /**
     * @var null
     */
    static private $instance  = NULL;

    /**
     * @return \PDO
     */
    public static function boot() :\PDO
    {
        if(self::$instance == NULL) {
            self::$instance = new \PDO('mysql:host='.env('DB_HOST').';dbname='.env('DB_NAME').';charset='.env('DB_CHARSET', 'utf8mb4'),
                env('DB_USER'),
                env('DB_PASSWORD')
            );

            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET sql_mode = NO_BACKSLASH_ESCAPES");
            self::$instance->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        return self::$instance;
    }
}