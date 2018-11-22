<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <TITLE>JAM-сервер сайта GITARIZM.RU - добро пожаловать!</TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content="форум, гитаристов, гитарный, профессионалы, любители, гитара, jam, джем, guitar, jam, онлайн, онлайн-джем, online-jam, guitar-jam, джем-сервер, сервер, jam-сервер, jam-server, ninjam, cockos, reaper, джемовать, импровизация, гаммы, пентатоника"/>
    <meta name='yandex-verification' content='6f6bb5fb3ec8a15c'/>
    <link rel="icon" href="http://gitarizm.ru/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://gitarizm.ru/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css"/>
</head>

<body class="bg-light" onload="updateNowPlaying(); setInterval('updateNowPlaying()',10000);">
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <!-- h4 class="text-white">About</h4 -->
                    <p class="text-muted">Тема на форуме, посвященная онлайн-джему, мануал по настройке софта: <a
                            href="http://forum.gitarizm.ru/showthread.php?t=39731">http://forum.gitarizm.ru/showthread.php?t=39731</a>
                    </p>
                    <p class="text-muted mb-1">Права на все композиции, звучащие в эфире, принадлежат их авторам. Трансляция аудиопотока
                        ведется исключительно для ознакомительных целей.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Контакты</h4>
                    <ul class="list-unstyled">
                        <li><a href="http://forum.fitarizm.ru/" class="text-white">Форум</a></li>
                        <li><a href="http://forum.gitarizm.ru/showthread.php?t=39731" class="text-white">Как
                            подключиться</a></li>
                        <li><a href="http://forum.gitarizm.ru/showthread.php?goto=newpost&t=52316" class="text-white">Обсуждение</a></li>
                        <li><a href="mailto:ajvan.ivan@gmail.com" class="text-white">Админ джем-сервера</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="img/logo.gif" style="width: 32px; height: 32px; margin-right: 10px;">
                <strong>GUITAR-JAM</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
<div class="container">
    <div class="py-5">
        <div id="jp_container_N" style="display: table; margin: 0 auto;" class="jp-audio"
             role="application" aria-label="media player">
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
                    To play the media you will need to either update your browser to a recent version or update your <a
                        href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4 col-sm-12 col-xs-12 alert alert-dark">
            <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="300">
                <tr>
                    <td class="alt1"><b>Сервер <?= $_SERVER['HTTP_HOST'] ?>:2050</b>
                    </td>
                    <td class="alt1"><a
                            style="padding: 8px 5px 3px 30px; text-decoration: none; font-weight:bold; background: transparent url('img/tunein.png') no-repeat left center;"
                            href="http://<?= $_SERVER['HTTP_HOST'] ?>:8000/2050.m3u">M3U</a></td>
                </tr>
                <tr>
                    <td class="alt1" colspan="2"><b>Слушают в плеере:</b>&nbsp;<span id="l1"></span></td>
                </tr>
                <tr>
                    <td class="alt1" height="100" valign="top" colspan="2">
                        <div id="u1"></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 mb-4 col-sm-12 col-xs-12 alert alert-dark">
            <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="300">
                <tr>
                    <td class="alt1"><b>Сервер <?= $_SERVER['HTTP_HOST'] ?>:2051</b></td>
                    <td class="alt1"><a
                            style="padding: 8px 5px 3px 30px; text-decoration: none; font-weight:bold; background: transparent url('img/tunein.png') no-repeat left center;"
                            href="http://<?= $_SERVER['HTTP_HOST'] ?>:8000/2051.m3u">M3U</a></td>
                </tr>
                <tr>
                    <td class="alt1" colspan="2"><b>Слушают в плеере:</b>&nbsp;<span id="l2"></span></td>
                </tr>
                <tr>
                    <td class="alt1" height="100" valign="top" colspan="2">
                        <div id="u2"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">Права на все композиции, звучащие в эфире, принадлежат их авторам. Трансляция аудиопотока
            ведется исключительно для ознакомительных целей.</p>
    </footer -->
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/js/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript" src="jplayer/lib/jquery.min.js"></script>
<script type="text/javascript" src="jplayer/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="jplayer/dist/add-on/jplayer.playlist.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="updinfo.js"></script>
<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function () {

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
        $.getJSON("/live_json.php", function (data) {  // get the JSON array produced by my PHP
            $.each(data, function (index, value) {
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
</body>
</html>
