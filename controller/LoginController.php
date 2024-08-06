<?php
session_start();
require_once 'model/dao/UsuariosDAO.php';

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new UsuariosDAO();
    }

    // Función para manejar el inicio de sesión
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = isset($_POST['email']) ? htmlentities($_POST['email']) : '';
            $password = isset($_POST['password']) ? htmlentities($_POST['password']) : '';

            if (empty($email) || empty($password)) {
                $_SESSION['mensaje'] = 'Por favor, rellene todos los campos.';
                $_SESSION['color'] = 'danger';
                header('Location: index.php?c=index&f=index&p=login');
                exit();
            }

            $usuario = $this->model->authenticate($email, $password);

            if ($usuario) {
                // Guardar información en la sesión
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nombre'] = $usuario->nombre;
                $_SESSION['usuario_rol'] = $usuario->rol_id;

                if ($usuario->rol_id == 1) {
                    $_SESSION['usuario_rol'] = 1;
                } else {
                    header('Location: index.php');//?c=Usuario&f=index
                }
                // Redirigir según el rol del usuario
                if ($usuario->rol_id == 2) {
                    // Rol 2 es gestor
                    $_SESSION['usuario_rol'] = 2;
                } else {
                    header('Location: index.php');//?c=Usuario&f=index
                }
                // Redirigir según el rol del usuario
                if ($usuario->rol_id == 3) {
                    // Rol 3 es usuario
                    $_SESSION['usuario_rol'] = 3;
                } else {
                    header('Location: index.php');//?c=Usuario&f=index
                }
                exit();
            } else {
                $_SESSION['mensaje'] = 'Email o contraseña incorrectos.';
                $_SESSION['color'] = 'danger';
                header('Location: index.php?c=index&f=index&p=login');
                exit();
            }
        }
    }
}
?>
