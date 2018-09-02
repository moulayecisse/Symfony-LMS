<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 02/09/2018
 * Time: 15:53
 */

namespace App\Traits\Entity\Book;


use Doctrine\Common\Collections\ArrayCollection;
use Faker\Test\Provider\Collection;

trait BookStatusTrait
{
    /**
     * @ORM\Column(type="json_array", nullable=true)
     *
     * @var Collection
     */
    private $status;

    public function __construct()
    {
        $this->status = new ArrayCollection();
        $this->addStatus('inside');
    }

    /**
     * @return Collection|string[]
     */
    public function getStatus(): Collection
    {
        return $this->status;
    }

    /**
     * @param Collection|string[] $status
     * @return BookStatusTrait
     */
    public function setStatus(Collection $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $status
     * @return BookStatusTrait
     */
    public function addStatus(string $status): self
    {
        if (!$this->status->contains($status) && count($this->status) < 2) {
            $key = count($this->status);
            $this->status[$status] = $key;
        }

        return $this;
    }

    /**
     * @param string $status
     * @return BookStatusTrait
     */
    public function removeStatus(string $status): self
    {
        if ($this->status->contains($status)) {
            $this->status->removeElement($status);
        }

        return $this;
    }
}