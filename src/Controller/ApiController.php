<?php

namespace App\Controller;

use App\Entity\Doudou;
use App\Entity\Personne;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/api/v1/doudous/random", name="api_doudous_random", methods={"GET"})
     */
    public function randomDoudous(Request $request)
    {

        $doudouRepo = $this->getDoctrine()->getRepository(Doudou::class);
        $num = $request->query->get('num');
        $doudous = $doudouRepo->randomDoudous($num);

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $doudous,
        ]);
    }

    /**
     * @Route("/api/v1/doudou/", name="api_doudou_new", methods={"GET", "POST"})
     */
    public function doudouCreate(Request $request)
    {
        //créer une instance de doudou vide
        $doudou = new Doudou();
        //interprétation des champs du formulaire
        $color = $request->request->get('color');
        $type = $request->request->get('type');
        $lieu = $request->request->get('lieu');
        $photo = $request->request->get('photo');
        //renseignement des champs utiles pour la création du doudou
        $doudou->setCouleur($color);
        $doudou->setType($type);
        $doudou->setLieuDecouverte($lieu);
        $doudou->setPhoto($photo);
        $doudou->setDateDecouverte(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($doudou);
        $em->flush();

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $doudou,
        ]);
    }

    /**
     * @Route("/api/v1/detenteurs", name="api_detenteurs_list", methods={"GET"})
     */
    public function detenteursList(Request $request)
    {
        $personneRepo = $this->getDoctrine()->getRepository(Personne::class);
        $q = $request->query->get('q');
        $detenteurs = $personneRepo->bla($q);

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $detenteurs,
        ]);
    }
}
