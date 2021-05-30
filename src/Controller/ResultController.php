<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('result/index.html.twig', [
            'score' => 'ResultController',
        ]);
    }
}
