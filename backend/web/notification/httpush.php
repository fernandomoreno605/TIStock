<?php
    use backend\models\Comments;

    set_time_limit(0);
    $fecha_ac = isset($_POST['timestamp']) ? $_POST['timestamp']:0;

    $fecha_bd = $row['timestamp'];
    while( $fecha_bd <= $fecha_ac ){
        $query = Comments::find()
            ->orderBy(['timestamp' => SORT_DESC])
            ->limit(1)
            ->asArray()
            ->all();
        foreach ($query as $q){
            $fecha_bd = strtotime($q['timestamp']);
        }
    }
    $query2 = Comments::find()
        ->orderBy(['timestamp' => SORT_DESC])
        ->limit(1)
        ->asArray()
        ->all();

    foreach ($query2 as $item){
        $dataComment['timestamp'] = strtotime($item['timestamp']);
        $dataComment['id'] = $item['id_comment'];
        $dataComment['comment_text'] = $item['comment_text'];
        $dataComment['comment_status'] = $item['comment_status'];
        $dataComment['comment_subject'] = $item['coment_subjet'];
    }
    $dato_json = json_encode($dataComment);
    echo $dato_json;
?>