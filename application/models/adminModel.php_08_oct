<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
################################################################
### file location - application/model/adminModel.php	########
### Developed by  - Sandeep singh	  					########
###													 	########
### Developer 	  - Sandeep Singh(sandy)           		########
################################################################
*/
Class AdminModel extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	// insert query
	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	// update database
	public function update_data($table, $data, $where)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
		return true;
	}

	// get all data from from table
	public function get_all_data($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result();
	}
	// get data with where condition
	public function get_all_where($table,$select=false, $where=false)
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}
	// delete query
	public function delete_query($table, $where)
	{
		$this->db->where($where);
		$this->db->delete($table);
		return true;
	}
	/*
	* get category for data table
	*/
	
	function get_category_for_datatable($filters){
		$sTable = "categories as c";
		$jTables = "";
		$aSelectionColumns = array( 'c.cat_id', 'c.category_name','c.category_url', 'c.category_url', 'c.created_time', 'c.cat_status');
		$aColumns = array( 'c.cat_id','c.cat_id','c.category_name', 'c.created_time', 'c.cat_status');
		
		$sIndexColumn = "c.cat_id";
		
		
		/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $filters['iDisplayStart'] ) && $filters['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $filters['iDisplayStart'] ).", ".
				intval( $filters['iDisplayLength'] );
		}
		
		
		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $filters['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $filters['iSortingCols'] ) ; $i++ )
			{
				if ( $filters[ 'bSortable_'.intval($filters['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $filters['iSortCol_'.$i] ) ]." ".
						($filters['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "";
		if ( isset($filters['sSearch']) && $filters['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($filters['bSearchable_'.$i]) && $filters['bSearchable_'.$i] == "true" && $filters['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($filters['sSearch_'.$i])."%' ";
			}
		}
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "	SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aSelectionColumns))." FROM   $sTable ";
		if($jTables){
			$sQuery .=  $jTables;
		}
		$sQuery .= "  $sWhere $sOrder $sLimit";
		$query = $this->db->query($sQuery);
		
		//$rResult = $query->result_array();
		$rResult = $query->result();
		/* Data set length after filtering */
		$sQuery = "SELECT FOUND_ROWS()";
		$query = $this->db->query($sQuery);
		//echo $this->db->last_query();die;
		$aResultFilterTotal = $query->result_array();
		$iFilteredTotal = $aResultFilterTotal[0]['FOUND_ROWS()'];
		
		/* Total data set length */
		$sQuery = "SELECT COUNT(".$sIndexColumn.") as cnt FROM   $sTable";
		$query = $this->db->query($sQuery);
		$aResultTotal = $query->result_array();
		$iTotal = $aResultTotal[0]['cnt'];

		$output = array(
			"sEcho" => intval($filters['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		return array('output' => $output, 'result' => $rResult);
	}
}