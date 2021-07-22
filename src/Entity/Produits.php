<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomProd;

    /**
     * @ORM\Column(type="text")
     */
    private $descProd;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixHt;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixTTC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $produitImg;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promo;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="produits")
     */
    private $promos;

    public function __construct()
    {
        $this->promos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProd(): ?string
    {
        return $this->nomProd;
    }

    public function setNomProd(string $nomProd): self
    {
        $this->nomProd = $nomProd;

        return $this;
    }

    public function getDescProd(): ?string
    {
        return $this->descProd;
    }

    public function setDescProd(string $descProd): self
    {
        $this->descProd = $descProd;

        return $this;
    }

    public function getPrixHt(): ?int
    {
        return $this->prixHt;
    }

    public function setPrixHt(int $prixHt): self
    {
        $this->prixHt = $prixHt;

        return $this;
    }

    public function getPrixTTC(): ?int
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(int $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getProduitImg(): ?string
    {
        return $this->produitImg;
    }

    public function setProduitImg(string $produitImg): self
    {
        $this->produitImg = $produitImg;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setProduits($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getProduits() === $this) {
                $promo->setProduits(null);
            }
        }

        return $this;
    }
}
