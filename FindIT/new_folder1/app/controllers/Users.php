<?php
class Users extends Controller {
  private $userModel;

  public function __construct(){
      $this->userModel = $this->model('User');
  }

  public function register(){
      // Проверяем, была ли отправлена форма
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Обрабатываем форму регистрации

          // Получаем данные из формы
          $data = [
              'name' => trim($_POST['name']),
              'email' => trim($_POST['email']),
              'password' => trim($_POST['password']),
              'confirm_password' => trim($_POST['confirm_password']),
              'name_err' => '',
              'email_err' => '',
              'password_err' => '',
              'confirm_password_err' => ''
          ];

          // логика валидации данных может быть добавлена здесь

          // Пытаемся зарегистрировать пользователя
          if ($this->userModel->register($data)) {
              // Регистрация прошла успешно
              flash('register_success', 'You are registered and can log in');
              redirect('users/login');
          } else {
              // Что-то пошло не так
              die('Something went wrong');
          }
      } else {
          // Если это не POST-запрос, вы могли бы отобразить форму регистрации
          // Например, используя $this->view('users/register');
      }
  }

  public function login(){
      // Оставляем ваш существующий код для обработки входа пользователя
  }

  public function logout(){
      // Оставляем ваш существующий код для выхода пользователя
  }
}
