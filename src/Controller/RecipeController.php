<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;

class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */

    public function recipe()
    {
        $rec = $this->getDoctrine()->getRepository(Recipe::class);
        $index = $rec->findAll();
        return $this->render('pages/index.html.twig',[
            'recipes' => $index
            ]);
    }


    /**
     * @Route("/recipe/{id}", name="recipeShow")
     */

    public function click($id)
    {
        $rec = $this->getDoctrine()->getRepository(Recipe::class);
        $recipe = $rec->findOneBy(['id' => $id]);
        
        return $this->render('pages/recipe.html.twig', [
           'recipe' => $recipe
    ]);
    } 

 /**
  * @Route("/pages"), name="pages")
  */

  public function index(){
      return $this->render('pages/index.html.twig',['controller_name' => 'PagesController']);
  }
  }