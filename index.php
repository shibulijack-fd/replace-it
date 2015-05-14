<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Replace It</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </head>
  <body>

  	<nav class="navbar navbar-inverse navbar-fixed-top">
  		<div class="container">
  			<div class="navbar-header">
  				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
  					<span class="sr-only">Toggle navigation</span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  				<a class="navbar-brand" href="#">Replace It</a>
  			</div>
  			<div id="navbar" class="navbar-collapse collapse">
  				
  			</div><!--/.navbar-collapse -->
  		</div>
  	</nav>

  	<div class="jumbotron">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-6">
  					<p>Original Content</p>
  					<textarea class="form-control" name="testData" id="testData" rows="7" ></textarea>
  				</div>
  				<div class="col-md-6">
  					<p>Replaced Content</p>
  					<textarea class="form-control" name="returnData" id="returnData" rows="7" ></textarea>
  				</div>
  			</div>
  			<div style="margin-top: 20px;"><button type="button" id="replaceText" class="btn btn-primary btn-lg btn-block">Replace It!</button></div>
  			<!-- <div class="row">
  				<div class="col-md-12">
  					<button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
  				</div>
  			</div> -->
  		</div>
  	</div>

  	<div class="container">

  		<div id="diffContent">
  			<div class="alert alert-info" role="alert">
  			  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
  			  Diff appears here after successful replacement.
  			</div>
  		</div>

  		<footer>
  			<p>&copy; Shibu Lijack 2014</p>
  		</footer>
  	</div> <!-- /container -->

  	
  	
  	<script>
  		$("#replaceText").click(function(){
        $('#diffContent').html('<img src="assets/images/load.gif" width="100" height="100" style="display: block; margin: auto;">');
  			var textToBeReplaced = $("#testData").val();
  			$.ajax({
  				type: 'POST',
  				dataType: "json",
  				url: 'replace.php',
  				data: {"testData":textToBeReplaced},
  				cache: false,
  				success: function(data) {
  					$("#returnData").val(data[0]);
  					$("#diffContent").html(data[1]);
  					$("#returnData").focus();
  				}
  			});
  		});
  	</script>
  	
  </body>
  </html>