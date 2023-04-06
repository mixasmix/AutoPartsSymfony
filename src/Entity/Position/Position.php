<?php

namespace App\Entity\Position;

use App\Entity\Part;
use App\Entity\User\User;
use App\Repository\OrderPosition\PositionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionRepository::class)]
abstract class Position
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    /**
     * @var int
     */
    #[ORM\Column(type: Types::INTEGER)]
    private int $quantity;

    /**
     * @var Part
     */
    #[ORM\OneToOne(targetEntity: Part::class)]
    #[ORM\JoinColumn(name: 'part_id', referencedColumnName: 'id')]
    private Part $part;
}
