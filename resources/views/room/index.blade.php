@extends ('layouts.rentapp')

<style>
  .pagination {font-size: 10pt;}
  .pagination li {display: inline-block;}

</style>


@section ('title', '部屋番号一覧')

@section ('menubar')
  @parent
  部屋番号一覧
@endsection

@section('content')
<h2>部屋番号一覧</h2>

<table>
<tr><th class="room">部屋番号</th></tr>

@foreach ($items as $item)
  <tr class="room">
    <td class="room"><a href="/rent/room/edit?id={{$item->id}}">{{ $item->name }}</a></td>
  </tr>
@endforeach
</table>
<a href="/rent/room/add">追加</a>

{{ $items->links() }}

@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 Annex Kawasaki
@endsection
