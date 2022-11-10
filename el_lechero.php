<?php

/* 
POR: Alexander Oliva V21112327
*/

/* Ejercicio del Lechero/Mochila  */

/* 
descomentar unicamente el 'bloque' de pruebas a usar y dejar los demas comentados, luego correr via consola
 */

$select_vacas = '';


$limite_peso = 700;
$vacas = [
    1 =>['peso' => 360, 'produccion' => 40],
    2 =>['peso' => 250, 'produccion' => 35],
    3 =>['peso' => 400, 'produccion' => 43],
    4 =>['peso' => 180, 'produccion' => 28],
    5 =>['peso' => 50, 'produccion' => 12],
    6 =>['peso' => 90, 'produccion' => 13]
];


/* 
$limite_peso = 1000;
$vacas = [
    1	=>['peso' => 223, 'produccion' => 30],
    2	=>['peso' => 243, 'produccion' => 34],
    3	=>['peso' => 100, 'produccion' => 28],
    4	=>['peso' => 200, 'produccion' => 45],
    5	=>['peso' => 200, 'produccion' => 31],
    6	=>['peso' => 155, 'produccion' => 50],
    7	=>['peso' => 300, 'produccion' => 29],
    8	=>['peso' => 150, 'produccion' => 1]
];
 */

/* 
$limite_peso = 2000;
$vacas = [
    1	=>['peso' => 340, 'produccion' =>45],
    2	=>['peso' => 355, 'produccion' =>50],
    3	=>['peso' => 223, 'produccion' =>34],
    4	=>['peso' => 243, 'produccion' =>39],
    5	=>['peso' => 130, 'produccion' =>29],
    6	=>['peso' => 240, 'produccion' =>40],
    7	=>['peso' => 260, 'produccion' =>30],
    8	=>['peso' => 155, 'produccion' =>52],
    9	=>['peso' => 302, 'produccion' =>31],
    10	=>['peso' => 130, 'produccion' =>1]
];
 */

$r=['max_peso'=>0, 'selected' => [] ];

$temp=['selected'=>[], 'peso'=>0];

foreach ($vacas as $key => $value) {

    $temp=['selected'=>[], 'peso'=>0];

    /* $temp['selected'][]=$key; #add first mode
    $temp['peso']+=$value['peso'];

    if ($temp['peso']>$limite_peso) {
        $temp['peso']-=$value['peso'];
        array_pop($temp['selected']);
        break;
    } */

    /* if ($temp['peso']+$value['peso']<=$limite_peso) { #check first mode
        $temp['selected'][]=$key;
        $temp['peso']+=$value['peso'];
    } */

    $aux=$vacas;

    unset($aux[$key]);
    
    foreach ($aux as $aux_key => $aux_value) {

        /* echo "\n".$key; */

        /* $temp['selected'][]=$aux_key;
        $temp['peso']+=$aux_value['peso'];

        if ($temp['peso']>$limite_peso) {
            $temp['peso']-=$aux_value['peso'];
            #array_pop($temp['selected']);
            unset($temp['selected'][array_search($aux_key, $temp['selected'])]);
            break;
        } */

        if ($temp['peso']+$aux_value['peso']<=$limite_peso) {
            $temp['selected'][]=$aux_key;
            $temp['peso']+=$aux_value['peso'];
        }

        if (vacas_seleccionadas($temp['selected'])['produccion']>vacas_seleccionadas($r['selected'])['produccion']) {
            $r=['max_peso'=>$temp['peso'], 'selected' => $temp['selected'] ];
        }       
    
    }

}

#$r['selected']=[6,1,2,3,4]; #manual test
#$r['selected']=[2,3,4,5,6]; #manual test
#6,1,2,3,4

foreach ($r['selected'] as $key => $value) {
    $select_vacas.=$value.',';
}

$select_vacas = substr($select_vacas, 0, -1);

echo "\n";
echo "\nresultado: ";
echo "\nLitros: ".vacas_seleccionadas( $r['selected'])['produccion'];
echo "\nPeso: ".vacas_seleccionadas( $r['selected'])['peso'];
echo "\nvacas selecionadas: ".$select_vacas." \n";
#echo var_dump($r['selected']);



function vacas_seleccionadas($select_vacas){

    global $vacas;

    $r=['peso'=>0, 'produccion'=>0];

    foreach ($vacas as $key => $value) {
    
        if ( in_array($key, $select_vacas) ) {
            $r['peso']+=$value['peso'];
            $r['produccion']+=$value['produccion'];
        }
    
    }

    return $r;

}


?>