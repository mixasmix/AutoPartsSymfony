<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
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
    private string $name;

    /**
     * @var string | null
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $site;

    /**
     * @param string        $name
     * @param string | null $site
     */
    public function __construct(string $name, ?string $site)
    {
        $this->name = $name;
        $this->site = $site;
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string | null
     */
    public function getSite(): ?string
    {
        return $this->site;
    }
}
