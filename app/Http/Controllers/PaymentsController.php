<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Numbers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->role_id == 1){
            $numbers = Numbers::all();
            $payments = Payments::all();
            return view('payments', compact('payments', 'numbers'));
        }
       

        else {
            $numbers = Numbers::where('user_id', '=', Auth::user()->id)->get();
            $payments = Payments::where('user_id', '=', Auth::user()->id)->get();
            return view('payments', compact('payments', 'numbers'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        
        $fileName = $request->file('image')->getClientOriginalName();
        $destinationPath = public_path().'/images' ;
        $user = Auth::user()->id; 
        $request['user_id'] = $user;
        $request['status'] = 'Initiated';
        $request['image'] = $fileName;
        $request['image_url'] = 'images/'.$fileName;

        $validatedData = $request->validate([
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'number' => ['required', 'max:255'],
        'user_id' => ['required', 'max:255'],
        'transaction_number' => ['required', 'max:255'],
        'amount' => ['required'],
        'payment_method' => ['max:255'],
        ]);

 
        $file = $request->file('image');
        $input = $request->all();
        // dd($input);
        Payments::create($input);       
        $file->move($destinationPath, $fileName);
        $message = 'Payment uploaded Successfully!';

        if (Auth::user()->role_id == 1){
            $numbers = Numbers::all();
            $payments = Payments::all();
            return view('payments', compact('payments', 'numbers','message'));
        }
       

        else {
            $numbers = Numbers::where('user_id', '=', Auth::user()->id)->get();
            $payments = Payments::where('user_id', '=', Auth::user()->id)->get();
            return view('payments', compact('payments', 'numbers', 'message'));

        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(Payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(Payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {   $request = Payments::whereId($id)->update([
        'status' => 'Approved']);
        $payments = Payments::all();
        $message = 'Payment approved Successfully!';
        return view('payments', compact('payments', 'message'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
