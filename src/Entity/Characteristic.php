<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Repository\CharacteristicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CharacteristicRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['characteristic:read']],
    denormalizationContext: ['groups' => ['characteristic:write']]
)]

#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'category' => 'exact'
    ]
)]
class Characteristic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('characteristic:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([
        'characteristic:read',
        'characteristic:write',
        'productCharacteristic:read'
    ])]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'characteristics')]
    #[Groups(['characteristic:read', 'characteristic:write'])]
    private Collection $category;

    #[ORM\Column(length: 10)]
    #[Groups([
        'characteristic:read',
        'characteristic:write',
        'productCharacteristic:read'
    ])]
    private ?string $type = null;

    #[Assert\NotBlank]
    #[ORM\OneToMany(mappedBy: 'characteristic', cascade:['persist'], targetEntity: CharacteristicVariant::class)]
    #[Groups(['characteristic:read', 'characteristic:write'])]
    private Collection $characteristicVariants;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->characteristicVariants = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, CharacteristicVariant>
     */
    public function getCharacteristicVariants(): Collection
    {
        return $this->characteristicVariants;
    }

    public function addCharacteristicVariant(CharacteristicVariant $characteristicVariant): static
    {
        if (!$this->characteristicVariants->contains($characteristicVariant)) {
            $this->characteristicVariants->add($characteristicVariant);
            $characteristicVariant->setCharacteristic($this);
        }

        return $this;
    }

    public function removeCharacteristicVariant(CharacteristicVariant $characteristicVariant): static
    {
        if ($this->characteristicVariants->removeElement($characteristicVariant)) {
            // set the owning side to null (unless already changed)
            if ($characteristicVariant->getCharacteristic() === $this) {
                $characteristicVariant->setCharacteristic(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
