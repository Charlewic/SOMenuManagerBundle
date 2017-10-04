<?php

namespace SO\MenuManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("computedName")
 */
class Menu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ComputedName", type="string", length=50, unique=true)
     * @Assert\Regex(
     *     pattern="/^[0-9A-Za-z\-\_]*$/",
     *     message="L'identifiant ne doit contenir que des caractères alphanumérique à l'exception du tiret '-' et de l'underscore '_'"
     * )
     * @Assert\NotNull()
     */
    private $computedName;

    /**
     * @ORM\OneToMany(targetEntity="\SO\MenuManagerBundle\Entity\MenuItem", mappedBy="menu", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"weight" = "ASC"})
     *
     */
    private $menuItems;

    public function __toString()
    {
        return ($this->getName()?$this->getName():"");
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Menu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menuItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add menuItem
     *
     * @param \SO\MenuManagerBundle\Entity\MenuItem $menuItem
     *
     * @return Menu
     */
    public function addMenuItem(\SO\MenuManagerBundle\Entity\MenuItem $menuItem)
    {
        $this->menuItems[] = $menuItem;

        return $this;
    }

    /**
     * Remove menuItem
     *
     * @param \SO\MenuManagerBundle\Entity\MenuItem $menuItem
     */
    public function removeMenuItem(\SO\MenuManagerBundle\Entity\MenuItem $menuItem)
    {
        $this->menuItems->removeElement($menuItem);
    }

    /**
     * Get menuItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuItems()
    {
        return $this->menuItems;
    }

    /**
     * Set computedName
     *
     * @param string $computedName
     *
     * @return Menu
     */
    public function setComputedName($computedName)
    {
        $this->computedName = $computedName;

        return $this;
    }

    /**
     * Get computedName
     *
     * @return string
     */
    public function getComputedName()
    {
        return $this->computedName;
    }
}
