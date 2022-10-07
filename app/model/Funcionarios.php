<?php

class Funcionarios extends TRecord
{
    const TABLENAME  = 'funcionarios';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $usuarios;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('rg');
        parent::addAttribute('entrada');
        parent::addAttribute('saida');
        parent::addAttribute('usuarios_id');
            
    }

    /**
     * Method set_usuarios
     * Sample of usage: $var->usuarios = $object;
     * @param $object Instance of Usuarios
     */
    public function set_usuarios(Usuarios $object)
    {
        $this->usuarios = $object;
        $this->usuarios_id = $object->id;
    }

    /**
     * Method get_usuarios
     * Sample of usage: $var->usuarios->attribute;
     * @returns Usuarios instance
     */
    public function get_usuarios()
    {
    
        // loads the associated object
        if (empty($this->usuarios))
            $this->usuarios = new Usuarios($this->usuarios_id);
    
        // returns the associated object
        return $this->usuarios;
    }

    
}

