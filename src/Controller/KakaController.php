<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KakaController extends AbstractController
{
    #[Route('/phpcode', name: 'app_kaka')]
    public function req(Request $req): Response
    {
        return new response('<p>Blackpink in your area</p>');
    }
}
