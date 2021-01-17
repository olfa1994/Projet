<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;


use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @var PropertyRepository
     */
    private $repository;
    public function __construct(PropertyRepository $repo){
        $this->repository=$repo;
    }
    
    /**
     * @Route("/ventes", name="property.index")
     * @return Response
     */
    public function index( PropertyRepository $repository): Response
    {   $property=$repository->findBy(array('location'=>0));
        return $this->render('property/index.html.twig', [
            'controller_name' => 'LocationController',
            'current_menu' => 'properties',
            'properties'=>$property,
        ]);
    }
    /**
     * @Route("/biens/{id}", name="property.show")
     * @return Response
     */
    public function show($id) : Response
    {
        $propy=$this->repository->find($id);
        if ($propy->getLocation()>0) {
            $latest=$this->repository->findLatestlocation(3);

        }
        else{
            $latest=$this->repository->findLatestventes(3);
        }

        if($propy){
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property'=> $propy,
            'latest'=>$latest,


        ]);
    }else{
            $this->addFlash('error', 'Propriété inexistante');
            return $this->redirectToRoute('property.index');
    }
    }
    /**
     * @Route("/hello")
     */
    public function hello()
    {
        return $this->render('home/hello.html.twig', [


        ]);

    }
}
