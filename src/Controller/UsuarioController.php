<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Usuario;

class UsuarioController extends AbstractController
{
    public function index()
    {
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
            'usuario' => $usuario,
        ]);
    }

    public function Guardar(Request $request){
        $usuario = $this->getUser();
        $usuario->setNombre($request->request->get('nombre'));
        
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->Guardar($usuario);
        
        $mensaje = "Nombre de usuario guardado correctamente";
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
            'mensaje' => $mensaje,
            'usuario' => $usuario,
        ]);
    }
}
