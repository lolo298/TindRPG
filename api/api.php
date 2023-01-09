<?php
$GLOBALS["prefix_path"] = "./api/";
function get_prof_by_id($id){
    $file_content = file_get_contents($GLOBALS["prefix_path"]."prof.json");
    $json_data = json_decode($file_content, true);
    if (array_key_exists($id, $json_data)){
        $pid = $json_data[$id];
    }
    else {
        $pid = array(
            "nom" => "unknown_id",
            "img" => 0
        );
    }
    return $pid;
}
function list_all_questions(){
    $file_content = file_get_contents($GLOBALS["prefix_path"]."questions.json");
    return json_decode($file_content, true);
}
?>