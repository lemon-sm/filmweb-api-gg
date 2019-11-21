<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class MovieService extends AbstractFOSRestController
{
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Movie::class);
    }

    public function getMovies(): array
    {
        $movies = $this->repository->findAll();
        return $movies;
    }
}