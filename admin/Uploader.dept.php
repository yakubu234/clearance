<?php
include "../classes/db.php";
include "geter.php";
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
class ChunkReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
  private $startRow = 0;
  private $endRow   = 0;

  /**  Set the list of rows that we want to read  */
  public function setRows($startRow, $chunkSize) {
    $this->startRow = $startRow;
    $this->endRow   = $startRow + $chunkSize;
  }

  public function readCell($column, $row, $worksheetName = '') {
        //  Only read the heading row, and the configured rows
    if (($row == 1) || ($row >= $this->startRow && $row < $this->endRow)) {
      return true;
    }
    return false;
  }
}
if(isset($_FILES['file'])){ 
  $conn = DB();  
  $inputFileName = $_FILES['file']['tmp_name'];
  try {
#log the user actions 
    $function = "user with name ".$username." uploaded an Excel Sheet to the department  table ";
    $ua = LoadUser($userid,$username, $admin_email,$function);
    /**  Identify the type of $inputFileName  **/
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Define how many rows we want to read for each "chunk"  **/
    $chunkSize = 2048;
    /**  Create a new Instance of our Read Filter  **/
    $chunkFilter = new ChunkReadFilter();

    /**  Tell the Reader that we want to use the Read Filter  **/
    $reader->setReadFilter($chunkFilter);

    /**  Loop to read our worksheet in "chunk size" blocks  **/
    for ($startRow = 2; $startRow <= 65536; $startRow += $chunkSize) {
      /**  Tell the Read Filter which rows we want this iteration  **/
      $chunkFilter->setRows($startRow,$chunkSize);
      /**  Load only the rows that match our filter  **/
      $spreadSheet = $reader->load($inputFileName);
      $excelSheet = $spreadSheet->getActiveSheet();
      $spreadSheetAry = $excelSheet->toArray();
      $sheetCount = count($spreadSheetAry);
      $sn = 0;$number ='';
      for ($i = 1; $i <= $sheetCount; $i ++) {
            $department = $spreadSheetAry[$i][0];//column A
            if (empty($department)) {
              continue;
            }
            #insert as new item to table

            $dataUp[] = [
              'name' => $department,
              'creator_id' => $userid,
              'creator_name' => $username,
              'status' => '1'
            ];
            $number = $sn;
            $sn++;
          } 
          try{
          $insert = "INSERT INTO department (name,creator_id,creator_name,status) VALUES (:name,:creator_id,:creator_name,:status)ON DUPLICATE KEY UPDATE name = :name";
          $stmtw = $conn->prepare($insert);
          $conn->beginTransaction();
          for ($i = 0; $i <=  $number; $i++) {
          $stmtw->execute(['name' => $dataUp[$i]['name'],'creator_id' => $dataUp[$i]['creator_id'],'creator_name' => $dataUp[$i]['creator_name'],'status' => $dataUp[$i]['status']]);
          }

          $conn->commit();
          } catch(PDOException $e) {
          // echo  $e->getMessage();die;
          }
        }
        $_SESSION['uploaded_data'] = $dataUp;
        $_SESSION['success'] = " Upload successful, here are your uploads";
        header('location:dept.upload.view');
		#catch exception here
      } catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        die('Error loading file: '.$e->getMessage());
      }
    }

    ?>