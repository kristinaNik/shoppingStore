<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 6/1/19
 * Time: 3:45 PM
 */

namespace App;


class Cart
{
    public $items = null;
    public $totalQuantity= 0;
    public $totalPrice = 0;

    /**
     * Cart constructor.
     * @param $oldCart
     */
    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * @param $item
     * @param $id
     */
    public function add($item, $id) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice+= $item->price;
    }

    public function reduceByOne($id) {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQuantity--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id) {
        $this->totalQuantity -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
