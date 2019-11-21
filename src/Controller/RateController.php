<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Rate;
use App\Service\RateService;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 *
 */
class RateController extends AbstractFOSRestController
{
  /**
   * Add Rate
   * @Rest\Post("/movies/{movie}/rates")
   * @param Request $request
   * @param Movie $movie
   * @param RateService $rateService
   * @return Response
   */
  public function add(Request $request, Movie $movie, RateService $rateService): Response
  {
      $rate = $rateService->addRate($request->getContent(),$movie);
      $view = View::create($rate, Response::HTTP_CREATED);
      if ($rate instanceof Rate) {
          $view->getContext()->setGroups(["create-rate"]);
      }
      return $this->handleView($view);
  }
}