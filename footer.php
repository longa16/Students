<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<h1></h1>
<style>
    .site-footer {
        background-color: #222;
        color: #fff;
        padding: 40px 20px;
    }

    .site-footer .container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .footer-columns {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .footer-column {
        flex: 1 1 calc(25% - 20px); /* Flexible grid */
        min-width: 200px;
    }

    .footer-column h3 {
        font-size: 1.2rem;
        margin-bottom: 15px;
        color: #f1c40f;
    }

    .footer-column p,
    .footer-column ul {
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }

    .footer-links,
    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li,
    .footer-contact li {
        margin-bottom: 10px;
    }

    .footer-links a,
    .footer-contact a {
        text-decoration: none;
        color: #fff;
        transition: color 0.3s ease;
    }

    .footer-links a:hover,
    .footer-contact a:hover {
        color: #f1c40f;
    }

    .social-icons a {
        display: inline-block;
        font-size: 1.2rem;
        margin-right: 10px;
        color: #fff;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icons a:hover {
        color: #f1c40f;
        transform: scale(1.1);
    }

    .footer-bottom {
        text-align: center;
        border-top: 1px solid #444;
        padding-top: 20px;
        font-size: 0.8rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-columns {
            flex-direction: column;
            gap: 40px;
        }
    }

</style>
<footer class="site-footer">
    <div class="container">
        <div class="footer-columns">
            <!-- Section: About -->
            <div class="footer-column">
                <h3>À propos</h3>
                <p>Nous sommes une entreprise dédiée à fournir des solutions innovantes pour tous vos besoins numériques.</p>
            </div>

            <!-- Section: Quick Links -->
            <div class="footer-column">
                <h3>Liens rapides</h3>
                <ul class="footer-links">
                    <li><a href="/about">À propos</a></li>
                    <li><a href="/services">Services</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/privacy-policy">Politique de confidentialité</a></li>
                </ul>
            </div>

            <!-- Section: Contact -->
            <div class="footer-column">
                <h3>Contact</h3>
                <ul class="footer-contact">
                    <li><span>📍</span> 123 Rue Principale, Paris, France</li>
                    <li><span>📞</span> <a href="tel:+33123456789">+33 1 23 45 67 89</a></li>
                    <li><span>✉️</span> <a href="mailto:info@exemple.com">info@exemple.com</a></li>
                </ul>
            </div>

            <!-- Section: Social Media -->
            <div class="footer-column">
                <h3>Suivez-nous</h3>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 longa16. Tous droits réservés.</p>
        </div>
    </div>
</footer>
</body>
</html>

