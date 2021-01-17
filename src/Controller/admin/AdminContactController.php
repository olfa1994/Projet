<?php

namespace App\Controller\admin;


use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;

use  Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{
    /**
     * @var ContactRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ContactRepository $repository, EntityManagerInterface $em){
        $this->repository =$repository;
        $this->em=$em;
    }
    /**
     * @Route("/admin/edit/contact/{id}", name="admin.contact.edit", methods="GET|POST")
     */
    public function edit(Contact $contact, Request $request): Response {

        $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){

            $this->em->flush();
            $this->addFlash('success', 'Contact a été modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('contact/edit.html.twig',[
            'contact'=>$contact,
            'form'=>$form->createView(),
        ]);
    }


}