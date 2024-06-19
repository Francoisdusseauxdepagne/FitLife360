<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/error404', name: 'error404')]
    public function show404(): Response
    {
        return $this->render('404/error404.html.twig', [
        ]);
    }
}