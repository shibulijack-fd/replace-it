
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="assets/css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

	<form>
		<textarea name="testData" id="testData" rows="4" cols="50"></textarea>
		<textarea name="returnData" id="returnData" rows="4" cols="50"></textarea>
		<br>
		<input type="button" name="submit" id="submit" value="Submit">
	</form>
	<div id="diffContent">
	</div>
	<script>
	$("#submit").click(function(){
		debugger;
		var textToBeReplaced = $("#testData").val();
		$.ajax({
		    type: 'POST',
		    dataType: "json",
		    url: 'home.php',
		    data: {"testData":textToBeReplaced},
		    cache: false,
		    success: function(data) {
		    	$("#returnData").val(data[0]);
		    	$("#diffContent").html(data[1]);
		    }
		});
	});
	</script>
</body>
</html>