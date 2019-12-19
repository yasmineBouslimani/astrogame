<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\NasaService;

class NasaController extends AbstractController
{
    /**
     * @Route("/nasa", name="nasa")
     */
    public function index(NasaService $nasaService)
    {
        $pictures = $nasaService->getPicture();
        return $this->render('picture/index.html.twig', ['pictures' => $pictures]);
    }
}
