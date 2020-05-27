<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Producto;
use App\Models\vmProducto;
use App\Entity\Imagen;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $listProducto = $this->ListadoProducto();      
        $user = $this->getUser();
        return $this->render('home/index.html.twig', [
            'user' => $user,          
            'listProducto' => $listProducto,
        ]);
    }

    public function Detalle($idproducto){

        $producto = $this->getDoctrine()->getRepository(Producto::class)->find($idproducto);
        $imagenes = $this->getDoctrine()->getRepository(Imagen::class)->findby(["idproducto"=>$idproducto]);
        return $this->render('home/detalle.html.twig', [
            'producto' => $producto,
            'imagenes' => $imagenes,
        ]);
    }
    

    public function ListadoProducto(){
        $array = [];
        $em = $this->getDoctrine()->getManager();
        $sql = "SELECT * FROM vistaProducto";
        $result = $em->getConnection()->prepare($sql);
        $result->execute();
        /* dump($result->fetchAll());
        die; */
        foreach($result->fetchAll() as $row){
            $pro = new vmProducto();
            $pro->setId($row["id"]);
            $pro->setNombreProducto($row["NombreProducto"]);
            $pro->setDescripcion($row["descripcion"]);
            $pro->setPrecio($row["precio"]);
            $pro->setNombreImagen($row["NombreImagen"]);
            $pro->setNombreCategoria($row["NombreCategoria"]);

            $array[] = $pro;
        }
        return $array;
    }
}
