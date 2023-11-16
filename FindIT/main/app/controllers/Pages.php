<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('posts');
      }

      $data = [
        'title' => '<h1 class = "main-screen">SharePosts<h1>',
        'description' => 'Look for a job or share an opportunity for ukrainian market'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share job posts with other ukrainians'
      ];

      $this->view('pages/about', $data);
    }
  }

  