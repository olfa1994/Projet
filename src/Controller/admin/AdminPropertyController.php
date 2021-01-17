<?php

namespace App\Controller\admin;

use App\Form\PropertyType;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Service\ImageUploaderService;
use  Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em){
        $this->repository =$repository;
        $this->em=$em;
    }

    /**
     * @Route("/admin/create", name="admin.property.create")
     */
    public function new(ImageUploaderService $imageUploaderService,
                        $uploadPersonneDirectory, Request $request){
        $property= new Property();
        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid())
        {
            $imageInfos = $form->get('path')->getData();

            if ($imageInfos) {
                $newImageName = $imageUploaderService->uploadFile($imageInfos, $uploadPersonneDirectory);
                $property->setPath('uploads/property/'.$newImageName);
            }
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Propriété a été ajouté avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin_property/new.html.twig',[
            'property'=>$property,
            'form'=>$form->createView(),
        ]);

    }
    /**
     * @Route("/admin", name="admin.property.index")
     */
    public function index(): Response
    {
        $properties=$this->repository->findAll();
        return $this->render('admin_property/index.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'properties'=>$properties,
        ]);
    }
    /**
     * @Route("/admin/edit/{id}", name="admin.property.edit", methods="GET|POST")
     */
    public function edit(ImageUploaderService $imageUploaderService,
                         $uploadPersonneDirectory,Property $property, Request $request): Response {

        $form=$this->createForm(PropertyType::class,$property);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $imageInfos = $form->get('path')->getData();

            if ($imageInfos) {
                $newImageName = $imageUploaderService->uploadFile($imageInfos, $uploadPersonneDirectory);
                $property->setPath('uploads/property/'.$newImageName);
            }
            $this->em->flush();
            $this->addFlash('success', 'Propriété a été modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin_property/edit.html.twig',[
            'property'=>$property,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/admin/edit/{id}", name="admin.property.delete" , methods="DELETE")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function delete(Property $property, Request $request): Response{
        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash('success', 'Propriété a été supprimé avec succès');
        return $this->redirectToRoute('admin.property.index');
    }
}   
