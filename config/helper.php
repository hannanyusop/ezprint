<?php

function displayPrice($price){

    return "RM ".number_format($price, 2, '.', '');
}