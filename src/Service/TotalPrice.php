<?php


namespace App\Service;


class TotalPrice
{
    public function TotalPrice($spectacles, $nbEnfant, $nbAdult) {
        $totalPrice = 0;
        foreach ($spectacles as $spectacle ){
            $tarifEnfantSemaine = $spectacle->getTarifEnfantSemaine();
            $tarifEnfantWe = $spectacle->getTarifEnfantWE();
            $tarifAdultSemaine = $spectacle->getTarifAdultSemaine();
            $tarifAdultWe = $spectacle->getTarifAdultWE();
            $dateSpectacle = $spectacle->getDate();


            $jour = $dateSpectacle->format('l');


            if ($jour == 'Sunday' || $jour == 'Saturday' ) {
                //Prix WE
                $totalPrice += $tarifEnfantWe * $nbEnfant + $tarifAdultWe * $nbAdult;

            } else {
                // Prix Semaine
                $totalPrice += $tarifEnfantSemaine * $nbEnfant + $tarifAdultSemaine * $nbAdult;
            }
        }
        return $totalPrice;
    }

}