<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StudentRepository;
#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/stu', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/Affiche')]
    function Affiche(StudentRepository $repo){
        $student=$repo->findAll();
        return $this->render('student/Affiche.html.twig',
            ["ss"=>$student]);

    }
}
