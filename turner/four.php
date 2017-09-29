<?php
//Using	PHP,	write	a	function	that	opens	and	saves	a	file.

    $succ =  open_save_file("/path/from/file", "/path/to/file");

    if($succ) "yada, yada";
    else "nada, nada";

    function open_save_file($path_from, $path_to){
        //no error checking provided since robust error checking, like unit testing
        //can easily double or triple code required
        //try catch is usually a good idea when opening and writing files
        //or most anytime :)

        //open  and get file contents
        $contents = file_get_contents($path_from);
        //save it:
        return file_put_contents($path_to, $contents);
    }