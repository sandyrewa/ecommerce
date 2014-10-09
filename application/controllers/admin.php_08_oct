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
				$tmparr['status'] = '<a id="sts_' . $category->cat_status . '_cmid_'. $category->cat_id .'" class="tooltips cmnty user_' . $category->cat_id . '" href="javascript:void(0)" data-original-title="Make Active" rel="tooltip" data-placement="top" title=""><i class="icon-ban-circle"></i> Deactive</a>';
			}
			else
			{
				$tmparr['status'] = '<a  id="sts_' . $category->cat_status . '_cmid_'. $category->cat_id .'" class="tooltips cmnty user_' .  $category->cat_id . '" href="javascript:void(0)" data-original-title="Make Inctive" rel="tooltip" data-placement="top" title=""><i class="icon-ok"></i> Active</a>';
			}
			$tmparr['actions'] = '<a href="'. base_url() .'admin/update_category/'.  $category->cat_id .'" class="tooltips" data-original-title="Edit" rel="tooltip" data-placement="top" title=""><i class=" icon-edit"></i></a>
								<a href="javascript:void(0)" data-target="#confirmDelete" class="tooltips delete-category" data-original-title="Delete" data-toggle="" data-placement="top" title="" id="'.  $category->cat_id .'" ><i class="icon-trash"></i></a>';
		
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
			$this->form_validation->set_rules('category', 'category name', 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			}
			else
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
		}
		$this->adminInnerView('admin/add_category', $this->data);
	}
	// update category
	public function update_category($cat_id=false)
	{
		// check if category id not in url then redirect to category list page
		if(empty($cat_id))
		{
			redirect(base_url().'admin');
		}
		$this->data['headerData'] = array(
										  'headerData'=> array(
										  		'title'=>'Admin :: Update Category',
										  		'metadata'=>''
											)
										);
		// when form is submit then it is execute
		if(isset($_POST['addCat']))
		{
			$this->form_validation->set_rules('category', 'category name', 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			}
			else
			{
				$catName = $_POST['category'];
				$cateUrl = $this->_clean_string($catName);
				$catDesc = $_POST['category_description'];
				$updateData = array(
					'category_name' 		 => $catName,
					'category_url' 			 => $cateUrl,
					'category_description'	 => $catDesc
				);
				$where = array('cat_id'=> $cat_id);
				$update = $this->AdminModel->update_data('categories', $updateData, $where);
				// after update data redirect to listing page
				redirect(base_url().'admin');
			}
		}
		// get the category detail
		$select = 'cat_id, category_name, category_description';
		$where  = array('cat_id'=>$cat_id);
		$table  = 'categories';
		$this->data['category'] = $this->AdminModel->get_all_where($table, $select, $where);
		$this->adminInnerView('admin/add_category', $this->data);
	}
	// check category name for unique ness
	public function check_cat_name()
	{
		$cat_name = $_POST['category'];
		$cat_id   = $_POST['cat_id'];
		if(empty($cat_id))
		{
			$select = '*';
			$table  = 'categories';
			$where = array('category_name'=>$cat_name);
		}
		else
		{
			$select = '*';
			$table  = 'categories';
			$where = array('cat_id !='=> $cat_id, 'category_name'=>$cat_name);
		}
		
		$result = $this->AdminModel->get_all_where($table, $select, $where);
		if(count($result) > 0)
		{
			$valid =  "false";
		}
		else
		{
			$valid = "true";
		}
		echo $valid;
	}
	// delete category
	public function delete_category()
	{
		$cat_id = $_POST['cat_id'];
		$where = array('cat_id'=>$cat_id);
		$this->AdminModel->delete_query('categories', $where);

		$message = "category successfully delete";
		echo json_encode($message);
	}
	// add product
	public function add_product()
	{
		$this->data['headerData'] = array(
										  'headerData'=> array(
										  		'title'=>'Admin :: Add new product',
										  		'metadata'=>''
											)
										);
		$this->adminInnerView('admin/add_product', $this->data);
	}
}

/* End of file admin.php */