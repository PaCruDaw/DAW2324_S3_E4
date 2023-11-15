<?php 
include("database.php");

class User {
    private $pdo;
    private $table_name = "usuario";
    private $id;
    private $email;
    private $es_admin;
    private $userName;

    public function __construct()
    {
        $connection = new Database();
        $this->pdo = $connection->connect();
    }

    public function getId()
    {
        return $this->id; 
    }

    public function getEmail()
    {
        return $this->email; 
    }

    public function getEsAdmin()
    {
        return $this->es_admin; 
    }

    public function getUsername() {
        return $this->userName;
    }


//function login 
    public function login($email, $password)
    {
        try {
            $query = "SELECT id, email, es_admin, username FROM " . $this->table_name . " 
                      WHERE email = :email AND contrasena = :contrasena";

            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':contrasena', $password);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //si encuentro al usuario en la base de datos, guardo los datos en mi objeto $user 
            //hash if(password_verify($password,$user['password']))
            if ($user) {
                $this->id = $user['id'];
                $this->email = $user['email'];
                $this->username = $user['username'];
                $this->es_admin = $user['es_admin'];

                return true; 
            } else {
                return false; //el login no es correcto
            }
        } catch (PDOException $e) {
            echo "Error al realizar el inicio de sesión " . $e->getMessage();
            return false; // Error al realizar el inicio de sesión
        }
    }
}