<?php

class Salas extends TRecord
{
    const TABLENAME  = 'salas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('status');
        parent::addAttribute('filme');
            
    }

    /**
     * Method getPoltronass
     */
    public function getPoltronass()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('salas_id', '=', $this->id));
        return Poltronas::getObjects( $criteria );
    }
    /**
     * Method getFilmess
     */
    public function getFilmess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('salas_id', '=', $this->id));
        return Filmes::getObjects( $criteria );
    }

    public function set_poltronas_salas_to_string($poltronas_salas_to_string)
    {
        if(is_array($poltronas_salas_to_string))
        {
            $values = Salas::where('id', 'in', $poltronas_salas_to_string)->getIndexedArray('id', 'id');
            $this->poltronas_salas_to_string = implode(', ', $values);
        }
        else
        {
            $this->poltronas_salas_to_string = $poltronas_salas_to_string;
        }

        $this->vdata['poltronas_salas_to_string'] = $this->poltronas_salas_to_string;
    }

    public function get_poltronas_salas_to_string()
    {
        if(!empty($this->poltronas_salas_to_string))
        {
            return $this->poltronas_salas_to_string;
        }
    
        $values = Poltronas::where('salas_id', '=', $this->id)->getIndexedArray('salas_id','{salas->id}');
        return implode(', ', $values);
    }

    public function set_filmes_salas_to_string($filmes_salas_to_string)
    {
        if(is_array($filmes_salas_to_string))
        {
            $values = Salas::where('id', 'in', $filmes_salas_to_string)->getIndexedArray('id', 'id');
            $this->filmes_salas_to_string = implode(', ', $values);
        }
        else
        {
            $this->filmes_salas_to_string = $filmes_salas_to_string;
        }

        $this->vdata['filmes_salas_to_string'] = $this->filmes_salas_to_string;
    }

    public function get_filmes_salas_to_string()
    {
        if(!empty($this->filmes_salas_to_string))
        {
            return $this->filmes_salas_to_string;
        }
    
        $values = Filmes::where('salas_id', '=', $this->id)->getIndexedArray('salas_id','{salas->id}');
        return implode(', ', $values);
    }

    
}

