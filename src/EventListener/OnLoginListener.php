<?php

namespace App\EventListener;

use App\Repository\ClientesRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class OnLoginListener
{
    private $clienteRepository;
    public function __construct(ClientesRepository $repo) {
        $this->clienteRepository = $repo;
    }
    //Método que se va a quedar a la escucha de que se dispare el evento de on login success response
    //Respuesta del login conseguido
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event) {
        //Cojo todos los datos de la respuesta:
        $data = $event->getData();
        //Me traigo el User:
        $user = $event->getUser();
        if (!$user instanceof UserInterface) {
            return;
        }
        $data['userId'] = $user->getId();
        //Traer el cliente:
        $clienteId = null;
        $cliente = $this->clienteRepository->findOneBy(['user'=>$user]);
        if ($cliente) {
            $clienteId = $cliente->getId();
        }
        //Añadimos los campos a la respuesta:
        $data['idCliente'] = $clienteId;
        $event->setData($data);
    }
}
