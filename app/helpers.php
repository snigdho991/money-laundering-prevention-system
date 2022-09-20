<?php
	function avatarLetter($str) {
	    $ret = '';
	    foreach (explode(' ', $str) as $word)
	        $ret .= strtoupper($word[0]);
	    return $ret;
	}