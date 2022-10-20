<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;

class AbstractApiController extends AbstractFOSRestController
{
    //Crear método intermedio para sobrescribir las opciones del formulario y poder desactivar el 'csrf_token'

}