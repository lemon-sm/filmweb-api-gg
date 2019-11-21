<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * Class Rate
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table()
 */
class Rate
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
     * @var int
     * @Assert\Range(
     *      min=1,
     *      max=5
     * )
     * @ORM\Column(type="integer")
     * @Groups({"details","create-rate"})
     */
    private $value;

    /**
     * @var Movie
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="rates")
     * @Groups({"create-rate"})
     */
    private $movie;

    /**
     * @return int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @param Movie $movie
     * @return self
     */
    public function setMovie(Movie $movie): self
    {
        $this->movie = $movie;
        return $this;
    }

    /**
     * @param int $value
     * @return self
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }


}