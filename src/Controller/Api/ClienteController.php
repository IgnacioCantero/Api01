<?php

namespace App\Controller\Api;

use App\Entity\Clientes;
use App\Form\ClienteType;
use App\Repository\ClientesRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/cliente")
 */
class ClienteController extends AbstractFOSRestController
{
    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $clienteRepository;

    public function __construct(ClientesRepository $repo)
    {
        $this->clienteRepository = $repo;
    }

    #1
    //http://127.0.0.1:8000/api/cliente/
    /**
     * @Rest\Post(path="/")
     * @Rest\View(serializerGroups={"post_add_cliente"}, serializerEnableMaxDepthChecks=true)
     */
    public function createClienteAction(Request $request) {
        //Asociar a su user
        /*Ejemplo de funcionamiento:
         * 1º - El usuario se registra con email y password -> obtenemos su User y nos devuelve el idUser y el role
         * 2º - Mostramos una nueva ventana para generar el cliente (nombre, apellidos, teléfono...)
         */
        $cliente = new Clientes();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form;
        }
        print_r($form->getData());
        $this->clienteRepository->add($cliente, true);
        return $cliente;
    }

    #2
    //http://127.0.0.1:8000/api/cliente/1
    /**
     * @Rest\Get(path="/{id}")
     * @Rest\View(serializerGroups={"get_list_one_cliente"}, serializerEnableMaxDepthChecks=true)
     */
    public function getClienteAction(Request $request) {
        $cliente = $this->clienteRepository->find($request->get('id'));
        if (!$cliente) {
            return new JsonResponse("No se ha encontrado el cliente", Response::HTTP_NOT_FOUND);
        }
        return $cliente;
    }

    #2
    //http://127.0.0.1:8000/api/cliente/
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"get_list_all_clientes"}, serializerEnableMaxDepthChecks=true)
     */
    public function getClientesAction() {
        return $this->clienteRepository->findAll();
    }

    #3
    //http://127.0.0.1:8000/api/cliente/
    /**
     * @Rest\Patch(path="/{id}")
     * @Rest\View(serializerGroups={"patch_update_one_cliente"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateClienteAction(Request $request) {
        $cliente = $this->clienteRepository->find($request->get('id'));
        if (!$cliente) {
            return new JsonResponse("No se ha encontrado el cliente", Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(ClienteType::class, $cliente, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form;
        }
        $this->clienteRepository->add($cliente,true);
        return $cliente;
    }

    #4
    //No se crea un endpoint delete dado que no queremos eliminar un cliente nunca de la bbdd
}
