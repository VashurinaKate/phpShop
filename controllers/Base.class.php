<?php
//
// Базовый контроллер сайта.
//
abstract class Base extends Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы
    protected $keyWords;

    protected function before() {
		$this->title = '';
		$this->content = '';
		$this->keyWords="";
	}
	
	//
	// Генерация базового шаблонаы
	//	
	public function render()
	{
		$user = new M_User();
        
        if (isset($_SESSION['user_id'])) {
            $userInfo = $user -> getUserData($_SESSION['user_id']);
        } else {
            $userInfo['name'] = false;
        }

		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader); 
        $template = $twig -> loadTemplate('main.twig');
        $vars = array(
            'title' => $this->title,
            'content' => $this->content, 
            'kw' => $this->keyWords,
			'user' => $userInfo['name']
        );
        echo $template -> render($vars);
	}
}
