<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuizRepository;
use App\Repository\ReponseRepository;
use App\Repository\CategorieRepository;
use App\Repository\HistoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Cookie;
use \Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Reponse;
use App\Entity\History;
use App\Entity\Categorie;

class CategorieController extends AbstractController
{

    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="categorie_show")
     */

    public function show(QuizRepository $repo, HistoryRepository $r, int $id, SessionInterface $session)
    {
        $request = Request::createFromGlobals();

        $categorie = substr($request->getPathInfo(), 11);
        if (!$request->cookies->has('question')) {
            $request->cookies->set('question', 0);
        }

        $next = $request->query->get('question');
        $request->cookies->set('question', substr($next, strpos($next, "-") + 1) + 1);

        $nextResponse = $request->cookies->get('question');

        $questions = $repo->findAllAskedOrderedByNewest(substr($next, strpos($next, "-") + 1), $categorie);
        $reponses = $repo->findAllAskedOrderedByNewest2(substr($next, strpos($next, "-") + 1), $categorie);
        $repository = $this->getDoctrine()->getRepository(Reponse::class);
        $isGood = $repository->find(preg_replace('/-(\d+)/', '', $next));

        $counter = $session->has('countScore') ? (int)$session->get('countScore') : 0;

        if ($isGood !== null) {
            if ($isGood->getReponseExpected() == true) {
            $counter++;
            }
        }

        $session->set('countScore',$counter);
        $total = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(array('id' => $categorie))->getTotalQuestion();

        if ($nextResponse < $total + 1) {
            return $this->render('categorie/liste.html.twig', [
            'q' => $questions,
            'question' => $nextResponse,
            'totalQuestion' => $total,
            'categorie' => $categorie,
            'score' => $counter,
            'categorie' => $categorie,
            'reponses' => $reponses
          ]);
        } else {
            $addHistory = new History();
            $addHistory->setScore($counter)
                       ->setDate(\DateTime::createFromFormat('Y-m-d', "2020-09-09"))
                       ->setToken($_SERVER['HTTP_X_FORWARDED_FOR'])
                       ->setCategorieId($categorie)
                       ->setHistoryId(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($addHistory);
            $em->flush();

            $session->clear();
            return $this->redirectToRoute('result');
        }
    }

    /**
     * @Route("/result", name="result")
     */

    public function result(HistoryRepository $r)
    {
        $result = $r->findBy(
            array('token'=> $_SERVER['HTTP_X_FORWARDED_FOR']),
            array('id'=>'DESC'),
        );

        // $total = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['categ_id']);
        // dump($total);

        return $this->render('result/index.html.twig', [
            'score' => $result,
          ]);
    }
}
