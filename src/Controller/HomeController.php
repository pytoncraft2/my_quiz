<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Categorie;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(SessionInterface $session): Response
    {
        $request = Request::createFromGlobals();
        // echo $request->cookies->get('PHPSESSID');

        $listeCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $session->clear();
        // dump($listeCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll());

        // dump($listeCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findBy(
    // array('total_question'=> 10),
    // array('id'=>'DESC')
  // ));

      // $showCategorie = new Categorie();

        return $this->render('home/index.html.twig', [
            'categories' => $listeCategorie,
        ]);
    }

    public function show()
    {
    }
}
