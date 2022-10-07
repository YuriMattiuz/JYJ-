<?php

class Poltronas extends TRecord
{
    const TABLENAME  = 'poltronas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $salas;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('salas');
        parent::addAttribute('poltrona1');
        parent::addAttribute('poltrona2');
        parent::addAttribute('poltrona4');
        parent::addAttribute('poltrona5');
        parent::addAttribute('poltrona6');
        parent::addAttribute('poltrona7');
        parent::addAttribute('poltron8');
        parent::addAttribute('poltrona9');
        parent::addAttribute('poltrona10');
        parent::addAttribute('poltrona11');
        parent::addAttribute('poltrona12');
        parent::addAttribute('poltrona13');
        parent::addAttribute('poltrona14');
        parent::addAttribute('poltrona15');
        parent::addAttribute('poltrona16');
        parent::addAttribute('poltrona17');
        parent::addAttribute('poltrona18');
        parent::addAttribute('poltrona19');
        parent::addAttribute('poltrona20');
        parent::addAttribute('column_22');
        parent::addAttribute('poltrona21');
        parent::addAttribute('poltrona23');
        parent::addAttribute('poltrona24');
        parent::addAttribute('poltrona25');
        parent::addAttribute('poltrona26');
        parent::addAttribute('poltrona27');
        parent::addAttribute('poltrona28');
        parent::addAttribute('poltrona29');
        parent::addAttribute('poltrona30');
        parent::addAttribute('salas_id');
            
    }

    /**
     * Method set_salas
     * Sample of usage: $var->salas = $object;
     * @param $object Instance of Salas
     */
    public function set_salas(Salas $object)
    {
        $this->salas = $object;
        $this->salas_id = $object->id;
    }

    /**
     * Method get_salas
     * Sample of usage: $var->salas->attribute;
     * @returns Salas instance
     */
    public function get_salas()
    {
    
        // loads the associated object
        if (empty($this->salas))
            $this->salas = new Salas($this->salas_id);
    
        // returns the associated object
        return $this->salas;
    }

    
}

