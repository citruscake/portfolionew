<html lang='en' xml:lang='en' xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <link href='/css/bootstrap.css' rel='stylesheet' type='text/css'>
    <link href='/css/site_styles.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Quattrocento' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Allan:bold' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js' type='text/javascript'></script>
    <script src='./js/underscore.js' type='text/javascript'></script>
    <script src='./js/backbone.js' type='text/javascript'></script>
    <script src='./js/portfolio.js' type='text/javascript'></script>
  </head>
  <body>
    <div id='gradient_container'>
      <div class='container-fluid' id='app_header'>
        <div class='header_inner_container'>
          <div class='row-fluid'>
            <div class='span6 left-frame'>
              <div class='title-frame'>
                <h2>
                  Ed's Portfolio
                </h2>
              </div>
            </div>
          </div>
          <div class='row-fluid'>
            <div class='span12 right-frame'>
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
        </div>
      </div>
      <div class='container-fluid' id='app_container'>
        <?php
        	echo $content_for_layout
        ?>
      </div>
      <div id='templates'></div>
    </div>
  </body>
</html>
