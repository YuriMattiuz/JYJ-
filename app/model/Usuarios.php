<?php

class Usuarios extends TRecord
{
    const TABLENAME  = 'usuarios';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('user');
        parent::addAttribute('senha');
        parent::addAttribute('acesso');
        parent::addAttribute('rg');
            
    }

    /**
     * Method getFuncionarioss
     */
    public function getFuncionarioss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('usuarios_id', '=', $this->id));
        return Funcionarios::getObjects( $criteria );
    }

    public function set_funcionarios_usuarios_to_string($funcionarios_usuarios_to_string)
    {
        if(is_array($funcionarios_usuarios_to_string))
        {
            $values = Usuarios::where('id', 'in', $funcionarios_usuarios_to_string)->getIndexedArray('id', 'id');
            $this->funcionarios_usuarios_to_string = implode(', ', $values);
        }
        else
        {
            $this->funcionarios_usuarios_to_string = $funcionarios_usuarios_to_string;
        }

        $this->vdata['funcionarios_usuarios_to_string'] = $this->funcionarios_usuarios_to_string;
    }

    public function get_funcionarios_usuarios_to_string()
    {
        if(!empty($this->funcionarios_usuarios_to_string))
        {
            return $this->funcionarios_usuarios_to_string;
        }
    
        $values = Funcionarios::where('usuarios_id', '=', $this->id)->getIndexedArray('usuarios_id','{usuarios->id}');
        return implode(', ', $values);
    }

    
}

