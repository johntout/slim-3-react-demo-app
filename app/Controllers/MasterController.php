<?php

namespace App\Controllers;

use App\Interfaces\Request as Request;

class MasterController
{
    /**
     * @param Request $request
     * @return array
     */
    protected function csrf(Request $request)
    {
        return $data = [
            'csrf_name' => $request->getAttribute('csrf_name'),
            'csrf_value' => $request->getAttribute('csrf_value'),
        ];
    }
}