<?php

if(!isset($_COOKIE["ck"])){
	setocookie"ck",time() + 86400);
	$count = 1;
}else{
	
