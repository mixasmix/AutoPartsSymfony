<?php

namespace App\Entity\Position;

use App\Entity\Order;
use App\Entity\Part;
use App\Entity\User\User;
use App\Enum\OrderPositionStatus;
use App\Repository\OrderPosition\PositionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionRepository::class)]
class OrderPosition extends Position
{
    /**
     * @var Order | null
     */
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderPositions')]
    private ?Order $order;

    /**
     * @var OrderPositionStatus
     */
    #[ORM\Column(type: Types::STRING, enumType: OrderPositionStatus::class)]
    private OrderPositionStatus $status;

    /**
     * @param int                      $quantity
     * @param Part                     $part
     * @param User                     $user
     * @param Order|null               $order
     * @param OrderPositionStatus|null $status
     */
    public function __construct(
        int $quantity,
        Part $part,
        User $user,
        ?Order $order,
        ?OrderPositionStatus $status = null
    ) {
        $this->quantity = $quantity;
        $this->part = $part;
        $this->user = $user;
        $this->order = $order;
        $this->status = $status ?? OrderPositionStatus::NEW;
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
     * @return OrderPositionStatus
     */
    public function getStatus(): OrderPositionStatus
    {
        return $this->status;
    }
}
