<html lang='en' xml:lang='en' xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <link href='/css/bootstrap.css' rel='stylesheet' type='text/css'>
    <link href='/css/styles.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Quattrocento' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js' type='text/javascript'></script>
    <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' type='text/javascript'></script>
    <script src='./js/vendor/underscore.js' type='text/javascript'></script>
    <script src='./js/vendor/backbone.js' type='text/javascript'></script>
    <script src='/js/vendor/bootstrap.js' type='text/javascript'></script>
    <script src='./js/vendor/timeout/jquery.ba-dotimeout.min.js' type='text/javascript'></script>
    <script src='./js/portfolio.js' type='text/javascript'></script>
    <script src='./js/vendor/baseline.js' type='text/javascript'></script>
  </head>
  <body>
    <div class='clearfix' id='background_container'>
      <div id='header_bg_container'>
        <section class='content'>
          <div class='row-fluid' id='app_header'>
            <div class='span10'>
              <div class='title-frame'>
                <h2>
                  Ed's Portfolio
                </h2>
              </div>
            </div>
          </div>
          <div class='row-fluid' id='app_nav'>
            <div class='span10'>
              <ul class='nav nav-pills'>
                <li>
                  <a id='about_me_link'>
                    About me
                  </a>
                </li>
                <li>
                  <a id='projects_link'>
                    Projects
                  </a>
                </li>
                <li>
                  <a id='contact_me_link'>
                    Contact me
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </section>
      </div>
      <section class='content'>
        <div id='app_container'>
          <?php
          	echo $content_for_layout
          ?>
        </div>
      </section>
      <div id='footer_bg_container'></div>
    </div>
    <div id='templates'></div>
  </body>
</html>
