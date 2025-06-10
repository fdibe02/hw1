<?php

    include 'auth.php';

    if(checkAuth()){
        header('Location: index.php');
        exit;
    }

    if(isset($_POST['form_type'])){

        if($_POST['form_type'] == 'signin'){
            if( !empty($_POST['email']) && !empty($_POST['password']) ){
                $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
                
                $email = mysqli_real_escape_string($conn, $_POST['email']);

                $query = "SELECT * FROM users WHERE email = '".$email."'";

                $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

                if(mysqli_num_rows($res) > 0){

                    $row = mysqli_fetch_assoc($res);

                    if (password_verify($_POST['password'], $row['password'])){
                        //imposto la sessione
                        $_SESSION['_medium_email'] = $row['email'];
                        $_SESSION['_medium_user_id'] = $row['id'];
                        header("Location: index.php");
                        mysqli_free_result($res);
                        mysqli_close($conn);
                        exit;
                    }
                }

                $error = "Username e/o password errati";           
            } 
            else if(isset($_POST['email']) || isset($_POST['password'])){
                $error = "Inserisci email e password";
            }
        }
        else if($_POST['form_type'] == 'signup'){
            if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])){
                $error = array();
                $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

                #EMAIL
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error["email"] = "Email non valida";
                }else {
                    $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
                    $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
                    if (mysqli_num_rows($res) > 0) {
                        $error["email"] = "Email già utilizzata";
                    }
                }

                # PASSWORD
                if (strlen($_POST["password"]) < 8) {
                $error["email"] = "Caratteri password insufficienti";
                } 

                # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(email, password, name, surname) VALUES('$email', '$password', '$name', '$surname')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_medium_email"] = $_POST["email"];
                $_SESSION["_medium_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: index.php");
                exit;
            } else {
                $error["database"] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    } 
    else if (isset($_POST["email"])) {
        $error["general"] = "Riempi tutti i campi";
    }
        }
    }

?>

<html>
    <head>
        <link rel="stylesheet" href="signin.css">
        <script src="signin.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Medium for Wp: Sign Up</title>
    </head>

    <body>
        <div id="modal-signup" class="hidden">
            <section id="form-signup">
                <div class="exit">&times</div>
                <h3>Join Medium.</h3>
                <?php if(isset($error['general'])) echo "<a class='error'>".$error['general']."</a>"; ?>
                <form name='signup' method='post'>
                    <input type='hidden' name="form_type" value="signup">
                    <div class="nome">
                        <label for="name">Nome</label> 
                        <input type='text' name='name' id="name" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>>
                        <span class="hidden">Inserisci il tuo nome</span>
                    </div>
                    <div class="cognome">
                        <label for="surname">Cognome</label>
                        <input type='text' name='surname' id="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>>
                        <span class="hidden">Inserisci il tuo cognome</span>
                        <?php if(isset($error['name'])) echo "<a class='error'>".$error['name']."</a>"; ?>
                    </div>
                    <div class="email">
                        <label for="email">E-mail</label>
                        <input type='text' name='email' id="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                        <span class="hidden">Inserisci la tua e-mail</span>
                        <?php if(isset($error['email'])) echo "<a class='error'>".$error['email']."</a>"; ?>
                    </div>
                    <div class="password">
                        <label for="password">Password</label>
                        <input type='password' name='password' id="password"  <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                        <span class="hidden">Inserisci una password</span> 
                        <?php if(isset($error['password'])) echo "<a class='error'>".$error['password']."</a>"; ?>                  
                    </div>
                    <input type="submit" value="Crea Account">
                </form>
                <a>Already have an account? <strong class="signin">Sign in</strong></a>
            </section>
        </div>

        <div id="modal-signin" class="hidden">
            <section id="form-signin">
                <div class="exit">&times</div>
                <h3>Welcome back.</h3>
                <?php if(isset($error)) echo "<a class='error'>$error</a>"?>
                <form name="signin" method='post'>
                    <input type='hidden' name="form_type" value="signin">
                    <div class="email">
                        <label for="email-si">E-mail</label>
                        <input type='text' name='email' id="email-si" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];}  ?>>
                        <span class="hidden">Inserisci la tua e-mail</span>

                    </div>
                    <div class="password">
                        <label for="password-si">Password</label>
                        <input type='password' name='password' id="password-si" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                        <span class="hidden">Inserisci una password</span>                   
                    </div>
                    <input type="submit" value="Accedi">
                </form>
                <a>Non hai un account? <strong class="signup">Sign up</strong></a>
            </section>
        </div>

        <header>
            <div id="logo"> Medium </div>
            <div id="start">
                <a>Our Story</a>
                <a>Membership</a>
                <a>Write</a>
                <a class="signin">Sign in</a>
                <button class="signup">Get started</button>
            </div>
        </header>

        <section id="main">
            <h1>Human <br> Stories & Ideas</h1>  
            <h3>A place to read, write, and deepen your understanding</h3>  
            <button class="signup">Start Reading</button>

        </section>

        <footer>
            <a>Help</a>
            <a>Status</a>
            <a>About</a>
            <a>Carrers</a>
            <a>Press</a>
            <a>Blog</a>
            <a>Privacy</a>
            <a>Rules</a>
            <a>Terms</a>
            <a>Text to speech</a>
        </footer>
    </body>
</html>