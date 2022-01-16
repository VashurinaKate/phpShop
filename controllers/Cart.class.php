<?php
include_once('models/M_Cart.class.php');
include_once('models/M_User.class.php');

class Cart extends Base
{
    public function action_index() {
		$this->title .= 'Корзина';
        $cart = new M_Cart();
        $user = new M_User();
        $userId = $user->getUserId();
        $cartGoods = $cart->getCart($userId);
        if ($cartGoods) {
            $info = "Your cart";
            $this->content = $this->Template('views/cart.php', array('cartGoods' => $cartGoods, 'info' => $info));
        } else {
            $info = "Ваша корзина пуста";
            $this->content = $this->Template('views/cart.php', array('info' => $info));
        }
	}

    public function action_add_to_cart() {
		$this->title .= 'Корзина';
        $cart = new M_Cart();
        $user = new M_User();
        $userId = $user->getUserId();
        $goodId = (int)$_GET['id'];
        if ($cart->addToCart($userId, $goodId)) {
            $addition_info = "Товар успешно добавлен!";
            $this->content = $this->Template('views/cart.php', array('addition_info' => $addition_info));
        } else {
            $addition_info = "Что-то пошло не так";
            $this->content = $this->Template('views/cart.php', array('addition_info' => $addition_info));
        }
	}

    public function action_remove_from_cart($id) {
		$this->title .= 'Корзина';
        $cart = new Cart;
        $id = (int)$_GET['id'];
        $cart->removeFromCart($id);
		$this->content = $this->Template('views/cart.php', array('cartGoods' => $cartGoods));
	}

}
