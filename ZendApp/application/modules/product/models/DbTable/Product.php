<?php
/**
 * Trucks online Db models
 *
 * @category   models
 * @package    product
 * 
  */

class Product_Model_DbTable_Product extends Zend_Db_Table_Abstract
{

    protected $_name = 'product';
    private function getFrontControllerInstance() : Zend_Controller_Front
    {
        return Zend_Controller_Front::getInstance();
    }

    /**
     * @param string $productid
     * @return array
    */
    
    public function orderDetail($productId):array
    {
        $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );
  
        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $stmt = $db->query("select * from $this->_name WHERE id='$productId'");
        $result = $stmt->fetchAll();
        return $result;
    }


    /**
     * @param int $productId
     * @param string $expectedDeliveryDate
     * @return bool
     */
    public function processOrder(int $productId, string $expectedDeliveryDate):bool
    {
        $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );

        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $data = array('status' => '1');
        $db->update($this->_name, $data, 'id = '.$productId);
        
        $data = array(  'c_id' => "1",
                        'p_id' => $productId,
                        'expected_dilivery_date' => "$expectedDeliveryDate"
                    );

        $db->insert('order_summary', $data);
        return true;
    }

    /**
     * @return array
     */
    public function selectAllProduct():array
    {
        $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );
 
        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $stmt = $db->query("select * from $this->_name");
        $result = $stmt->fetchAll();

        return $result;
    }
}

