<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Comment;
use App\Models\houses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Active Posts View
    public function activePostsView()
    {
        if (Session::has('loggedin')) {
            echo view('admin/top');
            echo view('admin/activepost');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Pending Posts View
    public function pendingPostsView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/pendingpost');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Expired Posts View
    public function expiredPostsView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/expiredpost');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Admins View
    public function adminAdminsView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/admins');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Owners View
    public function adminOwnersView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/owners');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Renters View
    public function adminRentersView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/renters');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Comments View
    public function adminCommentsView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/comments');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Transactions View
    public function adminTransactionsView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/transactions');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Admin Profile View
    public function adminProfileView()
    {
        if (Session::has('loggedin')) {
            // echo 'Hello';
            echo view('admin/top');
            echo view('admin/profile');
            echo view('admin/bottom');
        } else {
            return redirect('/');
        }
    }

    // Dashboard Informations
    public function getDashboardInfoAJAX()
    {
        $owner = User::where('user_type', '=', 'owner')->get();
        $renter = User::where('user_type', '=', 'renter')->get();
        $activehouses = houses::where('house_status', '=', 'active')->get();
        $pendinghouses = houses::where('house_status', '=', 'pending')->get();
        return response()->json([
            'owner' => count($owner),
            'renter' => count($renter),
            'activehouses' => count($activehouses),
            'pendinghouses' => count($pendinghouses)
        ]);
    }

    // Get all active posts informations
    public function fetchActivePostsAJAX()
    {
        $activehouses = houses::where('house_status', '=', 'active')->get();
        $data = [];
        foreach ($activehouses as $house) {
            $user = User::find($house->owner_id);
            array_push($data, [
                'title' => $house->house_title,
                'username' => $user->user_name,
                'posted' => $house->created_at,
                'status' => $house->house_status,
                'id' => $house->house_id,
            ]);
        }
        return response()->json($data);
    }

    // Get all pending posts informations
    public function fetchPendingPostsAJAX()
    {
        $activehouses = houses::where('house_status', '=', 'pending')->get();
        $data = [];
        foreach ($activehouses as $house) {
            $user = User::find($house->owner_id);
            array_push($data, [
                'title' => $house->house_title,
                'username' => $user->user_name,
                'posted' => $house->created_at,
                'status' => $house->house_status,
                'id' => $house->house_id,
            ]);
        }
        return response()->json($data);
    }

    // Get all expired posts informations
    public function fetchExpiredPostsAJAX()
    {
        $activehouses = houses::where('house_status', '=', 'expired')->get();
        $data = [];
        foreach ($activehouses as $house) {
            $user = User::find($house->owner_id);
            array_push($data, [
                'title' => $house->house_title,
                'username' => $user->user_name,
                'posted' => $house->created_at,
                'status' => $house->house_status,
                'id' => $house->house_id,
            ]);
        }
        return response()->json($data);
    }

    // Mark active post as expired
    public function expirePostAJAX(Request $request)
    {
        $house = houses::find($request->id);
        if ($house) {
            $house->house_status = 'expired';
            $result = $house->update();
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    // Mark pending and expired post as deleted
    public function deletePostAJAX(Request $request)
    {
        $house = houses::find($request->id);
        if ($house) {
            $house->house_status = 'deleted';
            $result = $house->update();
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    // Mark pending and expired post as active
    public function approvePostAJAX(Request $request)
    {
        $house = houses::find($request->id);
        if ($house) {
            $house->house_status = 'active';
            $result = $house->update();
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }

    public function fetchAdminsAJAX()
    {
        $admin = User::where('user_type', '=', 'admin')->get();
        $data = [];
        foreach ($admin as $ad) {
            if (Session::get('userid') != $ad->user_id) {
                array_push($data, $ad);
            }
        }
        return response()->json($data);
    }

    public function fetchOwnersAJAX()
    {
        $owner = User::where('user_type', '=', 'owner')->get();
        return response()->json($owner);
    }

    public function fetchRentersAJAX()
    {
        $renter = User::where('user_type', '=', 'renter')->get();
        return response()->json($renter);
    }

    public function fetchUserInfoAJAX(Request $request)
    {
        $id = $request->id;
        $user = User::join('states', 'users.user_state', '=', 'states.id')
            ->join('cities', 'users.user_city', '=', 'cities.id')
            ->where('user_id', '=', $id)->select('users.*', 'states.name as state', 'cities.city')
            ->first();
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found!'], 400);
        }
    }

    public function blockUserAJAX(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->user_status = 0;
            $result = $user->update();
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'User not found!'], 400);
        }
    }

    public function unblockUserAJAX(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->user_status = 1;
            $result = $user->update();
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'User not found!'], 400);
        }
    }

    public function deleteUserAJAX(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            $user->user_status = 2;
            $result = $user->update();
            if ($result) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'User not found!'], 400);
        }
    }

    public function fetchTransactionsAJAX()
    {
        $txn = Bookings::join('houses', 'bookings.house_id', '=', 'houses.house_id')->select('bookings.*', 'houses.house_title')->get();
        return response()->json($txn);
    }

    public function fetchTransactionInfoAJAX(Request $request)
    {
        $pid = $request->pid;
        $record = Bookings::join('houses', 'bookings.house_id', '=', 'houses.house_id')
    ->join('users', 'houses.owner_id', '=', 'users.user_id')
    ->leftJoin('house_images', 'houses.house_id', '=', 'house_images.image_belongs_to')
    ->where('bookings.payment_id', '=', $pid)
    ->select('bookings.*', 'houses.house_title', 'users.user_name', DB::raw('GROUP_CONCAT(house_images.image_name) as images'))
    ->groupBy(
        'bookings.booking_id',
        'bookings.booked_by',
        'bookings.booking_status',
        'bookings.payment_status',
        'bookings.payment_id',
        'bookings.customer_name',
        'bookings.card_number',
        'bookings.card_holder',
        'bookings.payment_time',
        'bookings.approved_by',
        'bookings.canceled_by',
        'bookings.cancel_time',
        'bookings.house_id',
        'bookings.paid_amount',
        'bookings.approval_timestamp',
        'users.user_name',
        'houses.house_title'
    )
    ->first();




        return response()->json($record);
    }

    public function fetchCommentsAJAX(){
        $comment = Comment::orderBy('comment_id','desc')->get();
        return response()->json($comment);
    }

    public function viewCommentsAJAX(Request $request){
        $comment = Comment::find($request->id);
        return response()->json($comment);
    }

    public function adminPicAJAX(){
        $user = User::find(Session::get('userid'));
        return response()->json($user);
    }

    public function chandraKishoreGupta(){
        echo view('self');
    }
}
