<?php

function apeso($numero)
{
    $formato = new \NumberFormatter("es-AR", \NumberFormatter::CURRENCY);
    return $formato->format(floatval($numero));
}

function afecha($fecha)
{
    $fecha = date("d/m/Y", strtotime($fecha));
    return $fecha;
}

function afechahora($fecha)
{
    $fecha = date("d/m/Y h:i", strtotime($fecha));
    return $fecha;
}

function alinkext($archivo, $leyenda = null)
{
    $exp = explode(".", $archivo);
    if($leyenda == null) $leyenda = strtoupper($exp[1]);
    $link = '<a target="_blank" href="storage/uploads/' . $archivo . '">' . $leyenda . '</a>';
    return $link;
}

function alinkextfull($archivo, $leyenda = null)
{
    $exp = explode(".", $archivo);
    if($leyenda == null) $leyenda = strtoupper($exp[1]);
    $link = '<a target="_blank" href="'.config('app.url').'/storage/uploads/' . $archivo . '">' . $leyenda . '</a>';
    return $link;
}
