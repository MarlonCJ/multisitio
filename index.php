<?php
declare(strict_types=1);

$year = date('Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PULSODIGITALWEB: estrategia, diseño y desarrollo web para impulsar negocios.">
    <title>PULSODIGITALWEB | Soluciones digitales que conectan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="site-header" id="inicio">
        <nav class="nav container" aria-label="Navegación principal">
            <a class="brand" href="#inicio" aria-label="Pulsodigitalweb, inicio">
                <span class="brand-mark" aria-hidden="true"><i></i><i></i><i></i></span>
                PULSO<span>DIGITAL</span>WEB
            </a>
            <button class="menu-toggle" type="button" aria-label="Abrir menú" aria-expanded="false">☰</button>
            <div class="nav-links">
                <a href="#servicios">Servicios</a>
                <a href="#proceso">Proceso</a>
                <a href="#nosotros">Nosotros</a>
                <a class="button button-small" href="#contacto">Hablemos <span>↗</span></a>
            </div>
        </nav>

        <section class="hero container">
            <div class="hero-copy">
                <p class="eyebrow"><span></span> Agencia digital con propósito</p>
                <h1>Tu marca no necesita<br>más ruido. Necesita <em>pulso.</em></h1>
                <p class="hero-text">Transformamos ideas ambiciosas en experiencias digitales que atraen, conectan y convierten.</p>
                <div class="hero-actions">
                    <a class="button" href="#contacto">Impulsa tu proyecto <span>↗</span></a>
                    <a class="text-link" href="#servicios">Conoce nuestros servicios <b>↓</b></a>
                </div>
            </div>
            <div class="hero-visual" aria-label="Visualización abstracta de conexión digital">
                <div class="orb orb-one"></div><div class="orb orb-two"></div>
                <div class="pulse-card"><span>CONEXIÓN</span><strong>01</strong><div class="pulse-line"><i></i><i></i><i></i><i></i><i></i></div></div>
                <div class="visual-ring ring-one"></div><div class="visual-ring ring-two"></div>
                <div class="signal signal-a"></div><div class="signal signal-b"></div><div class="signal signal-c"></div>
            </div>
        </section>
        <div class="trusted container"><span>CONFIAN EN EL IMPULSO DIGITAL</span><div>IDEA<span>LAB</span></div><div>NEXA</div><div>ORBITA</div><div>VERDE<span>VIVO</span></div></div>
    </header>

    <main>
        <section class="services section container" id="servicios">
            <div class="section-heading"><p class="eyebrow"><span></span> Lo que hacemos</p><h2>Hacemos que lo digital<br>trabaje para tu negocio.</h2></div>
            <div class="service-grid">
                <article class="service-card featured"><span class="number">01</span><div class="service-icon">✦</div><h3>Estrategia<br>Digital</h3><p>Definimos el rumbo para que cada acción tenga un propósito y un resultado medible.</p><a href="#contacto" aria-label="Consultar estrategia digital">↗</a></article>
                <article class="service-card"><span class="number">02</span><div class="service-icon">◌</div><h3>Branding &<br>Diseño</h3><p>Construimos identidades memorables que hablan el idioma de tu audiencia.</p><a href="#contacto" aria-label="Consultar branding y diseño">↗</a></article>
                <article class="service-card"><span class="number">03</span><div class="service-icon">⌘</div><h3>Desarrollo<br>Web</h3><p>Creamos sitios rápidos, intuitivos y preparados para crecer con tu negocio.</p><a href="#contacto" aria-label="Consultar desarrollo web">↗</a></article>
            </div>
        </section>

        <section class="statement" id="nosotros"><div class="container"><p class="eyebrow light"><span></span> Nuestra filosofía</p><h2>No seguimos tendencias.<br><em>Creamos relevancia.</em></h2><p>Combinamos pensamiento estratégico, diseño humano y tecnología para construir marcas que dejan huella.</p></div></section>

        <section class="process section container" id="proceso">
            <div class="section-heading"><p class="eyebrow"><span></span> Nuestra manera de trabajar</p><h2>Una ruta clara hacia<br>grandes resultados.</h2></div>
            <div class="steps"><article><b>01</b><h3>Escuchamos</h3><p>Entendemos tu negocio, tus retos y a las personas que quieres alcanzar.</p></article><article><b>02</b><h3>Diseñamos</h3><p>Convertimos los hallazgos en una propuesta estratégica y visual única.</p></article><article><b>03</b><h3>Activamos</h3><p>Llevamos la idea a la realidad y medimos el impacto para seguir mejorando.</p></article></div>
        </section>

        <section class="contact" id="contacto"><div class="container contact-inner"><div><p class="eyebrow light"><span></span> Empecemos</p><h2>Tu próximo gran paso<br>empieza <em>aquí.</em></h2></div><form class="contact-form" action="#contacto" method="post"><label>Tu nombre<input type="text" name="nombre" placeholder="¿Cómo te llamas?" required></label><label>Tu correo<input type="email" name="correo" placeholder="tu@correo.com" required></label><label>Cuéntanos tu idea<textarea name="mensaje" rows="3" placeholder="Tengo un proyecto en mente..."></textarea></label><button class="button" type="submit">Enviar mensaje <span>↗</span></button></form></div></section>
    </main>

    <footer><div class="container footer-content"><a class="brand" href="#inicio"><span class="brand-mark" aria-hidden="true"><i></i><i></i><i></i></span>PULSO<span>DIGITAL</span>WEB</a><p>© <?= htmlspecialchars($year, ENT_QUOTES, 'UTF-8') ?> PULSODIGITALWEB. Hecho con intención.</p><div class="socials"><a href="#inicio">Instagram</a><a href="#inicio">LinkedIn</a></div></div></footer>
    <script src="assets/js/main.js"></script>
</body>
</html>
