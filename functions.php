<?php

function connectToDB($servername='localhost', $dbname='parduotuve_karolis', $username='root', $password='') {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}

function performQuery($query) {
    try {
        $prepared = connectToDB()->prepare($query);
        $prepared->execute();
        $prepared->setFetchMode(PDO::FETCH_ASSOC);
        $result = $prepared->fetchAll();
        return $result;
    } catch(PDOException $e) {
        $error = $e->getMessage()."\n";
        error_log($error, 3, './log/error.txt');
    }
}

function printQuestion($question_no, $question) {
   
echo <<<HTML

<div class="row-cols-1">
    <h3 class="col mt-3">{$question}</h3>
    <form class="col" action="" method="post">
        <!-- 1 -->
        <input type="radio" id="answer1" name="answer" value="1">
        <label for="answer1">1</label><br>
        <!-- 2 -->
        <input type="radio" id="answer2" name="answer" value="2">
        <label for="answer2">2</label><br>
        <!-- 3 -->
        <input type="radio" id="answer3" name="answer" value="3">
        <label for="answer3">3</label><br>
        <!-- 4 -->
        <input type="radio" id="answer4" name="answer" value="4">
        <label for="answer4">4</label><br>
        <!-- 5 -->
        <input type="radio" id="answer5" name="answer" value="5">
        <label for="answer5">5</label><br>
        <!-- SUBMIT -->
        <input class="btn btn-primary" type="submit" name="$question_no" value="Pateikti atsakymą">
    </form>
</div>
HTML;
}