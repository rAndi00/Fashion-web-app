<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the wishlist.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all wishlist items for the authenticated user
        $wishlistItems = Wishlist::with('product')->where('user_id', auth()->id())->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Store a newly created wishlist item in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Add product to the user's wishlist
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist.');
    }

    /**
     * Remove the specified product from the wishlist.
     *
     * @param \App\Models\Wishlist $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        // Ensure the user is trying to delete their own wishlist item
        if ($wishlist->user_id !== auth()->id()) {
            return redirect()->route('wishlist.index')->with('error', 'Unauthorized action.');
        }

        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist.');
    }
}
