<?php

namespace App\Controller;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Devis;

class ProjetfinalController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, ObjectManager $manager)
    {
    $devis = new Devis();

        $form = $this->createFormBuilder($devis)
            ->add('nom')
            ->add('prenom')
            ->add('ville')
            ->add('telephone')
            ->add('email')
            ->add('save', SubmitType::class, [
                'label' => 'enregistrer'
            ])
            ->getForm();
        $form->handleRequest($request);


        if($form->isSubmitted() &&$form->isValid()){
            $devis->setCreatedAt(new \DateTime());

            $manager->persist($devis);
            $manager->flush();

            return $this->redirectToRoute('service', ['id' => $devis->getId()]);



        }


        return $this->render('projetfinal/index.html.twig', [
            'formDevis' => $form->createview()

        ]);
    }










    /**
     * @Route("service", name="service")
     */
    public function servi()
    {
        return $this->render('projetfinal/services.html.twig', [
            'controller_name' => 'ProjetfinalController',
        ]);
    }

    /**
     * @Route("temoin", name="temoin")
     */

    public function temoin()
    {
        return $this->render('projetfinal/temoignages.html.twig', [
            'controller_name' => 'ProjetfinalController',
        ]);
    }


    /**
     * @Route("comments", name="comments")
     */
    public function commentaire()
    {
        return $this->render('projetfinal/commentaires.html.twig', [
            'controller_name' => 'BesoinsquotidiensController',
        ]);
    }


}
