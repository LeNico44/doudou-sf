<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DoudouController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        return $this->render('doudou/home.html.twig', [
            'controller_name' => 'DoudouController',
        ]);
    }
}
