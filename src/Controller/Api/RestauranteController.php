<?php

namespace App\Controller\Api;

use App\Repository\RestaurantesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route(path="/restaurante")
 */
class RestauranteController extends AbstractFOSRestController
{
    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $restauranteRepository;
    public function __construct(RestaurantesRepository $repo)
    {
        $this->restauranteRepository = $repo;
    }

    #2
    /*
     Funcionamiento en la práctica:
      -> Mostrará la página del restaurante con toda su información
    */

    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestauranteAction(Request $request) {
        $restaurante = $this->restauranteRepository->find($request->get('id'));
        if (!$restaurante) {
            return new JsonResponse("No se ha encontrado el restaurante", 404);
        }
        return $restaurante;
    }

    #2
    //Endpoint que devuelve todos los restaurantes en base al dia, la hora y al municipio
    /*
     Funcionamiento en la práctica:
      -> Seleccionamos la dirección a enviar
      -> Seleccionamos el dia y la hora del reparto
      -> Mostramos los restaurantes que cumplen esas condiciones
    */
    /**
     * @Rest\Post (path="/filtered")
     * @Rest\View (serializerGroups={"rest_filtered"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestauranteByDiaHoraMunicipio(Request $request) {
        $dia = $request->get('dia');
        $hora = $request->get('hora');
        $municipio = $request->get('municipio');
        if (!$dia->isSubmitted() || !$dia->isValid() || !$hora->isSubmitted() || !$hora->isValid() || !$municipio->isSubmitted() || !$municipio->isValid()) {
            return new JsonResponse("Bad data", 400);
        }
        $restaurante = $this->restauranteRepository->findByDiaHoraMunicipio($dia, $hora, $municipio);
        return $restaurante;
    }
}
