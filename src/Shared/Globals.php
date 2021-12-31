<?php

namespace App\Shared;

use PHPUnit\Exception;


class Globals
{
    public function jsondecode()
    {
        // "ext-json":"*" ajouter cette ligne ds le composer.json pour informer le projet qu'on utilise du json
        try{
            return file_get_contents('php://input') ? json_decode(file_get_contents('php://input'), false) : [];
        }catch(Exception $e){
            return [];
        }
    }
}