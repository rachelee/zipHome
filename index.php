<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./dist/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container search">

      <form  role="form" action="<?=$_SERVER['PHP_SELF'];?>", method='get'>
        <div class="form-group" style="margin-bottom:20px">
          <div class="input-group-lg col-lg-6 col-lg-offset-3">
            <input type="text" name = "text_input" class="form-control">
          </div>
        </div><!-- /.form-group -->
        <div class="panel panel-default col-lg-6 col-lg-offset-3" style="margin-top: 30px;">
          <div class="form-group">
            <div class="panel-body">
              <div class = "row">
                <input type="radio" name="search_type" value="City"> Search by City </input>
                <input type="radio" name="search_type" value="Company"> Search by Company </input>
                <input type="radio" name="search_type" value="Community"> Search by Community </input>
              </div>
            </div>
          </div>
          <div class="form-group" >
            <span> Price </span>
            
            <input type="text" name = "price_from">
            to
            <input type="text" name = "price_to">
          </div>
          <div class = "form-group">
            <div>
              <p>Bedrooms</p> 
              <select name="bedroom">
               <option value=""></option>
               <option value="1">1 bedroom</option>
               <option value="2">2 bedrooms</option>
               <option value="3+">3 and more</option>
              </select>
            </div>
            <div>
              <p>Bathrooms</p> 
              <select name="bathroom">
               <option value=""></option>
               <option value="1">1 bathroom</option>
               <option value="2">2 bathrooms</option>
               <option value="3+">3 and more</option>
              </select>
            </div>
          </div><!--end bedroom bathroom form-group-->
          <div class="form-group">
            <button type="submit" class="btn btn-default"> Search </button>
          </div>
          
        </div><!-- end panel-->
        <div class="panel panel-default col-lg-6 col-lg-offset-3" >
          <div class = "form-group">
            <h2>Other Options</h2>
            <h3>Property Options</h3>
            <div>
              <p>Pet Policy</p>
              <select name="pet">
               <option value=""></option>
               <option value="Not allowed">Not allowed</option>
               <option value="Cat only">Cat only</option>
               <option value="Allowed">Allowed</option>
              </select>
            </div>
            <div>
              <p>Parking</p>
              <select name="parking">
               <option value=""></option>
               <option value="Garage">Garage</option>
               <option value="Carport">Carport</option>
               <option value="Open space">Open space</option>
              </select>
            </div>
            
            <h3>Options for search by community only</h3>
            <div>
              <p>Smoking Policy</p>
              <select name="smoking">
               <option value=""></option>
               <option value="Allowed">Allowed</option>
               <option value="Not allowed">Not Allowed</option>
              </select>
            </div>
            <div>
              <p>Payment Types</p>
              <select name = "payment">
               <option value=""></option>
               <option value="Cash only">Cash Only</option>
               <option value="Cash and Check">Cash and Check</option>
               <option value="Cash check or credit card">Cash, Check and Credit Card</option>
              </select>
            </div>
          </div>
        </div>
      </form>
    </div><!-- /.container -->
        
      
    <div class="container result" id="result">
      <div class="panel panel-default col-lg-6  col-lg-offset-3" style="margin-top: 30px;">
    <?php
      include('./search_result.php');
    ?>
      </div>
    </div><!-- /.container -->
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
