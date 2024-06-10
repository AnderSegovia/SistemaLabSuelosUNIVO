<?php

namespace App\Controller;

use App\Entity\TblDepartamentos;
use App\Entity\TblEmpresa;
use App\Entity\TblMunicipios;
use App\Entity\TblProyectos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProyectosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function proyectos(SessionInterface $session): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        $proyectos = $this->entityManager->getRepository(TblProyectos::class)->findAll();

        return $this->render('proyectos/proyectos.html.twig', [
            'proyectos' => $proyectos,
        ]);
    }

    public function AgregarProyecto( SessionInterface $session, $id): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }     
        $departamentos = $this->entityManager->getRepository(TblDepartamentos::class)->findAll();
        $municipios = $this->entityManager->getRepository(TblMunicipios::class)->findAll();


        return $this->render('proyectos/AgregarProyecto.html.twig', [
            'idEmpresa' => $id,
            'departamentos' => $departamentos,
            'municipios' => $municipios,
        ]);
    
    }
    public function addProyecto(SessionInterface $session, Request $request): Response
    {  
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
    
        if ($request->isMethod('POST')) {
            $proyecto = new TblProyectos();
    
            $proyecto->setNombreProyecto($request->request->get('nombre_proyecto'));
            $proyecto->setUbicacionProyecto($request->request->get('ubicacion_proyecto'));
            $proyecto->setFechaCreado(new \DateTime($request->request->get('fecha_creado')));
    
            $idDepartamento = $request->request->get('departamentos');
            $departamento = $this->entityManager->getRepository(TblDepartamentos::class)->find($idDepartamento);
            $proyecto->setFkDepartamento($departamento);
    
            $idMunicipio = $request->request->get('municipios');
            $municipio = $this->entityManager->getRepository(TblMunicipios::class)->find($idMunicipio);
            $proyecto->setFkMunicipio($municipio);
    
            $idCliente = $request->request->get('fk_cliente');
            $cliente = $this->entityManager->getRepository(TblEmpresa::class)->find($idCliente);
            $proyecto->setFkCliente($cliente);
    
            $this->entityManager->persist($proyecto);
            $this->entityManager->flush();
    
            return $this->redirectToRoute('proyectos');
        } else {
            return $this->redirectToRoute('proyectos');
        }
    }
    
    
    public function upProyecto(SessionInterface $session, Request $request, $id): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }

        $proyecto = $this->entityManager->getRepository(TblProyectos::class)->find($id);
        $departamentos = $this->entityManager->getRepository(TblDepartamentos::class)->findAll();
        $municipios = $this->entityManager->getRepository(TblMunicipios::class)->findAll();
        
        if (!$proyecto) {
            throw $this->createNotFoundException('No se encontró el proyecto.');
        }
        
        if ($request->isMethod('POST')) {
            $nombreProyecto = $request->request->get('nombre_proyecto');
            $codigoProyecto = $request->request->get('codigo_proyecto');
            $ubicacionProyecto = $request->request->get('ubicacion_proyecto');
            $idDepartamento = $request->request->get('departamento_proyecto');
            $idMunicipio = $request->request->get('municipio_proyecto');
            
            $departamento = $this->entityManager->getRepository(TblDepartamentos::class)->find($idDepartamento);
            $municipio = $this->entityManager->getRepository(TblMunicipios::class)->find($idMunicipio);
            
            if ($departamento && $municipio) {
                $proyecto->setNombreProyecto($nombreProyecto);
                $proyecto->setCodigo($codigoProyecto);
                $proyecto->setUbicacionProyecto($ubicacionProyecto);
                $proyecto->setFkDepartamento($departamento);
                $proyecto->setFkMunicipio($municipio);
                
                $this->entityManager->flush();
                return $this->redirectToRoute('proyectos');
            }
        }
        
        return $this->render('proyectos/upProyecto.html.twig', [
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'proyecto' => $proyecto,
        ]);
    }
    
}
