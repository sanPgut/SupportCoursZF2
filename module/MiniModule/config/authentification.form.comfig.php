<?php

return array(
    'elements' => array(
        // la saisie du login (type text)
        array(
            'spec' => array(
                'type' => 'Zend\Form\Element\Text',
                'name' => 'log',
                'attributes' => array(
                    'size' => '20',
                ),
                'options' => array(
                    'label' => 'Login : ',
                ),
            ),
        ),
        // le boutton de validation
        array(
            'spec' => array(
                'type' => 'Zend\Form\Element\Submit',
                'name' => 'submit',
                'attributes' => array(
                    'value' => 'Suite',
                ),
            ),
        ),
    ),
);