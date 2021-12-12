<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\CommunalConseilMembersRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommunalConseilMembersRepository::class)
 * @HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class CommunalConseilMembers
{
    public const MAIRE = 'maire';
    public const ADJOINTS_AU_MAIRE = 'adjoints_au_maire';
    public const C_A = 'c.as';
    public const PDT_CAEF = 'caef';
    public const PDTE_CASC = 'casc';
    public const PDT_COM_PLAINTES = 'plaintes';
    public const PDT_CADE = 'cade';
    public const CONSEILLERS_COMMUNAL = 'c.cs';
    
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
     *      minMessage="Le nom et le prénom doivent faire minimum {{ limit }} caractères",
     *      maxMessage="Le nom et le prénom ne doivent pas dépasser {{ limit }} caractères")
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(
     *      min=2,
     *      max=50,
     *      minMessage="Le poste doit contenir minimum {{ limit }} caractères",
     *      maxMessage="Le poste ne doit pas dépasser {{ limit }} caractères")
     */
    private $poste;

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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(
     *      min=8,
     *      max=255,
     *      minMessage="La mandature doit contenir minimum {{ limit }} caractères",
     *      maxMessage="La mandature ne doit pas dépasser {{ limit }} caractères")
     */
    private $mandature;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      min=8,
     *      max=255,
     *      minMessage="La mandature doit contenir minimum {{ limit }} caractères",
     *      maxMessage="La mandature ne doit pas dépasser {{ limit }} caractères")
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(
     *      min=2,
     *      max=50,
     *      minMessage="Le titre doit contenir minimum {{ limit }} caractères",
     *      maxMessage="Le titre ne doit pas dépasser {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="conseil_members", fileNameProperty="photo")
     * @Assert\Image(
     *     maxSize = "1000k",
     *     mimeTypes = {"image/jpeg", "image/png", "image/JPG"},
     *     allowLandscape = false,
     *     mimeTypesMessage = "Nous n'acceptons que les images en png, jpg, jpeg",
     *     maxSizeMessage = "Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est {{ limit }} {{ suffix }}"
     * )
     * 
     * @var File|null
     */
    private $imageFile;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return void
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function initSlug()
    {
        $sluger = new Slugify();
        if (empty($this->slug)) {
            $this->slug = $sluger->slugify($this->fullName);
        }
        $this->slug = $sluger->slugify($this->fullName);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

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

    public function getMandature(): ?string
    {
        return $this->mandature;
    }

    public function setMandature(string $mandature): self
    {
        $this->mandature = $mandature;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
