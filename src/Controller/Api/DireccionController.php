<?php

namespace App\Controller\Api;

use App\Entity\Direcciones;
use App\Form\DireccionType;
use App\Repository\DireccionesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/direccion")
 */
class DireccionController extends AbstractFOSRestController
{
    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $repo;
    public function __construct(DireccionesRepository $repo)
    {
        $this->repo = $repo;
    }

    #1
    //http://127.0.0.1:8000/api/direccion/
    /**
     * @Rest\Post(path="/")
     * @Rest\View (serializerGroups={"post_add_one_direccion"}, serializerEnableMaxDepthChecks=true)
     */
    public function createDireccionAction(Request $request) {
        $direccion = new Direcciones();
        $form = $this->createForm(DireccionType::class, $direccion);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse('Bad data', Response::HTTP_BAD_REQUEST);
        }
        $this->repo->add($direccion, true);
        return $direccion;
    }
}
