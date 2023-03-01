<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClassroomRepository;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/Affiche',name:'Aff')]
    function Affiche(ClassroomRepository $repo){
        $classroom=$repo->findAll();
        return $this->render(
            'classroom/Affiche.html.twig',
            ['cc'=>$classroom]
        );
    }
    #[Route('/detail/{id}',name:"DD")]
    //  function Detail(ClassroomRepository $repo,$id){
    //      $classroom=$repo->find($id);
    //     return $this->render('classroom/Detail.html.twig',
    // ['c'=>$classroom]);

    //  }
     function Detail(Classroom $classroom){
         return $this->render('classroom/Detail.html.twig',
          ['c'=>$classroom]);
     }
     #[Route('/Ajout')]
     function Ajout(ClassroomRepository $repo, Request $request){
        $classroom= new Classroom();
        $form=$this->createForm(ClassroomType::class,$classroom)
        ->add('Ajout',SubmitType::class);
        #request
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $repo->save($classroom,True);
            return $this->redirectToRoute('Aff');

        }
        return $this->render('classroom/Ajout.html.twig',
    ['f'=>$form->createView()]);
     }
     #[Route('Update/{id}',name:"U")]
     function Update(ManagerRegistry $doctrine,Classroom $classroom,Request $request){
        // $classroom= new Classroom();
        $form=$this->createForm(ClassroomType::class,$classroom)
        ->add('Update',SubmitType::class);
        #request
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $em=$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('Aff');

        }
        return $this->render('classroom/Ajout.html.twig',
    ['f'=>$form->createView()]);
        

     }
     #[Route('/Delete/{id}',name:'Del')]
     function Delete(Classroom $classroom,ClassroomRepository $repo){
        $repo->remove($classroom,True);
        return $this->redirectToRoute('Aff');

     }
}
