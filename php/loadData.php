
<?php
	include 'PDOconnect.php';
	include '../js/jquery.pajinate.js';
	
	nothingConnect();
	$order = $_POST['order'];
	$sort = $_POST['sort'];
	if ($order == '' AND $sort == '') {$order = 'dataStamp'; $sort = 'DESC';}
	echo "<div id='paging_container1' class='container' style='width:735px;'>
				<div class='page_navigation' ></div></br>";
				
				 
	echo "<table border='1' class='table table-bordered table-hover table-condensed' >";
		
		echo "<tr>";
			echo "<th ><a href = 'javascript:void(0);' id = 'userName' class = '".$sort."'>UserName</a></th>";
			echo "<th ><a href = 'javascript:void(0);' id = 'eMail' class = '".$sort."' >eMail</a></th>";
			echo "<th>HomePage</th>";
			echo "<th>Message</th>";
			echo "<th>FileName</th>";
			echo "<th ><a href = 'javascript:void(0);' id = 'dataStamp' class = '".$sort."' >DataStamp</a></th>";
			
		echo "</tr>";
		echo  "<tbody class = 'content'>";
		$query = "SELECT * FROM `form_data_table` ORDER BY `$order` $sort ";
		$dataList = nothingSelect($query, NULL);
			while ($rowDataList = $dataList -> fetch()){
			echo "<tr >";		
				echo "<td>".$rowDataList['userName']."</td>";
				echo "<td>".$rowDataList['eMail']."</td>";
				echo "<td>".$rowDataList['homePage']."</td>";
				echo "<td>".$rowDataList['message']."</td>";
				
			$parts = explode('.', $rowDataList['fileName']);
			$ext = strtolower($parts[(count($parts) - 1)]);
			if($ext != 'txt'){
				echo "<td><img src = 'uploads/".$rowDataList['fileName']."' width='200px' height='140px'/></td>";
			}
			else{
				echo "<td><a href = 'php/download.php?file=../uploads/".$rowDataList['fileName']."'><img src = 'img/file_txt.png' width='200px' height='140px'/></a></td>";
			}
				
				echo "<td>".$rowDataList['dataStamp']."</td>";
			echo "</tr>";		
			
			}
		
	echo '</tbody>';
	echo "</table>";
	echo "<div class='page_navigation' ></div>";
	echo "</br>";
	echo "</div>";
	 
	
	nothingClose();
	include '../js/sorting.js';
?>
