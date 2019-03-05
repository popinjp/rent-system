<html>
<head>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/css/app.css">
  <style>
  body  { font-size: 16pt; color: #999; margin: 5px; }
  h1 { font-size: 50pt; text-align:right; color: #f6f6f6;
    margin: -20px 0px -30px 0px; letter-spacing: -4pt; }
  ul { font-size: 12pt; }
  hr { margin: 25px 100px; border-top: 1pt dashed #ddd; }
  .menutitle { font-size: 14pt; font-weght: bold; margin: 0px; }
  .footer { text-align:right; font-size: 10pt; margin: 10px;
    border-bottom: solid 1px #ccc; color: #ccc }
  p.today { font-size: 12pt; color: #999; margin: 5px}

  div.content {
    margin: 30px 0 0 0;
  }

  h2 {font-size: 14pt; color: #666;}

  th.water_rate_amout_head {text-align: center; width: 25px; background-color: #999; color: fff; padding: 1px 1px; }
  th.water_rate_rate_head {text-align: center; width: 75px; background-color: #999; color: fff; padding: 1px 1px; }
  th.water_rate_amount {text-align: center; background-color: #ddd; color: #666; padding: 1px 2px; }
  td.water_rate_rate {text-align: right; border: solid 1px #aaa; color:#666; padding: 1px 8px; }
  caption {color: #006633; caption-side: top; }

  th.room {width: 150px; text-align: center;}
  td.room {text-align: center}

  th.resident_room {width: 80px; text-align: center;}
  th.resident_name {width: 120px; text-align: center;}
  th.resident_entrance {width: 120px; text-align: center;}
  th.resident_exit {width: 120px; text-align: center;}
  th.resident_tel {width: 120px; text-align: center;}
  th.resident_mail {width: 200px; text-align: center;}

  td.resident_room {text-align: center;}
  td.resident_name {text-align: center;}
  td.resident_entrance {text-align: center;}
  td.resident_exit {text-align: center;}
  td.resident_tel {text-align: center;}
  td.resident_mail {text-align: center;}

  th {background-color: #999; color:#fff; padding: 1px 1px; }
  td {border: solid 1px #aaa; color:#999; padding: 1px 1px; }
  input[type="text"] {border: solid 1px #ccc;}
  div.error {font-size: 11pt; color: #c00}

.nav {
  list-style: none;
}
 
.nav_main {
  width: 120px;
  margin: 0px 100px 0px 0px;
  padding: 2px 0px 2px 0px;
  border: none;
  border-radius: 7px 7px 0 0;
  text-align: center;
  color: #fff;
  background-color: #933;
  display: inline-block;
}
.nav_sub {
  width: 120px;
  margin: 0px 5px 0px 0px;
  padding: 2px 0px 2px 0px;
  border: none;
  border-radius: 7px 7px 0 0;
  text-align: center;
  background-color: #fbb;
  display: inline-block;
} 
a.nav_main {
  text-decoration: none;
  color: #fff;
  font-weight: bold;
}
a.nav_sub {
  text-decoration: none;
  color: #a44;
  font-weight: bold;
}

hr.nav {
  height: 0;
  margin: 0;
  padding: 0;
  border: 0;
  border-top: 1px solid #933;

}

  </style>

</head>
<body>

  <h1>@yield('title')</h1>
  @section('menubar')
  <ul class="nav">
  <li class="nav_main"><a href="/rent/water-bill" class="nav_main">水道料金請求</a></li>
  <li class="nav_sub"><a href="/rent/water-rate" class="nav_sub">水道料金表</a></li>
  <li class="nav_sub"><a href="/rent/resident" class="nav_sub">入居者</a></li>
  <li class="nav_sub"><a href="/rent/room" class="nav_sub">部屋番号</a></li>

  </ul>

  <hr class="nav">

  <div class="content">
    @yield('content')
  </div>

  <div class="footer">
    @yield('footer')
  </div>

  <p class="today"><?php echo date("Y年n月j日"); ?></p>
</body>
</html>
