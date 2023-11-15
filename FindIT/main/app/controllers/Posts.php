<?php
 require_once '../app/helpers/session_helper.php';

 $loader = new \Twig\Loader\FilesystemLoader('../app/views');
$twig = new \Twig\Environment($loader);

 class Posts extends Controller {
     public function __construct(){
         if(!isLoggedIn()){
             redirect('users/login');
         }
 
         $this->postModel = $this->model('Post');
         $this->userModel = $this->model('User');
     }

    public function index(){
        // Получаем посты
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Санитизация POST-запроса
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_COOKIE['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Валидация данных
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body text';
            }

            // Убедитесь, что ошибок нет
            if(empty($data['title_err']) && empty($data['body_err'])){
                // Валидация пройдена
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Загрузка представления с ошибками
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];

            $this->view('posts/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Санитизация POST-запроса
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_COOKIE['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Валидация данных
            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'Please enter body text';
            }

            // Убедитесь, что ошибок нет
            if(empty($data['title_err']) && empty($data['body_err'])){
                // Валидация пройдена
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Загрузка представления с ошибками
                $this->view('posts/edit', $data);
            }

        } else {
            // Получение существующего поста из модели
            $post = $this->postModel->getPostById($id);

            // Проверка на владельца
            if($post->user_id != $_COOKIE['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
    }

    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Получение существующего поста из модели
            $post = $this->postModel->getPostById($id);

            // Проверка на владельца
            if($post->user_id != $_COOKIE['user_id']){
                redirect('posts');
            }

            if($this->postModel->deletePost($id)){
                flash('post_message', 'Post Removed');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }
}

