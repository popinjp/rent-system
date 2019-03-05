@extends ('layouts.rentapp')

@section ('title', '部屋番号追加')

@section ('menubar')
  @parent
  部屋番号追加
@endsection

@section('content')
<h2>部屋番号追加</h2>

<table>
<form action="add" method="post">
{{ csrf_field() }}

<tr><th>部屋番号</th><td><input type="text" name="name"
  value="{{old('name')}}">
  @if ($errors->has('name'))
  <div class="error">{{$errors->first('name')}}</div>
  @endif
  </td></tr>
<tr><th></th><td><input type="submit" value="追加"></td></tr>

</table>
</form>
@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
