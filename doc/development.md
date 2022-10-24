# Developpement

En l'absence d'interlocuteur, l'application a été développée sur la base de consignes écrites ([détail](/Backend/ddd-and-cqrs-intermediare-senior.md)).

Les choix suivants ont été effectués :
- Tests : Utilisation de PHPUnit pour les tests unitaires
  - Pas d'utilisation de behat car je ne maitrise pas l'outil
- Architecture : Utilisation d'une arborescence et d'un découpage familier basé sur le bon sens et des principes _clean code_
  - Pas d'utilisation de CQRS, c'est une architecture inconnue
- Usager : Pas de prise en compte de l'usager
  - L'usager est mentionné, mais non détaillé, dans les consignes : les détails fonctionnels sont manquants
- Localisation de véhicule : pas d'id de la flotte dans la commande relative
  - Un véhicule est unique, il ne peut pas être à plusieurs endroits à la fois.

## Qualité de code

Dans le cadre du maintien et de l'amélioration de la qualité du code applicatif, l'utilisation des outils suivants sont conseillés :
- Norme de coding style commune à l'équipe (PSR4, PSR12 à choisir)
- Conventions de nommages (langues pour le code, pour les commentaires, snake_case/camelCase ...)
- Outil d'inspection de code à automatiser (SonarQube) et à configurer
