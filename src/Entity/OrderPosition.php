<?php

namespace App\Entity;

use App\Enum\PositionStatus;
use App\Repository\OrderPositionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderPositionRepository::class)]
class OrderPosition
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var int
     */
    #[ORM\Column(type: 'integer')]
    private int $quantity;

    /**
     * @var Part
     */
    #[ORM\OneToOne(targetEntity: Part::class)]
    #[ORM\JoinColumn(name: 'part_id', referencedColumnName: 'id')]
    private Part $part;

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'baskets')]
    private User $user;

    /**
     * @var Order | null
     */
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderPositions')]
    private ?Order $order;

    /**
     * @var PositionStatus
     */
    private PositionStatus $status;
}
