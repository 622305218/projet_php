<?php
require_once "models/User.class.php";
class UserManager extends Model {
    private $users = [];

    public function ajouterUser($user) {
        $this->users[] = $user;
    }

    public function getUsers() {
        return $this->users;
    }

    public function getAllUser() {
        try {
            $req = $this->getBdd()->prepare("SELECT * FROM users ORDER BY id ASC");
            $req->execute();
            $users = $req->fetchAll();
            $req->closeCursor();
            foreach($users as $user) {
                $u = new User($user['id'], $user['nom'], $user['email'], $user['password'], $user['role'], $user['actif']);
                $this->ajouterUser($u);
            }
            return $this->getUsers();
        }catch(PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function addUser(User $user) {

        $req = "INSERT INTO users (nom, email, password, role, actif)
        values(?,?,?,?,?)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute(
            [$user->getNom(),
             $user->getEmail(), 
             password_hash($user->getPassword(), PASSWORD_DEFAULT), 
             $user->getRole(),
             $user->isActif()
            ]);
    }

   public function findByEmail($email){

        $sql = "SELECT * FROM users WHERE email=?";

        $stmt = $this->getBdd()->prepare($sql);

        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        $stmt->closeCursor();

        return $user;
    }

    public function getUserById($id){

        $sql = "SELECT * FROM users WHERE id=?";

        $stmt = $this->getBdd()->prepare($sql);

        $stmt->execute([$id]);
        
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        return $user;
    }

    public function countUsers(){

        $sql = "SELECT COUNT(*) as total FROM users";

        return $this->getBdd()->prepare($sql)->execute()->fetch(PDO::FETCH_OBJ)->total;
    }

    public function updateUser($id,$nom,$email,$role, $actif){

        $sql = "UPDATE users SET nom=?, email=?, role=?, actif=? WHERE id=?";

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->closeCursor();

        return $stmt->execute([$nom,$email,$role,$actif,$id]);
    }

    public function deleteUser($id){

        $sql = "DELETE FROM users WHERE id=?";

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->closeCursor();

        return $stmt->execute([$id]);
    }

}
?>