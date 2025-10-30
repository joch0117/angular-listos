<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'guid', unique:'true')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 254)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column (length: 80)]
    private ?string $displayName;

    #[ORM\Column(type: 'json')]
    private array $role = [];

    #[ORM\Column]
    private ?DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updated_at = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $deleted_at = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    /**
     * @var Collection<int, Board>
     */
    #[ORM\OneToMany(targetEntity: Board::class, mappedBy: 'ownerId', orphanRemoval: true)]
    private Collection $boardId;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'createdBy', orphanRemoval: true)]
    private Collection $tasks;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'updatedBy')]
    private Collection $UpdateTasks;

    /**
     * @var Collection<int, LegalConsent>
     */
    #[ORM\OneToMany(targetEntity: LegalConsent::class, mappedBy: 'userId')]
    private Collection $legalConsents;

    #[ORM\OneToOne(mappedBy: 'userId', cascade: ['persist', 'remove'])]
    private ?AccountDeletion $accountDeletion = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->boardId = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->UpdateTasks = new ArrayCollection();
        $this->legalConsents = new ArrayCollection();
        $this->created_at = new DateTimeImmutable();
        $this->is_active = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

        public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): static
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getRole(): array
    {
        $role = $this->role;
        $role[] = 'ROLE_USER';
        return array_unique($role);
    }

    public function setRole(array $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, Board>
     */
    public function getBoardId(): Collection
    {
        return $this->boardId;
    }

    public function addBoardId(Board $boardId): static
    {
        if (!$this->boardId->contains($boardId)) {
            $this->boardId->add($boardId);
            $boardId->setOwnerId($this);
        }

        return $this;
    }

    public function removeBoardId(Board $boardId): static
    {
        if ($this->boardId->removeElement($boardId)) {
            // set the owning side to null (unless already changed)
            if ($boardId->getOwnerId() === $this) {
                $boardId->setOwnerId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCreatedBy() === $this) {
                $task->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getUpdateTasks(): Collection
    {
        return $this->UpdateTasks;
    }

    public function addUpdateTask(Task $updateTask): static
    {
        if (!$this->UpdateTasks->contains($updateTask)) {
            $this->UpdateTasks->add($updateTask);
            $updateTask->setUpdatedBy($this);
        }

        return $this;
    }

    public function removeUpdateTask(Task $updateTask): static
    {
        if ($this->UpdateTasks->removeElement($updateTask)) {
            // set the owning side to null (unless already changed)
            if ($updateTask->getUpdatedBy() === $this) {
                $updateTask->setUpdatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LegalConsent>
     */
    public function getLegalConsents(): Collection
    {
        return $this->legalConsents;
    }

    public function addLegalConsent(LegalConsent $legalConsent): static
    {
        if (!$this->legalConsents->contains($legalConsent)) {
            $this->legalConsents->add($legalConsent);
            $legalConsent->setUserId($this);
        }

        return $this;
    }

    public function removeLegalConsent(LegalConsent $legalConsent): static
    {
        if ($this->legalConsents->removeElement($legalConsent)) {
            // set the owning side to null (unless already changed)
            if ($legalConsent->getUserId() === $this) {
                $legalConsent->setUserId(null);
            }
        }

        return $this;
    }

    public function getAccountDeletion(): ?AccountDeletion
    {
        return $this->accountDeletion;
    }

    public function setAccountDeletion(?AccountDeletion $accountDeletion): static
    {
        // unset the owning side of the relation if necessary
        if ($accountDeletion === null && $this->accountDeletion !== null) {
            $this->accountDeletion->setUserId(null);
        }

        // set the owning side of the relation if necessary
        if ($accountDeletion !== null && $accountDeletion->getUserId() !== $this) {
            $accountDeletion->setUserId($this);
        }

        $this->accountDeletion = $accountDeletion;

        return $this;
    }
}
