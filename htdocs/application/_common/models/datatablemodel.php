<?php
class Datatablemodel extends CI_Model{
	
	function __construct()
    {
        // Call the Model Datatable
        parent::__construct();
    }	

    /**
    * CodeIgniter global variable
    *
    * @global object $ci
    * @name   $ci
    * $tablename is sufijo for e edit and delete options
    */
//    protected $ci;
	protected $tablename;

    /**
    * Magic method to facilitate method overloading
    */
    public function __call($name, $args)
    {
      return call_user_func_array(array($this, $name), $args);
    }

    /**
    * Overload handler for generate method
    */
    public function generate()
    {
      $num = func_num_args();
      $args = func_get_args();

      switch($num)
      {
        case 1:
          $result = $this->__call('generate_from_sql', $args);
          break;
        case 3:
          $result = $this->__call('generate_from_tci', $args);
          break;
        case 4:
          $result = $this->__call('generate_from_advanced', $args);
          break;
        default;
          die('Invalid set of arguments passed.');
      }
      return $result;
    }

    /**
    * Builds all the necessary query segments and performs the main query based on passed arguments
    *
    * @param string $table
    * @param mixed $columns
    * @param string $index
    * @return string
    */
    public function generate_from_tci($table, $columns, $index)
    {
		$this->tablename = $table;
	
      $sLimit = $this->get_paging();
      $sOrder = $this->get_ordering($columns);
      $sWhere = $this->get_filtering($columns);
      $rResult = $this->get_display_data($table, $columns, $sWhere, $sOrder, $sLimit);
      $rResultFilterTotal = $this->get_data_set_length();
      $aResultFilterTotal = $rResultFilterTotal->result_array();
      $iFilteredTotal = $aResultFilterTotal[0]['FOUND_ROWS()'];
      $rResultTotal = $this->get_total_data_set_length($table, $index, $sWhere);
      $aResultTotal = $rResultTotal->result_array();
      $iTotal = $aResultTotal[0]["COUNT($table.$index)"];
      return $this->produce_output($columns, $iTotal, $iFilteredTotal, $rResult);
    }

    /**
    * Builds all the necessary query segments and performs the main query based on passed arguments including join tables
    *
    * @param string $table
    * @param mixed $columns
    * @param string $index
    * @param mixed $options
    * @return string
    */
    public function generate_from_advanced($table, $columns, $index, $options)
    {
		$this->tablename = $table;
      $jointables = (isset($options['joins']) && is_array($options['joins']))? $options['joins'] : '';
      $custom_columns = (isset($options['custom_columns']) && is_array($options['custom_columns']))? $options['custom_columns'] : '';
      $custom_filter = (isset($options['custom_filter']) && $options['custom_filter'] != '')? $options['custom_filter'] : null;
      $tablenames = $this->get_aliased_tables($columns, $table, $jointables);
      $columns = $this->get_referenced_columns($columns, $table, $jointables);
      $sLimit = $this->get_paging();
      $sOrder = $this->get_ordering($columns, $table);
      $sWhere = $this->get_filtering($columns, $jointables, $custom_filter);
      $rResult = $this->get_display_data($tablenames, $columns, $sWhere, $sOrder, $sLimit);
      $rResultFilterTotal = $this->get_data_set_length();
      $aResultFilterTotal = $rResultFilterTotal->result_array();
      $iFilteredTotal = $aResultFilterTotal[0]['FOUND_ROWS()'];
      $rResultTotal = $this->get_total_data_set_length($table, $index, $sWhere, $tablenames);
      $aResultTotal = $rResultTotal->result_array();
      $iTotal = $aResultTotal[0]["COUNT($table.$index)"];
      return $this->produce_output($columns, $iTotal, $iFilteredTotal, $rResult, $custom_columns);
    }

