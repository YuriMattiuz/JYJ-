<?php

class FuncionariosForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'tickettech';
    private static $activeRecord = 'Funcionarios';
    private static $primaryKey = 'id';
    private static $formName = 'form_FuncionariosForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.8, null);
        parent::setTitle("Cadastro de funcionarios");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de funcionarios");


        $nome = new TEntry('nome');
        $id = new TEntry('id');
        $rg = new TEntry('rg');
        $entrada = new TEntry('entrada');
        $saida = new TEntry('saida');
        $usuarios_id = new TDBCombo('usuarios_id', 'tickettech', 'Usuarios', 'id', '{id}','id asc'  );

        $nome->addValidation("Nome", new TRequiredValidator()); 
        $rg->addValidation("Rg", new TRequiredValidator()); 
        $entrada->addValidation("Entrada", new TRequiredValidator()); 
        $saida->addValidation("Saida", new TRequiredValidator()); 
        $usuarios_id->addValidation("Usuarios id", new TRequiredValidator()); 

        $usuarios_id->enableSearch();
        $id->setEditable(false);

        $id->setSize(100);
        $rg->setSize('100%');
        $nome->setSize('100%');
        $saida->setSize('100%');
        $entrada->setSize('100%');
        $usuarios_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Nome:", '#ff0000', '14px', null)],[$nome],[new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Rg:", '#ff0000', '14px', null)],[$rg],[new TLabel("Entrada:", '#ff0000', '14px', null)],[$entrada]);
        $row3 = $this->form->addFields([new TLabel("Saida:", '#ff0000', '14px', null)],[$saida],[new TLabel("Usuarios id:", '#ff0000', '14px', null)],[$usuarios_id]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['FuncionariosHeaderList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Funcionarios(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $messageAction = new TAction(['FuncionariosHeaderList', 'onShow']);   

            if(!empty($param['target_container']))
            {
                $messageAction->setParameter('target_container', $param['target_container']);
            }

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            new TMessage('info', "Registro salvo", $messageAction); 

                TWindow::closeWindow(parent::getId()); 
        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Funcionarios($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

}

