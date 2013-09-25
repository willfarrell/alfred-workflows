<?php
// ****************
//error_reporting(0);
require_once('workflows.php');
$w = new Workflows();

// CACHING
if ( filemtime("data.json") <= time()-60*60*24*7 ) {
    $data = json_decode(file_get_contents("https://raw.github.com/Fyrd/caniuse/master/data.json"));
    addResults($data->data);
    save();
}

function update() {
    $data = json_decode(file_get_contents("https://raw.github.com/Fyrd/caniuse/master/data.json"));
    $this->addResults($data->data);
    $this->save();
}

function save() {
    if (count($this->results) === 0) {
        echo strtoupper($this->display_name)." FAILED\n";
        return;
    }
    file_put_contents(PARSER_URL."data/".$this->data_filename, json_encode($this->results));
    echo strtoupper($this->display_name)." DONE\n";
}

function addResults($arr) {
    foreach ($arr as $key => $val) {
        $title = $val->title;
        $url = "http://caniuse.com/#feat=" . $key;
        $description = $val->description;
        $this->addResult($url, $title, $description);
    }
}

function addResult($url, $title, $description) {
    $this->results[] = array(
        "url" => $url ,
        "title" => $title,
        "description" =>str_replace("&mdash;","-",html_entity_decode(trim(str_replace("\n"," ",strip_tags($description)))))
    );
}
// END CACHE

if (!isset($query)) { $query = urlencode( "{query}" ); }

$data = json_decode(file_get_contents("data.json"));

$extras = array();
$extras2 = array();
$found = array();

foreach ($data as $key => $result) {
	$value = strtolower(trim($result->title));
    $description = utf8_decode(strip_tags($result->description));
    
	if (strpos($value, $query) === 0) {
        if (!isset($found[$value])) {
            $found[$value] = true;
            $w->result( $type.$result->title, $result->url, $result->title, $result->description, "icon.png" );
        }
    }
    else if (strpos($value, $query) > 0) {
        if (!isset($found[$value])) {
            $found[$value] = true;
            $extras[$key] = $result;
        }
    }

    else if (strpos($description, $query) !== false) {
        if (!isset($found[$value])) {
            $found[$value] = true;
            $extras2[$key] = $result;
        }
    }
}

foreach ($extras as $key => $result) {
        $w->result( $type.$result->title, $result->url, $result->title, $result->description, "icon.png"  );

}

foreach ($extras2 as $key => $result) {
        $w->result( $type.$result->title, $result->url, $result->title, $result->description, "icon.png"  );

}

echo $w->toxml();
// ****************
?>