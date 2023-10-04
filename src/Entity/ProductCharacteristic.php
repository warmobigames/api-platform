<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\GetProductCharacteristics;
use App\Repository\ProductCharacteristicRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductCharacteristicRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['productCharacteristic:read']]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'product' => 'exact'
    ]
)]

class ProductCharacteristic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
        'productCharacteristic:read'
    ])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productCharacteristics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[Groups([
        'productCharacteristic:read'
    ])]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Characteristic $characteristic = null;


    #[Groups([
        'productCharacteristic:read'
    ])]
    #[ORM\Column(type: 'integer', length: 255, nullable: true)]
    private ?int $valueInt = null;


    #[Groups([
        'productCharacteristic:read'
    ])]
    #[ORM\Column(type: 'decimal', nullable: true)]
    private ?string $valueDecimal = null;


    #[Groups([
        'productCharacteristic:read'
    ])]
    #[ORM\ManyToOne]
    private ?CharacteristicVariant $valueObject = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     */
    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return Characteristic|null
     */
    public function getCharacteristic(): ?Characteristic
    {
        return $this->characteristic;
    }

    /**
     * @param Characteristic|null $characteristic
     */
    public function setCharacteristic(?Characteristic $characteristic): void
    {
        $this->characteristic = $characteristic;
    }

    /**
     * @return int|null
     */
    public function getValueInt(): ?int
    {
        return $this->valueInt;
    }

    /**
     * @param int|null $valueInt
     */
    public function setValueInt(?int $valueInt): void
    {
        $this->valueInt = $valueInt;
    }

    /**
     * @return string|null
     */
    public function getValueDecimal(): ?string
    {
        return $this->valueDecimal;
    }

    /**
     * @param string|null $valueDecimal
     */
    public function setValueDecimal(?string $valueDecimal): void
    {
        $this->valueDecimal = $valueDecimal;
    }

    /**
     * @return CharacteristicVariant|null
     */
    public function getValueObject(): ?CharacteristicVariant
    {
        return $this->valueObject;
    }

    /**
     * @param CharacteristicVariant|null $valueObject
     */
    public function setValueObject(?CharacteristicVariant $valueObject): void
    {
        $this->valueObject = $valueObject;
    }
}
