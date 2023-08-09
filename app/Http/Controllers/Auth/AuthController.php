<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Blog;
use Hash;
use Carbon\Carbon;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|string|confirmed',
            //'type'=> 'required',
            //'captcha' => 'required|captcha'
        ]);
           
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        //$check = $this->create($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //'type' => $data['type'],
         
        ]);
        /**$details = [
            'subject' => 'Welcome',
            'greeting' => 'Hello '.$data['name'].'!',
            'body' => 'Welcome to',
            'thanks' => 'Please blog our system support for any further support.',
            'notification' => 'welcome',
            'url' => url('/'),
        ];**/
        //Mail::to($data['email'])->send(new WelcomeMail($user));
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard($id=null)
    {
        if(Auth::check()){
            //$user=User::where(['id'=>auth()->user()->id])->first();
            $blogs=Blog::where(['user_id'=>auth()->user()->id])->orderBy('id','desc')->paginate(5);
            
            //echo "<pre>"; print_r($blog); die;
            return view('dashboard')->with(compact('blogs'));
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

}