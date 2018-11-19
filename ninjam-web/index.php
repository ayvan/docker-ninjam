<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru">
<HEAD>
<script>  (window.YaCC || (window.YaCC = {})).date = '02.11.2012 [03:13:38]';  </script>
<TITLE>JAM-сервер сайта GITARIZM.RU - добро пожаловать!</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="форум, гитаристов, гитарный, профессионалы, любители, гитара, jam, джем, guitar, jam, онлайн, онлайн-джем, online-jam, guitar-jam, джем-сервер, сервер, jam-сервер, jam-server, ninjam, cockos, reaper, джемовать, импровизация, гаммы, пентатоника" />
<meta name='yandex-verification' content='6f6bb5fb3ec8a15c' />
<link rel="icon" href="http://gitarizm.ru/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://gitarizm.ru/favicon.ico" type="image/x-icon"> 
<script type="text/javascript" src="updinfo.js"></script>
<link href="jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="jplayer/lib/jquery.min.js"></script>
    <script type="text/javascript" src="jplayer/dist/jplayer/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="jplayer/dist/add-on/jplayer.playlist.min.js"></script>
    <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function(){

            var myPlaylist = new jPlayerPlaylist({
                jPlayer: "#jquery_jplayer_N",
                cssSelectorAncestor: "#jp_container_N"
            }, [], {
                playlistOptions: {
                    enableRemoveControls: false,
		    autoPlay: true
                },
                swfPath: "jplayer/dist/jplayer",
                supplied: "mp3",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true,
                audioFullScreen: false,
            });

	    var playing = false;
            $.getJSON("/live_json.php",function(data){  // get the JSON array produced by my PHP
                $.each(data,function(index,value){
                    myPlaylist.add(value); // add each element in data in myPlaylist
		    if (!playing) {
			$("#jquery_jplayer_N").jPlayer("play");
			playing = true
		    }
                })
            });

	    $("#jquery_jplayer_N").jPlayer("play");
        });
        //]]>
    </script>
