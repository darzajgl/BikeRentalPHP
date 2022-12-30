<?php
function menu($page_title){
    echo '
  <html>
  <body>
  <div id="container">
  <!--        <div id="topbar">-->
  <!--        <div id="topbar-left">-->
  <!--            <img src="images/cyclist_ws.png">-->
  <!--        </div>-->
  <!--        <div id="topbar-right">-->
  <!--            BIKE RENTAL<br/>-->
  <!--        </div>-->
  <!--        <div style="clear:both;"></div>-->
      </div>
      <div id="logo">
          '.$page_title.'
      </div>
      <div id="menu">
          <div class="option" onclick="location.href=\'index.php\'">Strona Główna</div>
          <div class="option" onclick="location.href=\'account.php\'">Konto</div>
          <div class="option" onclick="location.href=\'login_form.php\'">Logowanie</div>
          <div class="option" onclick="location.href=\'register_form.php\'">Rejestracja</div>
          <div class="option" onclick="location.href=\'admin_form.php\'">Administracja</div>
          <div class="option" onclick="location.href=\'about.php\'">Informacje</div>
          <div class="option" onclick="location.href=\'cart.php\'">Koszyk</div>
          <div style="clear:both;"></div>
      </div>
  </div>
  </body>
  </html>
  ';
}

function footer(){
    echo '
  <!DOCTYPE html>
  <html lang="pl-PL">
  <body>
       <div id="footer"> *********PROJEKT TI********</div>
  </div>
  </body>
  </html>
  ';
}
?>