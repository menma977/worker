<?php

namespace App\Http\Controllers;

use App\model\Absent;
use App\model\Salary;
use App\model\SalaryList;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AbsentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|Response|View
   */
  public function index()
  {
    $dateSet = Carbon::now()->format('m-Y');
    $absenFinder = [];
    foreach (Absent::all() as $id => $item) {
      $dateParse = Carbon::parse($item->created_at)->format('m-Y');
      if (!in_array($dateParse, $absenFinder, false)) {
        $absenFinder[$id] = Carbon::parse($item->created_at)->format('m-Y');
      }
    }

    $absens = Absent::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
    $absens->map(function ($item) {
      $item->user = User::where('id', $item->user_id)->first();
      $item->salary = SalaryList::where('absent_id', $item->id)->first();
    });

    $data = [
      'absenFinder' => $absenFinder,
      'absens' => $absens,
      'dateSet' => $dateSet
    ];

    return view('admin.absent.index', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse|Response
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'user' => 'required|string|exists:users,id',
      'time' => 'required',
    ]);

    $salary = Salary::find(1);
    $user = User::find($request->user);

    $absen = new Absent();
    $absen->user_id = $user->id;
    $absen->on = explode(' - ', $request->time)[0];
    $absen->off = explode(' - ', $request->time)[1];
    $absen->over_time = Carbon::parse(explode(' - ', $request->time)[1])->diffInHours(Carbon::parse("16:00"));

    $getLastAbsenId = Absent::count() + 1;
    $salaryList = new SalaryList();
    $salaryList->absent_id = $getLastAbsenId;
    $salaryList->salary = $salary->salary;
    $salaryList->over_time = $salary->over_time * $absen->over_time;
    if ($user->benefit) {
      $salaryList->benefit = $salary->benefit;
    } else {
      $salaryList->benefit = 0;
    }
    $salaryList->total = $salaryList->salary + $salaryList->over_time + $salaryList->benefit;
    $salaryList->save();
    $absen->save();

    return redirect()->Back();
  }

  /**
   * Display the specified resource.
   *
   * @param Request $request
   * @return Application|Factory|Response|View
   */
  public function show(Request $request)
  {
    $dateSet = Carbon::parse('01-' . $request->time)->format('m-Y');
    $absenFinder = [];
    foreach (Absent::all() as $id => $item) {
      $dateParse = Carbon::parse($item->created_at)->format('m-Y');
      if (!in_array($dateParse, $absenFinder, false)) {
        $absenFinder[$id] = Carbon::parse($item->created_at)->format('m-Y');
      }
    }

    $absens = Absent::whereYear('created_at', Carbon::parse('01-' . $request->time)->format('Y'))->whereMonth('created_at', $dateSet)->get();
    $absens->map(function ($item) {
      $item->user = User::where('id', $item->user_id)->first();
      $item->salary = SalaryList::where('absent_id', $item->id)->first();
    });

    $data = [
      'absenFinder' => $absenFinder,
      'absens' => $absens,
      'dateSet' => $dateSet
    ];

    return view('admin.absent.index', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param $id
   * @return array|JsonResponse
   */
  public function update(Request $request, $id)
  {
    $salary = Salary::find(1);
    $absen = Absent::find($id);
    $absen->on = explode(' - ', $request->time)[0];
    $absen->off = explode(' - ', $request->time)[1];
    $absen->over_time = Carbon::parse(explode(' - ', $request->time)[1])->diffInHours(Carbon::parse("16:00"));

    $salaryList = SalaryList::where('absent_id', $absen->id)->first();
    $salaryList->salary = $salary->salary;
    $salaryList->over_time = $salary->over_time * $absen->over_time;
    $salaryList->total = $salaryList->salary + $salaryList->over_time + $salaryList->benefit;
    $salaryList->save();
    $absen->save();

    $data = [
      'message' => 'data has bin update'
    ];
    return response()->json($data, 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Absent $absent
   * @return Response
   */
  public function destroy(Absent $absent)
  {
    //
  }
}
