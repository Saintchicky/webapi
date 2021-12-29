<?php

namespace App\Entity;

use App\Entity\base\TraitEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TCommentRepository;

/**
 * @ORM\Entity(repositoryClass=TCommentRepository::class)
 */
class TComment
{
    use TraitEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=TUser::class, inversedBy="tComments")
     */
    private $fk_user;

    /**
     * @ORM\ManyToOne(targetEntity=TArticle::class, inversedBy="tComments")
     */
    private $fk_article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

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

    public function getFkArticle(): ?TArticle
    {
        return $this->fk_article;
    }

    public function setFkArticle(?TArticle $fk_article): self
    {
        $this->fk_article = $fk_article;

        return $this;
    }
}
