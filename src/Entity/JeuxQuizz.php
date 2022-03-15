<?php

namespace App\Entity;

use App\Repository\JeuxQuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JeuxQuizzRepository::class)
 */
class JeuxQuizz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ThemeQuizz::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $themeQuizz;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Jeux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_alt;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="jeuxQuizz")
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThemeQuizz(): ?ThemeQuizz
    {
        return $this->themeQuizz;
    }

    public function setThemeQuizz(?ThemeQuizz $themeQuizz): self
    {
        $this->themeQuizz = $themeQuizz;

        return $this;
    }

    public function getJeux(): ?string
    {
        return $this->Jeux;
    }

    public function setJeux(string $Jeux): self
    {
        $this->Jeux = $Jeux;

        return $this;
    }

    public function __toString()
    {
        return $this->Jeux;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageAlt(): ?string
    {
        return $this->image_alt;
    }

    public function setImageAlt(string $image_alt): self
    {
        $this->image_alt = $image_alt;

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setJeuxQuizz($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getJeuxQuizz() === $this) {
                $commentaire->setJeuxQuizz(null);
            }
        }

        return $this;
    }
}
