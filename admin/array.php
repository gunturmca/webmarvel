<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <?php
	$name= array();
	$value1= array();
	$columns[] =array();
	$type[] =array();
	$fields='';
	$values='';

/*for ($x = 1; $x <= 100; $x++)
	{
		print $array[$x-1] . ', ';
		
	}*/
foreach($_POST as $key=>$value){
	$name[]= $key;
	$value1[]= $value;

}
/*for ($x = 1; $x <= count($name); $x++)
	{
			print $name[$x-1] . ', ';
			print $value1[$x-1] . ', ';
			
		
	}*/
	
	
require 'db.php';
if(isset($_POST['test']))
{

	$sql = 'SHOW COLUMNS FROM tkepala_keluarga';
	$res = mysqli_query($con,$sql);
	$i = 0;
	while($row = mysqli_fetch_array($res)){
		$columns[] = $row['Field'];
		$type[] = $row['Type'];
		
		echo "{$row['Field']} - {$row['Type']}\n";
		$i=$i++;
	}

}
for ($x = 1; $x <= count($name); $x++)
{
	for ($y = 1; $y <= count($columns); $y++)
	{
		if ($name[$x-1]==$columns[$y-1])
		{
			$fields =  $fields . ', ' . $name[$x-1]; 
			$values =  $values . ', ' . $columns[$y-1] ;
		}
	}
}
print $fields;
print $values;
?>
</head>

<body>
<p>

  
</p>
<form  id = "form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td>
      <label>
        <input type="text" name="idkk" id="deni" />
        </label>
       </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <label>
        <input type="text" name="nokk" id="asep" />
        </label>
       </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="test" value="OK" /></td>
  </tr>
</table>
</form> 
</body>
</html>
