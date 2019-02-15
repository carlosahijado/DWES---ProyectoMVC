<?php

function autocargar($clase){
	   require_once   $clase .'.php';
}

spl_autoload_register('autocargar');