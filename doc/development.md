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
