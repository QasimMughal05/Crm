<?php

namespace App\Http\Controllers;
use App\Product;
Use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\ProductNotification;

class ProductController extends Controller
{

    public function index(){   
        try{
            $product = Product::latest()->get();
        }catch(\Exception $e){
            return back()->with('Error','No Product Found');
        } 
        return view('admin.dashboard',compact('product'));
    }


    public function create(){  
        return view('admin.create');
    }
    

    public function store(Request $request){
      // dd($request->all());
        $rules = [
            'product_name' => 'required|max:255',
            'product_price' => 'required',
        ];
     
        $validator = \Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('product.create')->withErrors($validator)->withInput();
        }
        try{
            if($request->id){
                $data = Product::findOrFail($request->id);
                $action = "Edited";
            }
            else{
               $action = "Added"; 
                $data = new Product;
            }
          
            $data->product_name = $request->product_name;
            $data->product_price = $request->product_price;

            if ($request->has('product_image')) {
                //dd($r->file('product_image'));
                $image = $request->file('product_image');
                $name = $request->input('name').'_'.time();
                $folder = 'upload/image/';
                $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
                $image->move($folder,$filePath);
                $data->product_image = $filePath;
            }
            $data->save();
            $user = Auth::user();
            // dd($user);
            $user->notify(new ProductNotification($data->product_name,$data->product_price,$action));
        }catch(\Exception $e){
            return back()->with('Error','Sorry,Try Again Later')->with('Reason',$e->getMessage());
        }
        return redirect('dashboard');
    }

    public function delete($id){
        try{
            $product = Product::findorFail($id);
            $product->delete();
        }
        catch(\Exception $e){
            return back()->with('Error','Product Not Found');
        }
      
        return redirect('dashboard')->with('success','User deleted successfully');
    }

    public function edit($id){
        try{
            $product = Product::findorFail($id);
        }catch(\Exception $e){
            return back()->with('Error','Sorry, Try Again Later')->with('Reason',$e->getMessage());
        }
      
        return view('admin.edit',compact('product'));
    }

    public function update(Request $request){
        try {
            $this->store($request);
        }
        catch(\Exception $e) {
            return back()->with('Error','Product Not Found')->with('Reason',$e->getMessage());
        }
        return redirect('dashboard');
    }

}
