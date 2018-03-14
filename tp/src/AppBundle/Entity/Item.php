<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 * @Vich\Uploadable
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=255, nullable=true)
     */
    private $content;
    /**
     * @var File
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png", "image/gif" })
     * @Vich\UploadableField(mapping="item_image", fileNameProperty="imageName")
     *
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;
    /**
     * @var string
     *
     * @ORM\Column(name="url_video", type="string", length=255, nullable=true)
     */
    private $urlVideo;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean", nullable=true)
     */
    private $enable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="ItemCategory")
     */
    private $category;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Item
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Item
     */
    public function setImage($image)
    {
        $this->image = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->createdAt = new \DateTimeImmutable();
        }
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set urlVideo
     *
     * @param string $urlVideo
     *
     * @return Item
     */
    public function setUrlVideo($urlVideo)
    {
        $this->urlVideo = $urlVideo;

        return $this;
    }

    /**
     * Get urlVideo
     *
     * @return string
     */
    public function getUrlVideo()
    {
        return $this->urlVideo;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Item
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Item
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Item
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Item
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Item
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\ItemCategory $category
     *
     * @return Item
     */
    public function setCategory(\AppBundle\Entity\ItemCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\ItemCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
