<?php

namespace App\Service;

use App\Entity\Movie;
use App\Entity\Rate;
use App\Form\RateType;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class RateService extends  AbstractFOSRestController
{
    public function addRate(string $content, Movie $movie)
    {
        $rate = new Rate();

        $rate->setMovie($movie);

        $form = $this->createForm(RateType::class, $rate);
        $data = json_decode($content, true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();

            return $rate;
        }
        return $form->getErrors();
    }
}