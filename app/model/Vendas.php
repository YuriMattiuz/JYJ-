<?php

class Vendas extends TRecord
{
    const TABLENAME  = 'vendas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $filmes;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('filme');
        parent::addAttribute('sessao');
        parent::addAttribute('sala');
        parent::addAttribute('poltrona');
        parent::addAttribute('ingresso');
        parent::addAttribute('filmes_id');
            
    }

    /**
     * Method set_filmes
     * Sample of usage: $var->filmes = $object;
     * @param $object Instance of Filmes
     */
    public function set_filmes(Filmes $object)
    {
        $this->filmes = $object;
        $this->filmes_id = $object->id;
    }

    /**
     * Method get_filmes
     * Sample of usage: $var->filmes->attribute;
     * @returns Filmes instance
     */
    public function get_filmes()
    {
    
        // loads the associated object
        if (empty($this->filmes))
            $this->filmes = new Filmes($this->filmes_id);
    
        // returns the associated object
        return $this->filmes;
    }

    
}

