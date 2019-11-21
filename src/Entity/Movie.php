<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * Class Movie
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table()
 */
class Movie
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list","details","create-rate"})
     */
    private $id;

    /**
     * @var string
     * @ORM\GeneratedValue
     * @ORM\Column(type="string", length=255)
     * @Groups({"list","details"})
     */
    private $title;

    /**
     * @var DateTime
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     * @Groups({"details"})
     */
    private $releaseDate;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Groups({"details"})
     */
    private $description;

    /**
     * @var Genre
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="movies")
     * @Groups({"list","details"})
     */
    private $genre;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Rate", mappedBy="movie")
     * @Groups({"details"})
     */
    private $rates;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return DateTime
     */
    public function getReleaseDate(): DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Genre
     */
    public function getGenre(): Genre
    {
        return $this->genre;
    }

    /**
     * @return ArrayCollection
     */
    public function getRates(): ArrayCollection
    {
        return $this->rates;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param DateTime $releaseDate
     * @return self
     */
    public function setReleaseDate(DateTime $releaseDate): self
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param Genre $genre
     * @return self
     */
    public function setGenre(Genre $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @param ArrayCollection $rates
     * @return self
     */
    public function setRates(ArrayCollection $rates): self
    {
        $this->rates = $rates;
        return $this;
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("rates_average")
     * @Groups({"details"})
     * @return float
     */
    public function getRatesAverage(): float
    {
        $rates = $this->rates;
        $sum = 0;
         /** @var Rate $rate */
        foreach ($rates as $rate) {
            $sum += $rate->getValue();
        }
        $average = round($sum/$rates->count(), 2);
        return $average;
    }




}