<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
################################################################
### file location - application/controller/admin.php	########
### Developed by  - Sandeep singh	  					########
###													 	########
### Developer 	  - Sandeep Singh(sandy)           		########
################################################################
*/

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$this->data['headerData'] = array(
										  'headerData'=> array(
										  		'title'=>'Admin :: Category List',
										  		'metadata'=>''
											)
										);
		$this->adminInnerView('admin/categories_list', $this->data);
	}
	/*
	* Get category data for data table
	*/
	public function get_category_list_for_data_table()
	{
		$result = $this->AdminModel->get_category_for_datatable($this->input->get());
		//print_r($result);die;
		$output = $result['output'];
		$list = $result['result'];
		$categories = array();
		foreach($list as $category){
			$tmparr = array();
			$tmparr['allcheck'] =  '<input type="checkbox" name="row_sel[]" class="case" value="'. $category->cat_id .'">';
			$tmparr['name'] =  $category->category_name;
			$create_date = date('Y-m-d H:i A', strtotime($category->created_time));
			$tmparr['createdDate'] = $create_date;
			if($category->cat_status=='0'){
				$tmparr['status'] = '<a id="sts_' . $category->cat_status . '_cmid_'. $category->cat_id .'" class="tooltips cmnty user_' . $category->cat_id . '" href="javascript:void(0)" data-original-title="Make Active" rel="tooltip" data-placement="top" title=""><i class="icon-ban-circle"></i></a>';
			}
			else
			{
				$tmparr['status'] = '<a  id="sts_' . $category->cat_status . '_cmid_'. $category->cat_id .'" class="tooltips cmnty user_' .  $category->cat_id . '" href="javascript:void(0)" data-original-title="Make Inctive" rel="tooltip" data-placement="top" title=""><i class="icon-ok"></i></a>';
			}
			$tmparr['actions'] = '<a href="'. base_url() .'admin/update_category/'.  $category->cat_id .'" class="tooltips" data-original-title="Edit" rel="tooltip" data-placement="top" title=""><i class=" icon-edit"></i></a>
								<a onclick="delCommunity('. $category->cat_id.')" href="javascript:void(0)" data-target="#confirmDelete" class="tooltips" data-original-title="Delete" data-toggle="" data-placement="top" title="" id="delete_row_'.  $category->cat_id .'" ><i class=" icon-trash"></i></a>';
		
			$categories[] = $tmparr;
		}
		$output['aaData'] = $categories;
		echo json_encode($output);
	}
	/*
	* add category
	*/
	public function add_categories()
	{
		$this->data['headerData'] = array(
										  'headerData'=> array(
										  		'title'=>'Admin :: Add Category',
										  		'metadata'=>''
											)
										);
		// when form is submit
		if(isset($_POST['addCat']))
		{
			$catName = $_POST['category'];
			$cateUrl = $this->_clean_string($catName);
			$catDesc = $_POST['category_description'];
			$insertData = array(
				'category_name' 		 => $catName,
				'category_url' 			 => $cateUrl,
				'category_description'	 => $catDesc
			);
			$insertId = $this->AdminModel->insertData('categories',$insertData );
			//echo $this->db->last_query();
			if(!empty($insertId))
			{
				redirect('admin');
			}
		}
		$this->adminInnerView('admin/add_category', $this->data);
	}
}

/* End of file admin.php */