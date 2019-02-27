<?php

$objeto1 = array(
    'id' => 1,
    'from' => 1,
    'to' => 2,
    'message' => 'Mensagem 1',
    's_read' => 1,
    'time' => '2019-02-26 10:32:55'
);
$objeto4 = array(
    'id' => 1,
    'from' => 1,
    'to' => 2,
    'message' => 'Mensagem 2',
    's_read' => 1,
    'time' => '2019-02-28 10:32:55'
);

$objeto2 = array(
    'id' => 2,
    'from' => 2,
    'to' => 1,
    'message' => 'Mensagem 2',
    's_read' => 1,
    'time' => '2019-02-27 08:33:40'
);

$objeto3 = array(
    'id' => 3,
    'from' => 1,
    'to' => 2,
    'message' => 'Mensagem 3',
    's_read' => 1,
    'time' => '2019-02-27 08:38:20'
);
$objeto5 = array(
    'id' => 3,
    'from' => 1,
    'to' => 2,
    'message' => 'Mensagem 3',
    's_read' => 1,
    'time' => '2019-02-28 08:38:20'
);
$objeto6 = array(
    'id' => 3,
    'from' => 1,
    'to' => 2,
    'message' => 'Mensagem 3',
    's_read' => 1,
    'time' => '2019-03-03 08:38:20'
);
$messages[] = (object) $objeto1;
$messages[] = (object) $objeto2;
$messages[] = (object) $objeto3;
$messages[] = (object) $objeto4;
$messages[] = (object) $objeto5;
$messages[] = (object) $objeto6;

//print_r($messages);


$sorted_date = array();
foreach ($messages as $message){

    $chat = [
        'msg'       => $message->id,
        'sender'    => $message->from, 
        'recipient' => $message->to,
        'avatar'    => 'no-image.jpg',
        'body'      => $message->message,
        'time'      => date("M j, Y, g:i a", strtotime($message->time)),
        'type'      => $message->from == 1 ? 'sender' : 'receiver',
        'name'      => $message->from == 2 ? 'You' : 0
    ];
    $timestamp = strtotime($message->time);
    $date = date('d-m-Y', $timestamp);
    if ( !in_array_r( $date, $sorted_date  ))
    {
        $sorted_date[] = array( 
            'data' => $date,
            'message' => array( $chat )
        );
    }
    else
    {
        //$key = array_search($date, $sorted_date['data']);
        $key = array_seach_f($date, $sorted_date )  ;  
        echo "Key $key \n";
        $sorted_date[$key]['message'][] = $chat;
    }
}
$response = [
    'success' => true,
    'thread'  => $sorted_date
];
print_r( $sorted_date );
header('Content-Type: application/json');
//echo json_encode($response);
function in_array_r($item , $array) {
    return preg_match('/"'.preg_quote($item, '/').'"/i' , json_encode($array));
}

 function array_seach_f( $data, $array )
 {
     $index = -1;
     foreach ($array as $key => $value) {
         
         if( in_array( $data, $value ) ){
                
                echo $data."\n";
                $index = $key;
                break;
            } 
       
        
     }
     
     return $index;
 }
?>