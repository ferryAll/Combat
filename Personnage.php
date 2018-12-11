<?php
class Personnage 
{
    private $_id ;
    private $_degats;
    private $_nom;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function frapper ( Personnage $perso ) {
        if ($perso->id() == $this->_id){
            return self::CEST_MOI;
        }
        // Avant tout ne pas se frapper soi-même.
        // Si c'est le cas, on stopppe tout en renvoyant une valeur signifiant que le personnage ciblé est le personnage qui attaque.
        // On indique au personnage frappé qu'il doit recevoir des dégats.
        return $perso->recevoirDegats();
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function recevoirDegats() {
        // on augmente de 5 les dégats
        if ($this->_degats >=100)
        {
            return self::PERSONNAGE_TUE;
        }
        // Si on a 100 de dégats ou plus, la méthode renverra une valeur signifiant que le personnage à été tué.
        return self::PERSONNAGE_FRAPPE;
        // Sinon, elle renverra une valeur signifiant que le personnage a été bien frappé.
    }

    public function degats() {
        return $this->_degats;
    }
    
    public function id() {
        return $this->_id;
    }

    public function nom() {
        return $this->_nom;
    }

    public function setDegats($degats) {
        $degats = (int) $degats;

        if ($degats >=0 && $degats <= 100)
        {
            $this->_degats = $degats;
        }
    }

    public function setId($id)
    {
        if (is_string($nom))
        {
            $this->_nom = $nom;
        }
    }
}

