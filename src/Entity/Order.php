<?php

namespace App\Entity;

use App\Entity\Position\OrderPosition;
use App\Repository\Order\OrderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    /**
     * @var Collection<OrderPosition>
     */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderPosition::class)]
    private Collection $orderPositions;
}
