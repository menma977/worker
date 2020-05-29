<?php

namespace App\Http\Controllers;

use App\model\Absent;
use App\model\SalaryList;
use App\User;
use Carbon\Carbon;
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
      $totalSalary = [0];
      $totalUser = [0];
      $dateSet = [];
      $absens = Absent::whereYear('created_at', Carbon::now())->get();
      $absens->map(static function ($item) {
        $item->user = User::find($item->user_id);
        $item->salary = SalaryList::find($item->id);
        return $item;
      });

      $month = Carbon::parse($absens->first()->created_at)->format('m');
      $i = 0;
      $countUser = 0;
      foreach ($absens as $item) {
        $monthNow = Carbon::parse($item->created_at)->format('m');
        if ($month == $monthNow) {
          $dateSet[$i] = $month;
          $totalSalary[$i] += $item->salary->total;
          $totalUser[$i] += ($countUser + 1);
        } else {
          $month = $monthNow;
          $countUser = 0;
          $i++;
          $totalSalary[$i] = $item->salary->total;
          $totalUser[$i] = $countUser;
          $dateSet[$i] = $month;
        }
      }

      $data = [
        'salary' => $totalSalary,
        'users' => $totalUser,
        'date' => $dateSet
      ];
      return view('home', $data);
    }
  }
}
