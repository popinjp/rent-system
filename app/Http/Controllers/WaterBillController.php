<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterBillController extends Controller
{
    //
    public function index (Request $request) {
        $items = Room::orderBy('name', 'asc')
          ->simplePaginate(20);
        /* $items = Person::all(); */
        return view('room.index', ['items'=>$items]);
    }

    public function add (Request $request) {
      return view('room.add', ['input'=>'']);
    }

    public function create (Request $request) {
      $this->validate($request, Room::$rules);
      $room = new Room;
      $form = $request->all();
      unset($form['_token']); // form中の_tokenのみ保存対象から除外
      $room->fill($form)->save();
      return redirect('/rent/room');
    }

    public function edit (Request $request) {
      $room = Room::find($request->id);
      return view('room.edit', ['form' => $room]);
    }

    public function update (Request $request) {
      $this->validate($request, Room::$rules);
      $room = Room::find($request->id);
      $form = $request->all();
      unset($form['_token']); // form中の_tokenのみ保存対象から除外
      $room->fill($form)->save();
      return redirect('/rent/room');
    }

    public function delete (Request $request) {
      $room = Room::find($request->id);
      return view('room.delete', ['form' => $room]);
    }

    public function remove (Request $request) {
      Room::find($request->id)->delete();
      return redirect('/rent/rooms');
    }
}
