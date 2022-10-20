<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Rest\Route("/user")
 */
class UserController extends AbstractFOSRestController
{
    private $userRepository;
    private $hasher;

    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $hasher) {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    //Endpoint para registrar a los usuarios:
    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"user"}, serializerEnableMaxDepthChecks=true)
     */
    public function createUserAction(Request $request) {
        //El ROLE va por separado:
        /*FORMATO OBJETO JSON:
         * {
         *  "user": {
         *      "email": ¿?
         *      "password": ¿?
         *  },
         *  "role": ¿?
         * }
         */
        //El $user y el $role los guarda en formato Array
        $user = $request->get('user');
        $role = $request->get('role');
        //Enviarlo al form:
        $form = $this->createForm(UserType::class);
        $form->submit($user);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form;
        }

        /**
         * @var User $newUser
         */
        $newUser = $form->getData();

        //Guardar el role en un Array:
        $roles[] = $role;
        $newUser->setRoles($roles);
        //Codificar el password:
        $hashedPassword = $this->hasher->hashPassword(
            $newUser,
            $user['password']
        );
        $newUser->setPassword($hashedPassword);
        //Guardar en bbdd:
        $this->userRepository->add($newUser,true);
        return $newUser;
    }
}