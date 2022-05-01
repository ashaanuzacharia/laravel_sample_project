<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Activity;
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
            'password' => 'required|min:6',
            'type'=> 'required',
            'captcha' => 'required|captcha'
        ]);
           
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        //$check = $this->create($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
         
        ]);
        $details = [
            'subject' => 'Welcome',
            'greeting' => 'Hello '.$data['name'].'!',
            'body' => 'Welcome to',
            'thanks' => 'Please activity our system support for any further support.',
            'notification' => 'welcome',
            'url' => url('/'),
        ];
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
            $user=User::where(['id'=>auth()->user()->id])->first();
            $activity=Activity::where(['type'=>$user->type])->get();
            $tasks=Activity::where(['user_id'=>auth()->user()->id])->get();
            
            //echo "<pre>"; print_r($activity); die;
            return view('dashboard')->with(compact('activity','tasks'));
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
    
    //add 
    public function addactivity(){
        $count=Activity::where(['user_id'=>auth()->user()->id])->whereDate('created_at', Carbon::today())->count();
        //echo "<pre>"; print_r($count); die;
        if($count>=2)
        {
            Session::flash('message', 'You Cannot added more than 2 activities in a day!');
            return redirect()->route('dashboard');

        }
        return view('addactivity');
     }
    public function store(Request $request){
        $data = $request->except('_method','_token','submit');
  
        $this->validate($request,[
         'activity' => 'required',
        
       ]);
  
        if($record = Activity::firstOrCreate($data)){
           Session::flash('message', 'Added Successfully!');
           Session::flash('alert-class', 'alert-success');
           return redirect()->route('dashboard');
        }else{
           Session::flash('message', 'Data not saved!');
           Session::flash('alert-class', 'alert-danger');
        }
  
        return Back();
     }

     //edit
   public function edit($id=null){
    $activity = activity::where(['id' => $id])->first();

     return view('editactivity')->with(compact('activity'));
  }

  public function update(Request $request,$id){
    $data = $request->except('_method','_token','submit');
    
    $this->validate($request,[
        'activity' => 'required',
       
    ]);
     
    $activity = activity::find($id);

     if($activity->update($data)){

        Session::flash('message', 'Update successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('dashboard');
     }else{
        Session::flash('message', 'Data not updated!');
        Session::flash('alert-class', 'alert-danger');
     }

     return Back()->withInput();
  }

  public function destroy($id){
    Activity::destroy($id);

    Session::flash('message', 'Delete successfully!');
    Session::flash('alert-class', 'alert-success');
    return redirect()->route('dashboard');
 }

}