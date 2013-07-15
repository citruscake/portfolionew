<html lang='en' xml:lang='en' xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <link href='/css/bootstrap.css' rel='stylesheet' type='text/css'>
    <link href='/css/styles.css' rel='stylesheet' type='text/css'>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js' type='text/javascript'></script>
    <script src='./js/underscore.js' type='text/javascript'></script>
    <script src='./js/backbone.js' type='text/javascript'></script>
    <script src='./js/portfolio.js' type='text/javascript'></script>
  </head>
  <body>
    <div class='container-fluid'>
      <div class='row-fluid'>
        <div class='span1'></div>
        <div class='span10'>
          <h2>
            Ed Blundell: Portfolio
          </h2>
        </div>
      </div>
      <div class='row-fluid'>
        <div class='span12'>
          <div class='span1'></div>
          <div class='span10'>
            <div class='row-fluid'>
              <div class='span3' style='background-color:#555555;'>
                <div class='row-fluid'>
                  <div class='span4'></div>
                  <div class='span8' id='thumbnail_gallery'></div>
                </div>
              </div>
              <div class='span9'>
                <?php 
                	echo $content_for_layout; 
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id='templates'></div>
  </body>
</html>
