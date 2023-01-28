<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('dia_semana')){
function dia_semana($nomdia){
$dias=array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
$fecha=$dias[date('w',strtotime($nomdia))];
return $fecha;
   }
 }

if(!function_exists('mes')){
function mes($nommes){
$meses=array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$mes=$meses[date('n',strtotime($nommes))];
return $mes;
    }
  }
  
  if(!function_exists('ano')){
function ano($numano){
$ano=date('Y',strtotime($numano));
return $ano;
    }
  }
  
  if(!function_exists('par')){
function par($num){
$espar="Impar";
if($num%2==0){
$espar="Par";
}
return $espar;
    }
  }

if(!function_exists('decena')){
function decena($num){
$con=0;
if($num==100 || $num<10){
$con = 0;
}else{
$cad=strval($num);
$dec=substr($cad,0,1);
$con=$dec+"c";
}
return $con;
     }
  }
  
  if(!function_exists('terminale')){
function terminale($nume){
$conv=0;
if($nume==100){
//$cade=strval($nume);
  //substr($cade,2,3);
$conv=0;

}else if($nume < 10){
 $conv=$nume;
} else{
$cade=strval($nume);
$ter=substr($cade,1,2);
$conv=$ter+"c";
}
return $conv;
   }
 }
 
 if(!function_exists('arr_menores')){
 function arr_menores($arreglo){
 $arr=array();
 $valores=array_count_values($arreglo);
 asort ($valores);
 $cont=0;
 
 //$salida = array_slice ($valores, 0, 20); 
 for (reset ($valores); $clave = key ($valores); next($valores)) {
 $cont++;
 if($cont<=3){
 $arr[]=$clave;

 }else{
 break;
 }
 }
 return $arr;
 }
 }

if(!function_exists('menores')){
function menores($arreglo){
$valores=array_count_values($arreglo);
asort ($valores);
$cont=0;
//$salida = array_slice ($valores, 0, 20); 
for (reset ($valores); $clave = key ($valores); next($valores)) {
$cont++;
if($cont<=20){
echo"<tr><td> $clave</td><td>" . $valores[$clave] . "</td></tr>";
}else{
break;
}
}
}
}

if(!function_exists('mayores')){
function mayores($arreglo1){
$valores1=array_count_values($arreglo1);
arsort ($valores1);
//$valores1=array_reverse($valo);
$cont1=0;
//$salida = array_slice ($valores, 0, 20); 
for (reset ($valores1); $clave1 = key ($valores1); next($valores1)) {
$cont1++;
if($cont1<=20){
echo"<tr class=''><td> $clave1</td><td>" . $valores1[$clave1] . "</td></tr>";
}else{
break;
}
}
}
}

if(!function_exists('jugar')){
function jugar($arreglo1){
$valores1=array_count_values($arreglo1);
arsort ($valores1);
//$valores1=array_reverse($valo);
$cont1=0;
echo"<td>";
echo "<p><font size='5' face='verdana'><b>";
echo "<center>";
for (reset ($valores1); $clave1 = key ($valores1); next($valores1)) {
$cont1++;
if($cont1<=20){
echo $clave1."   ";
}else{
break;
}
}
echo "</center>";
echo "</b></font></p>";
echo"</td>";
}
}

 if(!function_exists('terminal_viene')){
  function terminal_viene($arr,$buscar,$viene){
    $cont=0;
    $long=count($arr);
   for($i=0;$i<=$long-1;$i++){
    if($arr[$i]==$buscar && $arr[$i+1]==$viene){
       $cont++;
       
    }
   }
   return $cont;
  }
 }
 
 
 if(!function_exists('cruzeT')){
 function cruzeT($arrdec,$arrter,$buscar,$viene){
 $cont=0;
 $long=count($arrter);
 if(count($arrter) == count($arrdec)){
 for($i=0;$i<=$long-1;$i++){
 if($arrter[$i]==$buscar && $arrdec[$i+1]==$viene){
 $cont++;
 
 }
 }
 }
 return $cont;
 }
 }
 
 if(!function_exists('cruzeD')){
 function cruzeD($arrdec,$arrter,$buscar,$viene){
 $cont=0;
 $long=count($arrter);
 if(count($arrter) == count($arrdec)){
 for($i=0;$i<=$long-1;$i++){
 if($arrdec[$i]==$buscar && $arrter[$i+1]==$viene){
 $cont++;
 
 }
 }
 }
 return $cont;
 }
 }
 
 
 if(!function_exists('hoy_viene')){
 function hoy_viene($arr,$buscar,$viene){
 $cont=0;
 $long=count($arr);
 for($i=0;$i<=$long-1;$i++){
 if($arr[$i]==$buscar && $arr[$i+1]==$viene){
 $cont++;
 }
 }
 }
 return $cont;
 }
 
?>