<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    public function index (Request $request) {
        $items = Person::orderBy('age', 'asc')
          ->simplePaginate(5);
        /* $items = Person::all(); */
        return view('person.model', ['items'=>$items]);
    }

    public function add (Request $request) {
        return view('person.model_add', ['input'=>'']);
    }

    public function create (Request $request) {
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']); // form中の_tokenのみ保存対象から除外
        $person->fill($form)->save();
        return redirect('/person');
    }

    public function edit (Request $request) {
        $person = Person::find($request->id);
        return view('person.model_edit', ['form' => $person]);
    }

    public function update (Request $request) {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']); // form中の_tokenのみ保存対象から除外
        $person->fill($form)->save();
        return redirect('/person');
    }

    public function delete (Request $request) {
        $person = Person::find($request->id);
        return view('person.model_delete', ['form' => $person]);
    }

    public function remove (Request $request) {
        Person::find($request->id)->delete();
        return redirect('/person');
    }






    public function find (Request $request) {
        return view('person.model_find', ['input'=>'']);
    }

    public function search (Request $request) {
        $item = Person::find($request->input);
        $param = ['input'=>$request->input, 'item'=>$item ];
        return view('person.model_find', $param);
    }

    public function findByName (Request $request) {
        return view('person.model_findByName', ['input'=>'']);
    }

    public function searchByName (Request $request) {
        $item = Person::nameEqual($request->input)->first();
        // $item = Person::where('name', $request->input)->first();
        $param = ['input'=>$request->input, 'item'=>$item ];
        return view('person.model_findByName', $param);
    }

    public function findByAge (Request $request) {
        return view('person.model_findByAge', ['input'=>'']);
    }

    public function searchByAge (Request $request) {
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)
          ->ageLessThan($max)->first();
        // $item = Person::where('name', $request->input)->first();
        $param = ['input'=>$request->input, 'item'=>$item ];
        return view('person.model_findByAge', $param);
    }
}



