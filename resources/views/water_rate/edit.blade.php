@extends ('layouts.rentapp')

@section ('title', '水道料金表更新')

@section ('menubar')
  @parent
  水道料金表更新
@endsection

@section('content')
<h2>水道料金表更新</h2>
<p>{{ $message }}</p>

<table>
<form action="/rent/water-rate/edit" method="post">
{{ csrf_field() }}

<input type="hidden" name="id" value={{$form->id}}>

<tr><th>年月</th><td>
  <select name="year_month">

  <option value="">選択してください</option>
  @foreach (['201901'=>'2019/01', '201902'=>'2019/02', '201903'=>'2019/03'] as $year_month_key => $year_month_value)
  <option value="{{$year_month_key}}"
  @if ($form->year_month == $year_month_key)
  selected="selected"
  @endif
  >
  {{$year_month_value}}</option>
  @endforeach
  </select>

  @if ($errors->has('year_month'))
  <div class="error">{{$errors->first('year_month')}}</div>
  @endif
  </td></tr>
<tr><th>八尾市水道料金表URL</th><td><input type="text" name="water_rate_url" value="{{$form->water_rate_url}}">
@if ($errors->has('water_rate_url'))
<div class="error">{{$errors->first('water_rate_url')}}</div>
@endif
</td></tr>
<tr><th></th><td><input type="submit" value="取り込み"></td></tr>
</table>
</form>
<a href="/rent/water-rate">確認(戻る)</a>

{{-- 水道料金表を20行x5列で表示 --}}
<?php
$water_rate_data_20x5 = array();
if (count($water_rate_data) > 0) {
  for ($i=0; $i < 20; $i++) {
    $water_rate_data_20x5[$i + 0] = number_format($water_rate_data[$i + 0]);
    $water_rate_data_20x5[$i + 20] = number_format($water_rate_data[$i + 20]);
    $water_rate_data_20x5[$i + 40] = number_format($water_rate_data[$i + 40]);
    $water_rate_data_20x5[$i + 60] = number_format($water_rate_data[$i + 60]);
    $water_rate_data_20x5[$i + 80] = number_format($water_rate_data[$i + 80]);
  }
}
?>

<?php
    $capture_date = date('Y/n/d', strtotime($form->capture_date));  // 水道料金取り込み日付け
?>
<p>
@if (count($water_rate_data_20x5))
<br><hr><br>
<table>
<caption>八尾市水道料金表 ({{$capture_date}}取り込み)</caption>
<tr>
<th class="water_rate_amount_head">使用量</th><th class="water_rate_rate_head">料金</th>
<th class="water_rate_amount_head">使用量</th><th class="water_rate_rate_head">料金</th>
<th class="water_rate_amount_head">使用量</th><th class="water_rate_rate_head">料金</th>
<th class="water_rate_amount_head">使用量</th><th class="water_rate_rate_head">料金</th class="water_rate_head">
<th class="water_rate_amount_head">使用量</th><th class="water_rate_rate_head">料金</th>
</tr>
@foreach ($water_rate_data_20x5 as $water_rate_key => $water_rate_value)
@if ($water_rate_key < 20)
<tr>
@endif
<th class="water_rate_amount">{{ $water_rate_key }}</th>
<td class="water_rate_rate">{{ $water_rate_value }}</td>
@if ($water_rate_key >= 80)
</tr>
@endif
@endforeach
</table>

<a href="/rent/water-rate">確認(戻る)</a>
@endif
</p>

@endsection

@section('footer')
@php
echo date("Y年n月j日");
@endphp
copyright 2019 popin
@endsection
