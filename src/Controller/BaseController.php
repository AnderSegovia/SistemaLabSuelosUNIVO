<?php

namespace App\Controller;

use App\Entity\TblAuditoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BaseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function auditoria(SessionInterface $session): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        $auditoria = $this->entityManager->getRepository(TblAuditoria::class)->findAll();

        return $this->render('auditoria/auditoria.html.twig', [
            'auditoria' => $auditoria,
        ]);
    }
    public function inicio(SessionInterface $session): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        return $this->render('principal/inicio.html.twig');
    }
    
}
