<?php

namespace App\Facades;

/**
 * @method static \App\Services\MailService self()
 * @method static bool send(\App\Mails\Mail $mail)
 */

class Mail extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mail';
    }
}