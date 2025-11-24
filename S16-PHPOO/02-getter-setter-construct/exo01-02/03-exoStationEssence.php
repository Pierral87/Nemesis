<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
                -- Le but étant ici de réussir à développer la méthode donnerEssence, en gros, lorsqu'un véhicule passe à la station, il fait le plein si c'est possible, cela induit forcément des opérations pour le Vehicule et pour la Pompe 
                -- On considère que dans notre système, une voiture possède un stock max de 50 litres
                    -- On considère aussi que lorsqu'elle passe à la pompe à essence, elle met automatiquement le plein d'essence (si c'est possible)
                        -- Il va falloir gérer les exceptions de notre système

    */