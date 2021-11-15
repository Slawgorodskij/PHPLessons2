<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImagesBig
 *
 * @ORM\Table(name="images_big", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="image_id", columns={"image_id"})})
 * @ORM\Entity
 */
class ImagesBig
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url_img_big", type="string", length=100, nullable=true)
     */
    private $urlImgBig;

    /**
     * @var string|null
     *
     * @ORM\Column(name="size_img_big", type="string", length=100, nullable=true)
     */
    private $sizeImgBig;

    /**
     * @var int
     *
     * @ORM\Column(name="view_count", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $viewCount = '0';

    /**
     * @var \Images
     *
     * @ORM\ManyToOne(targetEntity="Images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * })
     */
    private $image;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUrlImgBig(): ?string
    {
        return $this->urlImgBig;
    }

    public function setUrlImgBig(?string $urlImgBig): self
    {
        $this->urlImgBig = $urlImgBig;

        return $this;
    }

    public function getSizeImgBig(): ?string
    {
        return $this->sizeImgBig;
    }

    public function setSizeImgBig(?string $sizeImgBig): self
    {
        $this->sizeImgBig = $sizeImgBig;

        return $this;
    }

    public function getViewCount(): ?int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): self
    {
        $this->image = $image;

        return $this;
    }


}
