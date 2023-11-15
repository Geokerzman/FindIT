<?php
  require_once '../app/bootstrap.php';
  require_once '../vendor/autoload.php';

  $loader = new \Twig\Loader\FilesystemLoader('../app/views');
  $twig = new \Twig\Environment($loader);
  

  // Init Core Library
  $init = new Core;