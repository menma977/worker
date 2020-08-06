<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|Response|View|null
   */
  public function index()
  {
    $users = User::where('role', 5)->where('delete', 0)->get();

    $data = [
      'users' => $users
    ];
    return view('admin.user.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Application|Factory|View
   */
  public function create()
  {
    return view('admin.user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $this->validate($request, [
      'code' => 'required|string|unique:users',
      'status' => 'required|numeric',
      'name' => 'required|string',
      'username' => 'required|string|unique:users',
      'password' => 'required|string|min:6|same:c_password',
      'c_password' => 'required|string|min:6|same:password',
      'phone' => 'required|numeric|min:10',
      'address' => 'required|string|min:6'
    ]);

    $user = new user();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->code = $request->code;
    $user->role = 5;
    $user->delete = 0;
    $user->suspend = 0;
    $user->password = Hash::make($request->password);
    $user->benefit = $request->status;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->save();

    return redirect()->route('user.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param $id
   * @return Application|Factory|View|void
   */
  public function edit($id)
  {
    $user = User::find($id);

    $data = [
      'user' => $user
    ];

    return view('admin.user.edit', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Request $request
   * @return Application|Factory|RedirectResponse|View
   * @throws ValidationException
   */
  public function findAndChange(Request $request)
  {
    $this->validate($request, [
      'code' => 'required|string|exists:users,code',
    ]);
    $user = User::where('code', $request->code)->first();
    if ($user->role != 5) {
      return redirect()->back()->withErrors(['code' => 'NIK not found']);
    }

    $data = [
      'user' => $user
    ];
    return view('admin.user.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, $id): RedirectResponse
  {
    $this->validate($request, [
      'name' => 'required|string',
      'status' => 'required|numeric',
      'phone' => 'required|numeric|min:10',
      'address' => 'required|string|min:6'
    ]);
    $user = user::find($id);
    if ($request->password) {
      $this->validate($request, [
        'password' => 'required|string|min:6|same:c_password',
        'c_password' => 'required|string|min:6|same:password'
      ]);
      $user->password = Hash::make($request->password);
    }
    if ($user->code != $request->code) {
      $this->validate($request, [
        'code' => 'required|string|unique:users'
      ]);
      $user->code = $request->code;
    }
    if ($user->username != $request->username) {
      $this->validate($request, [
        'username' => 'required|string|unique:users'
      ]);
      $user->username = $request->username;
    }
    $user->name = $request->name;
    $user->benefit = $request->status;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->save();

    return redirect()->route('user.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $id
   * @return RedirectResponse|void
   */
  public function suspand($id)
  {
    $user = User::find($id);
    if ($user->suspend == 1) {
      $user->suspend = 0;
    } else {
      $user->suspend = 1;
    }
    $user->save();

    return redirect()->Back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param $id
   * @return RedirectResponse|void
   */
  public function delete($id)
  {
    $user = User::find($id);
    $user->delete = 1;
    $user->save();

    return redirect()->Back();
  }
}
