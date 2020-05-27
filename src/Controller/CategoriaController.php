<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categoria;


class CategoriaController extends AbstractController
{
    public function index($page)
    {
        $numRegis = 2;
        if(!isset($page)) $page=1;
        $pos = ($page * $numRegis)-$numRegis;
        
        
        $numArtTotal = count($this->getDoctrine()->getRepository(Categoria::class)->findAll());
        $numPag = ceil($numArtTotal / $numRegis);       

        $prev = 1;
        if($page>1) $prev = $page -1;

         $next = $page;
        if($page<$numPag) $next = $next +1;

        $categorias = $this->getDoctrine()->getRepository(Categoria::class)-> ListadoCategoria("fechaCreacion","ASC", $pos, $numRegis);
        return $this->render('categoria/index.html.twig', [
            'categoria' => $categorias,
            'page' => $page,
            'numPag' => $numPag,
            'prev' => $prev,
            'next' => $next,
        ]);
    }

    public function Crear()
    {
        $categoria = new Categoria();
        return $this->render('categoria/insertUpdate.html.twig', [
            'categoria' => $categoria,
        ]);
    }

    public function Editar($id)
    {
        $categoria = $this->getDoctrine()->getRepository(Categoria::class)->find($id);
        return $this->render('categoria/insertUpdate.html.twig', [
            'categoria' => $categoria,
        ]);
    }

    public function Guardar(Request $request){
        $cat = new Categoria();    
        //$cat->setFechacreacion(new \DateTime); Sepuede poner aquí solo o abajo con el else
        
        $id = $request->request->get('id');
        $existeID = isset($id) && !empty($id);
        if ($existeID) {
            //categoria para editar
            $cat = $this->getDoctrine()->getRepository(Categoria::class)->find($id);
        }else{
            /*categoria nueva. la editada no se le modifica la fecha, porque si no,
            fechacreacion seria para nada, porque cambiaría cada vez que se modifica
            la categoría,otra cosa es poner un campo fecha de modificación y ahí si
            que se pondría donde está el nombre, abajo.*/
            $cat->setFechacreacion(new \DateTime);
        }
        //el nombre siempre se guarda se cree o se edite
        $cat->setNombre($request->request->get('nombre'));
        $categoria = $this->getDoctrine()->getRepository(Categoria::class)->Guardar($cat);
        return $this->render('categoria/insertUpdate.html.twig', [
            'categoria' => $categoria,
            'mensaje' => "Guardado satisfactoriamente",
        ]);
    }

    public function Borrar($id){
        $repo = $this->getDoctrine()->getRepository(Categoria::class); 
        $categoria = $repo->find($id); 
        $cat = $repo->Borrar($categoria);
        return $this->redirectToRoute('categoria');
    }
}
