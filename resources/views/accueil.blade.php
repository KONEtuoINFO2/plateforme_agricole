@extends('layouts.app')

@section('content')

<!--SECTION ACCUEIL -->
<section id="accueil" class="hero-section d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- 📝 Texte à gauche -->
            <div class="col-md-6 text-white" data-aos="fade-right">
                <h1 class="fw-bold mb-4">Je vends ma récolte avec <span class="fw-bold">ETS MALICKA</span></h1>
                <p class="lead mb-4">
                    La plateforme digitale qui connecte les producteurs agricoles ivoiriens à <strong>ETS MALICKA</strong>.<br>
                    Simplifiez vos ventes, sécurisez vos paiements et valorisez vos récoltes.
                </p>
                <a href="#services" class="btn btn-light btn-lg mt-2">Découvrir</a>
            </div>

            <!-- 🌾 Image à droite -->
            <div class="col-md-6 text-center" data-aos="fade-left">
                <img src="{{ asset('images/accueil-fond.jpg') }}" alt="Producteur agricole" class="img-fluid hero-image rounded shadow-lg">
            </div>
        </div>
    </div>
</section>
<!-- 🌿 SECTION A PROPOS -->
<section id="apropos" class="about-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">À propos d’ETS MALICKA</h2>
            <p class="section-subtitle">ETS MALICKA, votre partenaire de confiance</p>
        </div>

        <div class="row align-items-start">
            <!-- Mission -->
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <h3 class="text-success fw-bold mb-3">Notre Mission</h3>
                <p>
                    ETS MALICKA est une entreprise ivoirienne dédiée à l’achat et à la 
                    commercialisation de produits vivriers à travers toute la Côte d’Ivoire.
                    Nous œuvrons à bâtir une chaîne d’approvisionnement transparente, équitable
                    et durable au profit de tous les producteurs agricoles.
                </p>
                <ul class="list-unstyled mt-3">
                    <li>✔️ Paiements sécurisés et transparents</li>
                    <li>✔️ Collecte organisée et efficace</li>
                    <li>✔️ Accompagnement technique des producteurs</li>
                </ul>
            </div>

            <!-- Vision -->
            <div class="col-md-6" data-aos="fade-left">
                <h3 class="text-success fw-bold mb-3">Notre Vision</h3>
                <p>
                    Notre plateforme digitale <strong>"Je vends ma récolte"</strong> révolutionne la 
                    manière dont les producteurs interagissent avec nous.
                    Plus besoin de déplacements inutiles : tout est simplifié, sécurisé et accessible.
                </p>
                <p>
                    Grâce à une interface intuitive, même sur mobile, les producteurs peuvent
                    déclarer leurs récoltes, suivre leurs paiements en temps réel et choisir
                    le mode de vente qui leur convient le mieux.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- 🌿 SECTION SERVICES -->
<section id="services" class="services-section py-5">
    <div class="container text-center">
        <h2 class="section-title mb-3">Nos Services</h2>
        <p class="section-subtitle mb-5">Deux modes de vente adaptés à vos besoins</p>

        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card p-4">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-cash-coin fs-1"></i>
                    </div>
                    <h4 class="text-success fw-bold mb-3">Vente Cash Bord Champ</h4>
                    <p>
                        Déclarez votre récolte et recevez votre paiement immédiatement lors de la collecte sur votre exploitation.
                        Transparence et rapidité garanties.
                    </p>
                    <ul class="list-unstyled text-start d-inline-block mt-3">
                        <li>✔️ Paiement immédiat</li>
                        <li>✔️ Prix fixé à l’avance</li>
                        <li>✔️ Collecte sur exploitation</li>
                    </ul>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card p-4">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-building fs-1"></i>
                    </div>
                    <h4 class="text-success fw-bold mb-3">Dépôt-Vente</h4>
                    <p>
                        Nous prenons en charge votre récolte, la stockons et la vendons pour vous.
                        Vous recevez le paiement après la vente, optimisant ainsi votre revenu.
                    </p>
                    <ul class="list-unstyled text-start d-inline-block mt-3">
                        <li>✔️ Stockage sécurisé</li>
                        <li>✔️ Vente optimisée</li>
                        <li>✔️ Suivi transparent</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="processus" class="processus-section">
  <div class="container">
    <h2 class="section-title">Comment ça marche</h2>
    <p class="section-subtitle">Un processus simple en 3 étapes</p>

    <div class="steps">
      <div class="step">
        <div class="step-number">01</div>
        <h3>Déclaration de récolte</h3>
        <p>
          Connectez-vous avec votre numéro de téléphone et déclarez votre récolte :
          type de produit, quantité, localisation et mode de vente souhaité.
        </p>
        <ul>
          <li>✅ Interface simple</li>
          <li>✅ Géolocalisation</li>
        </ul>
      </div>

      <div class="step">
        <div class="step-number">02</div>
        <h3>Validation & Collecte</h3>
        <p>
          Notre équipe valide votre déclaration, fixe le prix et planifie la collecte.
          Vous recevez une notification avec tous les détails.
        </p>
        <ul>
          <li>✅ Prix transparents</li>
          <li>✅ Planning optimisé</li>
        </ul>
      </div>

      <div class="step">
        <div class="step-number">03</div>
        <h3>Paiement & Suivi</h3>
        <p>
          Recevez votre paiement selon le mode choisi (immédiat ou après vente)
          et suivez l’historique de toutes vos transactions.
        </p>
        <ul>
          <li>✅ Paiement sécurisé</li>
          <li>✅ Historique complet</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- SECTION : Pourquoi choisir notre plateforme -->
  <div class="why-choose">
    <h2>Pourquoi choisir notre plateforme</h2>
    <div class="why-grid">
      <div class="why-card">
        <div class="icon">🛡️</div>
        <h3>Sécurité</h3>
        <p>Paiements garantis et transactions sécurisées</p>
      </div>
      <div class="why-card">
        <div class="icon">⏱️</div>
        <h3>Rapidité</h3>
        <p>Processus optimisé de la déclaration au paiement</p>
      </div>
      <div class="why-card">
        <div class="icon">👁️</div>
        <h3>Transparence</h3>
        <p>Suivi en temps réel de toutes vos transactions</p>
      </div>
      <div class="why-card">
        <div class="icon">🎧</div>
        <h3>Support</h3>
        <p>Accompagnement personnalisé et support technique</p>
      </div>
    </div>
  </div>

  <!-- SECTION : Prêt à moderniser vos ventes agricoles ? -->
  <div class="cta">
    <h2>Prêt à moderniser vos ventes agricoles ?</h2>
    <p>
      Rejoignez dès maintenant la communauté des producteurs qui ont choisi la
      simplicité et la sécurité avec ETS MALICKA.<br />
      L’application sera bientôt disponible.
    </p>
    <a href="#contact" class="btn-orange">📩 Nous contacter</a>
  </div>
