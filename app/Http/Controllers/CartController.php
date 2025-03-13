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

        $userId = Auth::id();
        $brands = Brand::whereHas('products.carts', function ($query) use ($userId) {
            $query->where('user_id', $userId); // Filtrar por el ID del usuario
        })
            ->get();

        $subtotal =  $this->calculateTotal();
        $total = 0;
        
        foreach ($brands as $brand) {
            $totalBybrand = 0;
            foreach ($brand->carts as $cart) {
                $totalBybrand +=  $cart->price * $cart->quantity;
            }
            foreach ($brand->discounts as $discount) {
               
                if ($totalBybrand >=  $discount->min) {
                    if ($discount->type === 1) {
                        // Descuento fijo
                        $total += $subtotal - $discount->value ;
                    } elseif ($discount->type === 0) {
                        // Descuento porcentual
                        $total += $subtotal - ($subtotal * $discount->value) / 100 ;
                    }
                }else $total += $subtotal;
            }
        }


        // dd($brands->toArray());
        // dd($totalBybrand);
        // Calcular el total a pagar


        // debuguiar

        // Retornar una respuesta con el total
        // $total = $this->calculateTotal();
        // return response()->json([
        //     'message' => 'Producto agregado al carrito.',
        //     'total' => $total,
        // ]);

        //Retornar una respuesta con el precio con descuento aplicado
        // return response()->json([
        //     'message' => 'Precio con descuento.',
        //     'total' => $discountedPrice,
        // ]);


        // Retornar una respuesta  'arreglo' con las marcas aplicadas
        // $brand = $this->groupProductsByBrand();
        // return response()->json([
        //     'message' => 'Productos por marcas',
        //     'arreglo' => $brand,
        // ]);

        // Redirigir de vuelta a la vista de productos con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function calculateTotal()
    {
        // Obtener todos los productos en el carrito del usuario autenticado
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Calcular el total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    // agrupar los productos por marac
    // public function groupProductsByBrand()
    // {
    //     // Obtener el ID del usuario autenticado
    //     $userId = Auth::id();

    //     // Obtener los productos en el carrito del usuario con sus relaciones
    //     $cartItems = Cart::with(['product.brand'])
    //         ->where('user_id', $userId)
    //         ->get();

    //     // Agrupar los productos por marca
    //     $groupedByBrand = [];

    //     foreach ($cartItems as $item) {
    //         $brandName = $item->product->brand->name; // Nombre de la marca
    //         $productName = $item->product->name;      // Nombre del producto
    //         $quantity = $item->quantity;              // Cantidad del producto
    //         $price = $item->price;                   // Precio con descuento

    //         // Si la marca no existe en el arreglo, la inicializamos
    //         if (!isset($groupedByBrand[$brandName])) {
    //             $groupedByBrand[$brandName] = [
    //                 'products' => [],
    //                 'total' => 0,
    //             ];
    //         }

    //         // Agregar el producto a la marca correspondiente
    //         $groupedByBrand[$brandName]['products'][] = [
    //             'name' => $productName,
    //             'quantity' => $quantity,
    //             'price' => $price,
    //         ];

    //         // Sumar al total de la marca
    //         $groupedByBrand[$brandName]['total'] += $price * $quantity;
    //     }
    //     // $discountedPrice = $product->price - $product->discountValue();

    //     // //    Retornar una respuesta con el total
    //     // return response()->json([
    //     //     'message' => 'Producto agregado al carrito.',
    //     //     'total' => $groupedByBrand,
    //     // ]);
    //     return $groupedByBrand;
    // }














    // public function calculateSubtotalByBrand($product, $cart)
    // {
    //     $totalConDescuentosProductos = 0;
    //     foreach ($cart->product_id as $product) {
    //         $totalConDescuentosProductos += discountValue();
    //     }
    // }



    // dd(calculateTotal());
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
