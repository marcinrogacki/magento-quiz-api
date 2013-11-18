<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title><?php echo isset($title) ? $title : "Magento Quiz API"; ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap-theme.min.css">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/index">Magento Quiz API</a>
        </div>

        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success disabled">Sign in (not supported yet)</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div><!-- /.container -->

    </div><!-- /.navbar -->

    <div class="container">
       
      <br /> 
      <br /> 
      <br /> 
      <br /> 
      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">

          <div class="row">
            <div class="col-1">

            <?php if (isset($alerts) && count($alerts)): ?>
              <div class="alerts">
                <?php foreach ($alerts as $alert): ?>
                  <div class="alert <?php echo $alert->twitter()?>">
                    <?php echo $alert->msg(); ?>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <!-- simple render view engine :) -->            
            <?php require($this->_view); ?> 
             
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <a href="/" class="list-group-item">Home</a>
<!--            <a href="/demo" class="list-group-item">Demo</a> -->
            <a href="/question/add" class="list-group-item">Add question</a>
            <a href="/question/list" class="list-group-item">List of questions</a>
          </div>
        </div><!--/span-->

          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
              <img src="/public/to-glory.jpg" alt="...">
            </div>
          </div>

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Nexway Lab 2013</p>
      </footer>

    </div><!--/.container-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <?php if (isset($js)): ?>
        <?php foreach ($js as $entry): ?>
            <script src="<?php echo $entry ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
  </body>
</html>
