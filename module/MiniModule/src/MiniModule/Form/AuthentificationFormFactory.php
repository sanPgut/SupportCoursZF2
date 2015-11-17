<?php
namespace MiniModule\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class AuthentificationFormFactory implements  FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new Form();
        $form->add( new \MiniModule\Element\Login() , array('priority' => 1));
        $form->add( new Submit( 'submit') );
        return $form;
    }
}