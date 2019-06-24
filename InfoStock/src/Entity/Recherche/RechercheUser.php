<?php 
namespace App\Entity\Recherche;


class RechercheUser{

    /**
    * @var string|null
    */
    private $email;




/**
 *@return string|null
*/
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
    *@param string|null $titre
    *@return RechercheUser
    */
    public function setEmail(string $email): RechercheEmail
    {
        $this->titre = $email;
        return $this;
    }



}
