<?php

use \Illuminate\Support\Str;

function limitText($text, $length = 10, $suffix = '...')
{
    return Str::limit($text, $length, $suffix);
}

function formatDate($dateStr)
{
    if (strlen($dateStr) == 19){
        $date = new DateTime($dateStr);
        $formattedDate = $date->format('d.m.Y H:i:s');

        return $formattedDate;
    } else if (strlen($dateStr) == 10){
        $date = new DateTime($dateStr);
        $formattedDate = $date->format('d.m.Y');

        return $formattedDate;
    } else {
        return $dateStr;
    }
}