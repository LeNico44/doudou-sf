<?php

namespace App\Controller;

use App\Entity\Doudou;
use App\Form\DoudouType;
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
    /**
     * @Route("/doudou/create", name="doudou_create")
     */
    public function createDoudou(Request $request)
    {
        //créer une instance de review vide
        $doudou = new Doudou();
        //crée le formulaire et lui associe notre instance vide
        $form = $this->createForm(DoudouType::class, $doudou);
        //prend les donnéees du formulaire et les injeste dans le review vide
        $form->handleRequest($request);

        //renseigne la date actuelle dans notre review
        $doudou->setDateDecouverte(new \DateTime());

        //associer le bon film à cette review
        //$movieRepo = $this->getDoctrine()->getRepository(Movie::class);
        //$movie = $movieRepo->find($id);
        //$review->setMovie($movie);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($doudou);
            $em->flush();

            //ce mesage s'affiche sur la page suivante
            $this->addFlash("success", "Votre douddou à été déclaré !" . $doudou->getCouleur(). " !");

            $doudouRepo = $this->getDoctrine()->getRepository(Doudou::class);

            $q = $request->query->get('q');
            $doudous = $doudouRepo->search($q);

            return $this->redirectToRoute('home', array(
                "doudous" => $doudous
            ));
        }

        return $this->render("doudou/create.html.twig", [
            "form" => $form->createView()
        ]);

    }
}
