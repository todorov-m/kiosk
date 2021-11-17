<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view ('users.list',[

            'users' => User::where('level','<',5)->get()
//TODO да има 1 superuser и няколко admina, визия за избор на ниво потребител при редактиране
        ]);
    }

    public function create()
    {
        return view('users.register');
    }

    public function store()
    {
        $request = request()-> validate([
            'name' => 'required',
            'username' =>'required',
            'password' => ['required','min:4'],
            'level' => 'required'
        ]);


        User::create($request);

        return back()->with('success', 'Потребителя е добавен');
    }

    public function listuser($id) {
        $user = User::find($id);

        return view('users.password')->with('user', $user);

    }

    public function updatepass(User $id) {

        $request = request()->validate([
            'password'=> ['required','min:4']
        ]);
        $id->update($request);

        return back()->with('success', 'Паролата е сменена!');

    }

    public function login()
    {
        $request = request()-> validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        if(auth()->attempt($request))
        {
            $saldo = Saldo::where('users_id', auth()->user()->id)
               // ->whereRaw('DATE(shiftstart_date) = CURDATE()')
                   ->where('shiftstatus',0)
                   ->first();

            if (isset($saldo) && $saldo->shiftstatus == '0') {
                return view('sales.shiftsaldo')->with([
                    'shiftstart_sum' => $saldo->shiftstart_sum,
                    'shiftsale_sum' => $saldo->shiftsale_sum,
                    'shiftend_sum' => $saldo->shiftend_sum,
                    'shiftstatus'=> $saldo->shiftstatus,
                    'shift_id' => $saldo->id,
                    'error' => 'Смяната Ви не е приключена!'
                ]);

            }  else {
                return view('sales.startshift');

            }

        }

        return back()->withErrors([
            'username' => 'Грешен или несъществуващ Потребител!'
        ]);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!!!');
    }
}
