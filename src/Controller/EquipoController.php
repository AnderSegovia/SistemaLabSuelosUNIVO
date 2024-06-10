<?php

namespace App\Controller;

use App\Entity\TblDetalleEquipo;
use App\Entity\TblEquipo;
use App\Entity\TblMolde;
use App\Entity\TblProyectos;
use App\Entity\TblRol;
use App\Entity\TblTipoMuestra;
use App\Entity\TblUsuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EquipoController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function equipo(SessionInterface $session): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        
        $equipos = $this->entityManager->getRepository(TblEquipo::class)->findAll();
        $detalleEquipo = $this->entityManager->getRepository(TblDetalleEquipo::class)->findAll();

        
        return $this->render('equipo/equipo.html.twig', [
            'equipos' => $equipos,
            'detalleEquipo'=> $detalleEquipo,
        ]);
    }
    

    public function addEquipo( SessionInterface $session, $id): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        $equipos = $this->entityManager->getRepository(TblEquipo::class)->findAll();
        $moldes = $this->entityManager->getRepository(TblMolde::class)->findAll();



        return $this->render('equipo/AgregarEquipo.html.twig', [
            'idProyecto' => $id,
            'equipos' => $equipos,
            'moldes' => $moldes,
        ]);
    
    }

    public function agregarEquipo(Request $request,SessionInterface $session): Response
    {
        if ($request->isMethod('POST')) {
            // Recuperar datos del formulario
            $atencion = $request->request->get('atencion');
            $cargo = $request->request->get('cargo');
            $contacto = $request->request->get('contacto');
            $diasAlquiler = $request->request->get('diasAlquiler');
            $fechaSalida = new \DateTime($request->request->get('fechaSalida'));
            $observaciones = $request->request->get('observaciones');
            $idProyecto = $request->request->get('fk_proyecto');

            // Crear una nueva instancia de TblEquipo
            $equipo = new TblEquipo();
            $equipo->setAtencion($atencion);
            $equipo->setCargo($cargo);
            $equipo->setContacto($contacto);
            $equipo->setDiasAlquiler($diasAlquiler);
            $equipo->setFechaSalida($fechaSalida);
            $equipo->setFechaRecepcion(null);
            $equipo->setFechaElaboracion($fechaSalida);
            $equipo->setObservaciones($observaciones);
            $equipo->setEstado("Alquilado");


            $proyecto = $this->entityManager->getRepository(TblProyectos::class)->find($idProyecto);
            $tecnico = $this->entityManager->getRepository(TblUsuario::class)->find($session->get('codigo_usuario'));
        
            $equipo->setFkProyectoEquipo($proyecto);
            $equipo->setFkTecnicoEntrega($tecnico);

            $this->entityManager->persist($equipo);
            $this->entityManager->flush();

            $contador = 1;
            while ($request->request->has('equipo_' . $contador)) {
                $idEquipo = $request->request->get('equipo_' . $contador);
                $cantidad = $request->request->get('cantidad_equipo_' . $contador);

                $detalleEquipo = new TblDetalleEquipo();
                $detalleEquipo->setCantidadEquipo($cantidad);

                $molde = $this->entityManager->getRepository(TblMolde::class)->find($idEquipo);

                $detalleEquipo->setFkMolde($molde);
                $resta=$molde -> getCantidadMolde();
                $resta= $resta-$cantidad;
                $molde -> setCantidadMolde($resta);

                $detalleEquipo->setFkEquipo($equipo);

                $this->entityManager->persist($detalleEquipo, $molde);

                $contador++;
            }

            $this->entityManager->flush();

            return $this->redirectToRoute('equipo');
        }

        return $this->render('equipo/equipo.html.twig');
    }
    
    public function upEquipo(Request $request, $id): Response
    {

        $equipo = $this->entityManager->getRepository(TblEquipo::class)->find($id);
        $mold = $this->entityManager->getRepository(TblMolde::class)->findAll();


        $detalleEquipo = $this->entityManager->getRepository(TblDetalleEquipo::class)->findBy(['fkEquipo' => $id]);
        
        if ($request->isMethod('POST')) {
            // Obtener los datos del formulario
            $data = $request->request->all();

            // Actualizar los datos del equipo
            $equipo->setAtencion($data['atencion']);
            $equipo->setCargo($data['cargo']);
            $equipo->setContacto($data['contacto']);
            $equipo->setObservaciones($data['observaciones']);
            $equipo->setDiasAlquiler($data['dias_alquiler']);

            // Actualizar las fechas
            $equipo->setFechaSalida(new \DateTime($data['fecha_salida']));
            if (!empty($data['fecha_recepcion'])) {
                $equipo->setFechaRecepcion(new \DateTime($data['fecha_recepcion']));
            }

            foreach ($detalleEquipo as $index => $detalle) {

                $idMolde = $data['molde'][$index];
                $tipoMolde = $this->entityManager->getRepository(TblMolde::class)->find($idMolde);
                $detalle->setFkMolde($tipoMolde);

                $detalle->setCantidadEquipo($data['cantidad'][$index]);

            }


            $this->entityManager->flush();
    
            return $this->redirectToRoute('equipo');
        }
    
        return $this->render('equipo/upEquipo.html.twig', [
            'moldes' => $detalleEquipo,
            'equipo' => $equipo,
            'mold' => $mold,
        ]);
    }

    public function marcarEquipo(Request $request, SessionInterface $session , $id): Response
    {
        $codigoUsuario = $session->get('codigo_usuario');
        $usuario = $this->entityManager->getRepository(TblUsuario::class)->find($codigoUsuario);
        $equipo = $this->entityManager->getRepository(TblEquipo::class)->find($id);
        $detalleEquipos = $this->entityManager->getRepository(TblDetalleEquipo::class)->findBy(['fkEquipo' => $id]);

        if (!$equipo) {
            throw $this->createNotFoundException('No se encontró el equipo con el ID: ' . $id);
        }

        $equipo->setFkTecnicoRecibe($usuario);
        $equipo->setEstado("Recibido");


        foreach ($detalleEquipos as $detalleEquipo) {
            $molde = $detalleEquipo->getFkMolde();
            $cantidadAlquilada = $detalleEquipo->getCantidadEquipo();
            
            $nuevaCantidad = $molde->getCantidadMolde() + $cantidadAlquilada;
            $molde->setCantidadMolde($nuevaCantidad);
            
            $this->entityManager->persist($molde);
        }
        
        $fechaActual = new \DateTime(); 
        
        $equipo->setFechaRecepcion($fechaActual);

        $this->entityManager->persist($equipo);
        $this->entityManager->flush();

        return $this->redirectToRoute('equipo');
    }
}