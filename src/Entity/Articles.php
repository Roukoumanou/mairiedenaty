<?php

namespace App\Entity;

use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 * @HasLifecycleCallbacks()
 * @UniqueEntity(
 *    fields  = {"title"},
 *    message = "Cet titre est déja utilisé !")
 */
class Articles
{
    public const ARTICLE_PUBLISHED = 10;
    public const ARTICLE_ARCHIVED = 20;
    public const ARTICLE_DRAFT = 30;

    public const CATEGORIE_CONSEIL_COMMUNAL = 'conseils';
    public const CATEGORIE_INFOS = 'infos';
    public const CATEGORIE_PROJET = 'projets';

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
     *      minMessage="Le titre doit faire minimum {{ limit }} caractères",
     *      maxMessage="Le titre ne doit pas dépasser {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Content;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $status = self::ARTICLE_DRAFT;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @ORM\OneToMany(targetEntity=Commentes::class, mappedBy="article")
     */
    private $commentes;

    /**
     * @ORM\OneToMany(targetEntity=ArticlesLikes::class, mappedBy="article")
     */
    private $likes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->commentes = new ArrayCollection();
        $this->likes = new ArrayCollection();
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
            $this->slug = $sluger->slugify($this->title);
        }
        $this->slug = $sluger->slugify($this->title);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(?string $Content): self
    {
        $this->Content = $Content;

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

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

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

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return Collection|Commentes[]
     */
    public function getCommentes(): Collection
    {
        return $this->commentes;
    }

    public function addCommente(Commentes $commente): self
    {
        if (!$this->commentes->contains($commente)) {
            $this->commentes[] = $commente;
            $commente->setArticle($this);
        }

        return $this;
    }

    public function removeCommente(Commentes $commente): self
    {
        if ($this->commentes->removeElement($commente)) {
            // set the owning side to null (unless already changed)
            if ($commente->getArticle() === $this) {
                $commente->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticlesLikes[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(ArticlesLikes $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setArticle($this);
        }

        return $this;
    }

    public function removeLike(ArticlesLikes $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getArticle() === $this) {
                $like->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function getIsLikeByUser(User $user): bool
    {
        foreach ($this->likes as  $like) {
            if ($like->getAuthor() === $user) return true;
        }

        return false;
    }
}
