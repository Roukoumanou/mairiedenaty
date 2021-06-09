<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentesRepository::class)
 */
class Commentes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(
     *      min=8,
     *      max=255,
     *      minMessage="Le commentaire doit faire minimum {{ limit }} caractères",
     *      maxMessage="Le commentaire ne doit pas dépasser {{ limit }} caractères")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Articles::class, inversedBy="commentes")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity=CommenteReponse::class, mappedBy="commente")
     */
    private $commenteReponses;

    /**
     * @ORM\OneToMany(targetEntity=CommentesLikes::class, mappedBy="commente")
     */
    private $likes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->commenteReponses = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection|CommenteReponse[]
     */
    public function getCommenteReponses(): Collection
    {
        return $this->commenteReponses;
    }

    public function addCommenteReponse(CommenteReponse $commenteReponse): self
    {
        if (!$this->commenteReponses->contains($commenteReponse)) {
            $this->commenteReponses[] = $commenteReponse;
            $commenteReponse->setCommente($this);
        }

        return $this;
    }

    public function removeCommenteReponse(CommenteReponse $commenteReponse): self
    {
        if ($this->commenteReponses->removeElement($commenteReponse)) {
            // set the owning side to null (unless already changed)
            if ($commenteReponse->getCommente() === $this) {
                $commenteReponse->setCommente(null);
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
            $like->setCommente($this);
        }

        return $this;
    }

    public function removeLike(CommentesLikes $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getCommente() === $this) {
                $like->setCommente(null);
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
