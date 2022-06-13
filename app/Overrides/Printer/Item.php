<?php

namespace App\Overrides\Printer;

class Item
{
    private $name;
    private $qty;
    private $price;
    private $currency = 'BDT';

    function __construct($name, $qty, $price) {
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function getQty() {
        return $this->qty;
    }

    public function getPrice() {
        return $this->price;
    }

    public function __toString()
    {
        $right_cols = 20;
        $left_cols = 26;

        $item_price = number_format($this->price, 0, '.', ',').' '.$this->currency ;
        $item_subtotal = number_format($this->price * $this->qty, 0, '.', ',').' '.$this->currency;

        $print_name = ' '.str_pad($this->name, 40) ;
        $print_priceqty = ' '.str_pad($item_price . ' x ' . $this->qty, $left_cols);
        $print_subtotal = str_pad($item_subtotal, $right_cols, ' ', STR_PAD_LEFT);

        return "$print_name\n$print_priceqty$print_subtotal\n";
    }
}
