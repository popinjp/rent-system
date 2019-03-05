@extends ('layouts.rentapp')

@section ('title', '部屋番号削除')

@section ('menubar')
  @parent
  部屋番号削除
@endsection

@section('content')
<h2>部屋番号削除</h2>
<p>削除してよろしいですか?</p>
<table>
<form action="/rent/room/delete" method="post">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{$form->id}}">
<tr><th>部屋番号</th><td>{{$form->name}}</td></tr>
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
