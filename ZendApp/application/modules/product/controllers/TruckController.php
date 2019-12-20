<?php

/**
 * @controller RegistrationController
 */

class Product_TruckController extends Zend_Controller_Action
{
    private $product;

    /**
     * @param string $thsdf
     * @return array
     */
    public function getProductModel(): Product_Model_DbTable_Product
    {
        if (!$this->product) {
            $this->product = new Product_Model_DbTable_Product();
        }

        return $this->product;
    }

    public function setProductModel(Product_Model_DbTable_Product $product)
    {
            $this->product = $product;
    }

    public function listAction()
    {
        $productDetail = SELF::getProductModel();
        $result = $productDetail->selectAllProduct();
        $this->view->inventory = $result;
    }

     /**
     * @route product/truck/ordersummary/prod_id/<<prod_id>>
     * @method GET
     * 
     * Display summary information of product
     *
     * If any exception, 500 will be returned
     * 
     * @return void
     */

    public function ordersummaryAction(){
        $productId = $this->_getParam('prod_id');
        if(isset($productId)){
            $productDetail = SELF::getProductModel();
            $result = $productDetail->orderDetail($productId);
            $this->view->resultCount = count($result);
            $this->view->details = $result;

        }
        else{
                echo "Order symmary  failed";
        }   
    }

     /**
     * @route product/truck/orderprocess/prod_id/<<prod_id>>
     * @method GET
     * 
     * Process order
     *
     * If any exception, 500 will be returned
     * 
     * @return void
     */
    
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
                } else{
                    $this->view->status = '0';
                    $this->view->message = "Failed to place order";
                }
            } else{
                $this->view->status = '0';
                $this->view->message = "Already Sold";
            }
        } else{
            $this->view->status = '0';
            $this->view->message = "Failed to place order1";
        }   
    }
}
