<div class="contacto">
    <div class="hero">
        <h1>Contáctanos</h1>
        <p>¿Tienes alguna pregunta, sugerencia o necesitas ayuda? Estamos aquí para ayudarte. No dudes en ponerte en contacto con nosotros.</p>
    </div>

    <?php if (isset($_SESSION['error_contacto'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error_contacto']) ?>
            <?php unset($_SESSION['error_contacto']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['contacto_enviado']) || isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <strong>¡Mensaje enviado exitosamente!</strong>
            <?php if (isset($_SESSION['contacto_nombre'])): ?>
                Gracias <?= htmlspecialchars($_SESSION['contacto_nombre']) ?>, nos pondremos en contacto contigo pronto.
            <?php else: ?>
                Gracias por contactarnos, nos pondremos en contacto contigo pronto.
            <?php endif; ?>
            <?php 
            unset($_SESSION['contacto_enviado']); 
            unset($_SESSION['contacto_nombre']);
            ?>
        </div>
    <?php endif; ?>

    <div class="contact-container">
        <div class="contact-info">
            <div class="info-card">
                <h3>Ubicación</h3>
                <p>Av. Principal 123<br>Ciudad, País<br>Código Postal 12345</p>
            </div>

            <div class="info-card">
                <h3>Email</h3>
                <p>
                    <a href="mailto:info@anipro.com">info@anipro.com</a><br>
                    <a href="mailto:soporte@anipro.com">soporte@anipro.com</a>
                </p>
            </div>

            <div class="info-card">
                <h3>Teléfono</h3>
                <p>
                    <a href="tel:+1234567890">+1 (234) 567-890</a><br>
                    Lunes a Viernes: 9:00 AM - 6:00 PM
                </p>
            </div>

            <div class="info-card">
                <h3>Horario de Atención</h3>
                <p>
                    Lunes - Viernes: 9:00 AM - 6:00 PM<br>
                    Sábados: 10:00 AM - 4:00 PM<br>
                    Domingos: Cerrado
                </p>
            </div>
        </div>

        <div class="contact-form-container">
            <h2>Envíanos un Mensaje</h2>
            <form action="./controllers/procesar_contacto.php" method="POST" id="contactForm">
                <div class="form-group">
                    <label for="nombre">Nombre completo *</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>
                </div>

                <div class="form-group">
                    <label for="asunto">Asunto *</label>
                    <input type="text" id="asunto" name="asunto" placeholder="Resume en pocas palabras tu asunto" required>
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje *</label>
                    <textarea id="mensaje" name="mensaje" placeholder="Escribí tu mensaje..." required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button primary">Enviar Mensaje</button>
                    <button type="reset" class="button secondary">Limpiar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="social-links">
        <a href="#" class="social-link" title="Facebook">
            <img src="./public/assets/icons/social/facebook.png" alt="Facebook">
        </a>
        <a href="#" class="social-link" title="Twitter">
            <img src="./public/assets/icons/social/twitter.png" alt="Twitter">
        </a>
        <a href="#" class="social-link" title="Instagram">
            <img src="./public/assets/icons/social/instagram.png" alt="Instagram">
        </a>
        <a href="#" class="social-link" title="YouTube">
            <img src="./public/assets/icons/social/youtube.png" alt="YouTube">
        </a>
        <a href="#" class="social-link" title="Discord">
            <img src="./public/assets/icons/social/discord.png" alt="Discord">
        </a>
    </div>

    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.1234567890123!2d-99.12345678901234!3d19.432345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDI1JzU2LjQiTiA5OcKwMDcnMjQuNCJX!5e0!3m2!1ses!2smx!4v1234567890123!5m2!1ses!2smx" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>