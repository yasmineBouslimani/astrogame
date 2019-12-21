<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\NasaService;
use Symfony\WebpackEncoreBundle;

class NasaController extends AbstractController
{
    /**
     * @Route("/nasa", name="nasa")
     */
    public function index(NasaService $nasaService)
    {
        $pictures = [];
        $difficulty = 5;

        for ($i=0; $i<$difficulty; $i++) {
           $picture = $nasaService->getPicture();
           if (!in_array($picture,$pictures))
           {
               $pictures[] = $picture;
               $pictures[] = $picture;
           } else {
               $i-- ;
           }
        }
         shuffle($pictures);
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictures,
        ]);
    }

}
