<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Muestra los productos en el carrito del usuario autenticado.
     */

    public function index()
    {
        // Obtener el ID del usuario autenticado
        $user_id = Auth::id();

        // Obtener los productos en el carrito del usuario
        $cartItems = Cart::where('user_id', $user_id)->with('product')->get();

        // Calcular el total del carrito
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        // Pasar los datos a la vista
        return Inertia::render('Cart/Index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    /**
     * Agrega un producto al carrito.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener el producto
        $product = Product::findOrFail($request->product_id);

        // dd($product);
        $discountedPrice = $product->price - $product->discountValue();

        $cart = Cart::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {

            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            // Crear un nuevo registro en el carrito
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $discountedPrice, // Asumimos que el precio del producto es fijo           
            ]);
        }

        // Redirigir de vuelta a la vista de productos con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    /**
     * Elimina un producto del carrito.
     */
    // public function destroy($id)
    // {
    //     // Buscar el producto en el carrito
    //     $cartItem = Cart::findOrFail($id);

    //     // Verificar que el producto pertenece al usuario autenticado
    //     if ($cartItem->user_id !== Auth::id()) {
    //         return redirect()->route('cart.index')->with('error', 'No tienes permiso para eliminar este producto.');
    //     }

    //     // Eliminar el producto del carrito
    //     $cartItem->delete();

    //     // Redirigir al carrito con un mensaje de éxito
    //     return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    // }
}
