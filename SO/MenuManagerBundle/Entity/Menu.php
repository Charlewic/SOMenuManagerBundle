<?php

namespace SO\MenuManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\OneToMany(targetEntity="\SO\MenuManagerBundle\Entity\MenuItem", mappedBy="menu", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"weight" = "ASC"})
     *
     */
    private $menuItems;

    public function __toString()
    {
        return $this->getName();
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
}
