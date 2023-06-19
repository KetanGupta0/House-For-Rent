<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use App\Models\houses;
use App\Models\HouseImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HouseController extends Controller
{
    // Add House Process - Tested and Working
    public function addHouse(Request $request)
    {
        // Check Session
        if (Session::has('loggedin')) {
            // Validations
            $request->validate([
                'title' => 'required',
                'size' => 'required|numeric',
                'rooms' => 'required|numeric',
                'kitchens' => 'required|numeric',
                'bathrooms' => 'required|numeric',
                'address' => 'required',
                'description' => 'required',
                'type' => 'required',
                'rent' => 'required|numeric',
                'images.*' => 'image',
            ], [
                'title.required' => 'Title is required!',
                'rent.required' => 'Rent Amount is required!',
                'type.required' => 'Rent Type is required!',
                'size.required' => 'Size is required!',
                'rooms.required' => 'Rooms is required!',
                'kitchens.required' => 'Kitchens is required!',
                'bathrooms.required' => 'Bathrooms is required!',
                'address.required' => 'Address is required!',
                'description.required' => 'Description is required!',
                'size.numeric' => 'Size should be a number!',
                'rooms.numeric' => 'Rooms should be a number!',
                'kitchens.numeric' => 'Kitchens should be a number!',
                'bathrooms.numeric' => 'Bathrooms should be a number!',
                'rent.numeric' => 'Rent Amount should be a number!',
                'images.*.image' => 'Images must be of type JPEG, PNG, BMP, or GIF',
            ]);
            // Finding owner id
            $usermail = Session::get('usermail');
            $userid = User::where('user_email', '=', $usermail)->value('user_id');
            $images = $request->file('images');
            if($images === null || count($images) == 0){
                return response()->json(['message' => 'Image is required!'],400);
            }
            // Upload House Data
            $post = houses::create([
                'house_title' => $request->title,
                'house_rooms' => $request->rooms,
                'house_bathrooms' => $request->bathrooms,
                'house_kitchen' => $request->kitchens,
                'house_size' => $request->size,
                'house_address' => $request->address,
                'house_description' => $request->description,
                'rent_type' => $request->type,
                'house_rent' => $request->rent,
                'owner_id' => $userid,
            ]);
            $houseid = $post->house_id;
            if ($post) {
                // Upload House Images
                $images = $request->file('images');
                foreach ($images as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('img/house-img'), $imageName);
                    $check = HouseImage::create([
                        'image_belongs_to' => $houseid,
                        'image_name' => $imageName,
                    ]);
                    if (!$check) {
                        return response()->json('imgerror');
                    }
                }
                return response()->json('success');
            }
        } else {
            return response()->json('sessionerror');
        }
    }

    // Fetch Renter Bookings Process - Tested and working
    public function fetchRenterBookingsAJAX()
    {
        if (Session::has('loggedin')) {
            $bookingData = [];
            $bookings = Bookings::where('booked_by', '=', Session::get('userid'))->get();
            foreach ($bookings as $booking) {
                $house = houses::find($booking->house_id);
                array_push($bookingData, [
                    'house_title' => $house->house_title,
                    'house_rent' => $house->house_rent,
                    'house_id' => $house->house_id,
                    'booking_status' => $booking->booking_status,
                    'payment_status' => $booking->payment_status,
                    'payment_id' => $booking->payment_id,
                ]);
            }
            return response()->json($bookingData);
        } else {
            return response()->json('sessionerror');
        }
    }

    // Fetch Owner Houses Process - Tested and working
    public function fetchOwnerHousesAJAX()
    {
        if (Session::has('loggedin')) {
            $userid = User::where('user_email', '=', Session::get('usermail'))->value('user_id');
            $houses = houses::where('owner_id', '=', $userid)->where('house_status','!=','deleted')->get();
            return response()->json($houses);
        } else {
            return response()->json('sessionerror');
        }
    }

    // Get Single House Data - Tested and working
    public function getHouseDataAJAX(Request $request)
    {
        $data = houses::find($request->hid);
        $images = HouseImage::where('image_belongs_to', '=', $data->house_id)->get();
        $house = [
            'info' => $data,
            'images' => $images,
        ];
        return response()->json($house);
    }

    // Delete House - Tested and working
    public function deleteHouseDataAJAX(Request $request)
    {
        $result = houses::find($request->hid);
        $images = HouseImage::where('image_belongs_to', '=', $result->house_id)->delete();
        $check = $result->delete();
        if ($check) {
            return response()->json('success');
        } else {
            return response()->json('fali');
        }
    }

    // House Load Process - Tested and working
    public function loadHousesAJAX()
    {
        $h = houses::where('house_status','=','active')->orderBy('house_id','desc')->limit(9)->get();
        $house = [];
        foreach ($h as $key => $ho) {
            $img = HouseImage::where('image_belongs_to', '=', $ho->house_id)->first();
            array_push($house, [
                'image' => $img->image_name,
                'house_title' => $ho->house_title,
                'house_rooms' => $ho->house_rooms,
                'house_rent' => $ho->house_rent,
                'house_id' => $ho->house_id,
                'time' => $ho->created_at,
                'house_kitchen' => $ho->house_kitchen,
                'rent_type' => $ho->rent_type,
                'house_bathrooms' => $ho->house_bathrooms,
            ]);
        }
        return response()->json($house);
    }

    // All House Load Process - Tested and working
    public function loadAllHousesAJAX()
    {
        $h = houses::where('house_status','=','active')->orderBy('house_id','desc')->get();
        $house = [];
        foreach ($h as $key => $ho) {
            $img = HouseImage::where('image_belongs_to', '=', $ho->house_id)->first();
            array_push($house, [
                'image' => $img->image_name,
                'house_title' => $ho->house_title,
                'house_rooms' => $ho->house_rooms,
                'house_rent' => $ho->house_rent,
                'house_id' => $ho->house_id,
                'created_at' => $ho->created_at,
                'house_kitchen' => $ho->house_kitchen,
                'rent_type' => $ho->rent_type,
                'house_bathrooms' => $ho->house_bathrooms,
            ]);
        }
        return response()->json($house);
    }

    // All House Load Process for renters only - Tested and working
    public function loadAllHousesForRenterAJAX()
    {
        $h = houses::where('house_status','=','active')->where('house_booking_status','=',0)->orderBy('house_id','desc')->get();
        $house = [];
        foreach ($h as $key => $ho) {
            $img = HouseImage::where('image_belongs_to', '=', $ho->house_id)->first();
            $check = Bookings::where('booked_by', '=', Session::get('userid'))->where('house_id', '=', $ho->house_id)->get();
            $booking = 0;
            foreach ($check as $ch) {
                if ($ch->booking_status == 1) {
                    $booking = 1;
                    break;
                }
            }
            array_push($house, [
                'image' => $img->image_name,
                'house_title' => $ho->house_title,
                'house_rooms' => $ho->house_rooms,
                'house_rent' => $ho->house_rent,
                'house_id' => $ho->house_id,
                'created_at' => $ho->created_at,
                'booking' => $booking,
                'house_kitchen' => $ho->house_kitchen,
                'rent_type' => $ho->rent_type,
                'house_bathrooms' => $ho->house_bathrooms,
            ]);
        }
        return response()->json($house);
    }

    // Get House data for booking - Tested and working
    public function getHouseDataForBookingAJAX(Request $request)
    {
        if (Session::has('loggedin')) {
            if (Session::get('usertype') == 'renter') {
                return response()->json(houses::find($request->hid));
            } else {
                return response()->json('notallowed');
            }
        }
    }

    // Making payment for house booking - Tested and working
    public function makePaymentAJAX(Request $request)
    {
        if (Session::has('loggedin')) {
            if (Session::get('usertype') == 'renter') {
                $request->validate([
                    'name' => 'required',
                    'card' => 'required|numeric|digits:16',
                    'amount' => 'required|numeric',
                    'cvv' => 'required|numeric|digits:3',
                    'expMonth' => 'required|numeric',
                    'expYear' => 'required|numeric|digits:4',
                ], [
                    'name.required' => 'Card owner name is required!',
                    'card.required' => 'Card number is required!',
                    'card.numeric' => 'Card number is invalid!',
                    'card.digits' => 'Card number is invalid!',
                    'amount.required' => 'Amount is required!',
                    'amount.numeric' => 'Invalid amount!',
                    'cvv.required' => 'CVV is required!',
                    'cvv.numeric' => 'Invalid CVV!',
                    'cvv.digits' => 'Invalid CVV!',
                    'expMonth.required' => 'Month is required!',
                    'expMonth.numeric' => 'Invalid month!',
                    'expMonth.digits' => 'Invalid month!',
                    'expYear.required' => 'Year is required!',
                    'expYear.numeric' => 'Invalid year!',
                    'expYear.digits' => 'Invalid year!',
                ]);

                $house = houses::find($request->hid);
                if ($house) {
                    if ($house->house_booking_status == 0) {
                        $booking = new Bookings();
                        $booking->booked_by = Session::get('userid');
                        $booking->booking_status = 1;
                        $booking->payment_status = 1;
                        $isUnique = false;
                        while (!$isUnique) {
                            $rand = rand(111111, 999999);
                            $check = Bookings::where('payment_id', '=', 'hfr@' . $rand)->first();
                            if ($check) {
                                continue; // Try again if payment ID already exists
                            } else {
                                $booking->payment_id = 'hfr@' . $rand;
                                $isUnique = true; // Exit loop if payment ID is unique
                            }
                        }
                        $booking->customer_name = Session::get('username');
                        $booking->card_number = $request->card;
                        $booking->card_holder = $request->name;
                        $booking->payment_time = Carbon::now();
                        $booking->house_id = $request->hid;
                        if ($house->house_rent == $request->amount) {
                            $booking->paid_amount = $request->amount;
                            $house->house_booking_status = 1;
                            $house->update();
                            $result = $booking->save();
                            if ($result) {
                                return response()->json('pass');
                            } else {
                                return response()->json('fail');
                            }
                        } else {
                            return response()->json('fail');
                        }
                    } else {
                        return response()->json('booked');
                    }
                } else {
                    return response()->json('nohouse');
                }
            } else {
                return response()->json('notallowed');
            }
        } else {
            return response()->json('nosession');
        }
    }

    // Check Availability - Tested and working
    public function checkAvailableAJAX(Request $request)
    {
        $hid = $request->hid;
        $house = houses::find($hid);
        if ($house) {
            if ($house->house_booking_status == 0) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(['message' => 'Reload required!'], 400);
        }
    }

    // Fetch Payment Record - Tested and working
    public function getPaymentInfoAJAX(Request $request)
    {
        $booking = Bookings::where('payment_id', '=', $request->pid)->first();
        $user = User::find($booking->booked_by);
        $house = houses::find($booking->house_id);
        if ($booking && $user && $house) {
            return response()->json([
                'name' => $user->user_name,
                'propertyName' => $house->house_title,
                'email' => $user->user_email,
                'amount' => $booking->paid_amount,
                'date' => $booking->payment_time,
                'transaction' => $booking->payment_id
            ]);
        }
    }

    // Cancel Booking - Tested and working
    public function cancelBookingAJAX(Request $request)
    {
        $booking = Bookings::where('payment_id', '=', $request->pid)->first();
        if ($booking) {
            $house = houses::find($booking->house_id);
            if ($house) {
                $booking->booking_status = 3;
                $house->house_booking_status = 0;
                $result = $booking->update();
                if ($result) {
                    $result = $house->update();
                    if ($result) {
                        return response()->json(true);
                    } else {
                        return response()->json(['message' => 'Critical Error! Please contact admin asap!'], 400);
                    }
                } else {
                    return response()->json(false);
                }
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }
    }
}
