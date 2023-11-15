<?php
class Users extends Controller {
  public function __construct(){
      $this->userModel = $this->model('User');
  }

  public function register(){
      // ... (оставим код регистрации без изменений)

      if($this->userModel->register($data)){
          flash('register_success', 'You are registered and can log in');
          redirect('users/login');
      } else {
          die('Something went wrong');
      }
  }

  public function login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $data = [
              'email' => trim($_POST['email']),
              'password' => trim($_POST['password']),
              'email_err' => '',
              'password_err' => '',
          ];

          if(empty($data['email'])){
              $data['email_err'] = 'Please enter email';
          }

          if(empty($data['password'])){
              $data['password_err'] = 'Please enter password';
          }

          if($this->userModel->findUserByEmail($data['email'])){
              $loggedInUser = $this->userModel->login($data['email'], $data['password']);

              if($loggedInUser){
                  // Создаем куки для пользователя
                  setcookie('user_id', $loggedInUser->id, time() + 3600, "/");
                  setcookie('user_email', $loggedInUser->email, time() + 3600, "/");
                  setcookie('user_name', $loggedInUser->name, time() + 3600, "/");

                  redirect('posts');
              } else {
                  $data['password_err'] = 'Password incorrect';
                  $this->view('users/login', $data);
              }
          } else {
              $data['email_err'] = 'No user found';
              $this->view('users/login', $data);
          }
      } else {
          $data =[    
              'email' => '',
              'password' => '',
              'email_err' => '',
              'password_err' => '',        
          ];

          $this->view('users/login', $data);
      }
  }

  public function logout(){
      // Удаляем куки пользователя
      setcookie('user_id', '', time() - 3600, "/");
      setcookie('user_email', '', time() - 3600, "/");
      setcookie('user_name', '', time() - 3600, "/");
      
      redirect('users/login');
  }
}

