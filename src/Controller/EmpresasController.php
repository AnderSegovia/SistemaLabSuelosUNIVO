<?php

namespace App\Controller;

use App\Entity\TblDepartamentos;
use App\Entity\TblEmpresa;
use App\Entity\TblMunicipios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EmpresasController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function empresas(SessionInterface $session): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        $empresas = $this->entityManager->getRepository(TblEmpresa::class)->findAll();

        return $this->render('empresas/empresas.html.twig', [
            'empresas' => $empresas,
        ]);
    }

    public function AgregarEmpresa( SessionInterface $session): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }       
        $departamentos = $this->entityManager->getRepository(TblDepartamentos::class)->findAll();
        $municipios = $this->entityManager->getRepository(TblMunicipios::class)->findAll();


        return $this->render('empresas/AgregarEmpresa.html.twig', [
            'departamentos' => $departamentos,
            'municipios' => $municipios,
        ]);
    
    }
    
    public function AgregarCliente( SessionInterface $session): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }    
           
        $departamentos = $this->entityManager->getRepository(TblDepartamentos::class)->findAll();
        $municipios = $this->entityManager->getRepository(TblMunicipios::class)->findAll();


        return $this->render('empresas/AgregarCliente.html.twig', [
            'departamentos' => $departamentos,
            'municipios' => $municipios,
        ]);
    
    }
    public function addEmpresa(SessionInterface $session, Request $request): Response
    {     
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        
        if ($request->isMethod('POST')) {
            $empresa = new TblEmpresa();
        
            $empresa->setNombreEmpresa($request->request->get('nombre_empresa'));
            $empresa->setCorreoEmpresa($request->request->get('correo_empresa'));
            $empresa->setDuiDepositante($request->request->get('dui_depositante'));
            $empresa->setDireccionEmpresa($request->request->get('direccion_empresa'));
            $empresa->setTelefonoEmpresa($request->request->get('telefono_empresa'));
            $empresa->setNoNit($request->request->get('no_nit'));
            $empresa->setGiroEmpresa($request->request->get('giro_empresa'));
            $empresa->setRazonSocial($request->request->get('razon_social'));
            $empresa->setNoRegistronrc($request->request->get('no_registroNRC'));
            $empresa->setFechaCreado(new \DateTime($request->request->get('fecha_creado')));
            $empresa->setTipoCliente($request->request->get('tipo_cliente'));


            $idDepa = $request->request->get('departamentos');
            $depa = $this->entityManager->getRepository(TblDepartamentos::class)->find($idDepa);
            $empresa->setfkDepartamento($depa);

            $idMuni = $request->request->get('municipios');
            $muni = $this->entityManager->getRepository(TblMunicipios::class)->find($idMuni);
            $empresa->setfkMunicipio($muni);

            $this->entityManager->persist($empresa);
            $this->entityManager->flush();
        
            return $this->redirectToRoute('clientes');
        } else {
            return $this->redirectToRoute('clientes');
        }
        
    }
    public function upEmpresa(SessionInterface $session, Request $request, $id): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        
        $empresa = $this->entityManager->getRepository(TblEmpresa::class)->find($id);
        $departamentos = $this->entityManager->getRepository(TblDepartamentos::class)->findAll();
        $municipios = $this->entityManager->getRepository(TblMunicipios::class)->findAll();
        
        if (!$empresa) {
            throw $this->createNotFoundException('No se encontró la empresa.');
        }
        
        if ($request->isMethod('POST')) {
            $empresa->setNombreEmpresa($request->request->get('nombreEmpresa'));
            $empresa->setCorreoEmpresa($request->request->get('correoEmpresa'));
            $empresa->setDuiDepositante($request->request->get('duiDepositante'));
            $empresa->setDireccionEmpresa($request->request->get('direccionEmpresa'));
            $empresa->setTelefonoEmpresa($request->request->get('telefonoEmpresa'));
            $empresa->setNoNit($request->request->get('noNit'));
            $empresa->setGiroEmpresa($request->request->get('giroEmpresa'));
            $empresa->setRazonSocial($request->request->get('razonSocial'));
            $empresa->setNoRegistronrc($request->request->get('noRegistronrc'));
            $empresa->setFechaCreado(new \DateTime($request->request->get('fechaCreado')));
        
            $idDepa = $request->request->get('departamentoEmpresa');
            $depa = $this->entityManager->getRepository(TblDepartamentos::class)->find($idDepa);
            $empresa->setFkDepartamento($depa);
        
            
            $idMuni = $request->request->get('municipioEmpresa');
            $muni = $this->entityManager->getRepository(TblMunicipios::class)->find($idMuni);
            $empresa->setFkMunicipio($muni);        
    
            $this->entityManager->flush();
            
            return $this->redirectToRoute('clientes');
        }
        
        return $this->render('empresas/upEmpresa.html.twig', [
            'empresa' => $empresa,
            'departamentos' => $departamentos,
            'municipios' => $municipios,
        ]);
    }
    public function eliminarEmpresa(Request $request, $id): Response
    {
        $usuario = $this->entityManager->getRepository(TblEmpresa::class)->find($id);

        if (!$usuario) {
            throw $this->createNotFoundException('No se encontró el usuario con el ID: '.$id);
        }

        $this->entityManager->remove($usuario);
        $this->entityManager->flush();

        $this->addFlash('success', 'Usuario eliminado exitosamente.');

        return $this->redirectToRoute('clientes');
    }
}
