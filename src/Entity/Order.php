<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\Collection;
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
    #[ORM\Column(type: 'integer')]
    private int $id;

    /**
     * @var Collection<OrderPosition>
     */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderPosition::class)]
    private Collection $orderPositions;
}
