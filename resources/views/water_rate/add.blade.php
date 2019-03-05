@extends ('layouts.rentapp')

@section ('title', '水道料金表追加')

@section ('menubar')
  @parent
  水道料金表追加
@endsection

@section('content')
<h2>水道料金表追加</h2>

<table>
<form action="add" method="post">
{{ csrf_field() }}



<tr><th>年月</th><td>
  <select name="year_month">
  <option value="">選択してください</option>
  @foreach (['201901'=>'2019/01', '201902'=>'2019/02', '201903'=>'2019/03'] as $year_month_key => $year_month_value)
  <option value="{{$year_month_key}}">{{$year_month_value}}</option>
  @endforeach
  </select>

  @if ($errors->has('year_month'))
  <div class="error">{{$errors->first('year_month')}}</div>
  @endif
  </td></tr>

<tr><th>水道料金表URL</th><td><input type="text" name="water_rate_url"
  value="{{old('water_rate_url')}}">
  @if ($errors->has('water_rate_url'))
  <div class="error">{{$errors->first('water_rate_url')}}</div>
  @endif
  </td></tr>

<tr><th></th><td><input type="submit" value="追加"></td></tr>

</table>
</form>
<a href="/rent/water-rate">戻る</a>
@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
