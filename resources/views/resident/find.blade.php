@extends ('layouts.helloapp')

@section ('title', 'Edit')

@section ('menubar')
  @parent
  find
@endsection

@section('content')
{{-- モデル find --}}
<p>モデル 検索(find)</p>


<form action="/person/find" method="post">
{{ csrf_field() }}
<label for="input">ID：</label>
<input type="text" name="input" value="{{ $input }}">
<input type="submit" value="検索">
</form>

@if(isset($item))
<table>
<tr><th>ID検索</th></tr>
<tr><td>{{ $item->getData() }}</td></tr>
</table>
@endif

@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
