<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CharacteristicVariantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CharacteristicVariantRepository::class)]
#[ApiResource]
class CharacteristicVariant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]    #[Groups([
        'productCharacteristic:read'
    ])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'characteristicVariants')]
    #[Groups(['characteristic:write'])]
    #[Assert\NotBlank]
    private Characteristic $characteristic;

    #[Groups([
        'characteristic:read',
        'characteristic:write',
        'productCharacteristic:read'
    ])]
    #[ORM\Column(length: 255)]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacteristic(): Characteristic
    {
        return $this->characteristic;
    }

    public function setCharacteristic(Characteristic $characteristic): static
    {
        $this->characteristic = $characteristic;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
