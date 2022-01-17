<?php
class User extends Base {
	public function action_invite() {
		$this->title .= 'Welcome';
		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader);
		$template = $twig -> loadTemplate('invitation.twig');
		echo $template -> render(array()); // как можно определить $this->content?
	}

	public function action_account() {
		$this->title .= 'Личный кабинет';
		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader);
		$template = $twig -> loadTemplate('account.twig');
		echo $template -> render(array());
	}

	public function action_logout() {
		$this->title .= 'Приглашение';
		$user = new M_User();
		$user->logout();
		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader);
		$template = $twig -> loadTemplate('invitation.twig');
		echo $template -> render(array());
	}

	public function action_reg() {
		$this->title .= 'Регистрация';
		$user = new M_User();

		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader);
		$template = $twig -> loadTemplate('regForm.twig');

		// if ($this -> IsPost()) {
		// 	// $user = new M_User();
		// 	$info = "Вы успешно зарегистрированы!";
		// 	$res = $user -> regUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
		// 	echo $template -> render(array('content' => $res, 'info' => $info));
		// } else {
		// 	$info = 'Что-то пошло не так, попробуйте еще раз';
		// 	echo $template -> render(array('info' => $info));
		// }

		if ($this -> IsPost()) {
			if ($user->regUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'])) {
				$info = "Вы успешно зарегистрированы!";
				$template = $twig -> loadTemplate('invitation.twig');
				$vars = array(
					'info' => $info
				);
				echo $template -> render($vars);
			} else {
				$info = 'Пользователь с таким логином уже существует'; // ?????
				$template = $twig -> loadTemplate('regForm.twig');
				$vars = array('info' => $info);
				echo $template -> render($vars);
			}
		} else {
			$info = 'Что-то пошло не так, попробуйте еще раз'; // ?????
			$template = $twig -> loadTemplate('regForm.twig');
			echo $template -> render(array('info' => $info));
		}
	}

	public function action_auth() {
		$this->title .= 'Вход';
        $user = new M_User();

		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader); 
        
        if ($_POST) {
			$userData = $user->auth($_POST['email'], $_POST['password']);
			if ($userData) {
				$info = 'Вы успешно вошли в аккаунт!';
				$template = $twig -> loadTemplate('account.twig');
				$vars = array(
					'info' => $info,
					'email' => $email,
					'userData' => $userData
				);
				echo $template -> render($vars);
			} 
			else {
				$info = 'Неправильно введен логин или пароль';
				$template = $twig -> loadTemplate('authForm.twig');
				$vars = array(
					'info' => $info,
				);
				echo $template -> render($vars);
			}
		}
		else {
			$template = $twig -> loadTemplate('authForm.twig');
			echo $template -> render(array());
		}
	}
}
