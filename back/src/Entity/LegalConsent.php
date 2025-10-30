<?php

namespace App\Entity;

use App\Repository\LegalConsentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LegalConsentRepository::class)]
class LegalConsent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (type: 'guid', unique:'true')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 50)]
    private ?string $scope = null;

    #[ORM\Column(length: 20)]
    private ?string $version = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $consentedAt = null;

    #[ORM\Column(length: 128)]
    private ?string $ipHash = null;

    #[ORM\ManyToOne(inversedBy: 'legalConsents')]
    private ?User $userId = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(string $scope): static
    {
        $this->scope = $scope;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getConsentedAt(): ?\DateTimeImmutable
    {
        return $this->consentedAt;
    }

    public function setConsentedAt(\DateTimeImmutable $consentedAt): static
    {
        $this->consentedAt = $consentedAt;

        return $this;
    }

    public function getIpHash(): ?string
    {
        return $this->ipHash;
    }

    public function setIpHash(string $ipHash): static
    {
        $this->ipHash = $ipHash;

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
