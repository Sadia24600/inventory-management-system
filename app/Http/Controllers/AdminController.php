<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Products;
use App\Models\Order;
class AdminController extends Controller
{
    public function addCategory()
    {
        return view ('admin.addcategory');
    }

    public function postAddCategory(Request $request)
    {
       $category = new Category();
       $category->category_name = $request->category_name;
       $category->save();
        return redirect('/viewcategory')->with("success","Category Added Successfully");
    }

    public function viewCategory()
    {
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with("success","Category Deleted Successfully");
    }

    public function updateCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.updatecategory', compact('category'));
    }

    public function postUpdateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->save();
        return redirect('/viewcategory')->with("success","Category Updated Successfully");
    }

    public function addSupplier()
    {
        return view('admin.addsupplier');
    }

     public function postAddSupplier(Request $request)
    {
       $supplier = new Supplier();
       $supplier->supplier_name = $request->supplier_name;
       $supplier->supplier_email = $request->supplier_email;
       $supplier->supplier_contact = $request->supplier_contact;
       $supplier->save();
        return redirect('/viewsupplier')->with("success","Supplier Added Successfully");
    }

     public function viewSupplier()
    {
        $suppliers = Supplier::all();
        return view('admin.viewsupplier', compact('suppliers'));
    }

        public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->back()->with("success","Supplier Deleted Successfully");
    }

    public function updateSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.updatesupplier', compact('supplier'));
    }

    public function postUpdateSupplier(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->supplier_email = $request->supplier_email;
        $supplier->supplier_contact = $request->supplier_contact;
        $supplier->save();
        return redirect('/viewsupplier')->with("success","Supllier updated Successfully");
    }

     public function addProduct()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.addproduct', compact('categories', 'suppliers'));
    }

    public function postAddProduct(Request $request)
    {
        $product = new Products();
        $image =  $request->product_image;
        if($image){
            $new_img_name = time(). '.' . $image->getClientOriginalExtension();
            $product->product_image = $new_img_name;
        }
       
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->category_name = $request->category_name;
        $product->supplier_name = $request->supplier_name;

        $product->save();

        if($image && $product->product_image){
            $request->product_image->move('db_img', $new_img_name);
        }
        return redirect('/viewproduct')->with('success', 'Product added successfully!');
    }

    public function viewProduct()
    {
        $products = Products::all();
        return view('admin.viewproduct', compact('products'));
    }

    public function deleteProduct($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function updateProduct($id)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $product = Products::findOrFail($id);
        return view('admin.updateproduct', compact('product', 'categories', 'suppliers'));   
    }

    public function postUpdateProduct(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $image = $request->product_image;

        if ($image) {
            $new_img_name = time() . '.' . $image->getClientOriginalExtension();
            $product->product_image = $new_img_name;
        }

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->category_name = $request->category_name;
        $product->supplier_name = $request->supplier_name;

        $product->save();

        if ($image && $product->product_image) {
            $request->product_image->move('db_img', $new_img_name);
        }

        return redirect('/viewproduct')->with('success', 'Product updated successfully!');
    }

    public function viewOrders()
    {
        $orders = Order::all();
        $products = Products::all();
        return view('admin.orders',compact('products','orders'));
    }

    public function postOrders($id)
    {
        $product = Products::findOrFail($id);
        $quantity=1;
        
        $order = Order::where('product_id', $product->id)->first();
        if($order)
            {
                $order->product_quantity += $quantity;
            }
            else{
                $order = new Order();
                $order->product_id=$product->id;
                $order->product_name=$product->product_name;
                $order->product_quantity=$product->product_quantity;
                $order->product_price=$product->product_price;
            }
            $order->save();
            $product->product_quantity -= 1;
            $product->save();
            return redirect('/orders');
    }

    public function updateQuantity(Request $request , $id)
    {
        $order = Order::findOrFail($id);
        $product = Products::findOrfail($order->product_id);

        $newQty = $request->input('product_quantity');
        $oldQty = $order->product_quantity;

        // Calculate Difference
        $diff = $newQty - $oldQty;

        //Update Order Quantity
        $order->product_quantity = $newQty;
        $order->save();

        //If user increased order quantity , decrease stock
        if($diff >0)
            {
                $product->product_quantity -=$diff;
            }
            // If user decrease product quantity , return stock
            else if ($diff < 0)
                {
                    $product->product_quantity += abs($diff);
                }
                $product->save();
                return redirect()->back();
    }

    public function removeOrder($id)
    {
        $order = Order::findOrFail($id);
        $quantity = $order->product_quantity;
        $product = Products::findOrFail($order->product_id);
        $product->product_quantity += $quantity;
        $product->save();
        $order->delete();
        return redirect()->back();
    }
}
