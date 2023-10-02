<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ApiResource]

class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length:255)]
    private string $title;

    #[ORM\Column(type:"text", length:255)]
    private string $description;

    #[ORM\Column(length:255)]
    #[Gedmo\Slug(fields: ['title'])]
    private string $slug;

    #[ORM\Column(type:"datetime")]
    private \DateTime $date_created;

    #[ORM\Column(type:"string", length:255, nullable:true)]
    private string $image;


    #[Assert\Image(
        maxRatio: 1.35,
        minRatio: 1.31,
        maxRatioMessage: "Соотношение высоты и ширины изображения должны быть 4:3",
        minRatioMessage: "Соотношение высоты и ширины изображения должны быть 4:3"
    )]
    private string $imageFile;

    #[ORM\Column(type:"datetime", nullable:true)]
    private \DateTime $imageUpdatedAt;


    #[ORM\Column(type:"string", length:1024, nullable:true)]
    private ?string $shortDescription;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->date_created;
    }

    /**
     * @param \DateTime $date_created
     */
    public function setDateCreated(\DateTime $date_created): void
    {
        $this->date_created = $date_created;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImageFile(): string
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageFile
     */
    public function setImageFile(string $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return \DateTime
     */
    public function getImageUpdatedAt(): \DateTime
    {
        return $this->imageUpdatedAt;
    }

    /**
     * @param \DateTime $imageUpdatedAt
     */
    public function setImageUpdatedAt(\DateTime $imageUpdatedAt): void
    {
        $this->imageUpdatedAt = $imageUpdatedAt;
    }

    /**
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @param string|null $shortDescription
     */
    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }
}
