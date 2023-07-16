<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
        {
        }
    #[Route('/user', name: 'app_user')]
    public function index(EntityManagerInterface $em, Request $req): Response
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em->persist($data);
            $em->flush();

            return new RedirectResponse($this->urlGenerator->generate('app_ds_user')); 
        }

        return $this->render('user/index.html.twig', [
            'User_form' => $form->createView(),
        ]);
    }

    #[Route('/user/ds', name: 'app_ds_user')]
    public function list_user(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('SELECT user FROM App\Entity\User user');
        $lSp = $query->getResult();
        return $this->render('user/list.html.twig', [
            "data"=>$lSp
        ]);
    }
    
    #[Route('/user/{id}', name: 'app_edit_user')]
    public function edit(EntityManagerInterface $em, int $id, Request $req): Response
    {
        $user = $em->find(User::class, $id); 
        // tìm kiếm khóa chính id
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            
            $user->setUsername($data->getUsername())->setFirstName($data->getFirstName())->setLastName($data->getLastName());
            $em->flush();
            
            return new RedirectResponse($this->urlGenerator->generate('app_ds_user'));
        
    }
    return $this->render('user/index.html.twig', [
        'User_form' => $form->createView(),
        ]);
    }

    #[Route('/user/{id}/delete', name: 'app_delete_user')]
    public function delete(EntityManagerInterface $em, int $id, Request $req): Response
        {
            $user = $em->find(User::class, $id); 
            $em->remove($user);
            $em->flush();
            return new RedirectResponse($this->urlGenerator->generate('app_ds_user'));     
        }
}