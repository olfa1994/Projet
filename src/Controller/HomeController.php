<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PropertyRepository $repository): Response
    {
        $ventes=$repository->findLatestventes(6);
        $locations=$repository->findlatestlocation(6);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ventes'=> $ventes,
            'locations' =>$locations
        ]);
    }
}
