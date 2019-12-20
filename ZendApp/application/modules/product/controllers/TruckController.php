<?php

/**
 * Controller : RegistrationController
 * 
 */

class Product_TruckController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {        
        // action body

    }

    public function listAction()
    {
        $productDetail = new Product_Model_DbTable_Product();
        $result = $productDetail->selectAllProduct();
        $this->view->inventory = $result;
    }

    public function ordersummaryAction(){
        $prodcutId = $this->_getParam('prod_id');
        if(isset($prodcutId)){
            $productDetail = new Product_Model_DbTable_Product();
            $result = $productDetail->orderDetail($prodcutId);
            $this->view->resultCount = count($result);
            $this->view->details = $result;

        }
        else{
                echo "Order symmary  failed";
        }   
    }
    public function orderprocessAction()
    {
        $productId = $this->_getParam('prod_id');
     
        if(isset($productId)){
            $product = new Product_Model_DbTable_Product();
            $productDetail = $product->orderDetail($productId)[0];

             if($productDetail['status'] == '0'){
                $expectedDeliveryDate = date('Y-m-d',strtotime(' + 6 days'));
                $status = $product->processOrder($productId,$expectedDeliveryDate);
                if($status==true){
                    $this->view->status ='1';
                    $this->view->message = "Order Placed Successfully";
                }
                else{
                    $this->view->status = '0';
                    $this->view->message = "Failed to place order";
                }
            }
            else{
                $this->view->status = '0';
                $this->view->message = "Already Sold";
            }
        }
        else{
            $this->view->status = '0';
            $this->view->message = "Failed to place order1";
        }   
    }

    /**
     *  
     */
    public function emailAction()
    {
    }

}

