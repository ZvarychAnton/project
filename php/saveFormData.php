<?php
include 'PDOconnect.php';

nothingConnect();
// check browser
$user_agent = $_SERVER["HTTP_USER_AGENT"];
if(strpos($user_agent,"Firefox") !== false) $browser = "Firefox";
elseif(strpos($user_agent,"Opera") !== false) $browser = "Opera";
elseif(strpos($user_agent,"Chrome") !== false) $browser = "Chrome";
elseif(strpos($user_agent,"MSIE") !== false) $browser = "IE";
elseif(strpos($user_agent,"Safary") !== false) $browser = "Safary";
else $browser = "Undefined";




// Путь загрузки
$path = '../uploads/';
$tmp_path = '../uploads/tmp/';

// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$parts = explode('.', $_FILES['picture']['name']);
$ext = strtolower($parts[(count($parts) - 1)]);
$better_token = md5(uniqid(rand(),1));

	function resize($file)
	{
		global $better_token;
		global $ext;
		global $tmp_path;

		// Ограничение по ширине в пикселях
		$max_width_size = 320;
		$max_height_size = 240;
	
		// Cоздаём исходное изображение на основе исходного файла
		if ($file['type'] == 'image/jpeg')
			$src = imagecreatefromjpeg($file['tmp_name']);
		elseif ($file['type'] == 'image/png')
			$src = imagecreatefrompng($file['tmp_name']);
		elseif ($file['type'] == 'image/gif')
			$src = imagecreatefromgif($file['tmp_name']);
			
		else
			return false;
			
		// Определяем ширину и высоту изображения
		$w_src = imagesx($src); 
		$h_src = imagesy($src);
		
		// В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
		$w = $max_width_size;
		$h = $max_height_size;
	

		// Если ширина больше заданной
		if ($w_src < $w AND $h_src < $h)
		{
		
			// Вывод картинки и очистка памяти
			if ($file['type'] == 'image/jpeg')
			imagejpeg($src, $tmp_path . $better_token.'.'.$ext);
		elseif ($file['type'] == 'image/png')
			imagepng($src, $tmp_path . $better_token.'.'.$ext);
		elseif ($file['type'] == 'image/gif')
			imagegif($src, $tmp_path . $better_token.'.'.$ext);
		else
			return false;
			
			imagedestroy($src);

			return $better_token.'.'.$ext;
		}
		else
		{
			// Вычисление пропорций
			$ratio_w = $w_src/$w;
			$w_dest = round($w_src/$ratio_w);
			$h_dest = round($h_src/$ratio_w);
	
			// Создаём пустую картинку
			$dest = imagecreatetruecolor($w_dest, $h_dest);
			
			// Копируем старое изображение в новое с изменением параметров
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

			// Вывод картинки и очистка памяти
			if ($file['type'] == 'image/jpeg')
			imagejpeg($dest, $tmp_path . $better_token.'.'.$ext);
		elseif ($file['type'] == 'image/png')
			imagepng($dest, $tmp_path . $better_token.'.'.$ext);
		elseif ($file['type'] == 'image/gif')
			imagegif($dest, $tmp_path . $better_token.'.'.$ext);
		else
			return false;
			
			imagedestroy($dest);
			imagedestroy($src);

			return $better_token.'.'.$ext;
		}
		
	}
	if($_FILES['picture']['type']!='text/plain'){
		$name = resize($_FILES['picture']);
		copy($tmp_path.$name, $path . $name);
		unlink($tmp_path . $name);
	}
	else{
		copy($_FILES['picture']['tmp_name'], $path . $better_token.'.'.$ext);
	}
	}


 $ip = $_SERVER['REMOTE_ADDR']; 
$userName = $_POST['userName'];
$eMail = $_POST['eMail'];
$homePage = $_POST['homePage'];
$message = $_POST['message'];
$fileName = $better_token.'.'.$ext;
 
 $query = "INSERT INTO `project`.`form_data_table`
		( `userName`, `eMail`, `homePage`, `message`, `fileName`, `ip`, `browser`, `dataStamp`)	
		VALUES
		(:userName, :eMail, :homePage, :message, :fileName, :ip, :browser,  CURRENT_TIMESTAMP);
		";
$array = array(':userName' => $userName, ':eMail' => $eMail, ':homePage' => $homePage, ':message' => $message,':fileName' => $fileName, ':ip' => $ip, ':browser' => $browser );
nothingInsert($query,$array);
 nothingClose();
 //exit('<meta http-equiv="refresh" content="0; url=../index.php" />');
header('Location: ../index.php');
exit;
 ?>
