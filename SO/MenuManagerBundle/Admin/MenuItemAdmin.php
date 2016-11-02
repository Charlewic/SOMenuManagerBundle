<?php

namespace SO\MenuManagerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MenuItemAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('weight')
            ->add('name', 'text', array(
                    'label' => 'Titre du lien',
                    'required' => true,
                )
            )
            ->add('url', 'text', array(
                    'label' => 'Url du lien',
                    'required' => true,
                )
            )
            ->add('target', 'choice', array(
                    'label' => 'Cible du lien',
                    'choices'   => array('_self' => 'Même fenêtre', '_blank' => 'Nouvelle fenêtre'),
                    'required'  => true,
                )
            )
            ->add('menuItemParent', null, array(
                    'label' => 'Lien parent',
                    'required'  => false,
                )
            )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('url')
            ->add('target')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('url')
            ->add('target')
        ;
    }
}