<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Quiz;
use App\Entity\Reponse;
use App\Form\CreationquizzType;
use App\Repository\Createquizz2Repository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Createquizz2Controller extends AbstractController
{
    public $nombre=[];

    /**
     * @Route("/createquizz2", name="createquizz2")
     */
    public function index(Request $request): Response
    {
        $categorie = new Categorie();



        $form = $this->createForm(CreationquizzType::class, $request2 = Request::createFromGlobals());
        $form->handleRequest($request);
        //dump($request->query->get('nombrequizz'));

        $request2 = Request::createFromGlobals();
        if ($request2->query->get('nombrequizz')=="10") {
            $this->nombre=['un'=>1,'deux'=>2,'trois'=>3,'quatre'=>4,'cinq'=>5,'six'=>6,'sept'=>7,'huit'=>8,'neuf'=>9,'dix'=>10];
        } else {
            $this->nombre=['un'=>1,'deux'=>2,'trois'=>3,'quatre'=>4,'cinq'=>5,'six'=>6,'sept'=>7,'huit'=>8,'neuf'=>9,'dix'=>10,
                'onze'=>11,'douze'=>12,'treize'=>13,'quartoze'=>14,'quinze'=>15,'seize'=>16,'dix-sept'=>17,'dix-huit'=>18,'dix-neuf'=>19,'vingt'=>20];
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $categorie->setName($form["categorie"]->getData());
            $categorie->setTotalQuestion($request2->query->get('nombrequizz'));
            $entityManager->persist($categorie);
            $entityManager->flush();

            $repository = $this->getDoctrine()->getRepository(Categorie::class);
            $id_categorie = $repository->findOneBy(array('name' => $form["categorie"]->getData()))->getId();

            $abcd=[];


            foreach ($this->nombre as $key => $value) {
                $key = new Quiz();
                $key->setquestion($form["question".$value]->getData());
                $key->setidcategorie($id_categorie);
                $entityManager->persist($key);
                $entityManager->flush();
                $abcd[]=['a'.$value,'b'.$value,'c'.$value];
            }

            $nbr_question = $request2->query->get('nombrequizz');
            $repository = $this->getDoctrine()->getRepository(Quiz::class);
            // $id_question = $repository->findOneBy(array('id' => ->getData()))->getId();
            // $id_question = $repository->findOneBy(array('name' => $form["categorie"]->getData()))->getId();
            $id_question = $repository->findOneBy([], ['id' => 'desc'])->getId() - $nbr_question;
            // $id_question += $nbr_question;
            dump($id_question);


            // $lastQuestion = $em->getRepository('AppBundle:Question')->findOneBy([], ['id' => 'desc']);
            // $lastId = $lastQuestion->getId();
            $y = 1;
            $reset = 0;
            foreach ($abcd as $key => $value) {
                foreach ($value as $clef => $valeur) {
                    $lettrechiffre=$valeur;
                    $valeur= new Reponse();
                    $valeur->setReponse($form[$lettrechiffre]->getData());
                    $valeur->setreponseExpected($form["reponse_".$lettrechiffre]->getData());
                    if ($reset == 3) {
                        $y++;
                        $reset = 0;
                    }
                    $valeur->setidquestion($id_question + $y);
                    $entityManager->persist($valeur);
                    $entityManager->flush();
                    $reset++;
                }
            }


            return $this->redirectToRoute('home');
        }




        return $this->render('createquizz2/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
