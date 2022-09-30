<?php

namespace App\Controller;

use App\Entity\Categorias;
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
        //1º -> Cogemos la información a guardar que nos viene en la petición (request)
        $nombreCategoria = $request->get('categoria');
        //2º -> Creo un objeto JsonResponse que va a ser la respuesta que enviaremos de vuelta
        $response = new JsonResponse();
        //3º -> Patrón de negación primero -> tengo que comprobar que la 'categoria' no venga a null o no venga (que no hayan errores)
        if (!$nombreCategoria) {
            //Esto pasa si es null, si no tiene valor asignado, si es igual a 0 o si es false, es decir, nos han enviado mal los datos en la petición (request)
            $response->setData([
                'succes' => false,
                'data' => null,
                'error' => 'Categoria controller can´t be null or empty'
            ]);
            return $response;
        }
        //4º -> Tengo que crear un nuevo objeto y setear sus atributos, ya que nos han enviado bien los datos de la petición (request)
        $categoria = new Categorias();
        $categoria->setCategoria($nombreCategoria);
        //5º -> Guardamos el objeto en bbdd con el EntityManagerInterface
        $em->persist($categoria);   //Doctrine -> persist() -> prepara la query para guardar el objeto en bbdd
        #$em->remove($categoria);   //Doctrine -> remove() -> prepara la query para borrar el objeto en bbdd
        $em->flush();   //Doctrine -> flush() -> ejecuta esa query
        //6º -> Devolver siempre una respuesta (response)
        $response->setData([
            'succes' => true,
            'data' => [
                'id' => $categoria->getId(),
                'nombre' => $categoria->getCategoria()
            ]
        ]);
        return $response;
    }
}
