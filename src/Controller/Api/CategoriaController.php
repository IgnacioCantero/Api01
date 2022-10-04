<?php

namespace App\Controller\Api;

use App\Repository\CategoriasRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Rest\Route("/categoria")
 */
class CategoriaController extends AbstractFOSRestController
{
    private $categoriaRepository;

    public function __construct(CategoriasRepository $repo)
    {
        $this->categoriaRepository = $repo;
    }

    //http://127.0.0.1:8000/api/categoria
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"get_categorias"}, serializerEnableMaxDepthChecks=true)
     */
    public function getCategorias() {
        return $this->categoriaRepository->findAll();
    }

}