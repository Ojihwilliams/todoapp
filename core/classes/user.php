<?php

/**
 * summary
 */
class User 
{
    /**
     * summary
     */
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo= $pdo;
    }

    public function checkInput($var){
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripcslashes($var);
		return $var;
	}

	public function checkUsername($username){
		$stmt = $this->pdo->prepare("SELECT username FROM users WHERE username = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_OBJ);


		$count = $stmt->rowCount();

		if($count > 0){
			return true ;
		}else{
			return false;
		}

	}
	public function checkEmail($email){
		$stmt= $this->pdo->prepare("SELECT * FROM users WHERE email =:email");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_OBJ);

		$count = $stmt->rowCount();

			if ($count > 0) {
				return true;
			}else {
				return false;
			}

	}

	public function login($user,$pass){
		$stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE username = :user AND password = :pass");
		$stmt->bindParam(":user", $user, PDO::PARAM_STR);
		$stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $stmt->rowCount();

		if ($count > 0) {
			$_SESSION['user_id'] = $user->user_id;
			header('Location: home.php');
			
		}else{
			return false;
		}

	}

	public function logout(){
		$_SESSION = array();
		session_destroy();
		header('Location: '.BASE_URL.'index.php');
	}

		public function loggedIn(){
		return (isset($_SESSION['user_id'])) ? true : false;
	}


	public function userData($user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	 public function newUser($user, $pass, $email, $name, $sex){
        $stmt = $this->pdo->prepare("INSERT INTO users(username, name, email, password, sex) VALUES(:user, :name, :email, :pass, :sex)");
        $stmt->bindParam(":user", $user, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
        $stmt->bindParam(":sex", $sex, PDO::PARAM_STR);
        $stmt->execute();
}
	public function userID($user){
        $stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE username = :user");
        $stmt->bindParam(":user", $user, PDO::PARAM_STR);
        $stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
		

    }


	public function uploadImage($file){
		$filename = basename($file['name']);
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $error = $file['error'];

        $ext = explode('.', $filename);
        $ext = strtolower(end($ext));
        $allowed_ext = array('jpg', 'png', 'jpeg');

        if (in_array($ext, $allowed_ext) === true) {
            if ($error === 0) {
                if ($fileSize <= 209272152) {
                    $fileRoot = './images/'.$filename;
                    move_uploaded_file($fileTmp, $fileRoot);
                    return $fileRoot;
                }else{
                  $GLOBALS['imageError'] = "The file size is to large";

                }
            }
        }else {
            $GLOBALS['imageError'] = "The Extension is not allowed";
        }
    }

    public function update($table, $id, $fields = array()){
        $columns = '';
        $i      = 1;

        foreach ($fields as $name => $value) {
            $columns .= "{$name} = :{$name}";
            if ($i < count($fields)) {
                $columns .= ', ';
            }
            $i++;
        }
            $sql = "UPDATE {$table} SET {$columns} WHERE user_id = {$id}";
            if ($stmt = $this->pdo->prepare($sql)) {
                foreach ($fields as $key => $value) {
                    $stmt->bindValue(':'.$key, $value);
                }
            $stmt->execute();
            }
        }

	public function newItem($item, $postedBy){
		$stmt= $this->pdo->prepare("INSERT INTO mylist(item, postedBy, date) VALUES(:item, :postedBy, NOW())");
		$stmt->bindParam(":item", $item, PDO::PARAM_STR);
	    $stmt->bindParam(":postedBy", $postedBy, PDO::PARAM_INT);
	    $stmt->execute();
	}

	public function displayItem($postedBy){
		$stmt= $this->pdo->prepare("SELECT item, item_id FROM mylist WHERE postedBy = :postedBy");
	    $stmt->bindParam(":postedBy", $postedBy, PDO::PARAM_INT);
	    $stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_OBJ);
	   

	}

	public function deleteItem($id){
		$stmt = $this->pdo->prepare("DELETE FROM mylist WHERE item_id = :id");
	    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
	    $stmt->execute();
	    //header('location:'.BASE_URL.'home.php');
	   
	}
}

?>