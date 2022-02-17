<form class="d-flex flex-column justify-content-center w-25 mx-auto p-5 " method="POST">
    <div class="mb-3">
        <label for="inputId" class="form-label">Identifiant</label>
        <input type="text" class="form-control" name="id" required>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="pass" required>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Verification mot de passe</label>
        <input type="password" class="form-control" name="verifPass" required>
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<?php

if (isset($_POST['id']) && $_POST['pass'] && $_POST['verifPass']) {
    if ($_POST['pass'] != $_POST['verifPass']) {
        echo "Le mot de passe n'est pas verifié";
    } else {
        $signup = $connection->query("SELECT COUNT(*) AS count FROM users WHERE pseudo ='".$_POST['id']."'");
        $signup = $signup->fetchAll(PDO::FETCH_ASSOC);
        if ($signup[0]['count']!='0') {
            echo 'Le pseudo existe déjà';
        } else {
            $statement = $connection->query("INSERT INTO users(pseudo,password) VALUES ('".$_POST['id']."','".$_POST['pass']."')"); ?>
<a href="?page=login">Le compte à été crée. Connectez-vous.</a>;
<?php
        }
    }
}



// if (isset($_POST['pass'])) {
//     if ($_POST['pass']!==$_POST['verifPass']) {
//         echo 'le mot de passe ne correspond pas à la verfication';
//     } else {
//        header('Location: ?page=login');
//         echo 'Compte crée, veuillez vous connecter';
//    }
// }
