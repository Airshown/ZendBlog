<?php

namespace Blog\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class InscriptionForm extends Form
{
    public function init()
    {
        $this->add(
            array(
                'name' => 'user',
                'type' => 'Blog\Form\Fieldset\UserFieldset',
                'options' => array(
                    'use_as_base_fieldset' => true,
                ),
            )
        );

        $this->setValidationGroup(
            array(
                'user' => array(
                    'name',
                    'fname',
                    'email',
                    'login',
                    'password',
                )
            )
        );

        $this->add(
            array(
                'name' => 'submit',
                'attributes' => array(
                    'type' => 'submit',
                    'value' => 'SUBMIT_LOGIN',
                    'class' => 'btn btn-lg btn-primary btn-block',
                ),
            )
        );

        $this->setAttribute('class', 'form-signin');
    }
}