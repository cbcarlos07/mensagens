<?php

$objeto1 = array(
    'id' => 1,
    'from' => 1,
    'to' => 2,
    'message' => 'Mensagem 1',
    's_read' => 1,
    'time' => '2019-02-26 10:32:55'
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
$messages[] = (object) $objeto1;
$messages[] = (object) $objeto2;
$messages[] = (object) $objeto3;

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
        $key = array_search($date, $sorted_date);
        
        $sorted_date[$key]['message'][] = $chat;
    }
}
$response = [
    'success' => true,
    'thread'  => $sorted_date
];
//print_r( $sorted_date );
header('Content-Type: application/json');
echo json_encode($response);
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
?>