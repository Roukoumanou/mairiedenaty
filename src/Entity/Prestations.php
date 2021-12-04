<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PrestationsRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PrestationsRepository::class)
 * @UniqueEntity(
 *    fields  = {"name"},
 *    message = "Cet type de prestation est déja utilisé !")
 */
class Prestations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(
     *      min=8,
     *      max=255,
     *      minMessage="Le nom de la prestation doit faire minimum {{ limit }} caractères",
     *      maxMessage="Le nom de la prestation ne doit pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $pieces;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $cout;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $delai;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="prestations")
     */
    private $service;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPieces(): ?string
    {
        return $this->pieces;
    }

    public function setPieces(string $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getCout(): ?int
    {
        return $this->cout;
    }

    public function setCout(int $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDelai(): ?string
    {
        return $this->delai;
    }

    public function setDelai(string $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
