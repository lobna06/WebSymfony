<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    private $authors;
    public function __construct()
{$this -> authors = [ [ 'id' => 1 , 'picture' => '/images/vh.png' , 'username' => 'Victor Hugo' , 'email' => 'victor.hugo@gmail.com' , 'nb_books' => 100 ], 
    [ 'id' => 2 , 'picture' => '/images/ws.png' , 'username' => 'William Shakespeare' , 'email' => 'william.shakespeare@gmail.com' , 'nb_books' => 200 ],
     [ 'id' => 3 , 'picture' => '/images/th.png' , 'username' => 'Taha Hussein' , 'email' => 'taha.hussein@gmail.com' , 'nb_books' => 300 ], ];}

    #[Route('/author', name: 'app_author',methods:["GET"])]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }


    #[Route('/showAuthor/{name}', name: 'app_showAuthor')]
    public function  showAuthor ($name)
    {return $this->render('service/showAuthor.html.twig',['n'=>$name]);
    }


    #[Route ('/listAuthors', name: 'app_listAuthors',methods:["GET"])]
    public function  listAuthors ():Response
    {
        return $this->render('author/listAuthors.html.twig',['authors'=>$this->authors]);
    }



    #[Route('/author/{id}', name: 'app_showAuthor')]
public function authorDetails($id): Response
{
    $author = array_filter($this->authors, fn($a) => $a['id'] === (int)$id);//neb9a nlawej aal author b id teeou b filtre
 $author = reset($author);// hethi pour acceder au 1er author

    return $this->render('author/showAuthor.html.twig', ['author' => $author,   ]);
}
}