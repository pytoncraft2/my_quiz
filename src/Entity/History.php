<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $token;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorie_id;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="history")
     */
    private $categ_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $history_id;

    public function __construct()
    {
        $this->categ_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorie_id;
    }

    public function setCategorieId(int $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

    /**
     * @return Collection|categorie[]
     */
    public function getCategId(): Collection
    {
        return $this->categ_id;
    }

    public function addCategId(categorie $categId): self
    {
        if (!$this->categ_id->contains($categId)) {
            $this->categ_id[] = $categId;
            $categId->setHistory($this);
        }

        return $this;
    }

    public function removeCategId(categorie $categId): self
    {
        if ($this->categ_id->removeElement($categId)) {
            // set the owning side to null (unless already changed)
            if ($categId->getHistory() === $this) {
                $categId->setHistory(null);
            }
        }

        return $this;
    }

    public function getHistoryId(): ?int
    {
        return $this->history_id;
    }

    public function setHistoryId(?int $history_id): self
    {
        $this->history_id = $history_id;

        return $this;
    }
}
