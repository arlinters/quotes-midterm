<?php

/**
 * $startingFile = __FILE__
 * $filename = target file
 */
function getRelativeFile($startingFile, $filename){
	return (realpath(dirname($startingFile).'/'.$filename));
}
?>