<style type="text/css" id="vbulletin_css">
/**
* vBulletin 3.8.1 CSS
* Style: 'Default Style'; Style ID: 1
*/
body
{
    background: #FFFFFF;
    color: #000000;
    font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
    margin: 5px 10px 10px 10px;
    padding: 0px;
}
a:link, body_alink
{
	color: #22229C;
}
a:visited, body_avisited
{
	color: #22229C;
}
a:hover, a:active, body_ahover
{
	color: #FF4400;
}
.page
{
	background: #FFFFFF;
	color: #000000;
}
td, th, p, li
{
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.tborder
{
	background: #000000;
	color: #0000B6;
	border: 1px solid #0B198C;
}
.tcat
{
	background: #536080;
	color: #000000;
	font: bold 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.tcat a:link, .tcat_alink
{
	color: #ffffff;
	text-decoration: none;
}
.tcat a:visited, .tcat_avisited
{
	color: #ffffff;
	text-decoration: none;
}
.tcat a:hover, .tcat a:active, .tcat_ahover
{
	color: #FFFF66;
	text-decoration: underline;
}
.thead
{
	background: #727272;
	color: #FFFFFF;
	font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.thead a:link, .thead_alink
{
	color: #FFFFFF;
}
.thead a:visited, .thead_avisited
{
	color: #FFFFFF;
}
.thead a:hover, .thead a:active, .thead_ahover
{
	color: #FFFF00;
}
.tfoot
{
	background: #727272;
	color: #E0E0F6;
}
.tfoot a:link, .tfoot_alink
{
	color: #E0E0F6;
}
.tfoot a:visited, .tfoot_avisited
{
	color: #E0E0F6;
}
.tfoot a:hover, .tfoot a:active, .tfoot_ahover
{
	color: #FFFF66;
}
.alt1, .alt1Active
{
	background: #EFEFEF;
	color: #000000;
}
.alt2, .alt2Active
{
	background: #FFFFFF;
	color: #000000;
}
.inlinemod
{
	background: #FFFFCC;
	color: #000000;
}
.wysiwyg
{
	background: #EFEFEF;
	color: #000000;
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
textarea, .bginput
{
	font: 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.bginput option, .bginput optgroup
{
	font-size: 10pt;
	font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.button
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
select
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
option, optgroup
{
	font-size: 11px;
	font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.smallfont
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.time
{
	color: #666686;
}
.navbar
{
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.highlight
{
	color: #FF0000;
	font-weight: bold;
}
.fjsel
{
	background: #3E5C92;
	color: #E0E0F6;
}
.fjdpth0
{
	background: #F7F7F7;
	color: #000000;
}
.panel
{
	background: #E4E7F5 url(images/gradients/gradient_panel.gif) repeat-x top left;
	color: #000000;
	padding: 10px;
	border: 2px outset;
}
.panelsurround
{
	background: #D1D4E0 url(images/gradients/gradient_panelsurround.gif) repeat-x top left;
	color: #000000;
}
legend
{
	color: #22229C;
	font: 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
}
.vbmenu_control
{
	background: #727272;
	color: #FFFFFF;
	font: bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	padding: 3px 6px 3px 6px;
	white-space: nowrap;
}
.vbmenu_control a:link, .vbmenu_control_alink
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_control a:visited, .vbmenu_control_avisited
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_control a:hover, .vbmenu_control a:active, .vbmenu_control_ahover
{
	color: #FFFFFF;
	text-decoration: underline;
}
.vbmenu_popup
{
	background: #FFFFFF;
	color: #000000;
	border: 1px solid #0B198C;
}
.vbmenu_option
{
	background: #BBC7CE;
	color: #000000;
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	white-space: nowrap;
	cursor: pointer;
}
.vbmenu_option a:link, .vbmenu_option_alink
{
	color: #6699FF;
	text-decoration: none;
}
.vbmenu_option a:visited, .vbmenu_option_avisited
{
	color: #6699FF;
	text-decoration: none;
}
.vbmenu_option a:hover, .vbmenu_option a:active, .vbmenu_option_ahover
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_hilite
{
	background: #8A949E;
	color: #FFFFFF;
	font: 11px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;
	white-space: nowrap;
	cursor: pointer;
}
.vbmenu_hilite a:link, .vbmenu_hilite_alink
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_hilite a:visited, .vbmenu_hilite_avisited
{
	color: #FFFFFF;
	text-decoration: none;
}
.vbmenu_hilite a:hover, .vbmenu_hilite a:active, .vbmenu_hilite_ahover
{
	color: #FFFFFF;
	text-decoration: none;
}
/* ***** styling for 'big' usernames on postbit etc. ***** */
.bigusername { font-size: 14pt; }

/* ***** small padding on 'thead' elements ***** */
td.thead, div.thead { padding: 4px; }

/* ***** basic styles for multi-page nav elements */
.pagenav a { text-decoration: none; }
.pagenav td { padding: 2px 4px 2px 4px; }

/* ***** define margin and font-size for elements inside panels ***** */
.fieldset { margin-bottom: 6px; }
.fieldset, .fieldset td, .fieldset p, .fieldset li { font-size: 11px; }

form { display: inline; }
label { cursor: default; }
.normal { font-weight: normal; }
.inlineimg { vertical-align: middle; }
a.navs:link,a.navs:visited      {color: #003366; font-size: 13px; margin: 0px; text-decoration:none;  font-weight: bold; }

a.navs:hover               {color: #CC0000; font-size: 13px; margin: 0px; text-decoration:none; font-weight: bold; }

</style>		    


</HEAD>
<body onload="updateNowPlaying(); setInterval('updateNowPlaying()',10000);">
<table width="100%">
<tr><td bgcolor="#536080" height="80">

<table width="100%">
<tr><td>

 <img src="http://gitarizm.ru/_img/logo.gif" border="0" align="left" valign="top" alt="Форум гитаристов"> 
 
 </td>
 <td>
 
 &nbsp;
 
 
 </td>
 
 </tr>
 </table>
 
 
 </td></tr>
 <tr><td height="23" valign="middle">
 <a class="navs" href="http://gitarizm.ru">Главная</a>&nbsp;|&nbsp;
 <a class="navs" href="http://gitarizm.ru/articles/">Статьи</a>&nbsp;|&nbsp;
 <a class="navs" href="http://gitarizm.ru/school/">Школа</a>&nbsp;|&nbsp;
 <a class="navs" href="http://gitarizm.ru/video/">Видео</a>&nbsp;|&nbsp;
 
 <a class="navs" href="http://gitarizm.ru/guitarsoft/">Софт</a>&nbsp;|&nbsp;
 <a class="navs" href="http://gtp.gitarizm.ru">Табы</a>&nbsp;|&nbsp;
 <a class="navs" href="http://forum.gitarizm.ru">Форум</a>&nbsp;|&nbsp;
 <a class="navs" href="http://guitars.gitarizm.ru">Гитарный блог</a>
 <hr>
 </td></tr>
 </table>
 
<table class="tborder" cellpadding="6" cellspacing="0" border="0" width="100%" height="600" align="center">
<tr>
    <td colspan=2 class="alt1" width="100%">
        <h2 align=center>JAM-серверы</h2>
<div id="jp_container_N" style="display: table;  margin: 0 auto;" class="jp-video jp-video-270p" role="application" aria-label="media player">
    <div class="jp-type-playlist">
        <div id="jquery_jplayer_N" class="jp-jplayer"></div>
        <div class="jp-gui">
            <div class="jp-video-play">
                <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
            </div>
            <div class="jp-interface">
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                <div class="jp-controls-holder">
                    <div class="jp-controls">
                        <!--button class="jp-previous" role="button" tabindex="0">previous</button-->
                        <button class="jp-play" role="button" tabindex="0">play</button>
                        <!--button class="jp-next" role="button" tabindex="0">next</button-->
                        <button class="jp-stop" role="button" tabindex="0">stop</button>
                    </div>
                    <div class="jp-volume-controls">
                        <button class="jp-mute" role="button" tabindex="0">mute</button>
                        <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
                <div class="jp-details">
                    <div class="jp-title" aria-label="title">&nbsp;</div>
                </div>
            </div>
        </div>
        <div class="jp-playlist">
            <ul>
                <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                <li>&nbsp;</li>
            </ul>
        </div>
        <div class="jp-no-solution">
            <span>Update Required</span>
            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>
    </div>
</div>

    </td>
</tr>
<tr>
    <td class="alt1" colspan=2 align=center valign="top">
    <a href="http://forum.gitarizm.ru/showthread.php?t=39731">Тема на форуме, посвященная онлайн-джему, мануал по настройке софта.</a>
    </td>
</tr>
<tr>
    <td class="alt1" valign="top">
        <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="400" align="right">
    	<tr><td class="alt1"><b>Сервер <?= $_SERVER['HTTP_HOST'] ?>:2050</b>
	</td><td class="alt1"><a style="padding: 8px 5px 3px 30px; text-decoration: none; font-weight:bold; background: transparent url('img/tunein.png') no-repeat left center;" href="http://<?= $_SERVER['HTTP_HOST'] ?>:8000/2050.m3u">M3U</a></td></tr>
    	<tr><td class="alt1" colspan="2"><b>Слушают в плеере:</b>&nbsp;<span id="l1"></span></td></tr>
    	<tr><td class="alt1" height="200" valign="top" colspan="2">
	<div id="u1"></div>
	</td></tr>
	<!--
	<tr><td class="alt1"  valign="top" colspan="2">	
	<b>Время последнего перезапуска сервера:&nbsp; 
	31.10.2012 04:50	</b>
	</td></tr>
	<tr><td class="alt1"  valign="top" colspan="2">	
	<b>Посетили сервер с момента последнего перезапуска:</b>
	</td></tr>
	<tr><td class="alt1" height="100" valign="top" colspan="2">
	<div id="allusers1"></div>
	</td></tr>
	-->
	</table>
    </td>
    <td class="alt1" width="50%" valign="top">
       <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="400" align="left">
    	<tr><td class="alt1"><b>Сервер <?= $_SERVER['HTTP_HOST'] ?>:2051</b></td><td class="alt1"><a style="padding: 8px 5px 3px 30px; text-decoration: none; font-weight:bold; background: transparent url('img/tunein.png') no-repeat left center;" href="http://<?= $_SERVER['HTTP_HOST'] ?>:8000/2051.m3u">M3U</a></td></tr>    
    	<tr><td class="alt1"  colspan="2"><b>Слушают в плеере:</b>&nbsp;<span id="l2"></span></td></tr>	
        <tr><td class="alt1" height="200" valign="top"  colspan="2">
	<div id="u2"></div>        
	</td></tr>
	<!--
	<tr><td class="alt1"  valign="top"  colspan="2">
	<b>Время последнего перезапуска сервера:&nbsp; 
	31.10.2012 04:50	</b>
	</td></tr>
	<tr><td class="alt1"  valign="top"  colspan="2">	
	<b>Посетили сервер с момента последнего перезапуска:</b>	
	</td></tr>
	<tr><td class="alt1" height="100" valign="top"  colspan="2">
	<div id="allusers2"></div>
	</td></tr>
	-->
	</table>
    </td>
</tr>
</table>
 
<div align="center">
	<div class="smallfont" align="center" style="visibility:hidden; display:none;">
	<a href="http://nick-name.ru/sertificates/11024/"><img src="http://nick-name.ru/img.php?nick=%C0%E9%E2%E0%ED&sert=2" alt="Никнейм Айван зарегистрирован!" border="0" /></a><br />
	</div>
	<div class="smallfont" align="center">
	<br><a>Права на все композиции, звучащие в эфире, принадлежат их авторам. Трансляция аудиопотока ведется исключительно для ознакомительных целей.</a>	
	<br><a>Администратор сервера: <a href="mailto:ajvan.ivan@gmail.com">ajvan.ivan@gmail.com</a>
	</div>
</div>
</BODY>
</html>