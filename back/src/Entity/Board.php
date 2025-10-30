<?php

namespace App\Entity;

use App\Enum\BoardType;
use App\Repository\BoardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: BoardRepository::class)]
class Board
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (type: 'guid', unique:'true')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 120)]
    private ?string $title = null;

    #[ORM\Column(enumType: BoardType::class)]
    private ?BoardType $type = null;

    #[ORM\Column]
    private ?int $pasition = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\ManyToOne(inversedBy: 'boardId')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ownerId = null;

    /**
     * @var Collection<int, ListEntity>
     */
    #[ORM\OneToMany(targetEntity: ListEntity::class, mappedBy: 'idBoard', orphanRemoval: true)]
    private Collection $listEntities;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->listEntities = new ArrayCollection();
        $this->type = BoardType::CHECKLIST;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?BoardType
    {
        return $this->type;
    }

    public function setType(BoardType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPasition(): ?int
    {
        return $this->pasition;
    }

    public function setPasition(int $pasition): static
    {
        $this->pasition = $pasition;

        return $this;
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

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getOwnerId(): ?User
    {
        return $this->ownerId;
    }

    public function setOwnerId(?User $ownerId): static
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * @return Collection<int, ListEntity>
     */
    public function getListEntities(): Collection
    {
        return $this->listEntities;
    }

    public function addListEntity(ListEntity $listEntity): static
    {
        if (!$this->listEntities->contains($listEntity)) {
            $this->listEntities->add($listEntity);
            $listEntity->setIdBoard($this);
        }

        return $this;
    }

    public function removeListEntity(ListEntity $listEntity): static
    {
        if ($this->listEntities->removeElement($listEntity)) {
            // set the owning side to null (unless already changed)
            if ($listEntity->getIdBoard() === $this) {
                $listEntity->setIdBoard(null);
            }
        }

        return $this;
    }
}
