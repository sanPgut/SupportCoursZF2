<?php
namespace MiniModule\Controller;

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
        return array();
    }

    /**
     * on traite sans utiliser ZF
     * @return array
     */
    public function traiteAction()
    {
        return array( 'login' => $_GET['log'] );
    }
}