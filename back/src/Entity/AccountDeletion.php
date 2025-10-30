<?php

namespace App\Entity;

use App\Repository\AccountDeletionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AccountDeletionRepository::class)]
class AccountDeletion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (type: 'guid', unique:'true')]
    private ?Uuid $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $requestedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $processedAt = null;

    #[ORM\OneToOne(inversedBy: 'accountDeletion', cascade: ['persist', 'remove'])]
    private ?User $userId = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestedAt(): ?\DateTimeImmutable
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(\DateTimeImmutable $requestedAt): static
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    public function getProcessedAt(): ?\DateTimeImmutable
    {
        return $this->processedAt;
    }

    public function setProcessedAt(\DateTimeImmutable $processedAt): static
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
