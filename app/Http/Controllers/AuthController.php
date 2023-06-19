<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Session;
use LDAP\Result;

class AuthController extends Controller
{
    // User Home Page Load Check - Tested and Working
    public function index()
    {
        if (Session::has('loggedin')) {
            if (Session::get('usertype') == 'renter') {
                return view('renter/dashboard');
            } else if (Session::get('usertype') == 'owner') {
                return view('owner/dashboard');
            } else if (Session::get('usertype') == 'admin') {
                echo view('admin/top');
                echo view('admin/dashboard');
                echo view('admin/bottom');
            }
        } else {
            return view('index');
        }
        // return 'Welcome to house for rent';
    }

    // Owner House Page Load Check - Tested and Working
    public function ownerHouses()
    {
        if (Session::has('loggedin')) {
            return view('owner/houses');
        } else {
            return redirect('/');
        }
    }

    // Owner Profile Page Load Check - Tested and Working
    public function ownerProfile()
    {
        if (Session::has('loggedin')) {
            return view('/owner/profile');
        } else {
            return redirect('/');
        }
    }

    // Renter Profile Page Load Check - Tested and Working
    public function renterProfile()
    {
        if (Session::has('loggedin')) {
            return view('/renter/profile');
        } else {
            return redirect('/');
        }
    }

    // Renter Bookings Page Load Check - Tested and Working
    public function renterBookings()
    {
        if (Session::has('loggedin')) {
            return view('/renter/bookings');
        } else {
            return redirect('/');
        }
    }

    // Owner Contact Page Load Check - Tested and Working
    public function ownerContact()
    {
        if (Session::has('loggedin')) {
            return view('/owner/contact');
        } else {
            return redirect('/');
        }
    }

    // Renter Contact Page Load Check - Tested and Working
    public function renterContact()
    {
        if (Session::has('loggedin')) {
            return view('/renter/contact');
        } else {
            return redirect('/');
        }
    }

    // Renter Dashboard Page Load Check - Tested and Working
    public function renterDashboard()
    {
        if (Session::has('loggedin')) {
            return view('/renter/dashboard');
        } else {
            return redirect('/');
        }
    }

    // Login Check Process - Tested and Working
    public function loginCheck()
    {
        if (Session::has('loggedin')) {
            if (Session::get('loggedin') == true) {
                return redirect('/');
            } else {
                return view('login');
            }
        } else {
            return view('login');
        }
    }

    // Login Check Process - Tested and Working
    public function navHouseList()
    {
        if (Session::has('loggedin')) {
            if (Session::get('loggedin') == true) {
                return redirect('/');
            } else {
                return view('houselist');
            }
        } else {
            return view('houselist');
        }
    }

    // Login Check Process - Tested and Working
    public function navContactPage()
    {
        if (Session::has('loggedin')) {
            if (Session::get('loggedin') == true) {
                return redirect('/');
            } else {
                return view('contact');
            }
        } else {
            return view('contact');
        }
    }

    // Login Check Process - Tested and Working
    public function navAboutPage()
    {
        if (Session::has('loggedin')) {
            if (Session::get('loggedin') == true) {
                return redirect('/');
            } else {
                return view('about');
            }
        } else {
            return view('about');
        }
    }

