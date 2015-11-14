<?php
namespace MiniModule\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
        if ( $this->getRequest()->isPost() ) {
            $form->setData( $this->getRequest()->getPost());
            if ($form->isValid()) {
                $vm = new ViewModel();
                $vm->setVariables( $form->getData() );
                $vm->setTemplate('mini-module/index/traite');
                return $vm;
            }
        }
        $form->setAttribute('action', $this->url()->fromRoute('default', array('action' => 'form' )) );
        return array( 'form' => $form ); // ici le viewManager est celui par défaut il est initialisé avec les valeurs retournées
    }

    public function traiteAction()
    {
        return array( 'login' => $_GET['log'] );
    }
}