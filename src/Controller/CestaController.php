<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Cesta;
use App\Entity\Producto;
use App\Models\vmProducto;

class CestaController extends AbstractController
{
    public function index()
    {
        $user = $this->getUser();
        $listCesta = $this->ListadoProductoCesta();    
        return $this->render('cesta/index.html.twig', [
            'controller_name' => 'CestaController',
            'listCesta' => $listCesta,
        ]);
    }

    public function add(Request $request){
        $idproducto = $request->request->get("idp");
        $cantidad = $request->request->get("cnt");

        $cesta = new Cesta();
        $user = $this->getUser();
        $producto = $this->getDoctrine()->getRepository(Producto::class)->find($idproducto);
        
        $cesta->setIdproducto($producto);
        $cesta->setIdusuario($user);
        $cesta->setFechacreacion(new \DateTime);
        $cesta->setCantidad($cantidad);

        $existecesta = $this->getDoctrine()->getRepository(Cesta::class)->findBy(["idproducto"=>$idproducto,"idusuario"=>$user->getId()]);
        $cant = $cantidad;
        if($existecesta){
            $row = $existecesta[0];
            $cant = $row->getCantidad() + $cantidad;
            $row->setCantidad($cant);
            $cesta = $row;
        }
        $this->getDoctrine()->getRepository(Cesta::class)->Guardar($cesta);

        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT SUM(c.cantidad) AS numElementos FROM App\Entity\Cesta c WHERE c.idusuario = ?1";
        $numElementos = $em->createQuery($dql)
                            ->setParameter(1, $user->getId())
                            ->getSingleScalarResult();
       
        return new JsonResponse(array('msg'=>'Producto añadido al carrito','cantidad'=>$numElementos));
    }

    public function ListadoProductoCesta(){
        $array = [];
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM vmListaCesta WHERE idusuario = " . $this->getUser()->getId();
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        
        foreach($result->fetchAll() as $row){
            $pro = new vmProducto();
            $pro->setId($row["id"]);
            $pro->setNombreProducto($row["nombre"]);
            $pro->setDescripcion($row["descripcion"]);
            $pro->setPrecio($row["precio"]);
            $pro->setNombreImagen($row["NombreImagen"]);
            $pro->setCantidad($row["cantidad"]);

            $array[] = $pro;
        }
        return $array;
    }
}