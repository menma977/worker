<?php

namespace App\Http\Controllers;

use App\model\Absent;
use App\model\SalaryList;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return Renderable
   */
  public function index(): Renderable
  {
    $user = Auth::user();
    $users = User::where('role', 5)->get();
    $absensUser = User::where('role', 5)->get();
    $absensUser->map(static function ($item) {
      $item->absens = Absent::where('user_id', $item->id)->whereDay('created_at', date('d'))->first();
      return $item;
    });
    if ($user->role == 5) {
      $absens = Absent::where('user_id', $user->id)->whereMonth('created_at', date('m'))->get();
      $absens->map(static function ($item) {
        $item->salary = SalaryList::find($item->id);
        return $item;
      });

      $data = [
        'absens' => $absens
      ];
      return view('user.home.index', $data);
    } else if ($user->role == 4) {
      $data = [
        'users' => $users,
        'unAbsens' => $absensUser->whereNull('absens'),
        'inAbsens' => $absensUser->whereNotNull('absens')
      ];
      return view('admin.home.index', $data);
    } else if ($user->role == 3) {
      $data = [
        'users' => $users,
        'unAbsens' => $absensUser->whereNull('absens'),
        'inAbsens' => $absensUser->whereNotNull('absens')
      ];
      return view('admin.home.index', $data);
    } else {

      return view('home');
    }
  }
}
