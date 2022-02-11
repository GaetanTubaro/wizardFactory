<form class="d-flex flex-column justify-content-center w-25 mx-auto p-5 " method="POST">
    <div class="mb-3">
        <label for="inputId" class="form-label">Identifiant</label>
        <input type="text" class="form-control"  name="id" required>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="pass" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
<?php
if (isset($_POST["pass"]) && $_POST["pass"] != $myPass) {
    echo 'Mauvais mot de passe';
}
?>