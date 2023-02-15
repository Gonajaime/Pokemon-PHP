<?php
namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{

    #[Route("/pokemon/{id}")]
    public function showPokemon(EntityManagerInterface $doctrine, $id)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);

        return $this->render("pokemons\showPokemon.html.twig", ["pokemon"=>$pokemon]);


    }

    #[Route("/pokemons")]
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

        $doctrine->persist($pokemon1);
        $doctrine->persist($pokemon2);
        $doctrine->persist($pokemon3);

        $doctrine->flush();

        return new Response("Pokemons inserted correctly");
    }

}