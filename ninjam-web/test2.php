<?php
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, 'http://localhost/getxml.php');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_HEADER, 0);
 
$data = curl_exec($ch);
 
curl_close($ch);

$p = xml_parser_create();
xml_parse_into_struct($p, $data, $vals, $index);
xml_parser_free($p);

$mnt="0";
foreach($vals as $arr)
{
if( $arr['tag']=="MOUNT") {
  $mnt=$arr['value'];
  }
if(($arr['tag']=="USERS")&($mnt!="0")){
  $users[$mnt]=$arr['value'];
  }  
}

$users_2050=0;
$users_2051=0;
if($users['/2050']!=NULL)
{
    if(substr_count($users['/2050'],"No users.")==1)
    {
    	$users_2050=0;
    	echo "Users on /2050: ".$users_2050;
    }
    else
    {
        $users_2050=substr_count($users['/2050']," ")+1;
        echo "Users on /2050: ".$users_2050;    
    }
} else echo "/2050 error!";

if($users['/2051']!=NULL)
{
    if(substr_count($users['/2051'],"No users.")==1)
    {
    	$users_2051=0;
    	echo "Users on /2051: ".$users_2051;
    }
    else
    {
        $users_2050=substr_count($users['/2051']," ")+1;
        echo "Users on /2051: ".$users_2051;    
    }
} else echo "/2051 error!";
?>