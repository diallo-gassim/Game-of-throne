<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 2000)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'motherOf')]
    private ?self $mother = null;

    #[ORM\OneToMany(mappedBy: 'mother', targetEntity: self::class)]
    private Collection $motherOf;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'fatherOf')]
    private ?self $father = null;

    #[ORM\OneToMany(mappedBy: 'father', targetEntity: self::class)]
    private Collection $fatherOf;

    #[ORM\ManyToMany(targetEntity: House::class, inversedBy: 'members')]
    private Collection $houses;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Title $title = null;

    


    public function __construct()
    {
        $this->motherOf = new ArrayCollection();
        $this->fatherOf = new ArrayCollection();
        $this->houses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    public function getMother(): ?self
    {
        return $this->mother;
    }

    public function setMother(?self $mother): static
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMotherOf(): Collection
    {
        return $this->motherOf;
    }

    public function addMotherOf(self $motherOf): static
    {
        if (!$this->motherOf->contains($motherOf)) {
            $this->motherOf->add($motherOf);
            $motherOf->setMother($this);
        }

        return $this;
    }

    public function removeMotherOf(self $motherOf): static
    {
        if ($this->motherOf->removeElement($motherOf)) {
            // set the owning side to null (unless already changed)
            if ($motherOf->getMother() === $this) {
                $motherOf->setMother(null);
            }
        }

        return $this;
    }

    public function getFather(): ?self
    {
        return $this->father;
    }

    public function setFather(?self $father): static
    {
        $this->father = $father;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getFatherOf(): Collection
    {
        return $this->fatherOf;
    }

    public function addFatherOf(self $fatherOf): static
    {
        if (!$this->fatherOf->contains($fatherOf)) {
            $this->fatherOf->add($fatherOf);
            $fatherOf->setFather($this);
        }

        return $this;
    }

    public function removeFatherOf(self $fatherOf): static
    {
        if ($this->fatherOf->removeElement($fatherOf)) {
            // set the owning side to null (unless already changed)
            if ($fatherOf->getFather() === $this) {
                $fatherOf->setFather(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, House>
     */
    public function getHouses(): Collection
    {
        return $this->houses;
    }

    public function addHouse(House $house): static
    {
        if (!$this->houses->contains($house)) {
            $this->houses->add($house);
        }

        return $this;
    }

    public function removeHouse(House $house): static
    {
        $this->houses->removeElement($house);

        return $this;
    }

    public function getTitle(): ?Title
    {
        return $this->title;
    }

    public function setTitle(?Title $title): static
    {
        $this->title = $title;

        return $this;
    }  
}
