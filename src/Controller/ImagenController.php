<?php

namespace App\Controller;

use App\Entity\Imagen;
use App\Entity\Producto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ImagenController extends AbstractController
{
    public function index()
    {
        return $this->render('imagen/index.html.twig', [
            'controller_name' => 'ImagenController',
        ]);
    }

    public function Crear()
    {
        $imagen = [];
        array_push($imagen, new Imagen());

        $producto = $this->getDoctrine()->getRepository(Producto::class)->findAll();
        return $this->render('imagen/insertUpdate.html.twig', [
            'imagen' => $imagen,
            'producto' => $producto,
        ]);
    }

    public function Editar($id)
    {
        $produc = $this->getDoctrine()->getRepository(Producto::class);
        $img = $this->getDoctrine()->getRepository(Imagen::class);

        $imagen = $img->ListImagenes($id);
        $producto = $produc->findAll();

        return $this->render('imagen/insertUpdate.html.twig', [
            'producto' => $producto,
            'imagen'=> $imagen,
        ]);
    }

    public function Guardar(Request $request){
        $objImagen = [];
        $idproducto = $request->request->get('idproducto');
        $uploadedFile = $request->files->get('nombre');
        $objProducto = $this->getDoctrine()->getRepository(Producto::class)->find($idproducto);
     
        $ruta ="img/producto/".$idproducto;
        foreach ($uploadedFile as $item){
            $nombre = $item->getClientOriginalName();
            $imagen = new Imagen();
            $imagen->setNombre($nombre);
            $imagen->setIdproducto($objProducto);
            $item->move($ruta, $nombre);
            $itemImagen = $this->getDoctrine()->getRepository(Imagen::class)->Guardar($imagen); 
            array_push($objImagen, $itemImagen);
        }

         $producto = $this->getDoctrine()->getRepository(Producto::class)->findAll();
        return $this->render('imagen/insertUpdate.html.twig', [
            'producto' => $producto,
            'imagen' =>$objImagen,
        ]);
    }

   

    /* Metodo GET 
    public function Borrar($id){
        $repo = $this->getDoctrine()->getRepository(Imagen::class);
        $img = $repo->find($id); 
        $idproducto = $img->getIdproducto()->getId; 
        $nombreimg = $img->getNombre();
        $ruta ="img/producto/".$idproducto."/".$nombreimg;

        unlink($ruta);
        $repo->Borrar($img);
        return $this->redirectToRoute('ImagenEditarPost',['id'=> $idproducto]);
    } */

    public function Borrar(Request $request){   
        $id = $request->request->get('id');   
        $repo = $this->getDoctrine()->getRepository(Imagen::class);
        $img = $repo->find($id); 
        $idproducto = $img->getIdproducto()->getId(); 
        $nombreimg = $img->getNombre();
        $ruta ="img/producto/".$idproducto."/".$nombreimg;

        unlink($ruta);
        $repo->Borrar($img);
        return new JsonResponse(array('msg' => 'Fichero eliminado por POST'));
    }
}
