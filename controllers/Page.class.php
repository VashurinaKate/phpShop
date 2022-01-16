<?php
class Page extends Base
{
	public function action_index() {
		$this->title .= 'Главная';
        $slogan = "The Brand Of Lux Fashion";
        $model = new M_Catalog;
        // $goods = $model->getGoods(15);

		$loader = new Twig_Loader_Filesystem('views'); 
        $twig = new Twig_Environment($loader); 
        $template = $twig -> loadTemplate('index.twig');
        $vars = array(
            'slogan' => $slogan,
			// 'goods' => $goods,
			// 'count' => count($goods)
        );
        echo $template -> render($vars);
	}
}
