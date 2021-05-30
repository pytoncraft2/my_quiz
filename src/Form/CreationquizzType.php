<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Categorie;
use App\Entity\Reponse;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CreationquizzType extends AbstractType
{
    public $nombre=0;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dump($options['data']->query->get('nombrequizz'));
        $this->nombre=$options['data']->query->get('nombrequizz');


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
            if($this->nombre==0){
                $form
                        ->add('10', CheckboxType::class, [
                            'label'    => 'cree 10 questions',
                            'mapped' => false,
                            'required' => false,

                        ])
                        ->add('20', CheckboxType::class, [
                            'label'    => 'cree 20 questions',
                            'mapped' => false,
                            'required' => false,
                        ]);
                $form
                ->add('cree', SubmitType::class);
            }

            if ($this->nombre>0) {
                $max=$this->nombre+1;
                $form
                ->add('categorie', TextType::class, [
                    'mapped' => false,

                ]);


                for($i=1;$i<$max;$i++){
                    $form
                        ->add('question'.$i, TextType::class, [
                            'mapped' => false,

                        ])
                        ->add('a'.$i, TextType::class, [
                            'mapped' => false,

                        ])
                        ->add('b'.$i, TextType::class, [
                            'mapped' => false,

                        ])
                        ->add('c'.$i, TextType::class, [
                            'mapped' => false,

                        ])
                        ->add('reponse_a'.$i, CheckboxType::class, [
                            'label'    => 'reponse juste a',
                            'mapped' => false,
                            'required' => false,

                        ])
                        ->add('reponse_b'.$i, CheckboxType::class, [
                            'label'    => 'reponse juste b',
                            'mapped' => false,
                            'required' => false,

                        ])
                        ->add('reponse_c'.$i, CheckboxType::class, [
                            'label'    => 'reponse juste c',
                            'mapped' => false,
                            'required' => false,

                        ])

                ;}
                $form
                ->add('cree2', SubmitType::class);

            }
        });


    }
    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'data_class' => null,//Categorie::class,
            "allow_extra_fields" => true,




        ]);

    }
}
