<?php

namespace Blog\Factory;

use Blog\Controller\InscriptionController;
use Blog\Form\InscriptionForm;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InscriptionControllerFactory implements FactoryInterface
{

    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return InscriptionController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator     = $serviceLocator->getServiceLocator();
        $formElementManager = $serviceLocator->get('formElementManager');
        /** @var inscriptionForm $inscriptionForm */
        $inscriptionForm = $formElementManager->get('Blog/Form/Inscription');
        /** @var AuthenticationService $authenticationService */
        $authenticationService = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        return new InscriptionController($inscriptionForm, $authenticationService);
    }
}