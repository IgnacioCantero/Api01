<?php

namespace App\Controller\Api;

use App\Entity\Direcciones;
use App\Form\DireccionType;
use App\Repository\ClientesRepository;
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

    private $direccionRepository;
    public function __construct(DireccionesRepository $repo)
    {
        $this->direccionRepository = $repo;
    }

    #1
    //http://127.0.0.1:8000/api/direccion/
    /**
     * @Rest\Post(path="/")
     * @Rest\View(serializerGroups={"post_add_one_direccion"}, serializerEnableMaxDepthChecks=true)
     */
    public function createDireccionAction(Request $request) {
        $direccion = new Direcciones();
        $form = $this->createForm(DireccionType::class, $direccion);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse('Bad data', Response::HTTP_BAD_REQUEST);
        }
        $this->direccionRepository->add($direccion, true);
        return $direccion;
    }

    #2
    //Endpoint que devuelve todas las direcciones en base al id de un cliente
    /**
     * @Rest\Get(path="/{id}")
     * @Rest\View(serializerGroups={"direccion"}, serializerEnableMaxDepthChecks=true)
     */
    public function getDireccionByClienteAction(Request $request, ClientesRepository $clienteRepository) {
        $cliente = $clienteRepository->find($request->get('id'));
        if (!$cliente) {
            return new JsonResponse("No se ha encontrado el cliente", Response::HTTP_NOT_FOUND);
        }
        $direccion = $this->direccionRepository->findBy(["cliente"=>$request->get('id')]);
        return $direccion;
    }

    #3
    /**
     * @Rest\Patch(path="/{id}")
     * @Rest\View(serializerGroups={"direccion"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateDireccionAction(Request $request) {
        $direccion = $this->direccionRepository->find($request->get('id'));
        if (!$direccion) {
            return new JsonResponse("No se ha encontrado la dirección", Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(DireccionType::class, $direccion, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form;
        }
        $this->direccionRepository->add($direccion,true);
        return $direccion;
    }

    #4
    /**
     * @Rest\Delete(path="/{id}")
     */
    public function deleteDireccionAction(Request $request) {
        $direccion = $this->direccionRepository->find($request->get('id'));
        if (!$direccion) {
            return new JsonResponse("No se ha encontrado la dirección", 400);
        }
        $this->direccionRepository->remove($direccion,true);
        return new JsonResponse("Dirección borrada", 200);
    }
}
