<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Repository\CategoriasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{
    /**
     * @Route  ("/categoria", name="create_categoria")
     */
    //El Request es la petición de datos que hace el usuario
    //El EntityManagerInterface coge la info que va a llegar desde la app y la guarda en la bbdd, para ello hemos de pasar el objeto a modo entidad primero
    public function createCategoriaAction(Request $request, EntityManagerInterface $em) {
        //1º -> Coger la información a guardar que viene en la petición (request)
        $nombreCategoria = $request->get('categoria');
        //2º -> Crear un objeto JsonResponse que va a ser la respuesta que se enviará de vuelta
        $response = new JsonResponse();
        //3º -> Patrón de negación primero -> comprobar que la 'categoria' no sea null o no exista (que no hayan errores)
        if (!$nombreCategoria) {
            //Esto pasa si es null, si no tiene valor asignado, si es igual a 0 o si es false, es decir, han enviado mal los datos en la petición (request)
            $response->setData([
                'success' => false,
                'data' => null,
                'error' => 'Categoria controller can´t be null or empty'
            ]);
            return $response;
        }
        //4º -> Crear un nuevo objeto y setear sus atributos, ya que han enviado bien los datos de la petición (request)
        $categoria = new Categorias();
        $categoria->setCategoria($nombreCategoria);
        //5º -> Guardar el objeto en bbdd con el EntityManagerInterface
        $em->persist($categoria);   //Doctrine -> persist() -> prepara la query para guardar el objeto en bbdd
        #$em->remove($categoria);   //Doctrine -> remove() -> prepara la query para borrar el objeto en bbdd
        $em->flush();   //Doctrine -> flush() -> ejecuta esa query
        //6º -> Devolver siempre una respuesta (response)
        $response->setData([
            'success' => true,
            'data' => [
                'id' => $categoria->getId(),
                'nombre' => $categoria->getCategoria()
            ]
        ]);
        return $response;
    }

    /**
     * @Route ("/categoria/list", name="list_categoria")
     */
    public function getAllCategoriasAction(CategoriasRepository $categoriasRepository) {
        //1º -> Llamar al método repository que devuelve un Array
        $categorias = $categoriasRepository->findAll();
        //2º -> Crear un objeto JsonResponse que va a ser la respuesta que se enviará de vuelta
        $response = new JsonResponse();
        //3º -> Patrón de negación primero -> comprobar que la 'categoria' no sea null o no exista (que no hayan errores)
        if (!$categorias) {
            //Esto pasa si es null, si no tiene valor asignado, si es igual a 0 o si es false, es decir, han enviado mal los datos en la petición (request)
            $response->setData([
                'success' => false,
                'data' => null,
                'error' => 'Categoria controller can´t be null or empty'
            ]);
            return $response;
        }
        //4º -> Enviar Array '$categorias' en formato Json (como Symfony no sabe pasar de Array a Json, hay que pasar cada objeto del Array '$categorias' a Json por separado)
        $categoriasAsArray = [];
        foreach ($categorias as $cat) {
            $categoriasAsArray[] = [
                'id' => $cat->getId(),
                'categoria' => $cat->getCategoria()
            ];
        }
        //5º -> Devolver siempre una respuesta (response)
        $response->setData([
            'success' => true,
            'data' => $categoriasAsArray
        ]);
        return $response;
    }
}





