---
author: Clément Szewczyk
date: 15/02/2024
title: Test Webreathe
---

# Test Webreathe : Clément Szewczyk

## Quelques informations sur le projet

Le projet a été réalisé sur Laragon avec MySQL 8.0.3 et PHP 8.3.1.


## Les étapes pour lancer le projet
1. Décompresser le fichier `Test_Clement_Szewczyk.zip`.
2. Déposer le projet dans le dossier `www` de Laragon.
3. Renommer le dossier `Test_Clement_Szewczyk` si besoin.
4. Créer une base de données MySQL avec le nom `webreath`.
5. Importer le fichier `webreath.sql` dans la base de données.
6. Modifier si besoin le fichier `bdd.php` qui se trouve dans le dossier `scripts` pour la connexion à la base de données.
7. Lancer le serveur avec Laragon.
8. Ouvrir un navigateur et taper `localhost/webreath` dans la barre d'adresse ou sur l'allias que vous avez choisi.

## La structure du projet

Le projet est composé de 3 dossiers principaux :
- `css` : qui contient les fichiers CSS.
- `script` : qui contient les scripts PHP et JS.
- `pages` : qui contient les pages PHP.

## La structure de la base de données

La base de données est composée de 3 tables :

- `modules` : qui contient les informations des modules.
- `user` : qui contient les informations des utilisateurs.
- `Historique` : qui contient l'historique des états des modules.

### La table `module`

| ID | Nom | description | Etat | valeur |
|----|-----------|------|------|------|
| 1  | Nom du Module | Description | 1 | Nome de la valeur |

### La table `user`

| ID | Login | MDP |
|----|--------|----------|
| 1  | Pseudo  | $2y$10$ |

### La table `Historique`

| ID | Module | Etat | date |
|----|-----------|------|------|
| 1  | Clef étrangère vers le module | 1    | 2024-02-15 00:00:00 |

### Table des modules

|id | valeur | date |
|---|--------|------|
| ID | Valeur de l'élément | Date d'ajout de l'élément |

## Les différentes pages

- **Index** : Page d'accueil qui affiche les modules avec quelques informations.
- **Ajout Module** : Page qui permet d'ajouter un module.
- **connexion** : Page de connexion.
- **inscription** : Page d'inscription.
- **historique** : Page qui affiche l'historique des état des modules.
- **navbar** : La barre de navigation qui est incluse dans toutes les pages.
- **visu Module** : Page qui affiche les informations d'un module.

## Les différents fonctionnalités

- **Ajout Module** : Permet d'ajouter un module à la bdd. 
    - Le module est ajouté dans une table qui stocke tous les modules existants et les informations associées (nom, description, état, date d'ajout, nom de la valeur).
    - Une table spécifique pour le module est créée pour stocker les valeurs du module.
- **Historique** : Permet de voir l'historique des états des modules.
- **add_element** : Permet d'ajouter un élément à la bdd.
    - Ajout d'un nombre aléatoire d'élément ave une valeur aléatoire dan la table du module.
    - Le script tourne toutes les 5 secondes grâce à un appel AJAX vers un script PHP (`add_element.php`).
    - Quand le module est en panne ou inactif, aucune valeur ne peut être ajoutée.
- **Recup_etat** : Permet de récupérer l'état du module.
    - L'état est récupéré toutes les 5 secondes grâce à un appel AJAX vers un script PHP (`recup_etat.php`).
    - L'état est stocké dans la table qui regroupe tous les modules.
    - Un état est généré aléatoirement toutes les 5 secondes avec un appel AJAX vers un script PHP (`etat.php`).
    - *Les Etats* : 
        - 0 : Inactif
        - 1 : Actif
        - 2 : En panne
    - Deux scripts JS (identiques) sont utilisés pour récupérer l'état et ajouter des éléments. Un pour l'index et un autre pour les pages dans le dossier pages.
- **Connexion \ Inscription** : Permet de se connecter ou de s'inscrire.
    - Les mots de passe sont hashés avec `password_hash` et vérifiés avec `password_verify`.
    - Lors de l'inscription une verification si le pseudo est déjà utilisé est effectuée.
    - Lors de la connexion, une vérification si le pseudo existe et si le mot de passe est correcte est effectuée.
    - Un utilisateur est créé par défaut lors de l'import de la bdd avec le pseudo `admin` et le mot de passe `admin`.


