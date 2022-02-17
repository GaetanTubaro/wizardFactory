<?php if (isset($_SESSION["login"])) {
    header('Location: ?page=list');
}

?>
<form class="d-flex flex-column justify-content-center w-25 mx-auto p-5 " method="POST">
    <div class="mb-3">
        <label for="inputId" class="form-label">Identifiant</label>
        <input type="text" class="form-control" name="id" required>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="pass" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php
if (isset($_POST['id'])) {
    $statement = $connection->query("SELECT * FROM users WHERE pseudo = '".$_POST['id']."'");
    $statement->setFetchMode(PDO::FETCH_CLASS, "Users");
    $user = $statement->fetch();
    if ($user->getPassword() == $_POST['pass']) {
        echo 'Connectated';
        $_SESSION["login"] = $_POST["id"];
        header('Location:?page=list');
    } else {
        echo "Identifiants Incorrects";
    }
}
// if (isset($_POST["pass"]) && $_POST["pass"] != $myPass) {
//     echo 'Mauvais mot de passe';
// }
