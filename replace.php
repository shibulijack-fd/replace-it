
<?php
/** Include path **/
header ("content-type: application/json; charset=utf-8");
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include './lib/PHPExcel/IOFactory.php';
require_once './lib/Diff.php';
require_once './lib/Diff/Renderer/Html/SideBySide.php';
GLOBAL $find, $replace, $testData, $replacedData;
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
// $testData = $_POST['testData'];
$testData = $_POST['testData'];
$replacedData = preg_replace($find,$replace,$testData,-1,$count); 
// echo $count;

if($count > 0) {

	$a = explode("\n", $testData);
	$b = explode("\n", $replacedData);
	$options = array(
	//'ignoreWhitespace' => true,
	//'ignoreCase' => true,
		);

// Initialize the diff class
	$diff = new Diff($a, $b, $options);
	$renderer = new Diff_Renderer_Html_SideBySide;
	$diffContent = $diff->Render($renderer);

}
else {

	$diffContent = "<h2>No Replacements</h2>";
}
$returnArray = array($replacedData, $diffContent);
echo json_encode($returnArray);

?>