<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
        {
        }
    #[Route('/contact', name: 'app_contact')]
    public function index(EntityManagerInterface $em, Request $req): Response
    {

        $fb = new Feedback();
        $form = $this->createForm(FeedbackType::class, $fb);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em->persist($data);
            $em->flush();

            return new RedirectResponse($this->urlGenerator->generate('app_contact')); #kết nối dữ liều giữ trang sanpham và trang sanphamds
            // return new Response("<p>Product Add Succefully!</p>");
        }

        return $this->render('contact/index.html.twig', [
            'feedback_form' => $form->createView(),
        ]);
    }

}
