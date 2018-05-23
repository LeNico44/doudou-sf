<?php

namespace App\Controller;

use App\Entity\Doudou;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DoudouController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $doudouRepo = $this->getDoctrine()->getRepository(Doudou::class);

        $q = $request->query->get('q');
        $doudous = $doudouRepo->search($q);

        return $this->render('doudou/home.html.twig', [
            "doudous" => $doudous
        ]);
    }
}
