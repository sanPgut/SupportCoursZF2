<?php
namespace MiniModule;

use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;


/**
 * Class IndexController
 * La class est temporairement déclarée dans Module.php
 * dans le prochain commit elle sera au bon endroit mais cela nécéssite d'ajouter un loader dans l'autoload
 * @package MiniModule
 */
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
    }

}