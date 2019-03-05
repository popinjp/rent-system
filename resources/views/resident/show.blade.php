@extends ('layouts.helloapp')

@section ('title', 'Show')

@section ('menubar')
  @parent
  詳細ページ
@endsection

@section('content')
{{-- DBクラス show --}}
<p>DBクラス show</p>

<table>
<tr><th>ID</th><td>{{$item->id}}</td></tr>
<tr><th>名前</th><td>{{$item->name}}</td></tr>
<tr><th>メール</th><td>{{$item->mail}}</td></tr>
<tr><th>年齢</th><td>{{$item->age}}</td></tr>

</table>
</form>
@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
