<?php

class VendasForm extends TWindow
{
    protected $form;
    private $formFields = [];
    private static $database = 'tickettech';
    private static $activeRecord = 'Vendas';
    private static $primaryKey = 'id';
    private static $formName = 'form_VendasForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setSize(0.8, null);
        parent::setTitle("Cadastro de vendas");
        parent::setProperty('class', 'window_modal');

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de vendas");


        $id = new TEntry('id');
        $filme = new TEntry('filme');
        $sessao = new TEntry('sessao');
        $sala = new TEntry('sala');
        $poltrona = new TEntry('poltrona');
        $ingresso = new TEntry('ingresso');
        $filmes_id = new TDBCombo('filmes_id', 'tickettech', 'Filmes', 'id', '{id}','id asc'  );

        $filmes_id->addValidation("Filmes id", new TRequiredValidator()); 

        $filmes_id->enableSearch();
        $id->setEditable(false);

        $id->setSize(100);
        $sala->setSize('100%');
        $filme->setSize('100%');
        $sessao->setSize('100%');
        $poltrona->setSize('100%');
        $ingresso->setSize('100%');
        $filmes_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id],[new TLabel("Filme:", null, '14px', null)],[$filme]);
        $row2 = $this->form->addFields([new TLabel("Sessao:", null, '14px', null)],[$sessao],[new TLabel("Sala:", null, '14px', null)],[$sala]);
        $row3 = $this->form->addFields([new TLabel("Poltrona:", null, '14px', null)],[$poltrona],[new TLabel("Ingresso:", null, '14px', null)],[$ingresso]);
        $row4 = $this->form->addFields([new TLabel("Filmes id:", '#ff0000', '14px', null)],[$filmes_id],[],[]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['VendasHeaderList', 'onShow']), 'fas:arrow-left #000000');
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

            $object = new Vendas(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $messageAction = new TAction(['VendasHeaderList', 'onShow']);   

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

                $object = new Vendas($key); // instantiates the Active Record 

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

