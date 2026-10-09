<?php
declare(strict_types=1);

session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);

const CMS_DB_PATH = __DIR__ . '/../storage/content.sqlite';

function db(): PDO
{
    static $connection = null;
    if ($connection instanceof PDO) {
        return $connection;
    }

    $directory = dirname(CMS_DB_PATH);
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }

    $connection = new PDO('sqlite:' . CMS_DB_PATH, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $connection->exec('CREATE TABLE IF NOT EXISTS settings (setting_key TEXT PRIMARY KEY, setting_value TEXT NOT NULL)');
    $connection->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT UNIQUE NOT NULL, password_hash TEXT NOT NULL)');

    if ((int) $connection->query('SELECT COUNT(*) FROM users')->fetchColumn() === 0) {
        $statement = $connection->prepare('INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)');
        $statement->execute([
            'username' => 'admin',
            // Cambie estas credenciales desde el panel antes de publicar el sitio.
            'password_hash' => password_hash('Cambiar123!', PASSWORD_DEFAULT),
        ]);
    }

    return $connection;
}

function defaults(): array
{
    return [
        'site_title' => 'PULSODIGITALWEB',
        'meta_description' => 'PULSODIGITALWEB: estrategia, diseño y desarrollo web para impulsar negocios.',
        'hero_eyebrow' => 'Agencia digital con propósito',
        'hero_title' => "Tu marca no necesita\nmás ruido. Necesita pulso.",
        'hero_text' => 'Transformamos ideas ambiciosas en experiencias digitales que atraen, conectan y convierten.',
        'hero_button' => 'Impulsa tu proyecto',
        'services_title' => "Hacemos que lo digital\ntrabaje para tu negocio.",
        'service_1_title' => "Estrategia\nDigital", 'service_1_text' => 'Definimos el rumbo para que cada acción tenga un propósito y un resultado medible.',
        'service_2_title' => "Branding &\nDiseño", 'service_2_text' => 'Construimos identidades memorables que hablan el idioma de tu audiencia.',
        'service_3_title' => "Desarrollo\nWeb", 'service_3_text' => 'Creamos sitios rápidos, intuitivos y preparados para crecer con tu negocio.',
        'statement_title' => "No seguimos tendencias.\nCreamos relevancia.",
        'statement_text' => 'Combinamos pensamiento estratégico, diseño humano y tecnología para construir marcas que dejan huella.',
        'process_title' => "Una ruta clara hacia\ngrandes resultados.",
        'step_1_title' => 'Escuchamos', 'step_1_text' => 'Entendemos tu negocio, tus retos y a las personas que quieres alcanzar.',
        'step_2_title' => 'Diseñamos', 'step_2_text' => 'Convertimos los hallazgos en una propuesta estratégica y visual única.',
        'step_3_title' => 'Activamos', 'step_3_text' => 'Llevamos la idea a la realidad y medimos el impacto para seguir mejorando.',
        'contact_title' => "Tu próximo gran paso\nempieza aquí.",
        'instagram_url' => '#', 'linkedin_url' => '#',
    ];
}

function content(): array
{
    $defaults = defaults();
    $statement = db()->query('SELECT setting_key, setting_value FROM settings');
    foreach ($statement as $row) {
        if (array_key_exists($row['setting_key'], $defaults)) {
            $defaults[$row['setting_key']] = $row['setting_value'];
        }
    }
    return $defaults;
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function text_lines(string $value): string
{
    return nl2br(e($value), false);
}

function csrf_token(): string
{
    $_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
        http_response_code(419);
        exit('La solicitud ha expirado. Recargue la página e inténtelo de nuevo.');
    }
}

function require_admin(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}
