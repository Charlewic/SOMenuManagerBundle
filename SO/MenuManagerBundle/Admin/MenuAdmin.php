<?php
namespace SO\MenuManagerBundle\Admin;

use SO\MenuManagerBundle\Entity\Menu;
use SO\MenuManagerBundle\Entity\MenuItem;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MenuAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array(
                    'label' => 'Nom du menu (admin)',
                    'required' => true,
                )
            )
            ->add('computedName', 'text', array(
                    'label' => 'Identifiant du menu (admin)',
                    'required' => true,
                    'sonata_help' => "L'identifiant ne doit contenir que des caractères alphanumérique à l'exception du tiret '-' et de l'underscore '_'",
                )
            )
            ->add('menuItems', 'sonata_type_collection', array(), array(
                    'label' => 'Liste des liens du menu',
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'weight',
                )
            )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }

    /**
     * @param mixed $menu
     */
    public function preUpdate($menu) {
        /** @var Menu $menu */
        /** @var MenuItem $menuItem */
        foreach($menu->getMenuItems() as $menuItem) {
            $menuItem->setmenu($menu);
        }
    }

    /**
     * @param mixed $menu
     */
    public function prePersist($menu) {
        /** @var Menu $menu */
        /** @var MenuItem $menuItem */
        foreach($menu->getMenuItems() as $menuItem) {
            $menuItem->setmenu($menu);
        }
    }
}