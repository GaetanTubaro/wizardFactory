<?php if (isset($_SESSION["login"])) {
    header('Location: ?page=list');
}

?>
<form class="d-flex flex-column justify-content-center w-25 mx-auto p-5 " method="POST">
    <div class="mb-3">
        <label for="inputId" class="form-label">Pseudo</label>
        <input type="text" class="form-control" name="pseudo" required>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="pass" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php
if (isset($_POST['pseudo'])) {
    $statement = $connection->query("SELECT * FROM users WHERE pseudo = '".$_POST['pseudo']."'");
    $statement->setFetchMode(PDO::FETCH_CLASS, "Users");
    $user = $statement->fetch();
    if ($user->getPassword() == $_POST['pass']) {
        echo 'Connectated';
        $_SESSION["login"] = $user->getPseudo();
        $_SESSION["id"] = $user->getId();
        header('Location:?page=list');
    } else {
        echo "Identifiants Incorrects";
    }
}
// if (isset($_POST["pass"]) && $_POST["pass"] != $myPass) {
//     echo 'Mauvais mot de passe';
// }
