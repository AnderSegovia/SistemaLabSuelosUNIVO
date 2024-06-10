<?php

namespace App\Controller;

use App\Entity\TblEnsayos;
use App\Entity\TblEstado;
use App\Entity\TblListaarchivos;
use App\Entity\TblMolde;
use App\Entity\TblTipoMuestra;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MantenimientoController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function mantenimiento(SessionInterface $session): Response
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }

        $tiposMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->findAll();
        $ensayos = $this->entityManager->getRepository(TblEnsayos::class)->findAll();
        $moldes = $this->entityManager->getRepository(TblMolde::class)->findAll();
        $estados = $this->entityManager->getRepository(TblEstado::class)->findAll();
        $plantillas = $this->entityManager->getRepository(TblListaarchivos::class)->findAll();


        return $this->render('mantenimiento/mantenimiento.html.twig', [
            'tiposMuestra' => $tiposMuestra,
            'ensayos'=>$ensayos,
            'moldes'=>$moldes,
            'estados'=>$estados,
            'plantillas'=>$plantillas,
        ]);
    }
    public function agregarTipoMuestra(Request $request)
    {
        $nombreEnsayo = $request->request->get('nombreTipoMuestra');
        $estadoMuestra = $request->request->get('estadoMuestraw');
        $rol = $this->entityManager->getRepository(TblEstado::class)->find($estadoMuestra);

        $ensayo = new TblTipoMuestra();
        $ensayo->setnombreTipoMuestra($nombreEnsayo);
        $ensayo->setfkestado($rol);

        $this->entityManager->persist($ensayo);
        $this->entityManager->flush();

        return $this->redirectToRoute('mantenimiento');
    }

    public function agregarEnsayo(Request $request)
    {
        $nombreEnsayo = $request->request->get('nombreEnsayo');
        $estadoMuestra = $request->request->get('estadoEnsayow');
        $rol = $this->entityManager->getRepository(TblEstado::class)->find($estadoMuestra);

        $ensayo = new TblEnsayos();
        $ensayo->setNombreEnsayo($nombreEnsayo);
        $ensayo->setfkestado($rol);

        $this->entityManager->persist($ensayo);
        $this->entityManager->flush();

        return $this->redirectToRoute('mantenimiento');
    }

    public function agregarMolde(Request $request)
    {
        $nombreMolde = $request->request->get('nombreMolde');
        $estadoMolde = $request->request->get('estadoMolde');
        $cantidadMolde = $request->request->get('cantidadMolde');

        $estado = $this->entityManager->getRepository(TblEstado::class)->find($estadoMolde);

        $ensayo = new TblMolde();
        $ensayo->setNombreMolde($nombreMolde);
        $ensayo->setCantidadMolde($cantidadMolde);
        $ensayo->setfkestado($estado);

        $this->entityManager->persist($ensayo);
        $this->entityManager->flush();

        return $this->redirectToRoute('mantenimiento');
    }

    public function upTipoMuestra(SessionInterface $session, Request $request)
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        
    
        if ($request->isMethod('POST')) {
            $nombreTipoMuestra = $request->request->get('nombreTipoMuestra');
            $id = $request->request->get('id');
            $estadoMuestra = $request->request->get('estadoMuestra');

            $tipoMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->find($id);
            $rol = $this->entityManager->getRepository(TblEstado::class)->find($estadoMuestra);

    
            $tipoMuestra->setnombreTipoMuestra($nombreTipoMuestra);
            $tipoMuestra->setfkestado($rol);
    
            $this->entityManager->flush();
            return $this->redirectToRoute('mantenimiento');
        }
        return $this->redirectToRoute('mantenimiento');
    }

    public function upEnsayo(SessionInterface $session, Request $request)
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        
    
        if ($request->isMethod('POST')) {
            $nombreEnsayo = $request->request->get('nombreEnsayo');
            $id = $request->request->get('id');
            $estadoMuestra = $request->request->get('estadoEnsayo');

            $ensayo = $this->entityManager->getRepository(TblEnsayos::class)->find($id);
            $rol = $this->entityManager->getRepository(TblEstado::class)->find($estadoMuestra);
    
            $ensayo->setnombreEnsayo($nombreEnsayo);
            $ensayo->setfkestado($rol);
    
            $this->entityManager->flush();
            return $this->redirectToRoute('mantenimiento');
        }
        return $this->redirectToRoute('mantenimiento');
    }

    public function upMolde(SessionInterface $session, Request $request)
    {
        $fkRol = $session->get('fk_rol');

        if ($fkRol !== 1) {
            return $this->redirectToRoute('login');
        }
        
    
        if ($request->isMethod('POST')) {
            $nombreMolde = $request->request->get('nombreMolde');
            $cantidadMolde = $request->request->get('cantidadMolde');
            $id = $request->request->get('id');
            $estadoMolde = $request->request->get('estadoEnsayo');

            $molde = $this->entityManager->getRepository(TblMolde::class)->find($id);
            $rol = $this->entityManager->getRepository(TblEstado::class)->find($estadoMolde);
    
            $molde->setNombreMolde($nombreMolde);
            $molde->setcantidadMolde($cantidadMolde);
            $molde->setfkestado($rol);
    
            $this->entityManager->flush();
            return $this->redirectToRoute('mantenimiento');
        }
        return $this->redirectToRoute('mantenimiento');
    }
    
    public function agregarPlantilla(Request $request)
    {
        $nombrePlantilla = $request->request->get('nombrePlantilla');
        $nombreArchivo = $request->request->get('nombreArchivo');
        $estadoPlantilla = $request->request->get('estadoPlantilla');
        $estado = $this->entityManager->getRepository(TblEstado::class)->find($estadoPlantilla);

        /** @var UploadedFile $archivoPlantilla */
        $archivoPlantilla = $request->files->get('archivoPlantilla');
    
        if ($archivoPlantilla) {
            $newFilename = $nombreArchivo.'-'.uniqid().'.'.$archivoPlantilla->guessExtension();

            try {
                $archivoPlantilla->move(
                    $this->getParameter('kernel.project_dir') . '/public/assets/excel/' ,
                    $newFilename
                );
            } catch (FileException $e) {

            }

            $plantilla = new TblListaarchivos();
            $plantilla->setNombre($nombrePlantilla);
            $plantilla->setRuta($newFilename);
            $plantilla->setFkEstado($estado);
            $this->entityManager->persist($plantilla);
            $this->entityManager->flush();
    
            return $this->redirectToRoute('mantenimiento');
        }
    
        return $this->redirectToRoute('mantenimiento');
    }
    public function editarPlantilla(Request $request)
    {
        $id = $request->request->get('editId');
        $nombrePlantilla = $request->request->get('editNombrePlantilla');
        $nombreArchivo = $request->request->get('editNombreArchivo');
        $estadoPlantilla = $request->request->get('editEstadoPlantilla');
        $estado = $this->entityManager->getRepository(TblEstado::class)->find($estadoPlantilla);
    
        /** @var UploadedFile $archivoPlantilla */
        $archivoPlantilla = $request->files->get('editArchivoPlantilla');
        
        $plantilla = $this->entityManager->getRepository(TblListaarchivos::class)->find($id);
        if (!$plantilla) {
            throw $this->createNotFoundException('Plantilla no encontrada');
        }
    
        $plantilla->setNombre($nombrePlantilla);
        $plantilla->setFkEstado($estado);
    
        $currentFile = $request->request->get('currentFile');
        if ($archivoPlantilla) {
            $newFilename = $nombreArchivo.'-'.uniqid().'.'.$archivoPlantilla->guessExtension();
    
            try {
                $archivoPlantilla->move(
                    $this->getParameter('kernel.project_dir') . '/public/assets/excel/',
                    $newFilename
                );

                $plantilla->setRuta($newFilename);
            } catch (FileException $e) {
            }
        } else {

            $plantilla->setRuta($currentFile);
        }
    
        $this->entityManager->persist($plantilla);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('mantenimiento');
    }
    
}
