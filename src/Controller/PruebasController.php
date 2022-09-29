<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PruebasController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    //Tenemos que definir cómo es el endpoint para poder hacer la petición desde el cliente
    //ENDPOINT:
    /**
     * @Route("/get/usuarios", name="get_users")
     */

    public function getAllUser(Request $request) {
        //Llamará a base de datos y se traerá toda la lista de Users
        //Devolver una respuesta en formato Json
        //REQUEST --> Petición (lo que me manda Angular cuando me manda el Endpoint)
        //RESPONSE --> SIEMPRE hay que devolver una respuesta

        //2º-Para una petición:
        //Comprobar con la url -> http://127.0.0.1:8000/get/usuarios?id=1
        //Capturamos los datos que vienen en el Request

        $id = $request->get('id');

        $this->logger->alert('Mensaje');

        //1º-Para una respuesta general:
        //Comprobar con la url -> http://127.0.0.1:8000/get/usuarios
        //$response = new Response(); //El $response será el del 'HttpFoundation'
        //$response->setContent('<div>Hola Mundo</div>');
        //Para una respuesta Json:
        $response = new JsonResponse();
        $response->setData([
            'succes' => true,
            'data' => [
//                1º Para el ejemplo del response:
//                [
//                    'id' => 1,
//                    'nombre' => 'Pepe',
//                    'email' => 'pepe@email.com'
//                ],
//                [
//                    'id' => 2,
//                    'nombre' => 'Manolo',
//                    'email' => 'manolo@email.com'
//                ]
//              2º Para el ejemplo del request:
//              Query sql para traer el user el id = $id:
                [
                    'id' => $id,
                    'nombre' => 'Pepe',
                    'email' => 'pepe@email.com'
                ]
            ]
        ]);
        return $response;
    }
}