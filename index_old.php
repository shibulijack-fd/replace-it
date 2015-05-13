
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
require_once './lib/Diff.php';
require_once './lib/Diff/Renderer/Html/SideBySide.php';
GLOBAL $find, $replace, $testData, $replacedData;
?>
	<?php if (!isset($_POST['submit'])) {	?>
	<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
		<textarea name="testData" id="testData" rows="4" cols="50"></textarea>
		<input type="submit" name="submit">
	</form>
	<? } /* if post data */ 
	else {
		// echo "test";
		$inputFileName = './test.xlsx';  // File to read
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} 
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		$i=0;
		foreach($sheetData as $rec)
		{
			$find[$i] = '/\b'.$rec['A'].'\b/u';
			$replace[$i] = $rec['B'];
			$i++;
		}
		$testData = $_POST['testData'];
		$replacedData = preg_replace($find,$replace,$testData,-1,$count); 
		// echo $count;

		if($count > 0) {
			?>
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				<textarea name="testData" id="testData" rows="4" cols="50"><?php echo $replacedData; ?></textarea>
				<input type="submit" name="submit">
			</form>
		<?

		$a = explode("\n", $testData);
		$b = explode("\n", $replacedData);
		$options = array(
			//'ignoreWhitespace' => true,
			//'ignoreCase' => true,
			);

		// Initialize the diff class
		$diff = new Diff($a, $b, $options);
		$renderer = new Diff_Renderer_Html_SideBySide;
		echo $diff->Render($renderer);

		}
		else {
			echo "No replacements";
		}

	}

	?>
	
</body>
</html>