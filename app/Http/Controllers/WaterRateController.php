<?php

namespace App\Http\Controllers;

use App\WaterRate;
use App\libs\Common;
use Illuminate\Http\Request;

class WaterRateController extends Controller
{
    //
    public function index (Request $request) {
        $items = WaterRate::orderBy('year_month', 'asc')
          ->simplePaginate(20);
        return view('water_rate.index', ['items'=>$items]);
    }

    public function add (Request $request) {
      return view('water_rate.add', ['input'=>'']);
    }

    public function create (Request $request) {
      $this->validate($request, WaterRate::$rules);
      $water_rate = new WaterRate;
      $form = $request->all();
      unset($form['_token']); // form中の_tokenのみ保存対象から除外
      $water_rate->fill($form)->save();

      
      $context_option = stream_context_create(array(
        'http' => array('ignore_errors' => true)
      ));
      $water_rate_html = file_get_contents($request->water_rate_url, false, $context_option);
      preg_match("/[0-9]{3}/", $http_response_header[0], $stcode);
      switch ($stcode[0]) {
        case '200':
          // 200の場合
        break;
        case "404":
          // 404の場合
        break;
        case '500':
        default:
        break;
      }
      \Debugbar::info('指定のURLから水道料金データの取り込みができませんでした ' . $stcode[0]);

      $water_rate_html_trim = preg_replace("/(　|\,|<br >)/", "", $water_rate_html );
      $water_rate_html_trim = preg_replace("/( |　)+</", "<", $water_rate_html_trim );
      $water_rate_html_trim = preg_replace("/>( |　)+/", ">", $water_rate_html_trim );

      $pattern_table = '/(<table.*<\/table>)/i';
      if (preg_match($pattern_table, $water_rate_html_trim, $water_rate_table)) {
        $common = new Common();
        $common->get_water_rate_array($water_rate_table[1]);
      }
      return redirect('/rent/water-rate');
    }

    public function edit (Request $request) {
      $water_rate = WaterRate::find($request->id);

      $water_rate_data = array();
      if ($water_rate->water_rate_data) {
        $water_rate_data = json_decode($water_rate->water_rate_data);
        \Debugbar::info($water_rate_data);
      }

      $message = '「八尾市の水道料金表」のURLを入力してください';
      $param = ['form' => $water_rate, 'water_rate_data' => $water_rate_data, 'message' => $message];
      return view('water_rate.edit', $param);
    }

    public function update (Request $request) {
      $this->validate($request, WaterRate::$rules);  // バリデーション

      /* 指定URLのデータ読込み */
      $context_option = stream_context_create(array(
        'http' => array('ignore_errors' => true)
      ));
      $water_rate_html = file_get_contents($request->water_rate_url, false, $context_option);
      preg_match("/[0-9]{3}/", $http_response_header[0], $stcode);
      switch ($stcode[0]) { // エラー種毎に処理を行う場合
        case '200':
        break;
        case "404":
        break;
        case '500':
        default:
        break;
      }
      \Debugbar::info('指定のURLから水道料金データの取り込みができませんでした ' . $stcode[0]);

      /* 水道料金表データの取り込み */
      $water_rate_html_trim = preg_replace("/(　|\,|<br >)/", "", $water_rate_html ); // データ中の改行削除
      $water_rate_html_trim = preg_replace("/( |　)+</", "<", $water_rate_html_trim ); // データ中の空白削除
      $water_rate_html_trim = preg_replace("/>( |　)+/", ">", $water_rate_html_trim ); // データ中の空白削除

      $water_rate_data = array();
      $pattern_table = '/(<table.*<\/table>)/i';
      if (preg_match($pattern_table, $water_rate_html_trim, $water_rate_table)) { // table ブロックの取り出し
        $common = new Common();
        $water_rate_data = $common->get_water_rate_array($water_rate_table[1]); // 水道料金データの取り出し(連想配列)
      }
      $water_rate_data_json = json_encode($water_rate_data);
      \Debugbar::info($water_rate_data_json);

      // データ取り込み成功確認

      $message = '';
      if (count($water_rate_data) > 0) {
        $message = '水道料金データの取り込みを行いました。';
        $water_rate_data_information = ['water_rate_data' => $water_rate_data_json,
          'capture_date' => date('Y-m-d H:i:s')];
      } else {
        $message = '水道料金データの取り込みができませんでした。';
        $water_rate_data_information = ['water_rate_data' => $water_rate_data_json];
      }


      /* データベースへ格納 */
      $water_rate = WaterRate::find($request->id);  // 
      $form = $request->all();
      unset($form['_token']); // form中の_tokenのみ保存対象から除外
      
      $water_rate->fill($form)->fill($water_rate_data_information)->save();



      $param = ['form' => $water_rate, 'water_rate_data'=>$water_rate_data, 'message'=>$message];
      return view('water_rate.edit', $param);
//      return redirect('/rent/water-rate');
    }

    public function delete (Request $request) {
      $water_rate = WaterRate::find($request->id);
      return view('water_rate.delete', ['form' => $water_rate]);
    }

    public function remove (Request $request) {
      WaterRate::find($request->id)->delete();
      return redirect('/rent/water-rates');
    }
}
