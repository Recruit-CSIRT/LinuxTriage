<?php
error_reporting(E_ERROR);
ini_set('max_execution_time',20000);
ini_set('memory_limit','512M');
header("content-Type: text/html; charset=utf-8");

$matches = array(
   '/function\_exists\s*\(\s*[\'|\"](popen|exec|proc\_open|system|passthru)+[\'|\"]\s*\)/i',
   '/(exec|shell\_exec|system|passthru)+\s*\(\s*\$\_(\w+)\[(.*)\]\s*\)/i',
   '/((udp|tcp)\:\/\/(.*)\;)+/i',
   '/preg\_replace\s*\((.*)\/e(.*)\,(.*)\)/i',
   '/preg\_replace\s*\((.*)\(base64\_decode\(\$/i',
   '/(eval|assert|include|require|include\_once|require\_once)+\s*\(\s*(base64\_decode|str\_rot13|gz(\w+)|file\_(\w+)\_contents|(.*)php\:\/\/input)+/i',
   '/(eval|assert|include|require|include\_once|require\_once|array\_map|array\_walk)+\s*\(\s*\$\_(GET|POST|REQUEST|COOKIE|SERVER|SESSION)+\[(.*)\]\s*\)/i',
   '/eval\s*\(.*\)/i',
   '/(include|require|include\_once|require\_once)+\s*\(\s*[\'|\"](\w+)\.(jpg|gif|ico|bmp|png|txt|zip|rar|htm|css|js)+[\'|\"]\s*\)/i',
   '/\$\_(\w+)(.*)(eval|assert|include|require|include\_once|require\_once)+\s*\(\s*\$(\w+)\s*\)/i',
   '/\(\s*\$\_FILES\[(.*)\]\[(.*)\]\s*\,\s*\$\_(GET|POST|REQUEST|FILES)+\[(.*)\]\[(.*)\]\s*\)/i',
   '/(fopen|fwrite|fputs|file\_put\_contents)+\s*\((.*)\$\_(GET|POST|REQUEST|COOKIE|SERVER)+\[(.*)\](.*)\)/i',
   '/echo\s*curl\_exec\s*\(\s*\$(\w+)\s*\)/i',
   '/new com\s*\(\s*[\'|\"]shell(.*)[\'|\"]\s*\)/i',
   '/\$(.*)\s*\((.*)\/e(.*)\,\s*\$\_(.*)\,(.*)\)/i',
   '/\$\_\=(.*)\$\_/i',
   '/\$\_(GET|POST|REQUEST|COOKIE|SERVER)+\[(.*)\]\(\s*\$(.*)\)/i',
   '/\$(\w+)\s*\(\s*\$\_(GET|POST|REQUEST|COOKIE|SERVER)+\[(.*)\]\s*\)/i',
   '/\$(\w+)\s*\(\s*\$\{(.*)\}/i',
   '/\$(\w+)\s*\(\s*chr\(\d+\)/i'
);

function antivirus($dir,$exs,$matches) {
   if(($handle = @opendir($dir)) == NULL) return false;
   while(false !== ($name = readdir($handle))) {
       if($name == '.' || $name == '..') continue;
       $path = $dir.$name;
       if(is_dir($path)) {
           if(is_readable($path)) antivirus($path.'/',$exs,$matches);
       } else {
           if(!preg_match($exs,$name)) continue;
           if(filesize($path) > 10000000) continue;
           $fp = fopen($path,'r');
           $code = fread($fp,filesize($path));
           fclose($fp);
           if(empty($code)) continue;
           foreach($matches as $matche) {
               $array = array();
               preg_match($matche,$code,$array);
               if(!$array) continue;
               $len = strlen($array[0]);
               if($len > 0) {
                   echo 'special_file  '.htmlspecialchars(substr($array[0],0,100)).'  '.$path.'  \n';
                   flush(); ob_flush(); break;
               }
           }
           unset($code,$array);
       }
   }
   closedir($handle);
   return true;
}

function strdir($str) { return str_replace(array('\\','//','//'),array('/','/','/'),chop($str)); }


   $dir = strdir($argv[1]);
   $exs = '/(\\.php|\\.inc|\\.phtml)/i';
   echo antivirus($dir,$exs,$matches) ? 'completed' : 'halted';
?>
