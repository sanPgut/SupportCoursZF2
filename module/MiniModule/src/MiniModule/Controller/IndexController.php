<?php
namespace MiniModule\Controller;

use Zend\Form\Factory;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class IndexController
 *
 * @package MiniModule
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function formAction()
    {
        $services = $this->getServiceLocator();
        $form = $services->get('MiniModule\Form\Authentification');
        return array( 'form' => $form );
    }

    public function traiteAction()
    {
        return array( 'login' => $_GET['log'] );
    }
}