@extends ('layouts.rentapp')

@section ('title', '部屋番号更新')

@section ('menubar')
  @parent
  部屋番号更新
@endsection

@section('content')
<h2>部屋番号更新</h2>

<table>
<form action="/rent/room/edit" method="post">
{{ csrf_field() }}

<input type="hidden" name="id" value={{$form->id}}>
<tr><th>部屋番号</th><td><input type="text" name="name" value="{{$form->name}}">
@if ($errors->has('name'))
<div class="error">{{$errors->first('name')}}</div>
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
