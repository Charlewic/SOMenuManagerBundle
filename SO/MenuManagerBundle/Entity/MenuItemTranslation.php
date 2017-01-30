<?php
namespace SO\MenuManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * MenuItem
 *
 * @ORM\Table(name="menu_item_translation",uniqueConstraints={@UniqueConstraint(name="lookup_unique_idx", columns={"locale", "field", "object_id"})})
 * @ORM\Entity
 */
class MenuItemTranslation extends AbstractPersonalTranslation
{
    /**
     * Convenient constructor
     *
     * @param string $locale
     * @param string $field
     * @param string $value
     */
    public function __construct($locale, $field, $value)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($value);
    }

    /**
     * @var Menu
     *
     * @ORM\ManyToOne(targetEntity="\SO\MenuManagerBundle\Entity\MenuItem", inversedBy="translations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     * })
     */
    protected $object;
}