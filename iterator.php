<?php 
echo '程序开始时间:'.time().'<br>';
$path = 'd:/www';
getRevDir($path);
echo '程序结束时间:'.time().'<br>';
exit;	
echo '<pre>';
//获取当前路径下所有的目录和文件名
//这种用法主要是用在获取远程服务器目录的B/S程序中
var_dump(array_keys(iterator_to_array(new RecursiveDirectoryIterator($path))));	
exit;

//迭代获取当前路径下所有的目录和文件
function getRevDir($path, $level = 0){
$dirIterator = new RecursiveDirectoryIterator($path);
$strSplitBar = '';
for($i=0;$i<$level;$i++){
if($i == $level-1){
$strSplitBar .= '|__';
}else{
$strSplitBar .= '&nbsp;&nbsp;';
}
}	
foreach ($dirIterator as $key => $fileInfo){
if($dirIterator->hasChildren()){	
$dirName = substr($key,strrpos($key, DIRECTORY_SEPARATOR)+1);
echo $strSplitBar.$dirName.'<br>';
getRevDir($key, $level+1);
}else{	
echo $strSplitBar.basename($key).'<br>';
}	
}
}
