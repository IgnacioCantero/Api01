<?php

namespace App\Controller\Api;

use App\Repository\MunicipiosRepository;
use App\Repository\ProvinciasRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/provincia")
 */
class ProvinciaController extends AbstractFOSRestController
{
    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $provinciaRepository;
    private $municipioRepository;
    public function __construct(ProvinciasRepository $repoProv, MunicipiosRepository $repoMuni)
    {
        $this->provinciaRepository = $repoProv;
        $this->municipioRepository = $repoMuni;
    }

    #2
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"provincias"}, serializerEnableMaxDepthChecks=true)
     */
    public function getProvinciasAction() {
        return $this->provinciaRepository->findAll();
    }

    #2
    //Endpoint que devuelve todos los municipios en base al id de una provincia
    /**
     * @Rest\Get(path="/{id}")
     * @Rest\View(serializerGroups={"municipios"}, serializerEnableMaxDepthChecks=true)
     */
    public function getMunicipiosByProvinciaAction(Request $request, ProvinciasRepository $provinciasRepository) {
        $provincia = $provinciasRepository->find($request->get('id'));
        if (!$provincia) {
            return new JsonResponse("No se ha encontrado la provincia", 404);
        }
        $municipio = $this->municipioRepository->findBy(["provincia"=>$request->get('id')]);
        return $municipio;
    }
}
