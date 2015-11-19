<?php
return array(
  'mini-module\form\new_user' => array(
      'elements' => array(
        array(
            'spec' => array(
                'type' => '\MiniModule\Form\Element\Login',
            )
        ),
          array(
              'spec' => array(
                  'type' => '\Zend\Form\Element\Captcha',
                  'name' => 'newUserCaptcha',
                  'options' => array(
                      'label' => 'Vérification que vous êtes un humain.',
                      'captcha' => array(
                          'class' => 'Dumb',
                      ),
                  ),
              ),
          ),
      ),
  )
);