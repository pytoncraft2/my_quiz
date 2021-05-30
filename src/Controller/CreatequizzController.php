<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Form\Type\CreatequizzFormType;
use App\Repository\CreatequizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CreatequizzController extends AbstractController
{
    public $nombre=[];
    static public $unefois=0;
    /**
     * @Route("/createquizz", name="createquizz")
     */
    public function index(Request $request ): Response
    {
        $categorie = new Categorie();
        $reponse = new Reponse();

        $form = $this->createForm(CreatequizzFormType::class, $categorie);
        $form->handleRequest($request);

        if(self::$unefois==0){

        if ($form->isSubmitted() && $form->isValid() && (!empty($form['10']) || !empty($form['20']) )  ) {

            if(false==($form['20']->getData())){
                $this->nombre=['un'=>1,'deux'=>2,'trois'=>3,'quatre'=>4,'cinq'=>5,'six'=>6,'sept'=>7,'huit'=>8,'neuf'=>9,'dix'=>10];
                $nbquizz=10;
            }else{
                $this->nombre=['un'=>1,'deux'=>2,'trois'=>3,'quatre'=>4,'cinq'=>5,'six'=>6,'sept'=>7,'huit'=>8,'neuf'=>9,'dix'=>10,
                'onze'=>11,'douze'=>12,'treize'=>13,'quartoze'=>14,'quinze'=>15,'seize'=>16,'dix-sept'=>17,'dix-huit'=>18,'dix-neuf'=>19,'vingt'=>20];
                $nbquizz=20;
            }
            return $this->redirectToRoute('createquizz2',array('nombrequizz' => $nbquizz));
        }}

        return $this->render('createquizz/index.html.twig', [
            'form' => $form->createView(),
        ]);



    }

}
