<?php
namespace MiniModule\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class NewUserFormFactory implements  FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('mini-module\form\config');
        $factory = new Factory();
        $form = $factory->createForm( $config['mini-module\form\new_user'] );
        $form->setAttribute( 'id', 'formAuthId');
        $form->add( new Submit( 'submit') );
        return $form;
    }
}