
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mizuno";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
/*$sql = "select * from treeview_items ";*/


$sql = "SELECT CODE AS id,nameof AS name,nameof AS text,'0' AS parent_id FROM sysappmenu

UNION
SELECT DISTINCT  b.`code`  parent_id,b.nameof AS name,b.nameof AS text,c.code  AS id 
FROM sysappmenu AS c LEFT JOIN sysappmenuitem AS b ON c.code = b.fcode  WHERE c.code  IS NOT NULL";

$res = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_assoc($res) ) { 
		$data[] = $row;
		
	}
	$itemsByReference = array();

// Build array of item references:
foreach($data as $key => &$item) {

   $itemsByReference[$item['id']] = &$item;
   // Children array:
   $itemsByReference[$item['id']]['children'] = array();
   // Empty data class (so that json_encode adds "data: {}" ) 
   $itemsByReference[$item['id']]['data'] = new StdClass();

}

// Set items as children of the relevant parent item.
foreach($data as $key => &$item)
   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
      $itemsByReference [$item['parent_id']]['children'][] = &$item;

// Remove items that were added to parents elsewhere:
foreach($data as $key => &$item) {
   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
      unset($data[$key]);
}
// Encode:
echo json_encode($data);
?>
