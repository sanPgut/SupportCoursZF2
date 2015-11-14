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

    // la clef se trouve dans module.config.php du module GMaps cloner dans le répertoire vendor
    // https://github.com/gowsram/zf2-google-maps-.git
    public function gmapsAction()
    {
        $markers = array(
            'Pôle Universitaire' => '49.836746,3.299840',
            'Home Town' => '49.849523, 3.287594'
        );
        $config = array(
            'sensor' => 'true',         //true or false
            'div_id' => 'map',          //div id of the google map
            'div_class' => 'grid_6',    //div class of the google map
            'zoom' => 13,                //zoom level
            'width' => "600px",         //width of the div
            'height' => "300px",        //height of the div
            'lat' => 49.836746,         //lattitude
            'lon' => 3.299840,         //longitude
            'animation' => 'none',      //animation of the marker
            'markers' => $markers,
        );

        $map = $this->getServiceLocator()->get('GMaps\Service\GoogleMap');
        $map->initialize($config);                                         //loading the config
        $html = $map->generate();                                          //genrating the html map content
        return array('map_html' => $html);
    }
}