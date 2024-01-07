<?php 


 class Staff extends RabbitORM\Model {
    const StaffDefinition = '{"name": "staff", "table": "staff"}';
    private $ID; 
    const idDefinition = '{"name": "id", "id":"id"}';
    private $EMPLOYEE_ID; 
    private $USERNAME; 
    private $PASSWORD; 
    private $ARIA; 
    private $PERIOD_BEGIN; 
    private $PERIOD_END; 
    private $DATE_STARTS; 
    private $DATE_UPDATE; 
    private $USER_STARTS; 
    private $USER_UPDATE; 
    private $VERIFY; 
    private $STATUS; 
    // private $ID; 
    // private $ID; 
    // private $ID; 

    // public function __construct()
    // {
    //     parent::__construct();
    // }

}