<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController{

    #[Route("/pokemon")]
    public function showPokemon(){
        $pokemon = ["name"=>"Pikachu", "description"=>"Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.",
                    "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png", "code"=>"0025"];
        return $this->render("pokemons\showPokemon.html.twig", ["pokemon"=>$pokemon]);


    }
    #[Route("/pokemons")]
    public function showPokemons(){
        $pokemons = [   
            ["name"=>"Pikachu", "description"=>"Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.",
                    "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/025.png", "code"=>"0025"],

                    ["name"=>"Bulbasaur", "description"=>"Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.",
                    "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png", "code"=>"0001"],

                    ["name"=>"ivusaur", "description"=>"Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.",
                    "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/002.png", "code"=>"0002"],

                    ["name"=>"elvenosaur", "description"=>"Cuando se enfada, este Pokémon descarga la energía que almacena en el interior de las bolsas de las mejillas.",
                    "img"=>"https://assets.pokemon.com/assets/cms2/img/pokedex/full/003.png", "code"=>"0003"]
                
                ];
        return $this->render("pokemons\CharactersPokemons.html.twig", ["pokemons"=>$pokemons]);


    }

}