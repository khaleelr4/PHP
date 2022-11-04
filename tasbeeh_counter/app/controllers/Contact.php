<?php
    class Contact extends Controller{
        private $contactModel;

        public function __construct(){
            $this->contactModel = $this->model("ContactModel");
        }

        // call the default view
        public function index(){
            $data = ['view' => 'Contact'];
            $this->view("contact/index", $data);
        }

        // make a function that takes the contact information
        public function SubmitContactData(){
            // check if the method is post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // get all the params
                $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : "";
                $email = isset($_POST['email']) ? $_POST['email'] : "";
                $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
                $message = isset($_POST['message']) ? $_POST['message'] : "";

                // if any provided value is empty response empty
                if(empty($fullname) || empty($email) || empty($phone) || empty($message)){
                    echo "incomplete_params";
                    die;
                }else{
                    // validate the email of the user
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        echo "invalid_email";
                        die;
                    }else{
                        // submit to the form 
                        $is_contact_inserted = $this->contactModel->InsertContact($fullname, $email, $phone, $message);
                        // if the contact is inserted
                        if($is_contact_inserted){
                            echo "contact_inserted";
                        }else{
                            echo "contact_insertion_fail";
                        }
                    }
                }
            }else{
                echo "invalid_request";
                die;
            }
        }
    }
?>