</section>



<section id="contact" class="contact-section py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="section-title text-center mb-3">Contactez-nous</h2>
        <p class="text-center section-subtitle mb-5">Notre équipe est là pour vous accompagner</p>

        <div class="row g-4">
            <!-- Bloc gauche -->
            <div class="col-lg-5">
                <div class="contact-info p-4 shadow-sm rounded bg-light">
                    <h5 class="mb-3 text-success fw-bold">Adresse</h5>
                    <p>Abidjan, Côte d'Ivoire<br>Adjamé Gare UTB</p>

                    <h5 class="mt-4 mb-3 text-success fw-bold">Téléphone</h5>
                    <p>
                        <a href="tel:+2250758643112">+225 07 58 64 31 12</a><br>
                        <a href="tel:+2250585024949">+225 05 85 02 49 49</a>
                    </p>

                    <h5 class="mt-4 mb-3 text-success fw-bold">Email</h5>
                    <p>
                        <a href="mailto:etsmalicka@gmail.com">etsmalicka@gmail.com</a>
                    </p>

                    <h5 class="mt-4 mb-3 text-success fw-bold">Horaires</h5>
                    <p>Lun - Ven : 8h00 - 17h30<br>Sam : 8h00 - 12h00</p>

                    <div class="map mt-4">
                        <iframe 
                            src="https://www.google.com/maps?q=Adjamé%20Gare%20UTB%20Abidjan&output=embed"
                            width="100%" height="200" style="border:0;" allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Bloc droite (Formulaire) -->
            <div class="col-lg-7">
                <form class="contact-form p-4 shadow-sm rounded bg-white" method="POST" action="#">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="nom" class="form-control" placeholder="Votre Nom" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Votre Email" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="telephone" class="form-control" placeholder="Votre Téléphone" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="sujet" class="form-control" placeholder="Sujet" required>
                        </div>
                        <div class="col-12">
                            <textarea name="message" rows="5" class="form-control" placeholder="Votre Message" required></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-send"></i> Envoyer le message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="footer mt-5">
    <div class="container py-5">
        <div class="row gy-4">
            <!-- Colonne 1 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">ETS MALICKA</h5>
                <p class="text-light small">
                    Votre partenaire de confiance pour la commercialisation et la distribution de produits agricoles en Côte d’Ivoire.
                </p>
                <div class="social-links mt-3">
                    <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                </div>
            </div>

            <!-- Colonne 2 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Liens Utiles</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#apropos">À propos</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <!-- Colonne 3 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Nos Services</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="#">Vente Cash</a></li>
                    <li><a href="#">Dépôt-Vente</a></li>
                    <li><a href="#">Support Technique</a></li>
                    <li><a href="#">Formation</a></li>
                </ul>
            </div>

            <!-- Colonne 4 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Newsletter</h5>
                <p class="text-light small">
                    Restez informés des nouveautés et des opportunités du secteur agricole.
                </p>
                <form class="newsletter-form mt-3">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Votre email" required>
                        <button class="btn btn-warning" type="submit">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
@endsection
