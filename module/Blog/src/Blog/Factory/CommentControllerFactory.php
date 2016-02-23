<?php

namespace Blog\Factory;

use Blog\Controller\PostController;
use Blog\Controller\CommentController;
use Blog\Form\CommentForm;
use Blog\Form\EditPostForm;
use Blog\Form\AddPostForm;
use Blog\Service\CommentService;
use Blog\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommentControllerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return CommentController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $formElementManager = $serviceLocator->get('formElementManager');
        /** @var PostService $postService */
        $postService = $serviceLocator->get('Blog\Service\Post');
        /** @var CommentService $commentService */
        $commentService = $serviceLocator->get('Blog\Service\Comment');
        /** @var CommentForm $commentForm */
        $commentForm = $formElementManager->get('Blog/Form/Comment');
        /** @var EditPostForm $editPostForm */
        $editPostForm = $formElementManager->get('Blog/Form/EditPost');
        /** @var AddPostForm $addPostForm */
        $addPostForm = $formElementManager->get('Blog/Form/AddPost');

        return new CommentController($postService, $commentService, $commentForm, $editPostForm, $addPostForm);
    }
}
