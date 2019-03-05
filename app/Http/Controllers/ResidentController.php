<?php

namespace App\Http\Controllers;

use App\Resident;
use App\Room;
use Illuminate\Http\Request;


class ResidentController extends Controller
{
    // 居住者一覧
    public function index (Request $request) {
//        $items = Resident::with(['room' => function($query){
//          return $query->orderBy('name', 'asc');
//        }])
        $items = Resident::with('room')->orderBy('room_id', 'asc')
          ->simplePaginate(20);
        /* $items = Person::all(); */
        return view('resident.index', ['items'=>$items]);
    }

    public function add (Request $request) {
      $rooms = Room::all();
      $param = ['input'=>'', 'rooms'=>$rooms];
      return view('resident.add', $param);
    }

    public function create (Request $request) {
      $this->validate($request, Resident::$rules);
      $resident = new Resident;
      $form = $request->all();
      unset($form['_token']); // form中の_tokenのみ保存対象から除外
      $resident->fill($form)->save();
      return redirect('/rent/resident');
    }

    public function edit (Request $request) {
      $resident = Resident::find($request->id);
      $rooms = Room::all();
      $param = ['form' => $resident, 'rooms'=>$rooms];
      return view('resident.edit', $param);
    }

    public function update (Request $request) {
      $this->validate($request, Resident::$rules);
      $resident = Resident::find($request->id);
      $form = $request->all();
      unset($form['_token']); // form中の_tokenのみ保存対象から除外
      $resident->fill($form)->save();
      return redirect('/rent/resident');
  }

  public function delete (Request $request) {
    $resident = Resident::find($request->id);
    return view('resident.delete', ['form' => $resident]);
  }

  public function remove (Request $request) {
    Resident::find($request->id)->delete();
    return redirect('/rent/resident');
  }







}