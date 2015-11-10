<?php
namespace MiniModule;

use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\Literal;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }
}

class Module implements ConfigProviderInterface, BootstrapListenerInterface
{

    public function getConfig()
    {
        return include __DIR__ . "/config/module.config.php";
    }

    public function onBootstrap(EventInterface $e)
    {
        // $e->getTarget() renvoit Zend\MVC\Application
        $application = $e->getTarget();
        $sm = $application->getServiceManager();
        $event = $application->getEventManager();
        $event->attach(MvcEvent::EVENT_DISPATCH_ERROR, function (MvcEvent $e) {
            error_log('DISPATCH_ERROR : ' . $e->getError());
            error_log($e->getControllerClass() . ' ' . $e->getController());
        });
        $event->attach(MvcEvent::EVENT_RENDER_ERROR, function (MvcEvent $e) {
            error_log('RENDER_ERROR : ' . $e->getError());
        });

        $route = $sm->get('Router');
        $route->addRoute('home', Literal::factory(array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'MiniModule\Controller\IndexController',
                    'action' => 'index')
            )
        )
        );

        $controller = $sm->get('ControllerManager');
        $controller->setService('MiniModule\Controller\IndexController', new IndexController());
    }

}