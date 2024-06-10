<?php

namespace App\Controller;

use App\Entity\TblUsuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LoginController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, SessionInterface $session): Response
    {
        if ($session->has('codigo_usuario')) {
            $session->remove('codigo_usuario');
        }
        if ($request->isMethod('POST')) {
            $codigoUsuario = $request->request->get('codigo_usuario');
            $contraUsuario = $request->request->get('contra_usuario');

            $usuario = $this->entityManager
                ->getRepository(TblUsuario::class)
                ->findOneBy(['codigoUsuario' => $codigoUsuario, 'contraUsuario' => $contraUsuario]);

            if (!$usuario) {
                $this->addFlash('error', 'Credenciales Invalidas');
                return $this->redirectToRoute('login');
            }
            $session->set('codigo_usuario', $codigoUsuario);
            $session->set('nombre_usuario', $usuario->getNombreUsuario());
            $session->set('fk_rol', $usuario->getFkRol()->getIdRol());

            return $this->redirectToRoute('inicio');
        }

        return $this->render('login/login.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request, SessionInterface $session): Response
    {
        $session->remove('codigo_usuario');

        return $this->redirectToRoute('login');
    }
  
}
