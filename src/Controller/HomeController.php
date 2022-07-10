<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Form\AjoutMembreType;
use App\Repository\MembresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/', name: 'app_home')]
    public function index(Request $request, MembresRepository $membresRepository): Response
    {
        $membre = new Membres();
        $form = $this->createForm(AjoutMembreType::class, $membre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $membre=$form->getData();
            $this->entityManager->persist($membre);
            $this->entityManager->flush();

            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'form'=>$form->createView(),
                'membres'=>$membresRepository->findAll()
            ]);
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form'=>$form->createView(),
            'membres'=>$membresRepository->findAll()
        ]);
    }

}
