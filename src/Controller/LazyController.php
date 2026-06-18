<?php

namespace App\Controller;

use App\Repository\StarshipPartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LazyController extends AbstractController
{
    #[Route('/lazy', name: 'app_lazy')]
    public function index(StarshipPartRepository $repository): Response
    {

        $part = $repository->find(1);

        dump($part->getStarship()->getName(),$part);

        return $this->render('lazy/index.html.twig', [
            'controller_name' => 'LazyController',
        ]);
    }
}
