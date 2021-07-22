<?php

namespace App\Entity;

use App\Repository\PromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="text")
     */
    private $descPromo;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixPromo;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="promo")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=Produits::class, inversedBy="promos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produits;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescPromo(): ?string
    {
        return $this->descPromo;
    }

    public function setDescPromo(string $descPromo): self
    {
        $this->descPromo = $descPromo;

        return $this;
    }

    public function getPrixPromo(): ?int
    {
        return $this->prixPromo;
    }

    public function setPrixPromo(int $prixPromo): self
    {
        $this->prixPromo = $prixPromo;

        return $this;
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setPromo($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getPromo() === $this) {
                $produit->setPromo(null);
            }
        }

        return $this;
    }

    public function getProduits(): ?Produits
    {
        return $this->produits;
    }

    public function setProduits(?Produits $produits): self
    {
        $this->produits = $produits;

        return $this;
    }
}
