<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
#[ApiResource(itemOperations:["get", "patch"=>["security"=>"is_granted('ROLE_ADMIN')"]])]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Professeur::class, inversedBy: 'etablissements')]
    private Collection $referent;

    #[ORM\OneToOne(inversedBy: 'etablissement', cascade: ['persist', 'remove'])]
    private ?Professeur $Referent = null;

    public function __construct()
    {
        $this->referent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getReferent(): Collection
    {
        return $this->referent;
    }

    public function addReferent(Professeur $referent): self
    {
        if (!$this->referent->contains($referent)) {
            $this->referent->add($referent);
        }

        return $this;
    }

    public function removeReferent(Professeur $referent): self
    {
        $this->referent->removeElement($referent);

        return $this;
    }

    public function setReferent(?Professeur $Referent): self
    {
        $this->Referent = $Referent;

        return $this;
    }
}
