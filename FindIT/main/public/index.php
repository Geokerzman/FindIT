<?php
require_once '../app/bootstrap.php';
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(['../app/views', '../app/views/inc', '../app/views/pages' ,'../app/views/posts','../app/views/users']);
$twig = new \Twig\Environment($loader);

// Init Core Library
$init = new Core;


echo $twig->render('inc/footer.twig');
echo $twig->render('inc/header.twig');
echo $twig->render('inc/navbar.twig');
echo $twig->render('pages/about.twig');
echo $twig->render('pages/index.twig');
echo $twig->render('posts/add.twig');
echo $twig->render('posts/edit.twig');
echo $twig->render('posts/index.twig');
echo $twig->render('posts/show.twig');
echo $twig->render('users/register.twig');
echo $twig->render('login.twig');





?>
