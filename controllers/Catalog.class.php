<?php
include_once('models/M_Catalog.class.php');
class Catalog extends Base
{
	public function action_index(){
	    $model = new M_Catalog();
		$goods = $model->getGoods(25);
		$this->title .= 'Каталог';
		$this->content = $this->Template('views/catalog.php', array('goods' => $goods, 'count' => count($goods)));
	}
}
