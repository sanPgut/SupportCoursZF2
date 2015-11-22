<?php
namespace MiniModule\Controller;

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
                $services->get('session')->user = $form->get('login')->getValue();
                $vm = new ViewModel();
                $vm->setVariables( $form->getData() );
                $vm->setTemplate('mini-module/index/index');
                return $vm;
            }
        }
        return array( );
    }
    public function deconnectAction()
    {
        $services = $this->getServiceLocator();
        unset($services->get('session')->user);
        return $this->redirect()->toRoute('home');

    }

    public function inscriptionAction()
    {
        $services = $this->getServiceLocator();
        $form = $services->get('MiniModule\Form\NewUser');
        if ( $this->getRequest()->isPost() ) {
            $form->setData( $this->getRequest()->getPost());
            if ($form->isValid()) {
                $services->get('session')->user = $form->get('login')->getValue();
                return $this->redirect()->toRoute('default', array('action'=>'index'))->setStatusCode(205);
            }
        }
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('formAuth' => $form ))
                  ->setTerminal(true);
        return $viewModel;
    }
}