    /**
    * Creates a pagination query segment
    *
    * @return string
    */
    protected function get_paging()
    {
      $sLimit = '';

      if($this->input->post('iDisplayStart') && $this->input->post('iDisplayLength') != '-1')
        $sLimit = 'LIMIT ' . $this->input->post('iDisplayStart') . ', ' . $this->input->post('iDisplayLength');
      else
      {
        $iDisplayLength = $this->input->post('iDisplayLength');
        $sLimit = (empty($iDisplayLength))? 'LIMIT 0,10' : 'LIMIT 0,' . $iDisplayLength;
      }

      return $sLimit;
    }

    /**
    * Creates a sorting query segment
    *
    * @param string $columns
    * @return string
    */
    protected function get_ordering($columns)
    {
      $sOrder = '';

      if($this->input->post('iSortCol_0') != null)
      {
        $sOrder = 'ORDER BY ';
        $sColArray = ($this->input->post('sColumns'))? explode(',', $this->input->post('sColumns')) : $columns;

        for($i = 0; $i < intval($this->input->post('iSortingCols')); $i++)
          if($sColArray[intval($this->input->post('iSortCol_' . $i))] && in_array($sColArray[intval($this->input->post('iSortCol_' . $i))], $columns))
            $sOrder .= $sColArray[intval($this->input->post('iSortCol_' . $i))] . ' ' . $this->input->post('sSortDir_' . $i) . ', ';

        $sOrder = substr_replace($sOrder, '', -2);
        if($sOrder == 'ORDER BY' || $sOrder == 'ORDER B') $sOrder = '';
      }

      return $sOrder;
    }

    /**
    * Creates a filtering query segment
    *
    * @param string $columns
    * @param mixed $jointables optional and is used for joins only
    * @return string
    */
    protected function get_filtering($columns, $jointables = null, $custom_filter = null)
    {
      $sWhere = '';

      if(isset($jointables) && is_array($jointables))
      {
        $sWhere = 'WHERE ';

        foreach($jointables as $jt_col_key => $jt_col_val)
          $sWhere .= $jt_col_val['fk'] . ' AND ';

        $sWhere = substr_replace($sWhere, '', -4);
      }

      if($this->input->post('sSearch') != '')
      {
        $sWhere .= (isset($jointables) && is_array($jointables))? ' AND ' : 'WHERE ';
        $sWhere .= '(';
        $sColArray = ($this->input->post('sColumns'))? explode(',', $this->input->post('sColumns')) : $columns;

        for($i = 0; $i < count($sColArray); $i++)
          if($this->input->post('bSearchable_' . $i) == 'true')
            if($sColArray[$i] && in_array($sColArray[$i], $columns))
          		$sWhere .= $sColArray[$i] . " LIKE '%" . mysql_real_escape_string($this->input->post('sSearch')) . "%' OR ";

        $sWhere = substr_replace($sWhere, '', -3);
        $sWhere .= ')';
      }

      for($i = 0; $i < count($columns); $i++)
      {
        if($this->input->post('bSearchable_' . $i) == 'true' && $this->input->post('sSearch_' . $i) != '')
        {
          $sWhere .= ($sWhere == '')? 'WHERE ' : ' AND ';
          $sWhere .= $columns[$i] . " LIKE '%" . mysql_real_escape_string($this->input->post('sSearch_' . $i)) . "%' ";
        }
      }

      if(isset($custom_filter) && $custom_filter != null)
      {
        $sWhere .= ($sWhere == '')? 'WHERE ' : ' AND ';
        $sWhere .= $custom_filter;
      }

      return $sWhere;
    }

    /**
    * Combines all created query segments to build the main query
    *
    * @param string $table
    * @param string $columns
    * @param string $sWhere
    * @param string $sOrder
    * @param string $sLimit
    * @return object
    */
    protected function get_display_data($table, $columns, $sWhere, $sOrder, $sLimit)
    {
		$sql = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(' , ', ' ', implode(', ', $columns)) . "
				FROM $table
				$sWhere
				$sOrder 
				$sLimit";
		/*
		echo "<pre>";
		print_r($sql);
		echo "</pre>";
		*/
		return $this->db->query($sql);
    }

