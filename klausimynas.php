<?php
if(!isset($_COOKIE['vartotojas'])) {
    header('Location: ./prisijungimas.php');
    exit();
}
session_start();
require './includes/header.php';
require 'functions.php';
?>
<div class="row">
    <div class="col text-center">
        <h1>Apklausa</h1>
        <h6 class="alert-danger p-3">Atsakykite pasirinkdami atsakymą nuo 1 iki 5, kur 1 - labai blogai, o 5 - labai gerai</h6>
    </div>
</div>
<?php
if(isset($_POST['q5'])) {
    $_SESSION['answer5'] = $_POST['answer'];
    $average = array_sum($_SESSION) / count($_SESSION);
    $query = "INSERT INTO vertinimas(vartotojo_id, vidurkis) VALUES('".$_COOKIE['vartotojas']."', '".$average."');";
    performQuery($query);
?>  <h1>Jūs įvertinote puslapį: <?php echo $average ?>/<span class="h5">5</span></h1>
    <button class="btn btn-primary mb-5" onclick="window.location.href='./klausimynas.php'">Grįžti į prekių sąrašą</button>
<?php
} else if(isset($_POST['q4'])) {
    $_SESSION['answer4'] = $_POST['answer'];
    printQuestion('q5', 'Kaip vertintumėte puslapio funkcionalumą?');
} else if(isset($_POST['q3'])) {
    $_SESSION['answer3'] = $_POST['answer'];
    printQuestion('q4', 'Kaip vertintumėte puslapio išvaizdą?');
} else if(isset($_POST['q2'])) {
    $_SESSION['answer2'] = $_POST['answer'];
    printQuestion('q3', 'Kaip vertintumėte prekių asortimentą?');
} else if(isset($_POST['q1'])) {
    $_SESSION['answer1'] = $_POST['answer'];
    printQuestion('q2', 'Kaip vertintumėte prekių kainas?');
} else {
    printQuestion('q1', 'Kaip vertintumėte pristatymo greitį?');    
}

require './includes/footer.php';
?>