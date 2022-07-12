<?php

namespace App\Entity;

use App\Enum\PositionStatus;
use App\Repository\OrderPositionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderPositionRepository::class)]
class OrderPosition
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

    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'positions')]
    private User $user;

    /**
     * @var Order | null
     */
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderPositions')]
    private ?Order $order;

    /**
     * @var PositionStatus
     */
    #[ORM\Column(type: Types::STRING, enumType: PositionStatus::class)]
    private PositionStatus $status;

    /**
     * @param int                 $quantity
     * @param Part                $part
     * @param User                $user
     * @param Order|null          $order
     * @param PositionStatus|null $status
     */
    public function __construct(
        int $quantity,
        Part $part,
        User $user,
        ?Order $order,
        ?PositionStatus $status = null
    ) {
        $this->quantity = $quantity;
        $this->part = $part;
        $this->user = $user;
        $this->order = $order;
        $this->status = $status ?? PositionStatus::NEW;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return Part
     */
    public function getPart(): Part
    {
        return $this->part;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @return PositionStatus
     */
    public function getStatus(): PositionStatus
    {
        return $this->status;
    }
}
