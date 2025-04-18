<?php

namespace App\Models;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $giohang = ['qty' => 0, 'price' => $item->unit_price, 'product' => $item];
        if ($this->items && array_key_exists($id, $this->items)) {
            $giohang = $this->items[$id]; 
        }
        $giohang['qty']++;
        $giohang['price'] = $item->unit_price * $giohang['qty']; 

        $this->items[$id] = $giohang;
        $this->totalQty++;
        $this->totalPrice += $item->unit_price;
    }
    //xóa 1            
    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['product']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['product']['price'];
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }
    //xóa nhiều
    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
    //cộng một 
    public function increase($id)
    {
        $this->items[$id]['qty'] ++;
        $this->items[$id]['price'] += $this->items[$id]['product']['price'];
        $this->totalPrice +=  $this->items[$id]['product']['price'];
        $this->totalQty++;
    }
}
