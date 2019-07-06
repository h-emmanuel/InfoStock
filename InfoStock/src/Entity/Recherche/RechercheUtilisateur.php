<?php 
namespace App\Entity\Recherche;


class RechercheUtilisateur{

    /**
    * @var string|null
    */
    private $nom;




/**
 *@return string|null
*/
    public function getNom(): ?string
    {
        return $this->nom;
    }
    
    /**
    *@param string|null $nom
    *@return RechercheUtilisateur
    */
    public function setNom(string $nom): RechercheUtilisateur
    {
        $this->nom = $nom;
        return $this;
    }



}
