# Commandes

L'application comporte 3 commandes qui couvrent les fonctionnalités requises.

## Création d'une flotte

Cette commande permet la création d'une flotte de véhicules pour un usager.

`php bin/app app:fleet:register <userId>`

userId : identifiant unique de l'usager

## Ajout d'un véhicule à une flotte

Cette commande permet de rattracher un véhicule à une flotte. Un véhicule peut être rattaché à plusieurs flottes.

`php bin/app app:vehicle:register <fleetId> <vehiclePlate>`

- fleetId : identifiant unique de la flotte de véhicule d'un usager
- vehiclePlate : plaque d'immatriculation d'un véhicule

## Localisation d'un véhicule

Cette commande permet d'associer une position géographique à un véhicule. La position doit être différente de celle actuelle.

`php bin/app app:vehicle:localize <vehiclePlate> <lat> <lng>`

- vehiclePlate : plaque d'immatriculation d'un véhicule
- lat : latitude de la position du véhicule
- lng : longitude de la position du véhicule
