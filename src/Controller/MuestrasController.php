<?php

namespace App\Controller;

use App\Entity\TblAuditoria;
use App\Entity\TblEnsayos;
use App\Entity\TblListaarchivos;
use App\Entity\TblMateriales;
use App\Entity\TblMuestras;
use App\Entity\TblPivote;
use App\Entity\TblProyectos;
use App\Entity\TblTipoMuestra;
use App\Entity\TblUsuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use function PHPUnit\Framework\isEmpty;

class MuestrasController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function muestras(SessionInterface $session): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        
        $muestras = $this->entityManager->getRepository(TblMuestras::class)->findAll();
        $materiales = $this->entityManager->getRepository(TblMateriales::class)->findAll();
        $archivos = $this->entityManager->getRepository(TblListaarchivos::class)->findBy(['fkEstado' => 1]);
        $historial = $this->entityManager->getRepository(TblAuditoria::class)->findAll();


        
        return $this->render('muestras/muestras.html.twig', [
            'muestras' => $muestras,
            'materiales'=> $materiales,
            'archivos'=> $archivos,
            'historial'=> $historial,

        ]);
    }
    

    public function AgregarMuestra( SessionInterface $session, $id): Response
    {
        if (!$session->has('codigo_usuario')) {
            return $this->redirectToRoute('login');
        }
        
        $tipoMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->findAll();
        $ensayo = $this->entityManager->getRepository(TblEnsayos::class)->findAll();

        dump($tipoMuestra);

        return $this->render('muestras/AgregarMuestra.html.twig', [
            'idProyecto' => $id,
            'tipoMuestra' => $tipoMuestra,
            'ensayo' => $ensayo,
        ]);
    
    }

    
    public function addMuestra(Request $request, SessionInterface $session): Response
    {
        
        $atencion = $request->request->get('atencion');
        $cargo = $request->request->get('cargo');
        $contacto = $request->request->get('contacto');
        $observaciones = $request->request->get('observaciones');
        $idProyecto = $request->request->get('fk_proyecto');
    
        $materiales = new TblMateriales();
        $materiales->setAtencion($atencion);
        $materiales->setCargo($cargo);
        $materiales->setContacto($contacto);
        $materiales->setObservaciones($observaciones);
        $materiales->setFechaCreado(new \DateTime($request->request->get('fecha_creado')));

    
        $proyecto = $this->entityManager->getRepository(TblProyectos::class)->find($idProyecto);
        $tecnico = $this->entityManager->getRepository(TblUsuario::class)->find($session->get('codigo_usuario'));
    
        $materiales->setFkProyecto($proyecto);
        $materiales->setFkTecnico($tecnico);
    
        $this->entityManager->persist($materiales);
        $this->entityManager->flush();

        $materialesId = $materiales->getIdMaterial();
    
        /*  $contador = 1;
        while ($request->request->has('tipo_muestra_' . $contador)) {
            $idTipoMuestra = $request->request->get('tipo_muestra_' . $contador);
            $cantidad = $request->request->get('cantidad_muestra_' . $contador);
            $fechaElaboracion = new \DateTime($request->request->get('fecha_elaboracion_muestra_' . $contador));
            $procedencia = $request->request->get('procedencia_muestra_' . $contador);
            $idEnsayo = $request->request->get('ensayo_muestra_' . $contador);
    
            $tipoMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->find($idTipoMuestra);
            $ensayo = $this->entityManager->getRepository(TblEnsayos::class)->find($idEnsayo);
    
            $muestraDetalle = new TblMuestras();
            $muestraDetalle->setTipoMuestra($tipoMuestra);
            $muestraDetalle->setCantidad($cantidad);
            $muestraDetalle->setFechaElaboracion($fechaElaboracion);
            $muestraDetalle->setProcedencia($procedencia);
            $muestraDetalle->setEnsayo($ensayo);
            $muestraDetalle->setFkMateriales($materiales);
    
            $this->entityManager->persist($muestraDetalle);
    
            $contador++;
        }  
    
        $this->entityManager->flush(); */
    
        return $this->redirectToRoute('detalle', ['id' => $materialesId]);

    }
    
    
    
    public function detalle(Request $request, $id): Response
    {
        $material = $this->entityManager->getRepository(TblMateriales::class)->find($id);
        $muestras = $this->entityManager->getRepository(TblMuestras::class)->findBy(['fkMateriales' => $id]);
        $tipoMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->findAll();
        $ensayo = $this->entityManager->getRepository(TblEnsayos::class)->findAll();
    
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
        
            $material->setAtencion($data['entrega']);
            $material->setCargo($data['cargo']);
            $material->setContacto($data['contacto']);
            $material->setObservaciones($data['observaciones']);
        
            foreach ($muestras as $index => $muestra) {
                $idTipoMuestra = $data['tipo_muestra'][$index];
                $tipoMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->find($idTipoMuestra);
                $muestra->setTipoMuestra($tipoMuestra);
                
                $muestra->setCantidad($data['cantidad'][$index]);
                $muestra->setProcedencia($data['procedencia'][$index]);

                $fechaElaboracion = \DateTime::createFromFormat('Y-m-d', $data['fecha_elaboracion'][$index]);
                    $muestra->setFechaElaboracion($fechaElaboracion);
   
        
                $idEnsayo = $data['ensayo'][$index];
                $ensayo = $this->entityManager->getRepository(TblEnsayos::class)->find($idEnsayo);
                $muestra->setEnsayo($ensayo);
            }
        
            $this->entityManager->flush();
    
            return $this->redirectToRoute('muestras');
        }
    
        return $this->render('muestras/detalle.html.twig', [
            'material' => $material,
            'muestras' => $muestras,
            'opcionesTipoMuestra' => $tipoMuestra,
            'opcionesEnsayo' => $ensayo,
        ]);
    }

    public function guardarMuestra(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $usuario = new TblMuestras();
            
            $idTipoMuestra = $request->request->get('tipo_muestra');
            $tipoMuestra = $this->entityManager->getRepository(TblTipoMuestra::class)->find($idTipoMuestra);
            $usuario->setTipoMuestra($tipoMuestra);
        
            $usuario->setCantidad($request->request->get('cantidad'));


            $usuario->setProcedencia($request->request->get('procedencia'));
            
            $idEnsayo = $request->request->get('ensayo');
            $ensayo = $this->entityManager->getRepository(TblEnsayos::class)->find($idEnsayo);
            $usuario->setEnsayo($ensayo);
        
            $usuario->setFechaElaboracion(new \DateTime($request->request->get('fecha_elaboracion')));
        
            $idMaterial = $request->request->get('fk_material');
            $materia = $this->entityManager->getRepository(TblMateriales::class)->find($idMaterial);
            $usuario->setFkMateriales($materia);

            
        
            $this->entityManager->persist($usuario);
            $this->entityManager->flush();
        
            return $this->redirectToRoute('detalle', ['id' => $idMaterial]);
        }
         else {
            return $this->redirectToRoute('muestras');
        }
    }
    public function descargarArchivos($id, $opcion)
    {
        $material = $this->entityManager->getRepository(TblMateriales::class)->find($id);
        $lista = $this->entityManager->getRepository(TblListaarchivos::class)->find($opcion);
        $pivote = $this->entityManager->getRepository(TblPivote::class)->findOneBy([
            'fkLista' => $lista,
            'fkMaterial' => $material
        ]);
    
        if ($material === null) {
            throw $this->createNotFoundException('El material no se encontró.');
        }
        if ($lista === null) {
            throw $this->createNotFoundException('El id de lista no se encontró.');
        }
    
        if($pivote === null){
            $nombreArchivo = $lista->getRuta();
            return $this->descargarTodosArchivos($nombreArchivo);
        }else{
            $nombreArchivogh = $pivote->getNombreArchivo();
            return $this->descargarTodosArchivos($nombreArchivogh);
        }
    }
    
    public function subirArchivos(Request $request, SessionInterface $session): Response
{
    $codigoUsuario = $session->get('codigo_usuario');
    $usuario = $this->entityManager->getRepository(TblUsuario::class)->find($codigoUsuario);

    $archivoModificado = $request->files->get('archivo_modificado');
    $idMuestra = $request->request->get('id_muestra');
    $archivoId = $request->request->get('archivo_id');


    $lista = $this->entityManager->getRepository(TblListaarchivos::class)->find($archivoId);
    if (!$lista) {
        return new Response('El archivo con ID ' . $archivoId . ' no se encontró.', 400);
    }
    $material = $this->entityManager->getRepository(TblMateriales::class)->find($idMuestra);
    if (!$material) {
        return new Response('El material con ID ' . $idMuestra . ' no se encontró.', 400);
    }

    $pivote = $this->entityManager->getRepository(TblPivote::class)->findOneBy([
        'fkLista' => $archivoId,
        'fkMaterial' => $idMuestra
    ]);

    if (!$pivote) {
        $pivote = new TblPivote();
        $nombreAntiguo = "";
    } else {
        $nombreAntiguo = $pivote->getNombreArchivo();
    }

    $rutaCompleta = $lista->getRuta(); 
    $partesRuta = explode('-', $rutaCompleta);
    array_pop($partesRuta); // Elimina la última parte
    $nombreSinExtension = implode('-', $partesRuta);

    $pivote->setFkLista($lista);
    $pivote->setFkMaterial($material);


    $auditoria = new TblAuditoria();
    $auditoria->setTipo($lista->getNombre());
    $auditoria->setArchivoAntiguo($nombreAntiguo);
    $auditoria->setFkUsuario($usuario);
    $auditoria->setFkMaterial($material);
    $auditoria->setFkLista($lista);

    $fechaActual = new \DateTime();
    $auditoria->setFecha($fechaActual);

    if ($archivoModificado && $material) {
        $nombreArchivo = $nombreSinExtension . '_' . $idMuestra . '_' . uniqid() . '.' . $archivoModificado->guessExtension();
        $directorioDestino = $this->getParameter('directorioArch');

        try {
            $archivoModificado->move($directorioDestino, $nombreArchivo);

            $pivote->setNombreArchivo($nombreArchivo);

            $auditoria->setArchivoNuevo($nombreArchivo);
            $this->entityManager->persist($auditoria); 

            $this->entityManager->persist($pivote);
            $this->entityManager->flush();

            return new Response('El archivo se ha subido correctamente', 200);
        } catch (FileException $e) {
            return new Response('Ha ocurrido un error al subir el archivo: ' . $e->getMessage(), 500);
        }
    }

    return new Response('No se ha recibido ningún archivo o la muestra no se encontró', 400);
}

    

    public function descargarTodosArchivos($id): BinaryFileResponse
    {

        $rutaArchivo = $this->getParameter('kernel.project_dir') . '/public/assets/excel/' . $id;
    
        if (!file_exists($rutaArchivo)) {
            throw $this->createNotFoundException('El archivo no existe');
        }

        $response = new BinaryFileResponse($rutaArchivo);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $id
        );
        // Añadir cabeceras de control de caché
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');


        return $response;
    }
    
}