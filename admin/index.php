<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$fields = [
    'Información general' => ['site_title' => 'Nombre de la empresa', 'meta_description' => 'Descripción para buscadores'],
    'Portada' => ['hero_eyebrow' => 'Texto superior', 'hero_title' => 'Título principal', 'hero_text' => 'Descripción', 'hero_button' => 'Texto del botón'],
    'Servicios' => ['services_title' => 'Título de servicios', 'service_1_title' => 'Servicio 1: título', 'service_1_text' => 'Servicio 1: descripción', 'service_2_title' => 'Servicio 2: título', 'service_2_text' => 'Servicio 2: descripción', 'service_3_title' => 'Servicio 3: título', 'service_3_text' => 'Servicio 3: descripción'],
    'Nosotros y proceso' => ['statement_title' => 'Titular de filosofía', 'statement_text' => 'Texto de filosofía', 'process_title' => 'Título del proceso', 'step_1_title' => 'Paso 1: título', 'step_1_text' => 'Paso 1: descripción', 'step_2_title' => 'Paso 2: título', 'step_2_text' => 'Paso 2: descripción', 'step_3_title' => 'Paso 3: título', 'step_3_text' => 'Paso 3: descripción'],
    'Contacto y redes' => ['contact_title' => 'Título de contacto', 'instagram_url' => 'Enlace de Instagram', 'linkedin_url' => 'Enlace de LinkedIn'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $allowed = array_merge(...array_map('array_keys', $fields));
    $save = db()->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value) ON CONFLICT(setting_key) DO UPDATE SET setting_value = excluded.setting_value');
    foreach ($allowed as $key) {
        $save->execute(['key' => $key, 'value' => trim((string) ($_POST['content'][$key] ?? ''))]);
    }
    header('Location: index.php?saved=1'); exit;
}
$content = content();
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Administrador | PULSODIGITALWEB</title><link rel="stylesheet" href="styles.css"></head><body><header class="admin-header"><div><p class="brand-name">PULSO<span>DIGITAL</span>WEB</p><small>Administrador de contenidos</small></div><nav><a href="../index.php" target="_blank">Ver sitio ↗</a><a href="logout.php">Cerrar sesión</a></nav></header><main class="admin-main"><div class="intro"><div><p class="kicker">CMS</p><h1>Edita el contenido de tu sitio</h1><p>Los cambios se publican inmediatamente al guardar.</p></div><?php if (isset($_GET['saved'])): ?><div class="notice success">✓ Cambios guardados correctamente.</div><?php endif; ?></div><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><?php foreach ($fields as $group => $items): ?><section class="editor-card"><h2><?= e($group) ?></h2><div class="field-grid"><?php foreach ($items as $key => $label): ?><label><?= e($label) ?><?php $multi = str_contains($key, 'title') || str_contains($key, 'text') || str_contains($key, 'description'); ?><?php if ($multi): ?><textarea name="content[<?= e($key) ?>]" rows="<?= str_contains($key, 'title') ? 3 : 4 ?>"><?= e($content[$key]) ?></textarea><?php else: ?><input name="content[<?= e($key) ?>]" value="<?= e($content[$key]) ?>"><?php endif; ?></label><?php endforeach; ?></div></section><?php endforeach; ?><div class="save-bar"><button type="submit">Guardar cambios</button><span>Tip: usa Enter para separar líneas en los títulos.</span></div></form></main></body></html>
