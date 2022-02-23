<?php
class Users
{
    protected int $id;
    protected string $pseudo;
    protected string $password;

    public function linkUser($connection, $id_character)
    {
        $findUser = $connection->prepare('SELECT id, pseudo FROM users WHERE pseudo="' . $this->getPseudo() . '"');
        $findUser->setFetchMode(PDO::FETCH_CLASS, Users::class);
        $findUser->execute();
        $user = $findUser->fetch();
        if (empty($user)) {
?>
            <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                <p class="mb-0">Joueur inconnu ou pseudo incorrect.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } else {
            $request = 'UPDATE game_character SET id_user =' . $user->getId() . ' WHERE id_charac =' . $id_character;
            $linkUserChar = $connection->exec($request);
            if ($linkUserChar == false || $linkUserChar == 0) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show w-50 mx-auto my-3" role="alert">
                    <p class="mb-0">Une erreure est survenue. Veuillez recommencer.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
            } else {
                header('Location: ?page=details&character=' . $id_character);
            }
        }
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }
}
