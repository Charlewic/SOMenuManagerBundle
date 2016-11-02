<?php

namespace SO\MenuManagerBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use SO\MenuManagerBundle\Entity\Menu;

class SOMenuManagerExtension extends \Twig_Extension
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * SOMenuManagerExtension constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction(
                'renderMenu',
                array($this, 'renderMenu'),
                array(
                    'needs_environment' => true,
                    'is_safe' => array('html')
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'so_menu_manager_extension';
    }

    /**
     * @param \Twig_Environment $environment
     * @param mixed $menu
     * @param int $deep
     * @param array $options
     * @return string
     */
    public function renderMenu(\Twig_Environment $environment, $menu = null, $deep = -1, $options = array())
    {
        if($menu == null){
            return '';
        }
        if(is_string($menu)){
            $menu = $this->em->getRepository("SO\\MenuManagerBundle\\Entity\\Menu")->findOneBy(array('computedName' => $menu));
        }
        if(!($menu instanceof Menu)){
            return '';
        }

        // build option
        $defaultOptions = array();
        $options = array_merge($defaultOptions, $options);

        return $environment->render('SOMenuManagerBundle::render-menu.html.twig', array(
            'menu'    => $menu,
            'options'  => $options,
        ));
    }
}
