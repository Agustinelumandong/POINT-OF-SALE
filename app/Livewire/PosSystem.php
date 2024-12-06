<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;

class PosSystem extends Component
{
    public function addToCart($id, $name, $price, $code, $image)
    {
        Cart::add([
            'id' => $id,
            'name' => $name,
            'qty' => 1,
            'price' => $price,
            'options' => ['code' => $code, 'image' => $image]
        ]);
    }

    public function incrementQty($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty + 1);
    }

    public function decrementQty($rowId)
    {
        $item = Cart::get($rowId);
        if ($item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
        }
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
    }

    public function render()
    {
        return view('livewire.pos-system', [
            'cartItems' => Cart::content(),
            'total' => Cart::total(),
            'product' => Product::with('productCategory')->get()
        ]);
    }
}
