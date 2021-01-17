<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location.index")
     */
    public function index( PropertyRepository $repository): Response
    {   $property=$repository->findBy(array('location'=>1));
        return $this->render('location/index.html.twig', [
            'controller_name' => 'LocationController',
            'current_menu' => 'location',
            'properties'=>$property,
        ]);
    }
}
