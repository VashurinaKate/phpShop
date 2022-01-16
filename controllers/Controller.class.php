<?php
abstract class Controller
{
	protected abstract function render();
	protected abstract function before();
	
	public function Request($action)
	{
		$this->before();
		$this->$action();
		$this->render();
	}

	protected function IsGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}

	protected function IsPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}	
	
	public function __call($name, $params){
		echo $name;
		echo $params;
        die('Не пишите фигню в url-адресе!!!');
	}
}
