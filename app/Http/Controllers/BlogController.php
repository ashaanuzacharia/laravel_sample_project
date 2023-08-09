<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Blog;
use App\Customer;
use App\Product;
use Image;
use Carbon\Carbon;

class BlogController extends Controller
{
    
    
    //add 
    public function addblog()
    {
        
        return view('addblog');
     }
    public function store(Request $request){
        
        if($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request,[
            'title' => 'required|max:150',
            'desc' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:6000000',
            ]);
            $blogs = new Blog;
            $blogs->user_id = $data['user_id'];
            $blogs->title = $data['title'];
            $blogs->sub_title = $data['sub_title'];
            $blogs->desc = $data['desc'];
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        //Resize path 
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;
                        $image_path = public_path('images/blog/'.$filename);
                    
                        Image::make($image_tmp)->fit(640, 360)->save($image_path);
                        $blogs->image = $filename;
                    }
                }
                $blogs->save();
            return redirect()->route('dashboard')->with(Session::flash('status', 'Your Article has been added Successfully!'));
        }
     }
     //view
     public function view($id=null){
        $blog = blog::where(['id' => $id])->first();
    
         return view('viewblog')->with(compact('blog'));
      }
     //edit
   public function edit($id=null){
    $blog = blog::where(['id' => $id])->first();

     return view('editblog')->with(compact('blog'));
  }

  public function update(Request $request,$id=null){
    if($request->isMethod('post')){
        $data = $request->all();
    
        $this->validate($request,[
            'title' => 'required|max:150',
            'desc' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:6000000',
        
        ]);
        
        $blog = Blog::where(['id'=>$id])->first();

        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){  
                if(!empty($blog->image)){
                $path = public_path().'/images/blog/'.$blog->image;
                unlink($path);
                }
                //Resize path 
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111,99999).'.'.$extension;
                $image_path = public_path('images/blog/'.$filename);
                Image::make($image_tmp)->fit(640, 360)->save($image_path);
            }
        }
        else
        {
            $filename = $data['current_image'];
        }


       Blog::where(['id'=>$id])->update(['image'=>$filename, 'title'=>$data['title'], 'sub_title'=>$data['sub_title'],'desc'=>$data['desc'], 'remember_token'=>$data['_token']]);
            
        return redirect()->route('dashboard')->with(Session::flash('status', 'Article updated Successfully!'));
    }
  }

  public function destroy($id){
    Blog::where(['id'=>$id])->delete();

    Session::flash('message', 'Delete successfully!');
    Session::flash('alert-class', 'alert-success');
    return redirect()->route('dashboard');
 }
 public function destroyimage($id){
 
    $file =Blog::where(['id'=>$id])->first();

    if(!empty($file->cover)){
    $file_path = public_path().'/images/blog/'.$file->image;
    unlink($file_path);
    }

    Blog::where(['id'=>$id])->update(['image'=>'']);
    return back();
     
  }

  public function addcustomer()
  {
      
      return view('addcustomer');
   }
  public function storecustomer(Request $request){
      
      if($request->isMethod('post')){
          $data = $request->all();
          $this->validate($request,[
          'name' => 'required|max:150',
          ]);
          $customer = new Customer;
          $customer->name = $data['name'];
          $customer->discount = $data['discount'];
          $customer->save();
          //return redirect()->route('dashboard')->with(Session::flash('status', 'Your Article has been added Successfully!'));
      }
   }
   public function addproduct()
  {
      
      return view('addproduct');
   }
  public function storeproduct(Request $request){
      
      if($request->isMethod('post')){
          $data = $request->all();
          $this->validate($request,[
          'name' => 'required|max:150',
          ]);
          $product = new Product;
          $product->name = $data['name'];
          $product->price = $data['price'];
          $product->save();
          //return redirect()->route('dashboard')->with(Session::flash('status', 'Your Article has been added Successfully!'));
      }
   }
   public function invoices()
  {
      
      return view('invoices');
   }
   public function getPrice($item=null){
        
    $price  = Product::where(['name' => $item])->first();

    return response()->json([
        "price" => $price->price
    ]);
    }
    public function getCustomer($name=null){
       //echo "<pre>"; print_r($name); die;
        $customer  = Customer::where(['name' => $name])->first();
    
        return response()->json([
            "discount" => $customer->discount
        ]);
    }
}
