# 🌿 Plateforme Agricole – Laravel + Vite

Ce projet est une application web moderne construite avec **Laravel 10** et **Vite**. Il permet la gestion de produits agricoles, avec une interface dynamique et responsive.

---

## 🚀 Fonctionnalités

- Ajout, modification et suppression de produits
- Affichage des produits avec images
- Intégration de Vite pour les assets front-end
- Connexion à une base de données MySQL
- Déploiement du front-end sur Netlify

---

## 🧱 Technologies utilisées

- Laravel 10 (PHP)
- Vite (JS/CSS bundler)
- Tailwind CSS (optionnel)
- MySQL
- Netlify (déploiement front-end)

---

## 📦 Installation locale

```bash
git clone https://github.com/ton-utilisateur/monprojet.git
cd monprojet
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev