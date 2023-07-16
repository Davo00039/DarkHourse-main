<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SP;
use App\Entity\Category;
use App\Form\ProductsType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductsController extends AbstractController
{
    // #[Route('/products', name: 'app_products')]
    // public function index(): Response
    // {
    //     return $this->render('products/list.html.twig', [
    //         'controller_name' => 'ProductsController',
    //     ]);
    // }

    public function __construct(private UrlGeneratorInterface $urlGenerator)
        {
        }
    // #[Route('/products', name: 'app_products')]
    // public function index(EntityManagerInterface $em, Request $req, FileUploader $fileUploader): Response
    // {

    //     $pr = new SP();
    //     $form = $this->createForm(ProductsType::class, $pr);
    //     $form->handleRequest($req);

    //     if($form->isSubmitted() && $form->isValid()) {
    //         $data = $form->getData();

    //         $file = $form->get("photo")->getData(); 

    //         $fileName = $fileUploader->upload($file);
    //         $data->setPhoto($fileName);

    //         $em->persist($data);
    //         $em->flush();

    //         return new RedirectResponse($this->urlGenerator->generate('app_ds_san_pham')); #kết nối dữ liều giữ trang sanpham và trang sanphamds
    //         // return new Response("<p>Product Add Succefully!</p>");
    //     }

    //     return $this->render('san_pham/index.html.twig', [
    //         'sp_form' => $form->createView(),
    //     ]);
    // }

    #[Route('/products', name: 'app_products')]
    public function list_sp(EntityManagerInterface $em): Response
    {
        $query = $em->createQuery('SELECT sp FROM App\Entity\SP sp');
        $lSp = $query->getResult();
        return $this->render('products/list.html.twig', [
            "data"=>$lSp
        ]);
    }

}














