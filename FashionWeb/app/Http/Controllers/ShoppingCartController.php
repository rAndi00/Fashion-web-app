<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    /**
     * Display the shopping cart for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = ShoppingCart::where('user_id', Auth::id())->get();

        return view('shopping_cart.index', compact('cartItems'));
    }

    /**
     * Add a product to the shopping cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Check if the product is already in the cart
        $cartItem = ShoppingCart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Update quantity if product is already in the cart
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create a new cart item
            ShoppingCart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('shopping_cart.index')->with('success', 'Product added to cart.');
    }

    /**
     * Update the quantity of a product in the shopping cart.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cartItem = ShoppingCart::find($id);

        if (!$cartItem || $cartItem->user_id !== Auth::id()) {
            return redirect()->route('shopping_cart.index')->with('error', 'Cart item not found.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('shopping_cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove a product from the shopping cart.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $cartItem = ShoppingCart::find($id);

        if (!$cartItem || $cartItem->user_id !== Auth::id()) {
            return redirect()->route('shopping_cart.index')->with('error', 'Cart item not found.');
        }

        $cartItem->delete();

        return redirect()->route('shopping_cart.index')->with('success', 'Product removed from cart.');
    }
}
