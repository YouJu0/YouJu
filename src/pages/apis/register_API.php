  <?php
  session_start();
  include("../../conexion.php");
  if (
    isset($_POST["Email"])
    && isset($_POST["Pass"])
    && isset($_POST["CONFIPass"])
    && isset($_POST["Email"])
  ) {
    function validar($datos)
    {
      $datos = trim($datos);
      $datos = stripcslashes($datos);
      $datos = htmlspecialchars($datos);
      return $datos;
    }
    $Name = validar($_POST['Name']);
    $Email = validar($_POST["Email"]);
    $pass = validar($_POST['Pass']);
    $confpass = validar($_POST['CONFIPass']);
    //verifica si las contraseñas coinciden
    if ($pass === $confpass) {

      if (empty($Email)) {
        header("Location: index.php?error=El usuario es requerido");
        exit();
      } elseif (empty($pass)) {
        header("Location: index.php?error=La contraseña es requerida");
        exit();
      } elseif (empty($Name)) {
        header("Location: index.php?error=El nombre es requerida");
        exit();
      } else {
        $passcypt = sha1($pass);
        $query = "INSERT INTO `user` (`ID_User`, `Name`, `email`, `pass`) 
      VALUES (NULL, '$Name', '$Email', '$passcrypt');";


        $resultado = $mysqli->query($query);
        if ($resultado) {

          header("Location: ../../index.php?error=El nombre es requerida");
          header("Location: ../../index.php");
          $resultado->close();
          exit();
        } else {
          header("Location: ../../index.php?error=EL correo ya esta registrado o no cumple los requisitos");
          exit();
        }
      }
    }
  } else {
    header("Location: ../../index.php?error=Las contraseñas no coinciden");
    $resultado->close();
    exit();
  }
