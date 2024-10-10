<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    #[Route('/author', name: 'app_author', methods: ["GET"])]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'app_show_author_by_name')]
    public function showAuthor($name): Response
    {
        return $this->render('author/showAuthor.html.twig', ['n' => $name]);
    }

    #[Route('/listAuthors', name: 'app_list_authors', methods: ["GET"])]
    public function listAuthors(): Response
    {
        // Fetching authors from repository
        $authors = $this->authorRepository->findAll();
        return $this->render('author/listAuthors.html.twig', ['authors' => $authors]);
    }

    #[Route('/showAuthors', name: 'app_show_authors', methods: ["GET"])]
    public function findauthorsbyId(): Response
    {
        // Fetching authors from repository
        $authors = $this->authorRepository->find($id);
        return $this->render('author/showAuthors.html.twig', ['authors' => $authors]);}

    #[Route('/author/{id}', name: 'app_show_author_by_id')]
    public function authorDetails($id): Response
    {
        // Fetch the author by ID from the repository
        $author = $this->authorRepository->find($id);
        
        if (!$author) {
            throw $this->createNotFoundException('Author not found');
        }

        return $this->render('author/showAuthor.html.twig', ['author' => $author]);
    }

    #[Route('/author/{id}/books', name: 'app_author_books', methods: ['GET'])]
public function showBooksByAuthor($id, LivreRepository $livreRepository): Response
{
    $author = $this->authorRepository->find($id);
    
    if (!$author) {
        throw $this->createNotFoundException('Author not found');
    }

    $books = $livreRepository->findByAuthor($author);

    return $this->render('author/showBooks.html.twig', [
        'author' => $author,
        'books' => $books,
    ]);
}

    
}
