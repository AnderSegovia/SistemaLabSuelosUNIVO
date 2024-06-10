<?php

namespace App\Controller;

use App\Entity\TblUsuario;
use App\Entity\TblRol;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UsuariosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function usuarios(SessionInterface $session): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        $usuarios = $this->entityManager->getRepository(TblUsuario::class)->findAll();

        return $this->render('usuarios/usuarios.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

    public function AgregarUsuario( SessionInterface $session): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }       
        $roles = $this->entityManager->getRepository(TblRol::class)->findAll();

        return $this->render('usuarios/AgregarUsuario.html.twig', [
            'roles' => $roles,
        ]);
    
    }
    public function addUsuarios(SessionInterface $session, Request $request): Response
    {  
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }

        if ($request->isMethod('POST')) {
            $usuario = new TblUsuario();

            $usuario->setCodigoUsuario($request->request->get('codigo_usuario'));
            $usuario->setNombreUsuario($request->request->get('nombre_usuario'));
            $usuario->setNumeroDui($request->request->get('numero_dui'));
            $usuario->setEdad($request->request->get('edad'));
            $usuario->setTelefono($request->request->get('telefono'));
            $usuario->setFechaCreado(new \DateTime($request->request->get('fecha_creado')));
            $usuario->setContraUsuario($request->request->get('contra_usuario'));

            $idRol = $request->request->get('fk_rol');
            $rol = $this->entityManager->getRepository(TblRol::class)->find($idRol);
            $usuario->setFkRol($rol);

            $this->entityManager->persist($usuario);
            $this->entityManager->flush();

            return $this->redirectToRoute('usuarios');
        } else {
            return $this->redirectToRoute('usuarios');
        }
    }
    public function upUsuario(SessionInterface $session, Request $request, $id): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        
        $usuario = $this->entityManager->getRepository(TblUsuario::class)->find($id);
        $roles = $this->entityManager->getRepository(TblRol::class)->findAll();
    
        if (!$usuario) {
            throw $this->createNotFoundException('No se encontró el usuario.');
        }
    
        if ($request->isMethod('POST')) {
            $codigoUsuario = $request->request->get('codigoUsuario');
            $nombreUsuario = $request->request->get('nombreUsuario');
            $numeroDui = $request->request->get('numeroDui');
            $edad = $request->request->get('edad');
            $telefono = $request->request->get('telefono');
            $fkRol = $request->request->get('fk_rol');
    
            $usuario->setCodigoUsuario($codigoUsuario);
            $usuario->setNombreUsuario($nombreUsuario);
            $usuario->setNumeroDui($numeroDui);
            $usuario->setEdad($edad);
            $usuario->setTelefono($telefono);
            
            $rol = $this->entityManager->getRepository(TblRol::class)->find($fkRol);
            if ($rol) {
                $usuario->setFkRol($rol);
            } else {
            }
    
            $this->entityManager->flush();
            return $this->redirectToRoute('usuarios');
        }
        return $this->render('usuarios/upUsuario.html.twig', [
            'roles' => $roles,
            'usuario' => $usuario,
        ]); 
    }
    public function eliminarUsuario(Request $request, $id): Response
    {
        $usuario = $this->entityManager->getRepository(TblUsuario::class)->find($id);

        if (!$usuario) {
            throw $this->createNotFoundException('No se encontró el usuario con el ID: '.$id);
        }

        $this->entityManager->remove($usuario);
        $this->entityManager->flush();

        $this->addFlash('success', 'Usuario eliminado exitosamente.');

        return $this->redirectToRoute('usuarios');
    }
}
