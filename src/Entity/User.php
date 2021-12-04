<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @HasLifecycleCallbacks()
 * @UniqueEntity(
 *    fields  = {"email"},
 *    message = "Cet mail est déja utilisé !")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message= "Ce Mail n'est pas valide")
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $email;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min=8,
     *      minMessage="Le mot de passe doit faire minimum {{ limit }} caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=4,
     *      minMessage="Le nom doit faire minimum {{ limit }} caractères")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=4,
     *      minMessage="Le prénom doit faire minimum {{ limit }} caractères")
     */
    private $lastName;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe ne correspondent pas")
     */
    private $confirmPass;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=CommenteReponse::class, mappedBy="author")
     */
    private $opinions;

    /**
     * @ORM\OneToMany(targetEntity=CommentesLikes::class, mappedBy="author")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=ArticlesLikes::class, mappedBy="author")
     */
    private $articlesLikes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->opinions = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->articlesLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
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
            $this->slug = $sluger->slugify($this->firstName . ' ' . $this->lastName);
        }
        $this->slug = $sluger->slugify($this->firstName . ' ' . $this->lastName);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getConfirmPass(): ?string
    {
        return $this->confirmPass;
    }

    public function setConfirmPass(string $confirmPass): self
    {
        $this->confirmPass = $confirmPass;

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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|CommenteReponse[]
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(CommenteReponse $opinion): self
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions[] = $opinion;
            $opinion->setAuthor($this);
        }

        return $this;
    }

    public function removeOpinion(CommenteReponse $opinion): self
    {
        if ($this->opinions->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getAuthor() === $this) {
                $opinion->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentesLikes[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(CommentesLikes $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setAuthor($this);
        }

        return $this;
    }

    public function removeLike(CommentesLikes $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getAuthor() === $this) {
                $like->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticlesLikes[]
     */
    public function getArticlesLikes(): Collection
    {
        return $this->articlesLikes;
    }

    public function addArticlesLike(ArticlesLikes $articlesLike): self
    {
        if (!$this->articlesLikes->contains($articlesLike)) {
            $this->articlesLikes[] = $articlesLike;
            $articlesLike->setAuthor($this);
        }

        return $this;
    }

    public function removeArticlesLike(ArticlesLikes $articlesLike): self
    {
        if ($this->articlesLikes->removeElement($articlesLike)) {
            // set the owning side to null (unless already changed)
            if ($articlesLike->getAuthor() === $this) {
                $articlesLike->setAuthor(null);
            }
        }

        return $this;
    }
}
