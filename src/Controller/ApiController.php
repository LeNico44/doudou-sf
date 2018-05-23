<?php

namespace App\Controller;

use App\Entity\Doudou;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    /**
     * @Route("/api/v1/doudous", name="api_doudous_list", methods={"GET"})
     */
    public function doudousList(Request $request)
    {
        $doudouRepo = $this->getDoctrine()->getRepository(Doudou::class);
        $q = $request->query->get('q');
        $doudous = $doudouRepo->search($q);

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $doudous,
        ]);
    }
}
