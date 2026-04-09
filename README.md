# 📄 Génération de fiches de paie

Application web développée avec **Laravel** pour la gestion des employés et la génération automatique des fiches de paie au format PDF.

## ✨ Fonctionnalités

- **Gestion des employés** : ajout, modification, suppression
- **Calcul automatique** des salaires et cotisations sociales
- **Export PDF** des fiches de paie
- **Dashboard RH** : indicateurs clés (nombre d'employés, total salaires, etc.)
- **Recherche et filtres** par employé ou période

## 🛠️ Technologies utilisées

| Catégorie | Technologies |
|-----------|--------------|
| Backend | Laravel 10, PHP 8.1+ |
| Base de données | MySQL |
| Frontend | Bootstrap 5|
| PDF | DomPDF |
| Versionnement | Git & GitHub |

## 🚀 Installation

### Prérequis
- PHP ≥ 8.1
- Composer
- MySQL


### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/DevAnjaratiana/Generation-fiche-de-paie.git
cd Generation-fiche-de-paie

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JavaScript
npm install
npm run build

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé application
php artisan key:generate

# 6. Configurer la base de données dans .env
# DB_DATABASE=fiche_paie
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Exécuter les migrations
php artisan migrate

# 8. Lancer le serveur
php artisan serve

# 8. Lancer le serveur
php artisan serve
