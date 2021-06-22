<?php

namespace App\Controller;

use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/register")
     */
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegisterType::class);
        $form->add('register', Type\SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->get('cgv')->getData()) {
            dump($form->getData());
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}