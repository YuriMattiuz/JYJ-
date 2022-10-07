<?php

class FilmesHeaderList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'tickettech';
    private static $activeRecord = 'Filmes';
    private static $primaryKey = 'id';
    private static $formName = 'formList_Filmes';
    private $showMethods = ['onReload', 'onSearch'];
    private $limit = 20;

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct($param = null)
    {
        parent::__construct();
        // creates the form

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        $this->limit = 20;

        $id = new TEntry('id');
        $titulo = new TEntry('titulo');
        $genero = new TEntry('genero');
        $classificacao = new TEntry('classificacao');
        $horario = new TEntry('horario');
        $sala = new TEntry('sala');
        $salas_id = new TDBCombo('salas_id', 'tickettech', 'Salas', 'id', '{id}','id asc'  );

        $id->exitOnEnter();
        $titulo->exitOnEnter();
        $genero->exitOnEnter();
        $classificacao->exitOnEnter();
        $horario->exitOnEnter();
        $sala->exitOnEnter();

        $id->setExitAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));
        $titulo->setExitAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));
        $genero->setExitAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));
        $classificacao->setExitAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));
        $horario->setExitAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));
        $sala->setExitAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));

        $salas_id->setChangeAction(new TAction([$this, 'onSearch'], ['static'=>'1', 'target_container' => $param['target_container'] ?? null]));

        $salas_id->enableSearch();
        $id->setSize('100%');
        $sala->setSize('100%');
        $titulo->setSize('100%');
        $genero->setSize('100%');
        $horario->setSize('100%');
        $salas_id->setSize('100%');
        $classificacao->setSize('100%');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();

        $this->datagrid_form = new TForm(self::$formName);
        $this->datagrid_form->onsubmit = 'return false';

        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', "Id", 'center' , '70px');
        $column_titulo = new TDataGridColumn('titulo', "Titulo", 'left');
        $column_genero = new TDataGridColumn('genero', "Genero", 'left');
        $column_classificacao = new TDataGridColumn('classificacao', "Classificacao", 'left');
        $column_horario = new TDataGridColumn('horario', "Horario", 'left');
        $column_sala = new TDataGridColumn('sala', "Sala", 'left');
        $column_salas_id = new TDataGridColumn('salas_id', "Salas id", 'left');

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_titulo);
        $this->datagrid->addColumn($column_genero);
        $this->datagrid->addColumn($column_classificacao);
        $this->datagrid->addColumn($column_horario);
        $this->datagrid->addColumn($column_sala);
        $this->datagrid->addColumn($column_salas_id);

        $action_onEdit = new TDataGridAction(array('FilmesForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel("Editar");
        $action_onEdit->setImage('far:edit #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('FilmesHeaderList', 'onDelete'));
        $action_onDelete->setUseButton(false);
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel("Excluir");
        $action_onDelete->setImage('fas:trash-alt #dd5a43');
        $action_onDelete->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        $tr = new TElement('tr');
        $this->datagrid->prependRow($tr);

        $tr->add(TElement::tag('td', ''));
        $tr->add(TElement::tag('td', ''));
        $td_id = TElement::tag('td', $id);
        $tr->add($td_id);
        $td_titulo = TElement::tag('td', $titulo);
        $tr->add($td_titulo);
        $td_genero = TElement::tag('td', $genero);
        $tr->add($td_genero);
        $td_classificacao = TElement::tag('td', $classificacao);
        $tr->add($td_classificacao);
        $td_horario = TElement::tag('td', $horario);
        $tr->add($td_horario);
        $td_sala = TElement::tag('td', $sala);
        $tr->add($td_sala);
        $td_salas_id = TElement::tag('td', $salas_id);
        $tr->add($td_salas_id);

        $this->datagrid_form->addField($id);
        $this->datagrid_form->addField($titulo);
        $this->datagrid_form->addField($genero);
        $this->datagrid_form->addField($classificacao);
        $this->datagrid_form->addField($horario);
        $this->datagrid_form->addField($sala);
        $this->datagrid_form->addField($salas_id);

        $this->datagrid_form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup("Listagem de filmess");
        $panel->datagrid = 'datagrid-container';
        $this->datagridPanel = $panel;
        $panel->getBody()->class .= ' table-responsive';

        $panel->addFooter($this->pageNavigation);

        $headerActions = new TElement('div');
        $headerActions->class = ' datagrid-header-actions ';

        $head_left_actions = new TElement('div');
        $head_left_actions->class = ' datagrid-header-actions-left-actions ';

        $head_right_actions = new TElement('div');
        $head_right_actions->class = ' datagrid-header-actions-left-actions ';

        $headerActions->add($head_left_actions);
        $headerActions->add($head_right_actions);

        $this->datagrid_form->add($this->datagrid);
        $panel->add($headerActions);
        $panel->add($this->datagrid_form);

        $button_cadastrar = new TButton('button_button_cadastrar');
        $button_cadastrar->setAction(new TAction(['FilmesForm', 'onShow']), "Cadastrar");
        $button_cadastrar->addStyleClass('btn-default');
        $button_cadastrar->setImage('fas:plus #69aa46');

        $this->datagrid_form->addField($button_cadastrar);

        $dropdown_button_exportar = new TDropDown("Exportar", 'fas:file-export #2d3436');
        $dropdown_button_exportar->setPullSide('right');
        $dropdown_button_exportar->setButtonClass('btn btn-default waves-effect dropdown-toggle');
        $dropdown_button_exportar->addPostAction( "CSV", new TAction(['FilmesHeaderList', 'onExportCsv'],['static' => 1]), self::$formName, 'fas:file-csv #00b894' );
        $dropdown_button_exportar->addPostAction( "XLS", new TAction(['FilmesHeaderList', 'onExportXls'],['static' => 1]), self::$formName, 'fas:file-excel #4CAF50' );
        $dropdown_button_exportar->addPostAction( "PDF", new TAction(['FilmesHeaderList', 'onExportPdf'],['static' => 1]), self::$formName, 'far:file-pdf #e74c3c' );
        $dropdown_button_exportar->addPostAction( "XML", new TAction(['FilmesHeaderList', 'onExportXml'],['static' => 1]), self::$formName, 'far:file-code #95a5a6' );

        $head_left_actions->add($button_cadastrar);

        $head_right_actions->add($dropdown_button_exportar);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Básico","Filmess"]));
        }

        $container->add($panel);

        parent::add($container);

    }

    public function onDelete($param = null) 
    { 
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                // get the paramseter $key
                $key = $param['key'];
                // open a transaction with database
                TTransaction::open(self::$database);

                // instantiates object
                $object = new Filmes($key, FALSE); 

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                // reload the listing
                $this->onReload( $param );
                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'));
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    public function onExportCsv($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.csv';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $this->limit = 0;
                $objects = $this->onReload();

                if ($objects)
                {
                    $handler = fopen($output, 'w');
                    TTransaction::open(self::$database);

                    foreach ($objects as $object)
                    {
                        $row = [];
                        foreach ($this->datagrid->getColumns() as $column)
                        {
                            $column_name = $column->getName();

                            if (isset($object->$column_name))
                            {
                                $row[] = is_scalar($object->$column_name) ? $object->$column_name : '';
                            }
                            else if (method_exists($object, 'render'))
                            {
                                $column_name = (strpos($column_name, '{') === FALSE) ? ( '{' . $column_name . '}') : $column_name;
                                $row[] = $object->render($column_name);
                            }
                        }

                        fputcsv($handler, $row);
                    }

                    fclose($handler);
                    TTransaction::close();
                }
                else
                {
                    throw new Exception(_t('No records found'));
                }

                TPage::openFile($output);
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onExportXls($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.xls';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $widths = [];
                $titles = [];

                foreach ($this->datagrid->getColumns() as $column)
                {
                    $titles[] = $column->getLabel();
                    $width    = 100;

                    if (is_null($column->getWidth()))
                    {
                        $width = 100;
                    }
                    else if (strpos($column->getWidth(), '%') !== false)
                    {
                        $width = ((int) $column->getWidth()) * 5;
                    }
                    else if (is_numeric($column->getWidth()))
                    {
                        $width = $column->getWidth();
                    }

                    $widths[] = $width;
                }

                $table = new \TTableWriterXLS($widths);
                $table->addStyle('title',  'Helvetica', '10', 'B', '#ffffff', '#617FC3');
                $table->addStyle('data',   'Helvetica', '10', '',  '#000000', '#FFFFFF', 'LR');

                $table->addRow();

                foreach ($titles as $title)
                {
                    $table->addCell($title, 'center', 'title');
                }

                $this->limit = 0;
                $objects = $this->onReload();

                TTransaction::open(self::$database);
                if ($objects)
                {
                    foreach ($objects as $object)
                    {
                        $table->addRow();
                        foreach ($this->datagrid->getColumns() as $column)
                        {
                            $column_name = $column->getName();
                            $value = '';
                            if (isset($object->$column_name))
                            {
                                $value = is_scalar($object->$column_name) ? $object->$column_name : '';
                            }
                            else if (method_exists($object, 'render'))
                            {
                                $column_name = (strpos($column_name, '{') === FALSE) ? ( '{' . $column_name . '}') : $column_name;
                                $value = $object->render($column_name);
                            }

                            $transformer = $column->getTransformer();
                            if ($transformer)
                            {
                                $value = strip_tags(call_user_func($transformer, $value, $object, null));
                            }

                            $table->addCell($value, 'center', 'data');
                        }
                    }
                }
                $table->save($output);
                TTransaction::close();

                TPage::openFile($output);
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onExportPdf($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.pdf';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $this->limit = 0;
                $this->datagrid->prepareForPrinting();
                $this->onReload();

                $html = clone $this->datagrid;
                $contents = file_get_contents('app/resources/styles-print.html') . $html->getContents();

                $dompdf = new \Dompdf\Dompdf;
                $dompdf->loadHtml($contents);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                file_put_contents($output, $dompdf->output());

                $window = TWindow::create('PDF', 0.8, 0.8);
                $object = new TElement('object');
                $object->data  = $output;
                $object->type  = 'application/pdf';
                $object->style = "width: 100%; height:calc(100% - 10px)";

                $window->add($object);
                $window->show();
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public function onExportXml($param = null) 
    {
        try
        {
            $output = 'app/output/'.uniqid().'.xml';

            if ( (!file_exists($output) && is_writable(dirname($output))) OR is_writable($output))
            {
                $this->limit = 0;
                $objects = $this->onReload();

                if ($objects)
                {
                    TTransaction::open(self::$database);

                    $dom = new DOMDocument('1.0', 'UTF-8');
                    $dom->{'formatOutput'} = true;
                    $dataset = $dom->appendChild( $dom->createElement('dataset') );

                    foreach ($objects as $object)
                    {
                        $row = $dataset->appendChild( $dom->createElement( self::$activeRecord ) );

                        foreach ($this->datagrid->getColumns() as $column)
                        {
                            $column_name = $column->getName();
                            $column_name_raw = str_replace(['(','{','->', '-','>','}',')', ' '], ['','','_','','','','','_'], $column_name);

                            if (isset($object->$column_name))
                            {
                                $value = is_scalar($object->$column_name) ? $object->$column_name : '';
                                $row->appendChild($dom->createElement($column_name_raw, $value)); 
                            }
                            else if (method_exists($object, 'render'))
                            {
                                $column_name = (strpos($column_name, '{') === FALSE) ? ( '{' . $column_name . '}') : $column_name;
                                $value = $object->render($column_name);
                                $row->appendChild($dom->createElement($column_name_raw, $value));
                            }
                        }
                    }

                    $dom->save($output);

                    TTransaction::close();
                }
                else
                {
                    throw new Exception(_t('No records found'));
                }

                TPage::openFile($output);
            }
            else
            {
                throw new Exception(_t('Permission denied') . ': ' . $output);
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch($param = null)
    {
        // get the search form data
        $data = $this->datagrid_form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->id) AND ( (is_scalar($data->id) AND $data->id !== '') OR (is_array($data->id) AND (!empty($data->id)) )) )
        {

            $filters[] = new TFilter('id', '=', $data->id);// create the filter 
        }

        if (isset($data->titulo) AND ( (is_scalar($data->titulo) AND $data->titulo !== '') OR (is_array($data->titulo) AND (!empty($data->titulo)) )) )
        {

            $filters[] = new TFilter('titulo', 'like', "%{$data->titulo}%");// create the filter 
        }

        if (isset($data->genero) AND ( (is_scalar($data->genero) AND $data->genero !== '') OR (is_array($data->genero) AND (!empty($data->genero)) )) )
        {

            $filters[] = new TFilter('genero', 'like', "%{$data->genero}%");// create the filter 
        }

        if (isset($data->classificacao) AND ( (is_scalar($data->classificacao) AND $data->classificacao !== '') OR (is_array($data->classificacao) AND (!empty($data->classificacao)) )) )
        {

            $filters[] = new TFilter('classificacao', 'like', "%{$data->classificacao}%");// create the filter 
        }

        if (isset($data->horario) AND ( (is_scalar($data->horario) AND $data->horario !== '') OR (is_array($data->horario) AND (!empty($data->horario)) )) )
        {

            $filters[] = new TFilter('horario', 'like', "%{$data->horario}%");// create the filter 
        }

        if (isset($data->sala) AND ( (is_scalar($data->sala) AND $data->sala !== '') OR (is_array($data->sala) AND (!empty($data->sala)) )) )
        {

            $filters[] = new TFilter('sala', 'like', "%{$data->sala}%");// create the filter 
        }

        if (isset($data->salas_id) AND ( (is_scalar($data->salas_id) AND $data->salas_id !== '') OR (is_array($data->salas_id) AND (!empty($data->salas_id)) )) )
        {

            $filters[] = new TFilter('salas_id', '=', $data->salas_id);// create the filter 
        }

        // fill the form with data again
        $this->datagrid_form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        if (isset($param['static']) && ($param['static'] == '1') )
        {
            $class = get_class($this);
            $onReloadParam = ['offset' => 0, 'first_page' => 1, 'target_container' => $param['target_container'] ?? null];
            AdiantiCoreApplication::loadPage($class, 'onReload', $onReloadParam);
        }
        else
        {
            $this->onReload(['offset' => 0, 'first_page' => 1]);
        }
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'tickettech'
            TTransaction::open(self::$database);

            // creates a repository for Filmes
            $repository = new TRepository(self::$activeRecord);

            $criteria = clone $this->filter_criteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }
            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $this->limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {

                    $row = $this->datagrid->addItem($object);
                    $row->id = "row_{$object->id}";

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($this->limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;

            return $objects;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  $this->showMethods))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

