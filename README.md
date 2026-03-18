# CRM Prospection : Prospect-tracker

Application de gestion de prospects développée en fullstack, dans le cadre de mon activité [KINOKO WEB SOLUTIONS](https://kinoko-websolutions.).

## Stack technique

| Couche | Techno |
|--------|--------|
| Backend | PHP / Symfony |
| API | REST (JSON) |
| Frontend | React |
| Base de données | SQL |
| Versioning | Git |

## Fonctionnalités

- Liste des prospects avec statuts imbriqués (données relationnelles exposées en JSON)
- Gestion des champs optionnels (téléphone, notes, potentiel...)
- Suivi du cycle de prospection par statut (`Identifié`, `Approché`, `Proposition envoyée`...)

## Architecture

Le projet suit une architecture **découplée** :

- Le backend Symfony expose une **API REST** indépendante
- Le frontend React **consomme l'API** via des appels HTTP
- Aucun couplage entre les deux couches

```
React (frontend)
      ↓ HTTP / JSON
Symfony API REST (backend)
      ↓
Base de données SQL
```

## Endpoints API (exemples)

```
GET  /api/listes-des-prospects         → liste tous les prospects avec leur statut
GET  /api/prospects/{id}    → détail d'un prospect
POST /api/créer-un-nouveau-prospect         → créer un prospect
PUT  /api/modifier-un-prospect/{id}    → mettre à jour un prospect
```

## Statut du projet

🚧 En cours de développement

## Contexte

Projet personnel développé pour répondre à un besoin concret : gérer ma propre activité de prospection commerciale. L'objectif est de construire un outil simple, fonctionnel et maintenable — sans over-engineering.
