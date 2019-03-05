<?php
namespace app\Libs;
class Common
{
   /* 八尾市水道料金HTML解析用 レコード抽出
    *
    * trタグで囲まれたtrタグを含む文字列を抽出する。
    * 八尾市水道料金HTMLでは、1行に2レコードが含まれる
    * ★DOMによる抽出を試みたが、文字化けするので本関数で抽出している。
    * 
    * @param string $html 八尾市水道料金テーブルを含むHTML
    * @param int $offset 検索開始文字位置
    * @return integer $messageId メッセージID（エラー時は0）← 戻り値
    */
    public function get_water_rate_array($html) {
        $html_length = mb_strlen($html);
        if ($html_length == 0) {
          return false;
        }
        $offset = 0;
        $pattern_tr = '<tr';
        $pattern_end_tr = '</tr'; // スラッシュのエスケープは不要
        $water_rate_data = array();
  
        while ($offset <= $html_length) {
          $tr_offset = mb_strpos($html, $pattern_tr, $offset); // trタグの検出
          $end_tr_offset = mb_strpos($html, $pattern_end_tr, $tr_offset); //</tr>の検出
          if ($tr_offset !== false && $end_tr_offset !== false) {
              $end_tr_offset += 5; // tr終了タグの次位置
              $offset = $end_tr_offset; // 次検索位置
              $tr_str = mb_substr($html, $tr_offset, $end_tr_offset - $tr_offset);
              // tr レコードが検出されたので、データを抽出
              $start_offset = 0; // 検索開始位置
              $element_data = [];
              for ($i = 0; $i < 8; $i++) {
                  [$start_offset, $end_offset] = $this->get_element_position($tr_str, $start_offset);
                  $element_length = $end_offset - $start_offset;
                  if ($element_length <= 0) {
                    if ($i > 3) { // エレメントが空白だが、表の左段エレメントがあるのでレコード取り込みを行う
                      continue 1;
                    } else { // エレメントが見つからないので、次 tr レコードを探す
                      continue 2;
                    }
                  }
                  $element = trim(mb_substr($tr_str, $start_offset, $element_length));
                  $element = preg_replace('/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', $element); // 日本語を含む trim
                  $element = str_replace(',', '', $element); // 数字中の , を削除

                  if (!is_numeric($element)) { // 数値ではないので次 tr レコードを探す
                    if ($i > 3) { // 行の左段データは有効なので、本行のデータ取り込みを行う
                      continue 1;
                    } else {
                      \Debugbar::info('データが数値ではないのでこの行を読み飛ばしました'); /* ★★ デバッグ ★★ */
                      continue 2;
                    }
                  }
                  $element_data[$i] = $element;
                  $start_offset += $element_length; // 次のエレメント検索位置
              }
              // tr 内のすべてのエレメントの検索を完了したので水道料金連想配列に追加する
              if (isset($element_data[0]) && isset($element_data[3])) {
                $water_rate_data += array($element_data[0] => $element_data[3]);
              }
              if (isset($element_data[4]) && isset($element_data[7])) {
                $water_rate_data += array($element_data[4] => $element_data[7]);
              }
            } else {
              $offset = $html_length + 1; // trタグが見つからない
            }

          }

          ksort($water_rate_data); // 水道料金データをキーで昇順ソート
          if (in_array(0, $water_rate_data)) {
            $water_rate_data = array();
            \Debugbar::info('水道料金取り込みデータは、値に0が含まれているので無効です。'); // ★★ デバッグ ★★
          }

          for ($i=0; $i <= 50; $i++) {
            if (!isset($water_rate_data[$i])) {
              $water_rate_data = array();
              \Debugbar::info('水道料金取り込みデータは、0～50リットルの間で値に抜けがあるため無効です。'); // ★★ デバッグ ★★
            }
          }      
          return $water_rate_data;
        }
  
      /* エレメントデータ抽出
      *
      * thタグまたはtdタグで囲まれた内側の文字列を抽出する。
      * 八尾市水道料金HTMLでは、1行に2レコードが含まれる
      * ★DOMによる抽出を試みたが、文字化けするので本関数で抽出している。
      * 
      * @param string $html 八尾市水道料金テーブルを含むHTMLのtrタグレコード
      * @param int $offset 検索開始文字位置
      * @return [integer $start_offset, integer $end_offset] エレメント先頭位置、エレメント最後の次位置
      */
      public function get_element_position($html, $offset) {
        $html_length = mb_strlen($html);
        if ($html_length == 0) {
          return false;
        }
        $start_offset = $offset;
        $end_offset = $offset;
        $pattern_th = '<th';
        $pattern_end_th = '</th';
        $pattern_td = '<td';
        $pattern_end_td = '</td';
        $pattern_end_tag = '>';
  
  
        while ($end_offset <= $html_length) {
          $th_offset = mb_strpos($html, $pattern_th, $offset); // thタグの検出
          $td_offset = mb_strpos($html, $pattern_td, $offset); // tdタグの検出
  
          if ($th_offset !== false && $td_offset !== false) {
            $start_offset = ($th_offset <= $td_offset ? $th_offset : $td_offset);
          } elseif ($th_offset === false) {
            $start_offset = $td_offset;
          } elseif ($td_offset === false) {
            $start_offset = $th_offset;
          } else {
            $start_offset = $html_length + 1; // thタグ、tdタグのいずれも見つからない
            break;
          }
          $start_offset = mb_strpos($html, $pattern_end_tag, $start_offset); // タグ終了の検出
          if ($start_offset === false) {
            $start_offset = $html_length + 1; // thタグ終了、tdタグ終了のいずれも見つからない
            break;
          }
          $start_offset += 1; // エレメント開始位置
  
          // エレメントスタート位置が見つかったのでエレメント終了位置を探す
          $th_end_offset = mb_strpos($html, $pattern_end_th, $start_offset); // th終了タグの検出
          $td_end_offset = mb_strpos($html, $pattern_end_td, $start_offset); // td終了タグの検出
          if ($th_end_offset !== false && $td_end_offset !== false) {
            $end_offset = ($th_end_offset <= $td_end_offset ? $th_end_offset : $td_end_offset);
          } elseif ($th_offset === false) {
            $end_offset = $td_end_offset;
          } elseif ($td_offset === false) {
            $end_offset = $th_end_offset;
          } else {
            $end_offset = $html_length + 1; // thタグ、tdタグが見つからない
          }
          break; // エレメントの終了位置が確定したのでループ終了
        }
        $end_offset = ($start_offset > $end_offset) ? $start_offset : $end_offset;
        return [$start_offset, $end_offset];
      }
}