<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Service\MovieService;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class MovieController extends AbstractFOSRestController
{
    /**
     * Lists all Movies.
     * @Rest\Get("/movies")
     * @param MovieService $movieService
     * @return Response
     */
    public function list(MovieService $movieService): Response
    {
        $movies = $movieService->getMovies();

        $view = View::create($movies);
        $view->getContext()->setGroups(["list"]);
        return $this->handleView($view);
    }

    /**
     * Show Movie.
     * @Rest\Get("/movies/{movie}")
     * @param Movie $movie
     * @return Response
     */
    public function details(Movie $movie): Response
    {
        $view = View::create($movie);
        $view->getContext()->setGroups(["details"]);
        return $this->handleView($view);
    }
}