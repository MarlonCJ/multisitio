<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (!empty($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $statement = db()->prepare('SELECT id, username, password_hash FROM users WHERE username = :username');
    $statement->execute(['username' => trim($_POST['username'] ?? '')]);
    $user = $statement->fetch();
    if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['username'];
        header('Location: index.php'); exit;
    }
    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Acceso | PULSODIGITALWEB</title><link rel="stylesheet" href="styles.css"></head><body class="login-page"><main class="login-card"><p class="brand-name">PULSO<span>DIGITAL</span>WEB</p><h1>Panel de administración</h1><p>Gestiona el contenido de tu página web.</p><?php if ($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Usuario<input name="username" required autofocus></label><label>Contraseña<input type="password" name="password" required></label><button type="submit">Ingresar al panel →</button></form><small>Acceso inicial: admin / Cambiar123!</small></main></body></html>
