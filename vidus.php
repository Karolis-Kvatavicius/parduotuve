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
    <div class="col">
        <h1>Sveiki, <?php echo $_COOKIE['vardas']." ".$_COOKIE['pavarde']?></h1>
        <h6>Jūs prisijungėte kaip <span class="text-primary"><?php echo $_COOKIE['vartotojas']; ?></span>
        </h6>
        <!-- ATSIJUNGIMAS NUO PASKYROS -->
        <button class="btn btn-danger m-3 fixed-bottom" onclick="window.location.href='./atsijungti.php'" 
        data-toggle="tooltip" data-html="true" title="<p class='text-light'>Išvalyti slapukus ir sunaikinti sesiją.</p>">Atsijungti</button>
<?php
if(!empty($_SESSION)) {
?>
        <button disabled class="btn btn-success mb-5">Dėkojame už jūsų nuomonę!</button>
<?php
} else {
?>
        <button class="btn btn-primary mb-5" onclick="window.location.href='./klausimynas.php'">Įvertinkite mus!</button>
<?php
       }
?>
    </div>
</div>
<?php
if(isset($_POST['baigti'])) {
    $query = "SELECT pavadinimas, kaina FROM vartotojai JOIN cart_userid ON vartotojai.id=cart_userid.vartotojo_id JOIN prekes ON cart_userid.prekes_id=prekes.id AND vartotojai.id='".$_COOKIE['vartotojas']."';";
    $cart = performQuery($query);
        foreach ($cart as $preke) {
            echo "<p>".$preke['pavadinimas']." <span class=\"text-success\">".$preke['kaina']."</span></p>";
        }
?>
            <a class="nav-link pl-0" href="./vidus.php">Grįžti į prekių sąrašą</a>
<?php
        $query = "DELETE FROM cart_userid WHERE vartotojo_id='".$_COOKIE['vartotojas']."';";
        $cart = performQuery($query);

} else if(isset($_POST['prideti'])) {
    array_pop($_POST);
    $query = "INSERT INTO cart_userid VALUES ";
    foreach ($_POST as $key => $prekesID) {
        if(array_key_last($_POST) == $key) {
            $query .= "('".$_COOKIE['vartotojas']."', '".$prekesID."');";
            break;
        }
        $query .= "('".$_COOKIE['vartotojas']."', '".$prekesID."'),";
    }
    $result = performQuery($query);
    header('Location: ./vidus.php');
    exit();
} else {
    $query = "SELECT * FROM prekes;";
    $result = performQuery($query);

    $query2 = "SELECT COUNT(*) AS kiekis FROM cart_userid WHERE vartotojo_id='".$_COOKIE['vartotojas']."';";
    $result2 = performQuery($query2);
    $disabled = true;
    ($result2[0]['kiekis'] == 0) ? $disabled = true : $disabled = false;

?>
<form class="row" action="" method="post">
    <div class="col-6">
        <h3>Pasirinkite prekes iš sąrašo:</h3>
        <?php
        foreach ($result as $preke) {
            echo '<input type="checkbox" id="'.$preke['id'].'" name="'.$preke['pavadinimas'].'" value="'.$preke['id'].'"><label for="'.$preke['id'].'">&nbsp;&nbsp;'.$preke['pavadinimas'].' <span class="text-success">Kaina: '.$preke['kaina'].'</span></label><br>';
        }
        ?>
        <input class="btn btn-primary my-3" name="prideti" value="Pridėti į krepšelį" type="submit">
    </div>
    <div class="col-6 text-center my-auto">
        <input <?php echo ($disabled) ? 'disabled' : ''; ?> class="btn btn-primary" name="baigti" value="Baigti apsipirkimą" type="submit">
    </div>
</form>
<?php
}

require './includes/footer.php';
?>