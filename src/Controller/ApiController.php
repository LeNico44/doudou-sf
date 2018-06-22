<?php

namespace App\Controller;

use App\Entity\Doudou;
use App\Entity\Personne;

use App\Entity\Type;
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
        $c = $request->query->get('c');
        $l = $request->query->get('l');
        $t = $request->query->get('t');
        $doudous = $doudouRepo->search($q, $c, $l, $t);

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $doudous,
        ]);
    }

    /**
     * @Route("/api/v1/doudous/recherche", name="api_doudous_recherche", methods={"GET"})
     */
    public function doudousRecherche(Request $request)
    {
        $doudouRepo = $this->getDoctrine()->getRepository(Doudou::class);
        $id = $request->query->get('id');
        $image = $request->query->get('photo');

        $doudous = $doudouRepo->findBy([
            'id' => $id,
            'photo' => $image,
        ]);

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
     * @Route("/api/v1/detenteurs", name="api_detenteurs_list", methods={"GET"})
     */
    public function detenteursList(Request $request)
    {
        $personneRepo = $this->getDoctrine()->getRepository(Personne::class);
        $q = $request->query->get('q');
        $detenteurs = $personneRepo->search($q);

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $detenteurs,
        ]);
    }

    /**

     * @Route("/api/v1/types", name="api_types_list", methods={"GET"})
     */
    public function typesList()
    {
        $typeRepo = $this->getDoctrine()->getRepository(Type::class);
        $types = $typeRepo->findAll();

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $types,
        ]);
    }

    /**
     * @Route("/api/v1/detenteur/", name="api_detenteur_new", methods={"GET", "POST"})
     */
    public function detenteurCreate(Request $request)
    {
        //créer une instance de doudou vide
        $detenteur = new Personne();
        //interprétation des champs du formulaire
        $email = $request->request->get('email');
        $prenom = $request->request->get('firstName');
        $nom = $request->request->get('lastName');
        //renseignement des champs utiles pour la création du doudou
        $detenteur->setEmail($email);
        $detenteur->setFirstname($prenom);
        $detenteur->setLastname($nom);
        $detenteur->setDateenregistrement(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($detenteur);
        $em->flush();

        return $this->json([
            "status" => "ok",
            "message" => "",
            "data" => $detenteur,
        ]);
    }


    /**
     * @Route("/api/v1/doudou/", name="api_doudou_new", methods={"POST"})
     */
    public function doudouCreate(Request $request)
    {

        var_dump($_FILES);
        $photo = basename($_FILES['photo']['name']);
        $dossier = $webPath = $this->get('kernel')->getProjectDir() . '/public/img/photos/';
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $photo)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo 'Upload effectué avec succès !';
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
        }

        $personneRepo = $this->getDoctrine()->getRepository(Personne::class);
        $typeRepo = $this->getDoctrine()->getRepository(Type::class);

        //créer une instance de doudou vide
        $doudou = new Doudou();
        //interprétation des champs du formulaire
        $color = $request->request->get('color');

        $chkBox = $request->request->get('chkGeo');
        $latitude = $request->request->get('latitude');
        $longitude = $request->request->get('longitude');
        $lieu = $request->request->get('lieu');
        $id_detenteur = $request->request->get('detenteur');
        $detenteur = $personneRepo->find($id_detenteur);
        $id_type = $request->request->get('type');
        $type = $typeRepo->find($id_type);



        //renseignement des champs utiles pour la création du doudou
        $doudou->setCouleur($color);
        $doudou->setType($type);
        $doudou->setLieuDecouverte($lieu);
        $doudou->setPhoto($photo);
        $doudou->setPersonne($detenteur);
        $doudou->setLat($latitude);
        $doudou->setLng($longitude);
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


}
