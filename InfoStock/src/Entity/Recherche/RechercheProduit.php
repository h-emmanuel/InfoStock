<?php 
namespace App\Entity\Recherche;


class RechercheProduit{

    /**
    * @var string|null
    */
    private $titre;




/**
 *@return string|null
*/
    public function getTitre(): ?string
    {
        return $this->titre;
    }
    
    /**
    *@param string|null $titre
    *@return RechercheProduit
    */
    public function setTitre(string $titre): RechercheProduit
    {
        $this->titre = $titre;
        return $this;
    }



}
