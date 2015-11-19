<?php
namespace MiniModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;


class Module implements ConfigProviderInterface, BootstrapListenerInterface, AutoloaderProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . "/config/module.config.php";
    }

    public function onBootstrap(EventInterface $e)
    {
        // Récupération des erreurs en ajoutant un callback qui affiche l'erreur coté serveur
        $application = $e->getTarget();
        $event = $application->getEventManager();
        $event->attach(MvcEvent::EVENT_DISPATCH_ERROR, function (MvcEvent $e) {
            error_log('DISPATCH_ERROR : ' . $e->getError());
            error_log($e->getControllerClass() . ' ' . $e->getController());
        });
        $event->attach(MvcEvent::EVENT_RENDER_ERROR, function (MvcEvent $e) {
            error_log('RENDER_ERROR : ' . $e->getError());
        });

        $event->attach(MvcEvent::EVENT_RENDER, function (MvcEvent $e) {
            $services = $e->getApplication()->getServiceManager();
            $session = $services->get('session');
            $rightViewModel = new ViewModel();
            if (!isset($session->user)) {
                $form = $services->get('MiniModule\Form\Authentification');
                $formUser = $services->get('MiniModule\Form\NewUser');
                $rightViewModel->setVariables(array('form' => $form, 'newUserForm' => $formUser));
                $rightViewModel->setTemplate('layout/form-auth');
            } else {
                $rightViewModel->setVariables(array('user' => $session->user));
                $rightViewModel->setTemplate('layout/info-auth');
            }
            $view = $e->getViewModel(); // c'est le viewModel qui contient le layout (top viewModel)
            $view->addChild($rightViewModel, 'formulaireAuth');
        });

    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}