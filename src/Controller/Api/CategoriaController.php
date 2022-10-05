<?php

namespace App\Controller\Api;

use App\Entity\Categorias;
use App\Repository\CategoriasRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    //http://127.0.0.1:8000/api/categoria/
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"get_list_categorias"}, serializerEnableMaxDepthChecks=true)
     */
    public function getCategoriasAction() {
        return $this->categoriaRepository->findAll();
    }

    //http://127.0.0.1:8000/api/categoria/
    /**
     * @Rest\Post(path="/")
     * @Rest\View(serializerGroups={"post_add_categoria"}, serializerEnableMaxDepthChecks=true)
     */
    public function createCategoriaAction(Request $request) {
        //1º -> Coger la información a guardar que viene en la petición (request)
        $categoria = $request->get('categoria');
        //2º -> Patrón de negación primero -> comprobar que la 'categoria' no sea null o no exista (que no hayan errores)
        if (!$categoria) {
            //3º -> Crear un objeto JsonResponse que va a ser la respuesta que se enviará de vuelta
            return new JsonResponse('Error en la petición', Response::HTTP_BAD_REQUEST);
        }
        //4º -> Crear un nuevo objeto y setear sus atributos, ya que han enviado bien los datos de la petición (request)
        $cat = new Categorias();
        $cat->setCategoria($categoria);
        //5º -> Guardar el objeto en bbdd con el EntityManagerInterface
        $this->categoriaRepository->add($cat, true);
        //6º -> Devolver siempre una respuesta (response)
        return $cat;
    }
}
