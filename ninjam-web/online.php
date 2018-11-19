<?php
//берем из GET переменную image, если передана
if(!empty($_GET['image']))
{
    $tmp=$_GET['image'];
    switch($tmp){
	case 0:
	    $image="lp1.jpg";
	    break;
	case 1:
	    $image="lp2.jpg";
	    break;
	case 2:
	    $image="exp1.jpg";
	    break;
	case 3:
	    $image="exp2.jpg";
	    break;

	case 4:
	    $image="strat1.jpg";
	    break;
	case 5:
	    $image="strat2.jpg";
	    break;
	case 6:
	    $image="marshall1.jpg";
	    break;
	case 7:
	    $image="mesa1.jpg";
	    break;

	case 8:
	    $image="vox1.jpg";
	    break;

	default:
	    $image="lp1.jpg";
	    break;
    }
} else $image="lp1.jpg";

//Загружаем XML
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, 'http://localhost/getxml.php');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HEADER, 0);
 
$data = curl_exec($ch);
 
curl_close($ch);
//============ НАЧАЛО ОБРАБОТКИ XML ===========
$p = xml_parser_create(); //создаем парсер
xml_parse_into_struct($p, $data, $vals, $index); //парсим в массивы
xml_parser_free($p); //удаляем парсер

$mnt="0";
foreach($vals as $arr) //пробегаем по массиву $vals
{
if( $arr['tag']=="MOUNT") { //и ищем точки монтирования - тэг MOUNT
  $mnt=$arr['value'];
  }
if(($arr['tag']=="USERS")&($mnt!="0")){ //помещаем имена юзеров в массив под идексом-именем точки монтирования
  $users[$mnt]=$arr['value'];
  }  
}

//============ КОНЕЦ ОБРАБОТКИ XML ===========

// Создаем новое изображение из файла
$im = ImageCreateFromJPEG($image);
//Задаем цвета
$black = ImagecolorAllocate($im,0,0,0);
$white = ImagecolorAllocate($im,255,255,255);

//Проверяем наличие данных в массиве
if($users['/2050']!=NULL)
{
    //Проверяем кто онлайн, записываем в переменную
    if(substr_count($users['/2050'],"No users.")==1)
    {
    	$users_2050="Никого нет.";
    }
    else
    {
        $users_2050=$users['/2050'];
    }
} else $users_2050="Ошибка!";

if($users['/2051']!=NULL)
{
    if(substr_count($users['/2051'],"No users.")==1)
    {
    	$users_2051="Никого нет";
    }
    else
    {
        $users_2051=$users['/2051'];
    }
} else $users_2051="Ошибка!";

//Функция пишет в изображение текст цветом color, добавляя фон текста цвета bgcolor
function imageText($im, $size, $x,$y,$color,$bgcolor,$font,$text)
{
    imagettftext($im, $size, 0, $x-1, $y-1, $bgcolor, $font, $text);
    imagettftext($im, $size, 0, $x-1, $y+1, $bgcolor, $font, $text);
    imagettftext($im, $size, 0, $x+1, $y-1, $bgcolor, $font, $text);
    imagettftext($im, $size, 0, $x+1, $y+1, $bgcolor, $font, $text);
    imagettftext($im, $size, 0, $x, $y, $color, $font, $text);
}

//Функция проверяет длину текста, и если текст (указанного размера и шрифта) не помещается в заданную ширину (в пикселах) - сокращает его (деление происходит по словам, т.е. по пробелам)
function crop_text($font_size, $font_name, $text, $max_width)
{
  $words = explode(" ", $text);
  $string = "";
  $tmp_string = "";
  for($i = 0; $i < count($words); $i++)
  {
    $tmp_string .= $words[$i]." ";
    $dim = imagettfbbox($font_size, 0, $font_name, $tmp_string);
    if($dim[4] < $max_width)
    {
      $string = $tmp_string;
    } else {
	$string.="и др.";
	break;
    }
  }
  return $string;
}

//Выводим заголовок в изображение
    imageText($im, 12, 10, 17, $white, $black, "ariali.ttf", "JAM-сервер Gitarizm.Guitar-Jam.ru");
//Проверяем и сокращаем текст со списком юзеров    
    $users_2050=crop_text(9, "./ariali.ttf",$users_2050,200);
    $users_2051=crop_text(9, "./ariali.ttf",$users_2051,200);
//Выводим текст в изображение    
    imageText($im, 9, 20, 37, $white, $black, "./ariali.ttf", "Сейчас на 2050: ".$users_2050);
    imageText($im, 9, 20, 52, $white, $black, "./ariali.ttf", "Сейчас на 2051: ".$users_2051);
// Выводим изображение в стандартный поток вывода
Header("Content-type: image/jpeg");
ImageJPEG($im);

?>