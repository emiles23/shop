<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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

        // dd($discountedPrice);
        $discountedPrice = $product->price - $product->discountValue();

        $cart = Cart::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();
        // dd($cart);
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

        // Obtener todos los productos en el carrito del usuario autenticado
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $total = 0;
        $userId = Auth::id();

        // Primero calculamos el total sin descuentos
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        // Obtenemos las marcas que tienen productos en el carrito
        $brands = Brand::whereHas('products.carts', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Aplicamos descuentos por marca
        foreach ($brands as $brand) {
            $totalByBrand = 0;

            // Calculamos el subtotal para esta marca
            foreach ($brand->products as $product) {
                foreach ($product->carts as $cartItem) {
                    if ($cartItem->user_id == $userId) {
                        $totalByBrand += $cartItem->price * $cartItem->quantity;
                    }
                }
            }

            // Aplicamos descuentos a este subtotal de marca
            foreach ($brand->discounts as $discount) {
                if ($totalByBrand >= $discount->min) {
                    if ($discount->type === 1) { // Descuento fijo
                        $total -= $discount->value;
                    } elseif ($discount->type === 0) { // Descuento porcentual
                        $total -= ($totalByBrand * $discount->value) / 100;
                    }
                }
            }
        }

        // Mostrar el total final con todos los descuentos aplicados
        dd($total,  $totalByBrand); // <-- AQUÍ PUEDES COLOCAR EL dd() PARA VER EL RESULTADO

        // Ahora $total contiene el monto correcto con los descuentos aplicados


        // debuguiar

        // Retornar una respuesta con el total
        // $total = $this->calculateTotal();
        // return response()->json([
        //     'message' => 'Producto agregado al carrito.',
        //     'total' => $total,
        // ]);

        // Redirigir de vuelta a la vista de productos con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    // public function calculateTotal()
    // {
    //     // Obtener todos los productos en el carrito del usuario autenticado
    //     $cartItems = Cart::where('user_id', Auth::id())->get();

    //     // Calcular el total
    //     $total = 0;
    //     foreach ($cartItems as $item) {
    //         $total += $item->price * $item->quantity;
    //     }
    //     return $total;
    // }
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
