<?php

namespace App\Entity;

use App\Entity\base\TraitEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TArticleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=TArticleRepository::class)
 */
class TArticle
{
    use TraitEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=TUser::class, inversedBy="tArticles")
     */
    private $fk_user;

    /**
     * @ORM\OneToMany(targetEntity=TComment::class, mappedBy="fk_article")
     */
    private $tComments;

    /**
     * @ORM\ManyToOne(targetEntity=TCategorie::class, inversedBy="tArticles")
     */
    private $pk_categories;


    public function __construct()
    {
        $this->tComments = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    public function getFkUser(): ?TUser
    {
        return $this->fk_user;
    }

    public function setFkUser(?TUser $fk_user): self
    {
        $this->fk_user = $fk_user;

        return $this;
    }

    /**
     * @return Collection|TComment[]
     */
    public function getTComments(): Collection
    {
        return $this->tComments;
    }

    public function addTComment(TComment $tComment): self
    {
        if (!$this->tComments->contains($tComment)) {
            $this->tComments[] = $tComment;
            $tComment->setFkArticle($this);
        }

        return $this;
    }

    public function removeTComment(TComment $tComment): self
    {
        if ($this->tComments->removeElement($tComment)) {
            // set the owning side to null (unless already changed)
            if ($tComment->getFkArticle() === $this) {
                $tComment->setFkArticle(null);
            }
        }

        return $this;
    }

    public function getPkCategories(): ?TCategorie
    {
        return $this->pk_categories;
    }

    public function setPkCategories(?TCategorie $pk_categories): self
    {
        $this->pk_categories = $pk_categories;

        return $this;
    }

}
