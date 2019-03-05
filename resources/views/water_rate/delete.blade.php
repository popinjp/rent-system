@extends ('layouts.rentapp')

@section ('title', '入居者削除')

@section ('menubar')
  @parent
  入居者削除
@endsection

@section('content')
<h2>入居者削除</h2>
<p>削除してよろしいですか?</p>
<table>
<form action="/rent/resident/delete" method="post">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{$form->id}}">
<tr><th>部屋番号</th><td>{{$form->room_id}}</td></tr>
<tr><th>入居者名</th><td>{{$form->name}}</td></tr>
<tr><th>入居日</th><td>{{$form->entrance_date}}</td></tr>
<tr><th>退居日</th><td>{{$form->exit_date}}</td></tr>
<tr><th>TEL</th><td>{{$form->tel}}</td></tr>
<tr><th>MAIL</th><td>{{$form->mail}}</td></tr>
<tr><th></th><td><input type="submit" value="削除"></td></tr>

</table>
</form>
@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
