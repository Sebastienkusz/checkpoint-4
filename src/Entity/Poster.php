<?php

namespace App\Entity;

use App\Repository\PosterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PosterRepository::class)
 * @Vich\Uploadable()
 */
class Poster
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
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Project::class, mappedBy="poster", cascade={"persist", "remove"})
     */
    private $project;

    /**
     * @Vich\UploadableField(mapping="poster_file", fileNameProperty="name")
     * @var File
     */
    private $posterFile;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        // unset the owning side of the relation if necessary
        if ($project === null && $this->project !== null) {
            $this->project->setPoster(null);
        }

        // set the owning side of the relation if necessary
        if ($project !== null && $project->getPoster() !== $this) {
            $project->setPoster($this);
        }

        $this->project = $project;

        return $this;
    }

    /**
     * @return File
     */
    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    /**
     * @param File $posterFile
     * @return Poster
     */
    public function setPosterFile(File $posterFile = null): Poster
    {
        $this->posterFile = $posterFile;
        return $this;
    }


}
