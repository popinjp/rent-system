@extends ('layouts.rentapp')

<style>
  .pagination {font-size: 10pt;}
  .pagination li {display: inline-block;}

</style>


@section ('title', '水道料金表')

@section ('menubar')
  @parent
  水道料金表
@endsection

@section('content')
<h2>水道料金表</h2>

<table>
<tr>  <th>年月</th><th>水道料金表</th></tr>

@foreach ($items as $item)
  <tr>
    <td><a href="/rent/water-rate/edit?id={{$item->id}}">{{ $item->year_month }}</a></td>
    <td>{{ $item->water_rate_url }}</td>
  </tr>
@endforeach
</table>
<a href="/rent/water-rate/add">追加</a>

{{ $items->links() }}

@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 Annex Kawasaki
@endsection
