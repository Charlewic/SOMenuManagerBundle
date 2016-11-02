<?php

namespace SO\MenuManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MenuItem
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
     * @var integer
     *
     * @ORM\Column(name="Weight", type="integer")
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="Url", type="string", length=255)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="target", type="string", length=255)
     */
    private $target;

    /**
     * @var Menu
     *
     * @ORM\ManyToOne(targetEntity="\SO\MenuManagerBundle\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     * })
     */
    private $menu;

    /**
     * @var MenuItem
     *
     * @ORM\ManyToOne(targetEntity="\SO\MenuManagerBundle\Entity\MenuItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_item_parent_id", referencedColumnName="id")
     * })
     */
    private $menuItemParent;

    /**
     *
     * @ORM\OneToMany(targetEntity="\SO\MenuManagerBundle\Entity\MenuItem", mappedBy="menuItemParent")
     */
    private $menuChildren;


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
     * @return MenuItem
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
     * Set weight
     *
     * @param integer $weight
     *
     * @return MenuItem
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return MenuItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set target
     *
     * @param string $target
     *
     * @return MenuItem
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set menu
     *
     * @param \SO\MenuManagerBundle\Entity\Menu $menu
     *
     * @return MenuItem
     */
    public function setMenu(\SO\MenuManagerBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \SO\MenuManagerBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set menuItemParent
     *
     * @param \SO\MenuManagerBundle\Entity\MenuItem $menuItemParent
     *
     * @return MenuItem
     */
    public function setMenuItemParent(\SO\MenuManagerBundle\Entity\MenuItem $menuItemParent = null)
    {
        $this->menuItemParent = $menuItemParent;

        return $this;
    }

    /**
     * Get menuItemParent
     *
     * @return \SO\MenuManagerBundle\Entity\MenuItem
     */
    public function getMenuItemParent()
    {
        return $this->menuItemParent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menuChildren = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add menuChild
     *
     * @param \SO\MenuManagerBundle\Entity\MenuItem $menuChild
     *
     * @return MenuItem
     */
    public function addMenuChild(\SO\MenuManagerBundle\Entity\MenuItem $menuChild)
    {
        $this->menuChildren[] = $menuChild;

        return $this;
    }

    /**
     * Remove menuChild
     *
     * @param \SO\MenuManagerBundle\Entity\MenuItem $menuChild
     */
    public function removeMenuChild(\SO\MenuManagerBundle\Entity\MenuItem $menuChild)
    {
        $this->menuChildren->removeElement($menuChild);
    }

    /**
     * Get menuChildren
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuChildren()
    {
        return $this->menuChildren;
    }
}
