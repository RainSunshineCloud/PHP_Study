<?php

//download属于下载资源，所以用get请求就可以了
class Download
{
    static private $size;
    static private $file;
    static private $range = [];
    static private $rangeStr;
    static protected $buffer = 2048;

    function __constuct (string $file) 
    {

    	self :: size = filesize($file);
      self :: file = $file;
       
    	do {
          self :: rangeStr = join('-',self :: range);
		      self :: headerMsg();
          self :: getFile();
          self :: range[0] = self :: range[1];
               
      } while (feof($file));
    }


	static function getRange ()
	{
        if (isset($_SERVER['HTTP_RANGE'])) {

        	$str = str_replace('=','-',$_SERVER['HTTP_RAGNE']);
         	self :: range = explode($str,'-');
         	array_shift(self :: range);

        } else {

        	self :: range[0] = 0;
        	self :: range[1] = min($buffer,$size);

        }

	}

  /*
  *
  */
	static protected function headerMsg ()
	{
	  header('Content-Length:'.self :: size);
    header('Content-Range: bytes:'.self :: rangeStr.'/'.self :: size);
	  header('Accenpt-Ranges: bytes');
	  header('application/octet-stream');
	  header("Cache-control: public");
	  header("Pragma: public");
	}

	static protected function getFile ()
	{
		 $fd = fopen(self :: file);
     fseek($fd,self :: range[0]);
     $str = fread($fd,$buffer);
     flush();
     ob_flush();
	}
}
