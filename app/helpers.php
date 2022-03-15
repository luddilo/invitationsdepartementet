<?php

function chart_colors($number)
{
    $colors = config('constants.CHART_COLORS');

    return array_slice($colors, 0, $number);
}