<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CafeType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cafe;
use Doctrine\ORM\EntityManagerInterface;

class BaseController extends AbstractController

{
 #[Route('/', name: 'app_accueil')]
 public function index(): Response
 {
 return $this->render('base/index.html.twig', [

 ]);
 }

 #[Route('/ajout-cafe', name: 'app_contact')]
 public function contact(Request $request, EntityManagerInterface $em): Response
 {
    $cafe = new Cafe();
    $form = $this->createForm(CafeType::class, $cafe);
    if($request->isMethod('POST')){
    $form->handleRequest($request);
    if ($form->isSubmitted()&&$form->isValid()){
        $em->persist($cafe);
        $em->flush();
        $this->addFlash('notice','Message envoyé');
        return $this->redirectToRoute('app_contact');

   
    }
    }

 return $this->render('base/cafe.html.twig', [
 'form' => $form->createView()
 ]);
 }


}