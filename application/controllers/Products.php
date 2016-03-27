<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {


    public function index() {  // Default method for this controller
        browser();
    }

    public function browser()
    {
        $this->load->model('category');
        $this->load->model('product');
        $this->load->helper('url');
        $categoryMap = $this->category->listAll();
        $currentCategoryId = $this->input->get('Category');
        if (!$currentCategoryId) {
            $currentCategoryId = key($categoryMap);
        }
        $productMap = $this->product->listAll($currentCategoryId);
        $currentProductId = $this->input->get('Product');
        if (!$currentProductId) {
            $currentProductId = key($productMap);
        }
        $product = $this->product->read($currentProductId);
        $title = 'Northwind Products';
        $data = array('categoryMap' => $categoryMap,
                      'productMap'  => $productMap,
                      'product'     => $product,
                      'title'       => 'Northwind Products');
        $data['content'] = $this->load->view(
                      'products/productBrowser',
                      $data, TRUE);
        $this->load->view('templates/master', $data);
    }
}
