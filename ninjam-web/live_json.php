<?php header('Content-Type: application/json'); ?>
[{
    "title":"<?= $_SERVER['HTTP_HOST']?>:2050",
    "mp3":"http://<?= $_SERVER['HTTP_HOST']?>:8000/2050"
},{
    "title":"<?= $_SERVER['HTTP_HOST']?>:2051",
    "mp3":"http://<?= $_SERVER['HTTP_HOST']?>:8000/2051"
}]
