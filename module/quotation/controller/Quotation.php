<?php


class Quotation
{
    use loader;


    public $user;
    public $quotation_id;
    public $rurl;
    public $db;

    public function __construct($user_id = NULL)
    {
       // loading this model
        //$this->loadModel(get_class($this));
       // Calling another controller
        //$this->loadController("Users");
        // $this->user= new Users();


    }

    /**
     * @param $data
     * @return array
     *  Desc: Validation check and saving free trial quotation
     */
    public function freeTrialQuotationAdd($data)
    {
        $user_data = array();
        $user_data['client_name'] = $account = sanitize_text_field($_POST['client_name']);
        $account = $user_data['client_email'] = sanitize_email($_POST['client_email']);
        $user_data['user_password'] = $_POST['password'];
        $user_data['find_us'] = sanitize_text_field($_POST['findus']);
        $user_data['terms'] = (isset($_POST['terms']) && !empty($_POST['terms'])) ? $_POST['terms'] : false;

        if (empty($account)) {
            $error = 'Enter an username or e-mail address.';
        } else {
            if (is_email($account)) {
                if (email_exists($account)) {
                    $get_by = 'email';
                    $exists_user_id = get_user_by( 'email', $account );
                } else {
                    $exists_user_id = false;
                }
            } else if (validate_username($account)) {
                if (username_exists($account))
                    $exists_user_id = get_user_by( 'email', $account );
                else
                    $exists_user_id = false;
            } else
                $error = 'Invalid username or e-mail address.';
        }


        if ($error) {
            $data = array("abc" => $data);
            $data['message'] = $error;
            $data['error'] = true;
            $data['success'] = false;
        } else {

            if (class_exists('Users')) {

                // Add currency
                $users = new Users();

                if( !$exists_user_id){
                    $sign_up_data = $users->user_signup($user_data);
                    if (is_int($sign_up_data)) {
                        $this->user_id = $sign_up_data;
                    }
                }

                if($this->processQuotationRequirements($data)){
                    $data['message'] = 'Your Quotation have been submited';
                    $data['error'] = false;
                    $data['success'] = true;
                }else{
                    $data['message'] = 'There is something going wrong with free trial "freeTrialQuotationAdd." function';
                    $data['error'] = true;
                    $data['success'] = false;
                }

            } else {
                $data['message'] = 'There is something going wrong try again or contact us.';
                $data['error'] = true;
                $data['success'] = false;
            }

        }

        return $data;

    }

    /**
     * @Author: Shah Alam
     * save customer's quotation into quotation table and update vendor table for next quotaion number
     */

    public function insertQuotation()
    {

        $this->quotation_id = $this->getlastQuotation();


        $newquotationNumber = 'CPI-Q-' . (substr(strrchr($this->quotation_id, "-"), 1) + 1);

        $vendorData = array("next_quotation_no" => $newquotationNumber);


        $data = array();

        $data['vendor'] = 'CPI';

        $data['potential_client_id'] = $this->potential_client_id;


        $data['user_id'] = $this->user_id;


        $data['billing_name'] = sanitize_text_field($_POST['client_name']);

        $data['quotation_no'] = $this->quotation_id;

        $data['quotation_date'] = strtotime(date('Y-m-d H:i:s'));

        $data['create_date'] = date('Y-m-d H:i:s');

        $data['modify_date'] = date('Y-m-d H:i:s');

        $data['status'] = 'Pending';


        $data['sizing'] = sanitize_text_field($_POST['sizing']);

        $data['quantity'] = sanitize_text_field($_POST['quantity']);

        $data['yearly_quantity'] = sanitize_text_field($_POST['yearlyImgEdit']);

        $data['quotation_details'] = sanitize_text_field($_POST['quotation_details']);

        $filepath = "";//$this->loadHelper('path');

        $data['image_folder'] = $filepath . session_id(). "_" . date("Y-m-d");//sanitize_text_field($_POST['quoteImgfolder']);

        if(isset($_POST['sizing']) && ($_POST['sizing']=='r')){

            if (isset($_POST['width']) && ($_POST['width'] != '')) {

                $data['width'] = sanitize_text_field($_POST['width']);

            }

            if (isset($_POST['height']) && ($_POST['height'] != '')) {

                $data['height'] = sanitize_text_field($_POST['height']);

            }


            if (isset($_POST['sizing_margin']) && ($_POST['sizing_margin'] != '')) {

                $data['margin'] = sanitize_text_field($_POST['sizing_margin']);

            }

            if (isset($_POST['resizeMarginType']) && ($_POST['resizeMarginType'] != '')) {

                $data['marginType'] = sanitize_text_field($_POST['resizeMarginType']);

            }

        }elseif(isset($_POST['sizing']) && ($_POST['sizing']=='o')){

            if (isset($_POST['original_margin']) && ($_POST['original_margin'] != '')) {

                $data['margin'] = sanitize_text_field($_POST['original_margin']);

            }

            if (isset($_POST['orginalMarginType']) && ($_POST['orginalMarginType'] != '')) {

                $data['marginType'] = sanitize_text_field($_POST['orginalMarginType']);

            }

        }


        $inserted_quotation = $this->db->insert(CMP_QUOTATION_TABLE, $data);



        if (is_wp_error($inserted_quotation)) {

            return $inserted_quotation->get_error_message();
        } else {

            unset($_SESSION["jod_folder"]);
            session_destroy();
            session_start();
            session_regenerate_id();
            $updated_vendor = $this->db->update(CMP_VENDOR_TABLE, $vendorData, array('vendor' => 'CPI'));

            if (is_wp_error($updated_vendor)) {
                return $updated_vendor->get_error_message();
            } else {
                return $updated_vendor;
            }
        }

    }

    /**
     * @param int $userid
     * @return array
     * Desc: a test function
     */
    public function getTemplate($id=0){

		$this->loadView('test',array('test'=>'ttttttt'));
	   }



}

