@extends ('layouts.rentapp')

<style>
  .pagination {font-size: 10pt;}
  .pagination li {display: inline-block;}

</style>


@section ('title', '居住者一覧')

@section ('menubar')
  @parent
  居住者一覧
@endsection

@section('content')
<h2>入居者一覧</h2>

<table>
<tr>
  <th>部屋番号</th><th>入居者</th><th>入居時期</th><th>退居時期</th><th>TEL</th><th>MAIL</th></tr>

@foreach ($items as $item)
  <tr>
    <td>{{ $item->room->name }}</td>
    <td><a href="/rent/resident/edit?id={{$item->id}}">{{ $item->name }}</a></td>
    <td>{{ $item->entrance_date }}</td>
    <td>{{ $item->exit_date }}</td>
    <td>{{ $item->tel }}</td>
    <td>{{ $item->mail }}</td>
  </tr>
@endforeach
</table>
<a href="/rent/resident/add">追加</a>

{{ $items->links() }}

@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 Annex Kawasaki
@endsection
