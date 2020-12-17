<?php
if(isset($_COOKIE['vartotojas'])) {
    header('Location: ./vidus.php');
    exit();
}

if(isset($_POST['prisijungimas'])) {
    require 'functions.php';
    $query = "SELECT * FROM vartotojai WHERE id='".$_POST['vartotojas']."';";
    $result = performQuery($query);

    if(is_array($result[0])) {
        if($result[0]['slaptazodis'] == $_POST['slaptazodis']) {
            setcookie('vartotojas', $result[0]["id"], time() + (3600 * 4));
            setcookie('vardas', $result[0]["vardas"], time() + (3600 * 4));
            setcookie('pavarde', $result[0]["pavarde"], time() + (3600 * 4));
            header('Location: ./vidus.php');
            exit();
        } else {
            header('Location: ./prisijungimas.php');
            exit();
        }
    
    } else {
        $result = "Prisijungimas nepavyko";
        header('Location: ./prisijungimas.php?error='.$result);
        exit(); 
    }
}
require './includes/header.php';
?>
<div class="row mt-5">
    <h1 class="col">Prisijunkite prie savo paskyros</h1>

    <form class="col" action="" method="post">
        <h6 class="text-danger"><?php echo (isset($_GET['error'])) ? $_GET['error'] : ''; ?></h6>
        <input class="form-control" required name="vartotojas" type="text" placeholder="Jūsų vartotojo vardas">
        <input class="form-control my-3" required name="slaptazodis" type="password" placeholder="Slaptažodis">
        <input class="btn btn-primary" type="submit" name="prisijungimas" value="Prisijungti">
    </form>
</div>

<?php
require './includes/footer.php';
?>