    /**
    * Gets all matched rows
    *
    * @return object
    */
    protected function get_data_set_length()
    {
      return $this->db->query('SELECT FOUND_ROWS()');
    }

    /**
    * Gets the count of all rows found
    *
    * @param string $table
    * @param string $index
    * @param string $sWhere
    * @param string $tablenames optional and is used for joins only
    * @return string
    */
    protected function get_total_data_set_length($table, $index, $sWhere, $tablenames = null)
    {
      $from = ($tablenames != null)? $tablenames : $table;

      return $this->db->query
      ("
        SELECT COUNT($table.$index)
        FROM $from
        $sWhere
      ");
    }

    /**
    * Creates a query segment with table references for column names
    *
    * @param mixed $columns
    * @param string $table
    * @param mixed $jointables
    * @return string
    */
    protected function get_referenced_columns($columns, $table, $jointables)
    {
      foreach($columns as $column)
        $tabledotcolumn[] = $table . '.' . $column;

      if(is_array($jointables) && count($jointables) > 0)
        foreach($jointables as $jointable_key => $jointable)
          foreach($jointable['columns'] as $jcolumn_key => $jcolumn_val)
            $tabledotcolumn[] = $jointable_key . '.' . $jcolumn_val;

      return $tabledotcolumn;
    }

    /**
    * Creates a query segment with aliased table names
    *
    * @param mixed $columns
    * @param string $table
    * @param mixed $jointables
    * @return string
    */
    protected function get_aliased_tables($columns, $table, $jointables)
    {
      $tables = $table;

      if(is_array($jointables) && count($jointables) > 0)
        foreach ($jointables as $jointable_key => $jointable)
          $tables .= ', ' . $jointable_key;

      return $tables;
    }

    /**
    * Builds a JSON encoded string data
    *
    * @param string $columns
    * @param string $iTotal
    * @param string $iFilteredTotal
    * @param string $rResult
    * @return string
    */
    protected function produce_output($columns, $iTotal, $iFilteredTotal, $rResult, $custom_columns = '')
    {
      $aaData = array();
      $sColumnOrder = '';
		$status_eng = array(3 => "Shipped", 2 => "Backorder", 1 => "Fulfilment", 0 => "Received");
		$status_esp = array(3 => "Enviado", 2 => "Pendiente", 1 => "Cumpliendo", 0 => "Recibido");
		$status_order_en = array(3 => "Received", 2 => "in Travel", 1 => "in Preparation", 0 => "Waiting");
		$status_order_es = array(3 => "Recibido", 2 => "En Camino", 1 => "En Preparaci&oacute;n", 0 => "En Espera");
		$iduri = 0;
		$idcart = 0;
		$carttype = 0;
		$cantforeign = 0;

      foreach($rResult->result_array() as $row_key => $row_val)
      {
        foreach($row_val as $col_key => $col_val)
        {

			if($col_key == 'id' && $this->tablename == "v_userprofile")
            {
				$id = $col_val;
				$iduri = $id;
				//$links = "<center><a href='javascript:void(0)' onclick={$this->tablename}_login($id) id='login_$id'"."><img src='../images/key.png' border='0' alt='login' title='login'></a>"."&nbsp;&nbsp;&nbsp;"."<a href='javascript:void(0)' onclick={$this->tablename}_stats($id) id='stats_$id'"."><img src='../images/tables/stats.png' border='0' alt='stats' title='stats'></a>"."&nbsp;&nbsp;&nbsp;"."<a href='javascript:void(0)' onclick={$this->tablename}_edit($id) id='edit_$id'"."><img src='../images/tables/page_white_edit.png' border='0' alt='edit' title='edit'></a>"."&nbsp;&nbsp;&nbsp;"."<a href='javascript:void(0)' onclick={$this->tablename}_delete($id) id='delete_$id'"."><img src='../images/tables/deleteitem.png' border='0' title='delete' alt='delete'></a></center>";
				$links = "<center>";
				//todo: check after if we require to log as another user
				//$links .= "<a href='javascript:void(0)' onclick={$this->tablename}_login($id) id='login_$id'"."><img src='../images/key.png' border='0' alt='login' title='login'></a>";
				//$links .= "&nbsp;&nbsp;&nbsp;";
				//$links .= "<a href='javascript:void(0)' onclick={$this->tablename}_stats($id) id='stats_$id'"."><img src='../images/tables/stats.png' border='0' alt='stats' title='stats'></a>";
                $links .= "&nbsp;&nbsp;&nbsp;";
                $links .= "<span class='btn-group'>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_edit($id) id='edit_$id'><i class='icon-pencil'></i></a>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_block($id) id='block_$id'><i class='icon-lock'></i></a>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_unblock($id) id='unblock_$id'><i class='icon-unlock'></i></a>
                                        </span>";

				$aaData[$row_key][] = $links;
			}elseif($col_key == 'selected' && $this->tablename == "v_userprofile"){
				$id = $col_val;
				$iduri = $id;
				$checkbox = "<input type='checkbox' value='{$row_val["id"]}' name='users[]' id='selectusers_".$row_val["id"]."' class='cb_new_published' />";
				$actions = "<center>{$checkbox}</center>";
				$aaData[$row_key][] = $actions;
			}elseif($col_key == 'selected' && $this->tablename == "v_company"){
                $id = $col_val;
                $iduri = $id;
                $checkbox = "<input type='checkbox' value='{$row_val["id"]}' name='company[]' id='selectcompany_".$row_val["id"]."' class='cb_new_published' />";
                $actions = "<center>{$checkbox}</center>";
                $aaData[$row_key][] = $actions;
            }elseif($col_key == 'selected' && $this->tablename == "v_booking"){
                $id = $col_val;
                $iduri = $id;
                $checkbox = "<input type='checkbox' value='{$row_val["id"]}' name='company[]' id='selectbooking_".$row_val["id"]."' class='cb_new_published' />";
                $actions = "<center>{$checkbox}</center>";
                $aaData[$row_key][] = $actions;
            }elseif($col_key == 'selected' && $this->tablename == "v_taxi"){

                $id = $col_val;
                $checkbox = "<input type='checkbox' value='{$row_val["id"]}' name='taxi[]' id='selecttaxis_"
                    .$row_val["id"]."' class='cb_new_published' />";
                $actions = "<center>{$checkbox}</center>";
                $aaData[$row_key][] = $actions;
            }elseif($col_key == 'status' && $this->tablename == "v_taxi"){
                $actions = $col_val == 0 ? "Libre":"Ocupado" ;
                $aaData[$row_key][] = $actions;
            }
            elseif($col_key == 'status' && $this->tablename == "v_addresstaxi"){
                $actions = $col_val == 0 ? "Libre":"Ocupado" ;
                $aaData[$row_key][] = $actions;
            }
            elseif($col_key == 'selected' && $this->tablename == "v_address"){

                $id = $col_val;
                $checkbox = "<input type='checkbox' value='{$row_val["id"]}' name='taxi[]' id='selectaddress_"
                    .$row_val["id"]."' class='cb_new_published' />";
                $actions = "<center>{$checkbox}</center>";
                $aaData[$row_key][] = $actions;
            }
            elseif($col_key == 'main' && $this->tablename == "v_address"){

                $actions = $col_val == 1 ? "Si":"No" ;
                $aaData[$row_key][] = $actions;
            }
            elseif($col_key == 'id' && $this->tablename == "v_address"){
                $id = $col_val;
                $iduri = $id;
                $links = "<span class='btn-group'>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_edit($id) id='edit_$id'><i class='icon-pencil'></i></a>
                                        </span>";
                $aaData[$row_key][] = $links;
            }
            elseif($col_key == 'id' && $this->tablename == "v_addressbooking"){
                $id = $col_val;
                $iduri = $id;
                $links = "<span class='btn-group'>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_select($id) id='selectaddress_$id'><i class='icon-ok'></i></a>
                                        </span>";
                $aaData[$row_key][] = $links;
            } elseif($col_key == 'id' && $this->tablename == "v_addresstaxi"){
                $id = $col_val;
                $iduri = $id;
                $links = "<span class='btn-group'>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_select($id) id='selecttaxi_$id'><i class='icon-ok'></i></a>
                                        </span>";
                $aaData[$row_key][] = $links;
            }

            elseif($col_key == 'status' && $this->tablename == "v_booking"){
                $bookingStatuses[1] = 'Sin Asignar';
                $bookingStatuses[2] = 'Taxi Asignado';
                $bookingStatuses[3] = 'Esperando pasajero';
                $bookingStatuses[4] = 'En Progreso';
                $bookingStatuses[5] = 'Terminada';
                $bookingStatuses[6] = 'Cancelada';
                $actions = $bookingStatuses[$col_val];
                $aaData[$row_key][] = $actions;
            }
            elseif($col_key == 'id' && $this->tablename == "v_booking"){
                $id = $col_val;
                $iduri = $id;
                $links = "<span class='btn-group'>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_edit($id) id='edit_$id'><i class='icon-pencil'></i></a>
                                        </span>";
                $aaData[$row_key][] = $links;
            }
            elseif($col_key == 'id'){
				$id = $col_val;
				$iduri = $id;

                $links = "<span class='btn-group'>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_edit($id) id='edit_$id'><i class='icon-pencil'></i></a>
                                            <a href='#' class='btn btn-small' onclick={$this->tablename}_delete($id) id='delete_$id'><i class='icon-trash'></i></a>
                                        </span>";

                //$links = "<center><a href='javascript:void(0)' onclick={$this->tablename}_edit($id) id='edit_$id'"."><img src='../images/tables/page_white_edit.png' border='0' alt='edit'></a>"."&nbsp;&nbsp;&nbsp;"."<a href='javascript:void(0)' onclick={$this->tablename}_delete($id) id='delete_$id'"."><img src='../images/tables/deleteitem.png' border='0' alt='delete'></a></center>";

                $aaData[$row_key][] = $links;
            }else{
				$aaData[$row_key][] = $col_val;
			}

        }

        if(isset($custom_columns) && is_array($custom_columns))
        {
          foreach($custom_columns as $cus_col_key => $cus_col_val)
          {
            if(isset($cus_col_val[1]) && is_array($cus_col_val[1]))
            {
              foreach($cus_col_val[1] as $cus_colr_key => $cus_colr_val)
                $cus_col_val[0] = str_ireplace('$' . ($cus_colr_key + 1), $aaData[$row_key][array_search($cus_colr_val, $columns)], $cus_col_val[0]);

              $aaData[$row_key][] = $cus_col_val[0];
            }
            else
              $aaData[$row_key][] = $cus_col_val[0];
          }
        }
      }

      foreach($columns as $col_key => $col_val)
        $sColumnOrder .= $col_val . ',';

      if(isset($custom_columns) && is_array($custom_columns))
        foreach($custom_columns as $cus_col_key => $cus_col_val)
          $sColumnOrder .= $cus_col_key . ',';

      $sColumnOrder = substr_replace($sColumnOrder, '', -1);

      $sOutput = array
      (
        'sEcho'                => intval($this->input->post('sEcho')),
        'iTotalRecords'        => $iTotal,
        'iTotalDisplayRecords' => $iFilteredTotal,
        'aaData'               => $aaData,
        'sColumns'             => $sColumnOrder
      );

      return json_encode($sOutput);
    }
}
