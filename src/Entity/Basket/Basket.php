<?php

namespace App\Entity\Basket;

use App\Entity\User\User;
use App\Repository\Backet\BasketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Collection;

#[ORM\Entity(repositoryClass: BasketRepository::class)]
class Basket
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(inversedBy: 'basket', targetEntity: User::class)]
    private User $user;

    #[ORM\OneToMany()]
    private Collection $orderPosition;
}
