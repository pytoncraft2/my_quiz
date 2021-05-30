<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Quiz::class, mappedBy="categorie")
     */
    private $quizz;

    /**
     * @ORM\ManyToOne(targetEntity=History::class, inversedBy="categ_id")
     */
    private $history;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_question;

    public function __construct()
    {
        $this->quizz = new ArrayCollection();
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
    public function __toString()
    {
        return $this->name;
    }





    /**
     * @return Collection|Quiz[]
     */
    public function getQuizz(): Collection
    {
        return $this->quizz;
    }

    public function addQuizz(Quiz $quizz): self
    {
        if (!$this->quizz->contains($quizz)) {
            $this->quizz[] = $quizz;
            $quizz->setCategorie($this);
        }

        return $this;
    }

    public function removeQuizz(Quiz $quizz): self
    {
        if ($this->quizz->removeElement($quizz)) {
            // set the owning side to null (unless already changed)
            if ($quizz->getCategorie() === $this) {
                $quizz->setCategorie(null);
            }
        }

        return $this;
    }

    public function getHistory(): ?History
    {
        return $this->history;
    }

    public function setHistory(?History $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getTotalQuestion(): ?int
    {
        return $this->total_question;
    }

    public function setTotalQuestion(int $total_question): self
    {
        $this->total_question = $total_question;

        return $this;
    }
    


}
