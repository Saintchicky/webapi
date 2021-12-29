<?php

namespace App\Entity\base;

use Doctrine\ORM\Mapping\Column;

trait TraitEntity
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $date_save;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    
    public function getDateSave(): ?\DateTimeInterface
    {
        return $this->date_save;
    }

    public function setDateSave(\DateTimeInterface $date_save): self
    {
        $this->date_save = $date_save;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}