    // Login Process - Tested and Working
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
        ]);

        if (Session::has('loggedin')) {
            if (Session::get('usertype') == 'admin') {
                return response()->json('admin');
            }
            if (Session::get('usertype') == 'owner') {
                return response()->json('owner');
            }
            if (Session::get('usertype') == 'renter') {
                return response()->json('renter');
            }
        } else {
            $checkUser = User::where('user_email', '=', $request->email)->first();
            if ($checkUser) {
                if($checkUser->user_status == 0){
                    return response()->json('blocked');
                }
                $checkpwd = User::where('user_email', '=', $request->email)
                    ->where('user_password', '=', $request->password)
                    ->first();
                if ($checkpwd) {
                    $state = State::find($checkpwd->user_state);
                    $city = City::find($checkpwd->user_city);
                    Session::put('loggedin', true);
                    Session::put('userid', $checkpwd->user_id);
                    Session::put('username', $checkpwd->user_name);
                    Session::put('usermail', $checkpwd->user_email);
                    Session::put('userphone', $checkpwd->user_phone);
                    Session::put('useraadhar', $checkpwd->user_aadhar);
                    Session::put('usercountry', $checkpwd->user_country);
                    Session::put('userstate', $state->name);
                    Session::put('usercity', $city->city);
                    Session::put('userpincode', $checkpwd->user_pincode);
                    Session::put('usertype', $checkpwd->user_type);
                    if ($checkpwd->user_type == 'owner') {
                        return response()->json('owner');
                    } else if ($checkpwd->user_type == 'renter') {
                        return response()->json('renter');
                    } else if ($checkpwd->user_type == 'admin') {
                        return response()->json('admin');
                    }
                } else {
                    return response()->json('wrongpwd');
                }
            } else {
                return response()->json('nouser');
            }
        }
    }

    // Signup Process - Tested and Woking
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'phone' => 'required|numeric',
            'aadhar' => 'required|numeric',
            'email' => 'required|unique:App\Models\User,user_email',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|numeric',
            'password' => 'required|between:8,16',
            'confirmpassword' => 'required|same:password',
            'image' => 'required|image|max:2048'
        ], [
            'username.required' => 'User name is required!',
            'phone.required' => 'Phone number is required!',
            'phone.numeric' => 'Phone number should not contain any character!',
            'aadhar.required' => 'Aadhar number is required!',
            'aadhar.numeric' => 'Aadhar number should not contain any character!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email already taken!',
            'country.required' => 'Country is required!',
            'state.required' => 'State is required!',
            'city.required' => 'City is required!',
            'pincode.required' => 'Pincode is required!',
            'pincode.numeric' => 'Pincode should not contain any character!',
            'password.required' => 'Password is required!',
            'confirmpassword.required' => 'Confirm Password is required!',
            'confirmpassword.same' => 'Confirm Password should be exact same as Password!',
        ]);

        if ($request->usertype == '#') {
            return response()->json('wrongtype');
        }

        $image = $request->file('image');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('img/profile-pic'), $imageName);

        if ($request->country != 105) {
            return response()->json('fail');
        }
        $country = Country::find($request->country);
        if ($country) {
            $state = State::find($request->state);
            if ($state) {
                $city = City::find($request->city);
                if ($city) {
                    $result = User::create([
                        'user_name' => $request->username,
                        'user_phone' => $request->phone,
                        'user_aadhar' => $request->aadhar,
                        'user_email' => $request->email,
                        'user_password' => $request->password,
                        'user_country' => $country->name,
                        'user_state' => $state->id,
                        'user_city' => $city->id,
                        'user_pincode' => $request->pincode,
                        'user_type' => $request->usertype,
                        'user_picture' => $imageName
                    ]);

                    if ($result) {
                        return response()->json('success');
                    } else {
                        return response()->json('fail');
                    }
                } else {
                    return response()->json('fail');
                }
            } else {
                return response()->json('fail');
            }
        } else {
            return response()->json('fail');
        }
    }

    // Logout Process - Tested and working
    public function logout()
    {
        if (Session::has('loggedin')) {
            if (Session::get('loggedin')) {
                Session::flush();
            }
        }
        return redirect('/');
    }


    // Comment process - Tested and working
    public function comments(Request $request)
    {
        // If user is loggedin
        if (Session::has('loggedin')) {
            $request->validate([
                'comment' => 'required',
            ], [
                'comment.required' => 'You should write something before submit!',
            ]);
            $username = Session::get('username');
            $email = Session::get('usermail');
            $comment = $request->comment;
            $result = Comment::create([
                'commenter_name' => $username,
                'commenter_email' => $email,
                'comment_msg' => $comment,
            ]);
            if ($result) {
                return response()->json('success');
            } else {
                return response()->json('fail');
            }
        }

        // If user is not loggedin
        else {
            $request->validate([
                'comment' => 'required',
                'username' => 'required',
                'usermail' => 'required',
            ], [
                'comment.required' => 'You should write something before submit!',
                'username.required' => 'Username is required!',
                'usermail.required' => 'Email is required!',
            ]);
            $username = $request->username;
            $email = $request->usermail;
            $comment = $request->comment;
            $result = Comment::create([
                'commenter_name' => $username,
                'commenter_email' => $email,
                'comment_msg' => $comment,
            ]);
            if ($result) {
                return response()->json('success');
            } else {
                return response()->json('fail');
            }
        }
    }

    // Get user profile information - Tested and working
    public function getUserProfileinfoAJAX(Request $request)
    {
        $user = User::where('user_email', '=', $request->email)->first();
        $city = City::find($user->user_city);
        $state = State::find($user->user_state);
        Session::put('loggedin', true);
        Session::put('userid', $user->user_id);
        Session::put('username', $user->user_name);
        Session::put('usermail', $user->user_email);
        Session::put('userphone', $user->user_phone);
        Session::put('useraadhar', $user->user_aadhar);
        Session::put('usercountry', $user->user_country);
        Session::put('userstate', $state->name);
        Session::put('usercity', $city->city);
        Session::put('userpincode', $user->user_pincode);
        Session::put('usertype', $user->user_type);
        return response()->json([
            'image' => $user->user_picture,
            'name' => $user->user_name,
            'email' => $user->user_email,
            'phone' => $user->user_phone,
            'aadhar' => $user->user_aadhar,
            'pincode' => $user->user_pincode,
            'cid' => $city->id,
            'sid' => $state->id
        ]);
    }

    // Update user profile information - Tested and working
    public function updateUserProfileAJAX(Request $request)
    {
        if (Session::has('loggedin')) {
            $name = $request->name;
            $phone = $request->phone;
            $state = $request->state;
            $city = $request->city;
            $pin = $request->pincode;

            $user = User::find(Session::get('userid'));
            $user->user_name = $name;
            $user->user_phone = $phone;
            $user->user_state = $state;
            $user->user_city = $city;
            $user->user_pincode = $pin;
            $result = $user->update();
            if ($result) {
                return response()->json('pass');
            } else {
                return response()->json('fail');
            }
        } else {
            return redirect('/');
        }
    }

    // Get all states list accordingly - Tested and working
    public function loadStateListAJAX(Request $request)
    {
        $states = State::where('country_id', '=', $request->cid)->get();
        return response()->json($states);
    }

    // Get all city list accordingly - Tested and working
    public function loadCityListAJAX(Request $request)
    {
        $city = City::where('state_id', '=', $request->sid)->get();
        return response()->json($city);
    }

    // Check password while typing - Tested and working
    public function typingCheckPasswordAJAX(Request $request)
    {
        $user = User::find(Session::get('userid'));
        if ($user->user_password == $request->oldpwd) {
            return response()->json('pass');
        } else {
            return response()->json('fail');
        }
    }

    // Update user password - Tested and working
    public function updateUserPasswordeAJAX(Request $request)
    {
        $request->validate([
            'pwd' => 'required|between:8,16',
            'oldpwd' => 'required',
            'cpwd' => 'required|same:pwd'
        ], [
            'pwd.required' => 'New password is required!',
            'pwd.between' => 'New password should be between 8 to 18 characters long!',
            'oldpwd.required' => 'Old password is required!',
            'cpwd.required' => 'Confirm password is required!',
            'cpwd.same' => 'Confirm password should be same as new password!'
        ]);

        $user = User::find(Session::get('userid'));

        if ($user->user_password == $request->oldpwd) {
            $user->user_password = $request->pwd;
            $result = $user->update();
            if ($result) {
                return response()->json('pass');
            } else {
                return response()->json('fail');
            }
        } else {
            return response()->json('nomatch');
        }
    }

    // Update user pricture - Tested and working
    public function updateUserPictureAJAX(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ], [
            'image.required' => 'Image is required!',
            'image.image' => 'Invalid image type!',
            'image.max' => 'Image should be under 2MB of size!'
        ]);

        $image = $request->file('image');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('img/profile-pic'), $imageName);

        $user = User::find(Session::get('userid'));
        $user->user_picture = $imageName;

        $result = $user->update();

        if ($result) {
            return response()->json([
                'status' => 'pass',
                'image' => $imageName
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'image' => 'nodata'
            ]);
        }
    }
}
