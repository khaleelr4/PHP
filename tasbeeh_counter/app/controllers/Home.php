<?php
    class Home extends Controller{
        private $homeModel;

        public function __construct(){
            $this->homeModel = $this->model("HomeModel");
        }

        // call home view
        public function index(){
            $data = ['view' => 'Home'];
            // if the user exits
            $annonymous_user = $this->homeModel->GetAnnonymousUser();
            if(!$annonymous_user){
                // insert the annonymous user 
                $is_inserted = $this->homeModel->InsertAnnonymousUser();
            }else{
                // update the annonymous user ip address
                $user_existance_obj = $this->homeModel->GetAnnonymousUserExistance();
                if(!$user_existance_obj){
                    // get the user
                    $is_updated = $this->homeModel->UpdateUserIpAddress($annonymous_user->user_id);
                }else{
                    // update the netid of the user
                    $is_updated = $this->homeModel->UpdateLeadUser($user_existance_obj->id, $annonymous_user->user_id);
                }
            }

            // add the user to the session
            $session_helper = new SessionHelper();
            $session_helper->make_session_variable("annonymous_user_object", $annonymous_user);

            // fetch all the ayats
            $array_ayats = array("ayat_array" => $this->homeModel->GetAllAyats());
            array_push($data, $array_ayats);
            $this->view("home/index", $data);
        }

        public function stats(){
            $data = ['view' => 'Stats'];
            // get all the ayat stats
            $ayat_stats_list = $this->homeModel->GetAllAyatStats();
            array_push($data, $ayat_stats_list);
            $this->view("home/stats", $data);
        }

        public function user_stats(){
            $data = ['view' => 'User Stats'];
            // add the user to the session
            $session_helper = new SessionHelper();
            // if the user is logged in
            if($session_helper->is_session_exists("user_object")){
                $user_obj = $session_helper->get_session_value("user_object");
                // get all the ayat stats
                $ayat_stats_list = $this->homeModel->GetAllAyatUsersStats($user_obj->id);
                array_push($data, $ayat_stats_list);
                $this->view("home/userstats", $data);
            }else{
                header("Location:" . URLROOT);
            }
        }

        public function GetAllStatsResponse(){
            $ayat_stats_list = $this->homeModel->GetAllAyatStats();
            echo json_encode($ayat_stats_list);
            die;
        }

        public function GetAllStatsUserResponse(){
            // add the user to the session
            $session_helper = new SessionHelper();
            if($session_helper->is_session_exists("user_object")){
                $user_obj = $session_helper->get_session_value("user_object");
                // get all the ayat stats
                $ayat_stats_list = $this->homeModel->GetAllAyatUsersStats($user_obj->id);
                echo json_encode($ayat_stats_list);
                die;
            }else{
                echo 'invalid_request';
                die;
            }
        }

        public function GetAyatDataById(){
            // check if the id is set
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                $ayat_obj = $this->homeModel->GetAyatById($id);
                echo json_encode(array("id" => $ayat_obj->id, "name" => $ayat_obj->ayat_name, "description" => $ayat_obj->ayat_description, "image" => base64_encode($ayat_obj->ayat_image), "audio" => base64_encode($ayat_obj->ayat_audio)));
                die;
            }else{
                echo 'invalid_params';
            }
        }

        public function SendAyatData(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // set the session of the login
                $session_helper = new SessionHelper();
                // check if the ayatid and userid is set
                if(isset($_POST['ayatid']) && ($session_helper->is_session_exists("user_object") || $session_helper->is_session_exists("annonymous_user_object")) && isset($_POST['counter_data'])){
                    // init the userid
                    $userid = $session_helper->is_session_exists("user_object") ? $session_helper->get_session_value("user_object")->id : $session_helper->get_session_value("annonymous_user_object")->user_id;
                    // init the ayatid
                    $ayatid = $_POST['ayatid'];
                    // init the counter data 
                    $counter = $_POST['counter_data'];

                    $is_success = null;

                    // if the counter data exists
                    if($this->homeModel->GetCounterByData($ayatid, $userid)){
                        $is_success = $this->homeModel->UpdateCounterData($ayatid, $userid, $counter);
                    }else{
                        // insert the counter data
                        $is_success = $this->homeModel->InsertCounterData($ayatid, $userid, $counter);
                    }

                    echo $is_success != null ? "success" : "failed";
                }else{
                    echo "invalid_params";
                }
            }else{
                echo 'invalid_request';
            }
        }

        public function GetAyatData(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // set the session of the login
                $session_helper = new SessionHelper();
                // check if the ayatid and userid is set
                if(isset($_POST['ayatid']) && ($session_helper->is_session_exists("user_object") || $session_helper->is_session_exists("annonymous_user_object"))){
                    // init the userid
                    $userid = $session_helper->is_session_exists("user_object") ? $session_helper->get_session_value("user_object")->id : $session_helper->get_session_value("annonymous_user_object")->user_id;
                    // init the ayatid
                    $ayatid = $_POST['ayatid'];

                    $count_obj = $this->homeModel->GetCounterByData($ayatid, $userid);
                    echo json_encode($count_obj);
                }else{
                    echo "invalid_params";
                }
            }else{
                echo 'invalid_request';
            }
        }

        // call registration
        public function register(){
            $data = ['view' => 'Sign Up'];
            $this->view("home/registration", $data);
        }

        // submit registration
        public function SubmitRegister(){
            // if the method is of the post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $fullname = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];

                if(empty($fullname) || empty($email) || empty($password) || empty($phone)){
                    echo "not_enough_params_received";
                    die;
                }

                // validate the email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "invalid_email_provided";
                    die;
                }

                // check if the email already exists
                if($this->homeModel->GetUserByEmail($email)){
                   echo 'email_already_exists';
                   die; 
                }

                // if the user exists
                $annonymous_user = $this->homeModel->GetAnnonymousUser();
                // encrypt the password
                $password = md5($password);
                if(!$annonymous_user){
                    // insert the user
                    $is_inserted = $this->homeModel->InsertUser($fullname, $email, $password, $phone);
                    if($is_inserted){
                        echo 'user_inserted';
                    }else{
                        echo 'user_not_inserted';
                    }
                }else{
                    // update the user
                    $net_id = 0;
                    $net_obj = $this->homeModel->GetAnnonymousUserExistance();

                    if(!$net_obj){
                        // update the user network address
                        $net_id = $this->homeModel->UpdateUserIpAddress($annonymous_user->user_id);
                    }else{
                        $net_id = $net_obj->id;
                    }
                    
                    $user_obj_obtained = $this->homeModel->GetUserById($annonymous_user->user_id);
                    if(empty($user_obj_obtained->name) && empty($user_obj_obtained->email) && empty($user_obj_obtained->password) && empty($user_obj_obtained->phone)){
                        $is_updated = $this->homeModel->UpdateLeadUserCredentials($net_id, $annonymous_user->user_id, $fullname, $email, $password, $phone);
                        if($is_updated){
                            echo 'user_updated';
                        }else{
                            echo 'user_not_updated';
                        }
                    }else{
                        // update the netid of the user
                        $this->homeModel->UpdateLeadUser($net_id, $annonymous_user->user_id);
                        echo 'cross_device_register';
                    }
                }
            }else{
                echo 'invalid_request';
            }
        }

        // login function 
        public function SubmitLogin(){
            // if the method is of the post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = $_POST['email'];
                $password = $_POST['password'];

                // check if the email or password are empty
                if(empty($email) || empty($password)){
                    echo 'params_missing';
                    die;
                }

                $password = md5($password);
                // get the user
                $user_obj = $this->homeModel->GetUserByEmailPass($email, $password);
                if($user_obj){
                    $network_id = 0;
                    $network_obj = $this->homeModel->GetAnnonymousUserExistance();
                    // if the network address doesn't exists
                    if(!$network_obj){
                        $network_id = UpdateUserIpAddress($user_obj->id);
                    }else{
                        $network_id = $network_obj->id;
                        $this->homeModel->UpdateLeadUser($network_id, $user_obj->id);
                    }
                    // set the session of the login
                    $session_helper = new SessionHelper();
                    // set the user object to the session
                    $session_helper->make_session_variable('user_object', $user_obj);
                    // response to the user
                    echo 'login_success';
                }else{
                    echo 'login_credentials_invalid';
                }
            }else{
                echo 'invalid_request';
                die;
            }
        }

        // logout function
        public function logout(){
            // init the sessino helper
            $session_helper = new SessionHelper();
            // destroy the whole session
            $session_helper->remove_all_session_variables();
            $session_helper->destroy_session();
            // redirect to the home page
            header("Location: " . URLROOT);
        }
    }
?>