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

}