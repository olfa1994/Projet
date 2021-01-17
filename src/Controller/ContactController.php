<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(ContactRepository $repository): Response
    {
        $contact=$repository->findAll();
        return $this->render('contact/contact.html.twig', [
            'contact'=>$contact,
            'controller_name' => 'Contact',
        ]);
    }
}
