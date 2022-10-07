<?php

class Filmes extends TRecord
{
    const TABLENAME  = 'filmes';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $salas;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('titulo');
        parent::addAttribute('genero');
        parent::addAttribute('classificacao');
        parent::addAttribute('horario');
        parent::addAttribute('sala');
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

    /**
     * Method getVendass
     */
    public function getVendass()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('filmes_id', '=', $this->id));
        return Vendas::getObjects( $criteria );
    }

    public function set_vendas_filmes_to_string($vendas_filmes_to_string)
    {
        if(is_array($vendas_filmes_to_string))
        {
            $values = Filmes::where('id', 'in', $vendas_filmes_to_string)->getIndexedArray('id', 'id');
            $this->vendas_filmes_to_string = implode(', ', $values);
        }
        else
        {
            $this->vendas_filmes_to_string = $vendas_filmes_to_string;
        }

        $this->vdata['vendas_filmes_to_string'] = $this->vendas_filmes_to_string;
    }

    public function get_vendas_filmes_to_string()
    {
        if(!empty($this->vendas_filmes_to_string))
        {
            return $this->vendas_filmes_to_string;
        }
    
        $values = Vendas::where('filmes_id', '=', $this->id)->getIndexedArray('filmes_id','{filmes->id}');
        return implode(', ', $values);
    }

    
}

