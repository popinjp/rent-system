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
  <th class="resident_room">部屋番号</th>
  <th class="resident_name">入居者</th>
  <th class="resident_entrance">入居時期</th>
  <th class="resident_exit">退居時期</th>
<!--  <th class="resident_tel">TEL</th> -->
  <th class="resident_mail">MAIL</th></tr>

@foreach ($items as $item)
<?php
    $entrance_date = date('Y/m/d', strtotime($item->entrance_date));  // 入居日
?>
  <tr>
    <td class="resident_room">{{ $item->room->name }}</td>
    <td class="resident_name"><a href="/rent/resident/edit?id={{$item->id}}">{{ $item->name }}</a></td>
    <td class="resident_entrance">{{ $entrance_date }}</td>
    <td class="resident_exit">{{ $item->exit_date }}</td>
<!--    <td class="resident_tel">{{ $item->tel }}</td> -->
    <td class="resident_mail">{{ $item->mail }}</td>
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
