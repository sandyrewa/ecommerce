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
		$this->data['headerData'] = array('headerData'=> array('title'=>'Admin :: Category List','metadata'=>''));
		$this->adminInnerView('admin/categories_list', $this->data);
	}
	/*
	* product category listing
	*/
	public function categories()
	{
		$this->data['headerData'] = array('headerData'=> array('title'=>'Admin :: Category List','metadata'=>''));
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
			$tmparr['id'] =  $category->cat_id;
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
								<a href="javascript:void(0)" class="tooltips delete-category" data-original-title="Delete" data-toggle="" data-placement="top" title="" id="'.  $category->cat_id .'" ><i class="icon-trash"></i></a>';
		
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
		$this->data['headerData'] = array('headerData'=> array('title'=>'Admin :: Add Category','metadata'=>''));
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
					redirect('admin/categories');
				}
			}
		}
		$this->adminInnerView('admin/add_category', $this->data);
	}
	// update category
	public function update_category($cat_id=false)
	{
		// check if category id not in url then redirect to category list page
		if(empty($cat_id) || (!is_numeric($cat_id)))
		{
			redirect(base_url().'admin/categories');
		}
		$this->data['headerData'] = array('headerData'=> array('title'=>'Admin :: Update Category','metadata'=>''));
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
				redirect(base_url().'admin/categories');
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

		$message = "Category successfully deleted";
		echo json_encode($message);
	}
	// add product
	public function add_product()
	{
		// when form is submit
		if(isset($_POST['addProduct']))
		{
			$this->form_validation->set_rules('product', 'product name', 'trim|required');
			$this->form_validation->set_rules('product_price', 'product price', 'trim|required');
			$this->form_validation->set_rules('product_price', 'product price', 'trim|required|numeric');
			$this->form_validation->set_rules('product_stock', 'product quantity', 'trim|required|numeric');
			if($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			}
			else
			{
				$insertData = array(
					'product_name'		=> $_POST['product'],
					'product_url'		=> $this->_clean_string($_POST['product']),
					'product_desc'		=> $_POST['product_desc'],
					'product_cat_id'	=> $_POST['category'],
					'product_price'		=> $_POST['product_price'],
					'product_stock'		=> $_POST['product_stock']
				);
				$insertId = $this->AdminModel->insertData('products', $insertData);
				if(!empty($insertId)){
					redirect(base_url().'admin/product');
				}
			}

		}
		$select = "cat_id, category_name, category_url";
		$table 	= "categories";
		$where  = "";
		$this->data['categories'] = $this->AdminModel->get_all_where($table, $select);
		$this->data['headerData'] = array(
										  'headerData'=> array(
										  		'title'=>'Admin :: Add new product',
										  		'metadata'=>''
											)
										);
		$this->adminInnerView('admin/add_product', $this->data);
	}
	// check product availability
	public function check_product_unique()
	{
		$pname = $_POST['pname'];
		
		if(isset($_POST['product_id']))
		{
			$product_id   = $_POST['product_id'];
			$select = '*';
			$table  = 'products';
			$where = array('product_id !='=> $product_id, 'product_name'=>$pname);

		}
		else
		{
			$select = '*';
			$table  = 'products';
			$where = array('product_name'=>$pname);
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
	// product listing
	public function product()
	{
		$this->data['headerData'] = array('headerData'=> array('title'=>'Admin ::Product list','metadata'=>''));
		$this->adminInnerView('admin/product_list', $this->data);
	}
	// product list by jquery data table
	public function get_product_list_for_data_table()
	{
		$result = $this->AdminModel->get_product_for_datatable($this->input->get());
		$output = $result['output'];
		$list = $result['result'];
		$products = array();
		foreach($list as $product){
			$tmparr = array();
			$tmparr['allcheck'] 	=  '<input type="checkbox" name="row_sel[]" class="case" value="'. $product->product_id .'">';
			$tmparr['id'] 		=  $product->product_id;
			$tmparr['product'] 		=  $product->product_name;
			$tmparr['category'] 	=  $product->category_name;
			$tmparr['price'] 		=  $product->product_price;
			$tmparr['quantity'] 	=  $product->product_stock;
			$create_date 			= date('Y-m-d H:i A', strtotime($product->cretae_time));
			$tmparr['createdDate'] 	= $create_date;
			
			if($product->product_status=='0'){
				$tmparr['status'] = '<a id="sts_' . $product->product_status . '_cmid_'. $product->product_id .'" class="tooltips cmnty user_' . $product->product_id . '" href="javascript:void(0)" data-original-title="Make Active" rel="tooltip" data-placement="top" title=""><i class="icon-ban-circle"></i> Deactive</a>';
			}
			else
			{
				$tmparr['status'] = '<a  id="sts_' . $product->product_status . '_cmid_'. $product->product_id .'" class="tooltips cmnty user_' .  $product->product_id . '" href="javascript:void(0)" data-original-title="Make Inctive" rel="tooltip" data-placement="top" title=""><i class="icon-ok"></i> Active</a>';
			}
			$tmparr['actions'] = '<a href="'. base_url() .'admin/update_product/'.  $product->product_id .'" class="tooltips" data-original-title="Edit" rel="tooltip" data-placement="top" title=""><i class=" icon-edit"></i></a>
								<a href="javascript:void(0)" data-target="" class="tooltips delete-product" data-original-title="Delete" data-toggle="" data-placement="top" title="" id="'.  $product->product_id .'" ><i class="icon-trash"></i></a>';
		
			$products[] = $tmparr;
		}
		$output['aaData'] = $products;
		echo json_encode($output);
	}
	// update product
	public function update_product($pid=false)
	{
		if(empty($pid) || (!is_numeric($pid)))
		{
			redirect(base_url('admin/product'));
		}
		
		if(isset($_POST['addProduct']))
		{
			$this->form_validation->set_rules('product', 'product name', 'trim|required');
			$this->form_validation->set_rules('product_price', 'product price', 'trim|required');
			$this->form_validation->set_rules('product_price', 'product price', 'trim|required|numeric');
			$this->form_validation->set_rules('product_stock', 'product quantity', 'trim|required|numeric');
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
					'product_name'		=> $_POST['product'],
					'product_url'		=> $this->_clean_string($_POST['product']),
					'product_desc'		=> $_POST['product_desc'],
					'product_cat_id'	=> $_POST['category'],
					'product_price'		=> $_POST['product_price'],
					'product_stock'		=> $_POST['product_stock']
				);
				$where  = array('product_id'=>$pid);
				$update = $this->AdminModel->update_data('products', $updateData, $where);
				// after update data redirect to listing page
				redirect(base_url().'admin/product');
			}
		}

		$this->data['headerData'] = array('headerData'=> array('title'=>'Admin ::Update product','metadata'=>''));
		// for get category
		$cselect = "cat_id, category_name, category_url";
		$ctable	 = "categories";
		$this->data['categories'] = $this->AdminModel->get_all_where($ctable, $cselect);
		
		// get the product detail
		$select = '*';
		$where  = array('product_id'=>$pid);
		$table  = 'products';
		$this->data['product'] = $this->AdminModel->get_all_where($table, $select, $where);
		
		$this->adminInnerView('admin/add_product', $this->data);
	}
	/*
	* Delete product from database
	*/
	public function delete_product()
	{
		$cat_id = $_POST['product_id'];
		$where = array('product_id'=>$cat_id);
		$this->AdminModel->delete_query('products', $where);

		$message = "Product successfully deleted.";
		echo json_encode($message);
	}
}

/* End of file admin.php */