<?php
class M_User {
    // protected $userId, $userLogin, $userName, $userPassword;

    // public function __construct(){}
    public function setPass($email, $password) {
	    return strrev(md5($email)) . md5($password);
    }

    public function getUserData($id)
    {
        $query = "SELECT * FROM users WHERE id=" . $id;
        $res = M_Pdo::Instance() -> Select($query);
        return $res;
    }

	function auth($email, $password) {
	    $query = "SELECT * FROM users WHERE email='". $email . "'";
        $res = M_Pdo::Instance() -> Select($query);
        if ($res) {
            if ($res['password'] == $this -> setPass($email, $password)) {
            $_SESSION['user_id'] = $res['id'];
            //     return 'Добро пожаловать в систему, ' . $res['name'] . '!';
            return true;
            } else {
            //     return 'Пароль не верный!';
                return false;
            }
        } 
        else {
            // return 'Пользователь с таким логином не зарегистрирован!';
            return false;
        }
    }

    function logout() {
        $_SESSION = array();
        session_destroy();
    }

    function regUser($name, $surname, $email, $password) {
        $query = "SELECT * FROM users WHERE email = '" . $email . "'";
        $res = M_Pdo::Instance() -> Select($query);
        if (!$res) {
            $password = $this -> setPass($email, $password);
            $object = [
              'name' => $name,
              'surname' => $surname,
              'email' => $email,
              'password' => $password
            ];
            $res = M_Pdo::Instance() -> Insert('users', $object);
            if (is_numeric($res)) {
                // return "regUser(): Регистрация прошла успешно.";
                return true;
            } else {
                // return "regUser(): Регистрация прервалась ошибкой.";
                return false;
            }
        } else {
            // return "regUser(): Пользователь уже существует.";
            return false;
        }
    }
}
