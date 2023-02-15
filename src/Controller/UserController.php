<?php
namespace App\Controller;

use App\Entity\Debilidad;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route("/new/user", name: "createUser")]
    public function newUsers(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $cifrado)
    {
        $form=$this->createForm(UserType::class);
        $form->handleRequest($request);//ve si se ha pasado o ricibido algun dato por el post
        if($form-> isSubmitted() && $form->isValid()){
            $user= $form->getData();

            $password = $user->getPassword();
            $passwordEncrypted = $cifrado->hashPassword($user,$password);
            $user->setPassword($passwordEncrypted);

            $user->setRoles(['ROLE_ADMIN']);
            
            $doctrine->persist($user);
            $doctrine->flush();
            $this->addFlash("exito", "user insertado correctamente") ;
            return $this->redirectToRoute("galeriaPokemon");
        }

        return $this->renderForm("pokemons\CreatePokemon.html.twig", ["pokemonForm"=>$form]);

    }

}