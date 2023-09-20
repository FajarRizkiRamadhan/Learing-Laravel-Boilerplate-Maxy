<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrderLine;
use Validator;
use \DateTime;


use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function getProductList(){
        $products = Product::paginate(10);
        return view('admin.products.index', ["products" => $products]);
    }
    public function getProdcutShow(){
        return view('admin.products.index');
    }
    public function getProdcutEdit(){
        return view('admin.products.index');
    }
    public function getProdcutDestroy(){
        return view('admin.products.index');
    }

    public function getPurchaseOrderLineList(){
        $purchaseOrderLines = PurchaseOrderLine::paginate(10);

        return view('admin.purchaseOrderLines.index',['purchaseOrderLines'=>$purchaseOrderLines]);
        
    }

    public function getPurchaseOrderLineShow($id){
        
    }

    public function getPurchaseOrderLineEdit($id){
        
    }

    public function getPurchaseOrderLineDestroy($id){
        
    }

    public function getPurchaseOrderLineCreate(){
        return view('admin.purchaseOrderLines.Create');

    }
    
    public function postPurchaseOrderLineUpdate(){
        
    }

    public function postPurchaseOrderLineInsert(Request $request, PurchaseOrderLine $purchaseOrderLine){
        $validator = Validator::make($request->all(),[
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required']);

        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $purchaseOrderLine->qty = $request->post('qty');
        $purchaseOrderLine->price = $request->post('price');
        $purchaseOrderLine->discount = $request->post('discount');
        $purchaseOrderLine->total = (int)$request->post('qty') * (int)$request->post('price') - ((int)$request->post('discount')/ 100 * (int)$request->post('price'));
        $purchaseOrderLine->created_at = new DateTIme();
        $purchaseOrderLine->updated_at = new DateTIme();
        $purchaseOrderLine->save();
        return redirect()->intended(route('admin.purchase.order.lines'));

    }



}
