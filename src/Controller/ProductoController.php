<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categoria;
use App\Entity\Producto;

class ProductoController extends AbstractController
{
    public function index($page)
    {
        $numRegis = 2;
        if(!isset($page)) $page=1;
        $pos = ($page * $numRegis)-$numRegis;
        
        
        $numArtTotal = count($this->getDoctrine()->getRepository(Producto::class)->findAll());
        $numPag = ceil($numArtTotal / $numRegis);       

        $prev = 1;
        if($page>1) $prev = $page -1;

         $next = $page;
        if($page<$numPag) $next = $next +1;

        $productos = $this->getDoctrine()->getRepository(Producto::class)-> ListadoProducto("fechaCreacion","ASC", $pos, $numRegis);
        return $this->render('producto/index.html.twig', [
            'producto' => $productos,
            'page' => $page,
            'numPag' => $numPag,
            'prev' => $prev,
            'next' => $next,
        ]);
    }

    public function Crear()
    {
        $producto = new Producto();
        $cat = new Categoria();
        $producto->setIdcategoria($cat);
        $categoria = $this->getDoctrine()->getRepository(Categoria::class)->findAll();
        return $this->render('producto/insertUpdate.html.twig', [
            'producto' => $producto,
            'categoria' => $categoria,
        ]);
    }

    public function Editar($id)
    {
        $categoria = $this->getDoctrine()->getRepository(Categoria::class)->findAll();
        $producto = $this->getDoctrine()->getRepository(Producto::class)->find($id);
        return $this->render('producto/insertUpdate.html.twig', [
            'producto' => $producto,
            'categoria'=> $categoria,
        ]);
    }

    public function Guardar(Request $request){
        $idcategoria = $request->request->get("idcategoria");
        $categoria = $this->getDoctrine()->getRepository(Categoria::class)->find($idcategoria);

        $pro = new Producto();    
        $pro->setFechacreacion(new \DateTime);
        
        $id = $request->request->get('id');
        $existeID = isset($id) && !empty($id);
        if ($existeID) {
            $pro = $this->getDoctrine()->getRepository(Producto::class)->find($id);
        }
        //el nombre siempre se guarda se cree o se edite
        $pro->setIdcategoria($categoria);
        $pro->setNombre($request->request->get('nombre'));
        $pro->setDescripcion($request->request->get('descripcion'));
        $pro->setPrecio($request->request->get('precio'));
        $pro->setStock($request->request->get('stock'));

        $producto = $this->getDoctrine()->getRepository(Producto::class)->Guardar($pro);
        return $this->render('producto/insertUpdate.html.twig', [
            'producto' => $producto,
            'categoria' => $categoria,
            'mensaje' => "Guardado satisfactoriamente",
        ]);
    }

   

    public function Borrar($id){
        $repo = $this->getDoctrine()->getRepository(Producto::class); 
        $producto = $repo->find($id); 
        $cat = $repo->Borrar($producto);
        return $this->redirectToRoute('producto');
    }
}
