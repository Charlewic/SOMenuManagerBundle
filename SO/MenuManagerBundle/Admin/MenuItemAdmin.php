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
        if ($this->getRoot()->getClass() != "SO\MenuManagerBundle\Entity\Menu") {
            $formMapper
                ->add('menu');
        }

        $formMapper
            ->add('weight');

        if ($this->id($this->getSubject())) {
            $formMapper
                ->add('name', 'translatable_field', array(
                        'label' => 'Titre du lien',
                        'required' => true,
                        'field' => 'name',
                        'attr' => array(
                            'data-translatable-tab-field' => 1,
                        ),
                        'personal_translation' => 'SO\MenuManagerBundle\Entity\MenuItemTranslation',
                        'property_path' => 'translations',
                    )
                )
                ->add('url', 'translatable_field', array(
                        'label' => 'Url du lien',
                        'required' => true,
                        'field' => 'url',
                        'attr' => array(
                            'data-translatable-tab-field' => 1,
                        ),
                        'personal_translation' => 'SO\MenuManagerBundle\Entity\MenuItemTranslation',
                        'property_path' => 'translations',
                    )
                );
        }
        else {
            $formMapper
                ->add('name', null, array(
                        'label' => 'Titre du lien',
                        'required' => true,
                    )
                )
                ->add('url', null, array(
                        'label' => 'Url du lien',
                        'required' => true,
                    )
                );
        }
        
        $formMapper
            ->add('target', 'choice', array(
                    'label' => 'Cible du lien',
                    'choices' => array('_self' => 'Même fenêtre', '_blank' => 'Nouvelle fenêtre'),
                    'required' => true,
                )
            )
            ->add('menuItemParent', null, array(
                    'label' => 'Lien parent',
                    'required' => false,
                )
            )
            ->add('menuItemMedia', 'sonata_type_model_list', array(
                'label' => 'Media associé au lien',
                'required' => false,
            ),
                array('link_parameters' => array('context' => 'default'))
            );
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('url')
            ->add('target');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('url')
            ->add('target');
    }
}