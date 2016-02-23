<?php
return array(
    'invokables' => array(

    ),
    'factories' => array(
        'Blog\Controller\Connexion' => 'Blog\Factory\ConnexionControllerFactory',
        'Blog\Controller\Inscription' => 'Blog\Factory\InscriptionControllerFactory',
        'Blog\Controller\Post'      => 'Blog\Factory\PostControllerFactory',
        'Blog\Controller\Comment'   => 'Blog\Factory\CommentControllerFactory',
    )
);
