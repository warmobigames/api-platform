<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'category' => 'exact',
        'productCharacteristics.characteristic.id' => 'exact',
        'productCharacteristics.valueDecimal' => 'exact'
    ]
)]

#[ApiFilter(
    RangeFilter::class,
    properties: [
        'price',
        'productCharacteristics.valueInt'
    ]
)]

class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'products')]
    private Collection $category;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Slug(fields: ['title'])]
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.'
    )]
    private int $price;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductCharacteristic::class, orphanRemoval: true)]
    private Collection $productCharacteristics;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->productCharacteristics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return Collection<int, ProductCharacteristic>
     */
    public function getProductCharacteristics(): Collection
    {
        return $this->productCharacteristics;
    }

    public function addProductCharacteristic(ProductCharacteristic $productCharacteristic): static
    {
        if (!$this->productCharacteristics->contains($productCharacteristic)) {
            $this->productCharacteristics->add($productCharacteristic);
            $productCharacteristic->setProduct($this);
        }

        return $this;
    }

    public function removeProductCharacteristic(ProductCharacteristic $productCharacteristic): static
    {
        if ($this->productCharacteristics->removeElement($productCharacteristic)) {
            // set the owning side to null (unless already changed)
            if ($productCharacteristic->getProduct() === $this) {
                $productCharacteristic->setProduct(null);
            }
        }

        return $this;
    }
}
