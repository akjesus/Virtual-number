<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNumbersRequest;
use App\Http\Requests\UpdateNumbersRequest;
use Illuminate\Http\Request;
use App\Models\Numbers;
use App\Models\Countries;
use App\Models\Operators;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Response;

class NumbersController extends Controller
{
    // /** @var  NumbersRepository */
    // private $numbersRepository;

    // public function __construct(NumbersRepository $numbersRepo)
    // {
    //     $this->numbersRepository = $numbersRepo;
    // }

    /**
     * Display a listing of the Numbers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {   
        if (Auth::user()->id === 1)
        {   $numbers = Numbers::all();
            $countries = Countries::all();
            $operators = Operators::all();
            $users= User::all();
        return view('numbers', compact('users', 'numbers','countries', 'operators'));
        } else{
            $numbers = Numbers::where('user_id', '=', Auth::user()->id)->get();
            $countries = Countries::all();
            $operators = Operators::all();
            return view('numbers', compact('numbers','countries', 'operators'));
        }
    }

    /**
     * Show the form for creating a new Numbers.
     *
     * @return Response
     */

    /**
     * Store a newly created Numbers in storage.
     *
     * @param CreateNumbersRequest $request
     *
     * @return Response
     */

    public function store(Request $request)
    {   $user = Auth::user();  
        // dd($request);
        $attributes = request()->validate([
        'number' => ['required', 'unique:numbers', 'max:255'],
        'user_id' => ['required', 'max:2550'],
        'operator_id' => ['required', 'max:255'],
        'country_id' => ['required', 'max:255'],
        'amount' => ['required'],
        'payment_method' => ['max:255'],
        'options'    => ['max:255'],
        ]);
        $numbersSave = Numbers::create($attributes);
        $numbers = Numbers::all();
        $countries = Countries::all();
        $operators = Operators::all();
        $message = 'Number created successfully';
        $users= User::all();
        return view('numbers')->with(compact('users', 'numbers','countries', 'operators', 'message'));

    }

    
    /**
     * Display the specified Numbers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $numbers = $this->numbersRepository->find($id);

        if (empty($numbers)) {
            Flash::error('Numbers not found');

            return redirect(route('numbers.index'));
        }

        return view('numbers.show')->with('numbers', $numbers);
    }

    /**
     * Show the form for editing the specified Numbers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $numbers = $this->numbersRepository->find($id);

        if (empty($numbers)) {
            Flash::error('Numbers not found');

            return redirect(route('numbers.index'));
        }

        return view('numbers.edit')->with('numbers', $numbers);
    }

    /**
     * Update the specified Numbers in storage.
     *
     * @param int $id
     * @param UpdateNumbersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNumbersRequest $request)
    {
        $numbers = $this->numbersRepository->find($id);

        if (empty($numbers)) {
            Flash::error('Numbers not found');

            return redirect(route('numbers.index'));
        }

        $numbers = $this->numbersRepository->update($request->all(), $id);

        Flash::success('Numbers updated successfully.');

        return redirect(route('numbers.index'));
    }

    /**
     * Remove the specified Numbers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $number = Numbers::find($id);

        if (empty($number)) {
        $message = 'Number not found.';
        $numbers = Numbers::all();
        $countries = Countries::all();
        $operators = Operators::all();
        return view('numbers', compact('numbers','countries', 'message', 'operators'));
        }

        $number->delete();
        $message = 'Number deleted successfully.';
        $numbers = Numbers::all();
        $countries = Countries::all();
        $operators = Operators::all();
        return view('numbers', compact('numbers','countries', 'message','operators'));
    }
}
