@extends ('layouts.rentapp')

@section ('title', '入居者情報更新')

@section ('menubar')
  @parent
  入居者情報更新
@endsection

@section('content')
<h2>入居者情報更新</h2>

<table>
<form action="/rent/resident/edit" method="post">
{{ csrf_field() }}

<input type="hidden" name="id" value={{$form->id}}>
<tr><th>部屋番号</th><td>
  <select name="room_id">

  <option value="">選択してください</option>
  @foreach ($rooms as $room)
  <option value="{{$room->id}}"
  @if ($form->room_id == $room->id)
  selected="selected"
  @endif
  >
  {{$room->name}}</option>
  @endforeach
  </select>

  @if ($errors->has('room_id'))
  <div class="error">{{$errors->first('room_id')}}</div>
  @endif
  </td></tr>
<tr><th>入居者名</th><td><input type="text" name="name" value="{{$form->name}}">
@if ($errors->has('name'))
<div class="error">{{$errors->first('name')}}</div>
@endif
</td></tr>
<tr><th>入居日</th><td><input type="text" name="entrance_date" value="{{$form->entrance_date}}">
@if ($errors->has('entrance_date'))
<div class="error">{{$errors->first('entrance_date')}}</div>
@endif
</td></tr>
<tr><th>退居日</th><td><input type="text" name="exit_date" value="{{$form->exit_date}}">
@if ($errors->has('exit_date'))
<div class="error">{{$errors->first('exit_date')}}</div>
@endif
</td></tr>
<tr><th>TEL</th><td><input type="text" name="tel" value="{{$form->tel}}">
@if ($errors->has('tel'))
<div class="error">{{$errors->first('tel')}}</div>
@endif
</td></tr>
<tr><th>MAIL</th><td><input type="text" name="mail" value="{{$form->mail}}">
@if ($errors->has('mail'))
<div class="error">{{$errors->first('mail')}}</div>
@endif
</td></tr>
<tr><th></th><td><input type="submit" value="更新"></td></tr>

</table>
</form>
@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
