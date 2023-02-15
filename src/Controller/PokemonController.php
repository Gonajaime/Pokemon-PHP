<?php
namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route("/pokemon/{id}", name:"infoPokemon")]
    #[IsGranted('ROLE_ADMIN')]
    public function showPokemon(EntityManagerInterface $doctrine, $id)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);

        return $this->render("pokemons\showPokemon.html.twig", ["pokemon"=>$pokemon]);

    }

    #[Route("/new/pokemon", name: "createPokemon")]
    public function newPokemons(EntityManagerInterface $doctrine, Request $request)
    {
        $form=$this->createForm(PokemonType::class);
        $form->handleRequest($request);//ve si se ha pasado o ricibido algun dato por el post
        if($form-> isSubmitted() && $form->isValid()){
            $pokemon= $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this->addFlash("exito", "pokemon insertado correctamente") ;
            return $this->redirectToRoute("galeriaPokemon");
        }

        return $this->renderForm("pokemons\CreatePokemon.html.twig", ["pokemonForm"=>$form]);

    }

    #[Route("/edit/pokemon/{id}", name: "editPokemon")]
    public function editPokemons(EntityManagerInterface $doctrine, Request $request, $id)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);

        $form=$this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);//ve si se ha pasado o ricibido algun dato por el post
        if($form-> isSubmitted() && $form->isValid()){
            $pokemon= $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this->addFlash("exito", "pokemon insertado correctamente");
            return $this->redirectToRoute("galeriaPokemon");
        }

        return $this->renderForm("pokemons\CreatePokemon.html.twig", ["pokemonForm"=>$form]);

    }

    #[Route("/delete/pokemon/{id}", name:"deletePokemon")]
    public function deletePokemon(EntityManagerInterface $doctrine, $id)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);
        $doctrine->remove($pokemon);
        $doctrine->flush();

        return $this->redirectToRoute('galeriaPokemon');

    }


    #[Route("/pokemons", name: "galeriaPokemon")]
    public function showPokemons(EntityManagerInterface $doctrine)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemons = $repository->findAll();

        return $this->render("pokemons\CharactersPokemons.html.twig", ["pokemons"=>$pokemons]);
    }

    #[Route("/insert/pokemon")]
    public function insertPokemons(EntityManagerInterface $doctrine)
    {
        $pokemon1 = new Pokemon ();
        $pokemon1->setName("Pikachu");
        $pokemon1->setDescription("Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.");
        $pokemon1->setImg("https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png");
    
        $pokemon2 = new Pokemon ();
        $pokemon2->setName("Bulbasaur");
        $pokemon2->setDescription("Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.");
        $pokemon2->setImg("https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png");

        $pokemon3 = new Pokemon ();
        $pokemon3->setName("Pikachu");
        $pokemon3->setDescription("Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.");
        $pokemon3->setImg("https://assets.pokemon.com/assets/cms2/img/pokedex/full/032.png");

        $debilidad1 = new Debilidad ();
        $debilidad1->setName("fuego");


        $debilidad2 = new Debilidad ();
        $debilidad2->setName("agua");

        $debilidad3 = new Debilidad ();
        $debilidad3->setName("veneno");

        $debilidad4 = new Debilidad ();
        $debilidad4->setName("electrico");

        $pokemon1->addDebilidade($debilidad2);
        $pokemon1->addDebilidade($debilidad3);
        $pokemon1->addDebilidade($debilidad4);

        $pokemon2->addDebilidade($debilidad1);
        $pokemon2->addDebilidade($debilidad3);

        $doctrine->persist($debilidad1);
        $doctrine->persist($debilidad2);
        $doctrine->persist($debilidad3);
        $doctrine->persist($debilidad4);

        $doctrine->persist($pokemon1);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);

        $doctrine->flush();

        return new Response("Pokemons inserted correctly");
    }

}