<?php

class Model_Tags extends Model{

    public function getTagCloudData() {
        $qGetCloud = "SELECT tags.tag, COUNT(messages_tags.tags_id) AS posts_count".
            " FROM messages_tags LEFT JOIN tags ON messages_tags.tags_id=tags.id".
            " GROUP BY tags.id";
        $result = $this->DB->query($qGetCloud);
        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        else {
            $records = array();

            while ($myrow=$result->fetch_assoc()){
                $records [] = $myrow;
            }
            return $records;
        }
    }

    public function CreateCloud(){
        $TagCloud = $this->getTagCloudData();
        $min = $TagCloud[0]['posts_count'];
        $max = $TagCloud[0]['posts_count'];
        for ($i = 1; $i < count($TagCloud); $i++){
            if ($TagCloud[$i]['posts_count'] > $max){
                $max = $TagCloud[$i]['posts_count'];
            }
            if ($TagCloud[$i]['posts_count'] < $min){
                $min = $TagCloud[$i]['posts_count'];
            }
        }
        $minSize = 70;
        $maxSize = 150;
        $records = array();
        foreach ($TagCloud as $item){
            if ($min == $max){
                $fontSize = round(($maxSize - $minSize) / 2 + $minSize);
            }
            else{
                $fontSize = round((($item['posts_count'] - $min)/($max - $min)) *
                    ($maxSize - $minSize) + $minSize);
            }
            $records[] = "<a class='tags' href='/main/tagssearch?tag=".$item['tag'].
                "'style='font-size:".$fontSize."%'>".
                $item['tag']." (".$item['posts_count'].")</a>&nbsp";
        }
        return $records;
    }
}
