<?php
header('Content-type: text/xml');

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";


$SignumID=$_GET['SignumID'];
//Connect to MSSQL database 
   
$myServer = "10.184.20.93";
$myUser = "sa";
$myPass = "optomation@123";
$myDB = "USERMANAGEMENT"; 
   
//create an instance of the ADO connection object
$conn = new COM ("ADODB.Connection")
  or die("Cannot start ADO");

//define connection string, specify database driver
$connStr = "PROVIDER=SQL Server Native Client 10.0 ;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB; 
  $conn->open($connStr); //Open the connection to the database

// $connect=mssql_connect("10.184.20.93","sa","optomation@123") or die("Cannot connect to the server");
// mssql_select_db("tab") or die (Cannot connect to the database);
//$query= "SELECT count(*) FROM [tab].[dbo].[register1] WHERE username='" . $username . "' and pass ='" . $pass . "'" ;
$query = "
SET NOCOUNT ON
exec [USERMANAGEMENT].[dbo].[user_sp_forgotPassword] '" . $SignumID . "' ";
$rs = $conn->execute($query);

// print $query;

$num_columns = $rs->Fields->Count();
for ($i=0; $i < $num_columns; $i++) {
    $fld[$i] = $rs->Fields($i);
} 
  echo "<catalog>";          
while (!$rs->EOF)  //carry on looping through while there are record
{
echo "<row>\n";
for ($i=0; $i < $num_columns; $i++)
    {
                if ($i == 0)
                {
                echo  "<flag>$fld[$i]</flag>";           
                }
				 }
				 
				echo "</row>";
                $rs->MoveNext();
				 
				 
}
				 //move on to the next record
///close the connection and recordset objects freeing up resources
echo "</catalog>";
//$rs->Close(); 
// if ($existCount == 1)
// {
// $_SESSION['SignumID'] = $SignumID;
// $_SESSION['Password'] = $Password;

// header("location: member3.php");
// exit();
// }
// else
// {
// echo 'That information is incorrect';
// exit();
// }


?>







