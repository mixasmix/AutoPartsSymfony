<?php

namespace App\Entity;

use App\Repository\PartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartRepository::class)]
class Part
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string $partNumber;

    /**
     * @var int
     */
    #[ORM\Column(type: 'integer')]
    private int $quantity;

    /**
     * @var int
     */
    #[ORM\Column(type: 'integer')]
    private int $multiplicity;

    /**
     * @param string $partNumber
     * @param int    $quantity
     * @param int    $multiplicity
     */
    public function __construct(string $partNumber, int $quantity = 1, int $multiplicity = 1)
    {
        $this->partNumber = $partNumber;
        $this->quantity = $quantity;
        $this->multiplicity = $multiplicity;
    }

    /**
     * @return string
     */
    public function getPartNumber(): string
    {
        return $this->partNumber;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getMultiplicity(): int
    {
        return $this->multiplicity;
    }
}
