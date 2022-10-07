<?php

namespace App\Controller\Api;

use App\Entity\Categorias;
use App\Form\CategoriaType;
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
    //CRUD -> Create(1), Read(2), Update(3), Delete(4)

    private $categoriaRepository;

    public function __construct(CategoriasRepository $repo)
    {
        $this->categoriaRepository = $repo;
    }

    #2
    //http://127.0.0.1:8000/api/categoria/
    /**
     * @Rest\Get(path="/")
     * @Rest\View(serializerGroups={"get_list_all_categorias"}, serializerEnableMaxDepthChecks=true)
     */
    public function getCategoriasAction() {
        return $this->categoriaRepository->findAll();
    }

    #2
    //http://127.0.0.1:8000/api/categoria/1
    /**
     * @Rest\Get(path="/{id}")
     * @Rest\View(serializerGroups={"get_list_one_categoria"}, serializerEnableMaxDepthChecks=true)
     */
    public function getCategoriaAction(Request $request) {
        $categoria = $this->categoriaRepository->find($request->get('id'));
        if (!$categoria) {
            return new JsonResponse("No se ha encontrado la categoría", Response::HTTP_NOT_FOUND);
        }
        return $categoria;
    }

/*
    #1
    //SIN FORMULARIOS
    //http://127.0.0.1:8000/api/categoria/
    /**
     * @Rest\Post(path="/")
     * @Rest\View(serializerGroups={"post_add_categoria"}, serializerEnableMaxDepthChecks=true)
     * /
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
        //5º -> Guardar el objeto en bbdd
        $this->categoriaRepository->add($cat, true);
        //6º -> Devolver siempre una respuesta
        return $cat;
    }
*/

    #1
    //CON FORMULARIOS
    //Sirven para manejar las peticiones y validar el tipado (validator) -> null/not null, texto en blanco, tamaño máximo de caracteres, etc
    //http://127.0.0.1:8000/api/categoria/
    /**
     * @Rest\Post(path="/")
     * @Rest\View(serializerGroups={"post_add_one_categoria"}, serializerEnableMaxDepthChecks=true)
     */
    public function createCategoriaAction(Request $request) {
        //1º -> Crear objeto vacío
        $cat = new Categorias();
        //2º -> Inicializar el form
        $form = $this->createForm(CategoriaType::class, $cat);
        //3º -> Indicar al formulario que maneje la request
        $form->handleRequest($request);
        //4º -> Comprobar si hay error (Patrón de negación primero)
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $form;
        }
        //5º -> Guardar el objeto en bbdd
        print_r($form->getData());
        $this->categoriaRepository->add($form->getData(), true);
        //6º -> Devolver siempre una respuesta
        return $form->getData();
    }

    #3
    /**
     * @Rest\Patch(path="/{id}")
     * @Rest\View(serializerGroups={"patch_update_one_categoria"}, serializerEnableMaxDepthChecks=true)
     */
    public function updateCategoriaAction(Request $request) {
        $catedoriaID = $request->get('id');
        $catedoria = $this->categoriaRepository->find($catedoriaID);
        if (!$catedoria) {
            return new JsonResponse("No se ha encontrado la categoría", Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(CategoriaType::class, $catedoria, ['method'=>$request->getMethod()]);
        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse("Bad data", 400);
        }
        $this->categoriaRepository->add($catedoria, true);
        return $catedoria;
    }

    #4
    /**
     * @Rest\Delete(path="/{id}")
     */
    public function deleteCategoriaAction(Request $request) {
        $categoriaId = $request->get('id');
        $categoria = $this->categoriaRepository->find($categoriaId);
        if (!$categoria) {
            return new JsonResponse("No se ha encontrado la categoría", 400);
        }
        $this->categoriaRepository->remove($categoria, true);
        return new JsonResponse("Categoría borrada", 200);
    }
}
