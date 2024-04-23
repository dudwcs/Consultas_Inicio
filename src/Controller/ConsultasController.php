<?php

namespace App\Controller;

use App\Repository\AutorRepository;
use App\Service\ConsultasService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConsultasController extends AbstractController
{

    public function __construct(private ConsultasService $consultasService) {
        
    }

    #[Route('/consultas/{fecha}', name: 'app_consultas')]
    public function index(DateTime $fecha ):Response
    {

        $autores =$this->consultasService->getAutoresByFechaNac($fecha);

        return $this->render('consultas/index.html.twig', [
            'controller_name' => 'ConsultasController',
            'autores' => $autores
        ]);
    }

    #[Route('/consultas/libros/maxu', name: 'app_consultas_maxunidades')]
    public function getMaxUnidades():Response
    {

        $maxUnidades = $this->consultasService->getMaxUnidades();

        return $this->render('consultas/index.html.twig', [
            'controller_name' => 'ConsultasController',
            'maxUnidades' => $maxUnidades
        ]);
    }


    
    #[Route('/consultas/autores/ventas/{unidades}', name: 'app_consultas_autores_por_ventas')]
    public function getAutoresByVentas($unidades):Response
    {

        $autoresSuperVentas = $this->consultasService->getAutoresByUnidades($unidades);

        return $this->render('consultas/index.html.twig', [
            'controller_name' => 'ConsultasController',
            'autoresSuperventas' => $autoresSuperVentas
        ]);
    }

    #[Route('/consultas/autores/ventas2/{unidades}', name: 'app_consultas_autores_por_ventas2')]
    public function getAutoresByVentas2($unidades):Response
    {

        $autoresSumaUnidades = $this->consultasService->getAutoresByUnidades2($unidades);

        return $this->render('consultas/index.html.twig', [
            'controller_name' => 'ConsultasController',
            'autoresSumaUnidades' => $autoresSumaUnidades
        ]);
    }
}
