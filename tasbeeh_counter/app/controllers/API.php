<?php
    class API extends Controller{
        private $apiModel;

        private $session_helper;

        // temperorary email and password
        private $emailtemp = 'admin@article.com';
        private $passwordtemp = "articlearc124000";

        public function __construct(){
            $this->apiModel = $this->model("APIModel");
            $this->session_helper = new SessionHelper();
        }

        public function login_admin(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = isset($_POST['email']) ? $_POST['email'] : "";
                $password = isset($_POST['password']) ? md5($_POST['password']) : "";

                if( ($email == $this->emailtemp) && ($password == md5($this->passwordtemp)) ){
                    // set the session helper
                    $this->session_helper->make_session_variable('api_login', true);
                    echo 'valid_credentials';
                    die;
                }else{
                    echo 'invalid_credentials';
                    die;
                }
            }
        }

        public function create_user(){
            if($this->session_helper->is_session_exists('api_login')){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $name = isset($_POST['name']) ? $_POST['name'] : "";
                    $email = isset($_POST['email']) ? $_POST['email'] : "";
                    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
                    $net_id = $this->apiModel->GetNetworkId();
    
                    if(empty($name)){
                        echo 'Please Provide the user name';
                        die;
                    }

                    // verify the email if not empty
                    if(!empty($email)){
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            echo "Please Provide the valid email";
                            die;
                        }
                    }

                    // insert the user
                    $user_id = $this->apiModel->InsertUser($name, $email, $phone, $net_id);

                    // update the user network address
                    $is_created = $this->apiModel->UpdateUserNetworkAddress($user_id, $net_id);

                    if($is_created){
                        echo 'user_created';
                        die;
                    }else{
                        echo 'user_not_created';
                        die;
                    }
                }else{
                    echo 'The Request is invalid';
                }
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function Insert_Counter(){
            if($this->session_helper->is_session_exists('api_login')){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $ayat_id = isset($_POST['ayat_id']) ? $_POST['ayat_id'] : 0;
                    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
                    $counter = isset($_POST['tasbeeh_count']) ? $_POST['tasbeeh_count'] : 0;

                    if($ayat_id == 0){
                        echo 'Please Provide the Ayat Id';
                        die;
                    }

                    if($user_id == 0){
                        echo 'Please Provide the User Id';
                        die;
                    }

                    if($counter <= 0){
                        echo 'Please Provide the Tasbeeh Counter Greater than 0';
                        die;
                    }

                    $is_count_inserted = $this->apiModel->InsertUserCount($user_id, $ayat_id, $counter);
                    
                    if($is_count_inserted){
                        echo 'count_inserted';
                    }else{
                        echo 'count_not_inserted';
                    }
                    die;
                }
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_contacts_list_data(){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    $contact_list_obj = $this->apiModel->GetAllContacts();
                    echo json_encode($contact_list_obj);
                    die;
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_users_list_data(){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    $user_list_obj = $this->apiModel->GetAllUserList();
                    echo json_encode($user_list_obj);
                    die;
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_user_by_id($id){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    if(!empty($id)){
                        $user_obj = $this->apiModel->GetUserById($id);
                        echo json_encode($user_obj);
                        die;
                    }else{
                        echo "user id is not provided";
                    }
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_all_network_profiles(){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    $network_profile_list = $this->apiModel->GetAllNetworkProfiles();
                    echo json_encode($network_profile_list);
                    die;
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_network_profile_by_id($id){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    if(!empty($id)){
                        $network_profile_obj = $this->apiModel->GetNetworkProfileById($id);
                        echo json_encode($network_profile_obj);
                        die;
                    }else{
                        echo 'Network Id is not provided';
                        die;
                    }
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_network_profile_by_userid($userid){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    if(!empty($userid)){
                        $network_profile_list = $this->apiModel->GetNetworkProfileByUserId($userid);
                        echo json_encode($network_profile_list);
                        die;
                    }else{
                        echo 'User Id is not provided';
                        die;
                    }
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_all_ayats(){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    $ayats_list = $this->apiModel->GetAllAyatsList();
                    echo json_encode($ayats_list);
                    die;
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_ayat_by_id($id){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    $ayats_obj = $this->apiModel->GetAyatById($id);
                    echo json_encode($ayats_obj);
                    die;
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_all_ayats_stats(){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    $ayat_stat_list = $this->apiModel->GetAllAyatStats();
                    echo json_encode($ayat_stat_list);
                    die;
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function get_all_user_ayats_count_stats($user_id){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    if(!empty($user_id)){
                        $ayat_stat_list = $this->apiModel->GetAllAyatUsersStats($user_id);
                        echo json_encode($ayat_stat_list);
                        die;
                    }else{
                        echo 'User id not provided';
                        die;
                    }
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function UploadAyat(){
            if($this->session_helper->is_session_exists('api_login')){
                $session_api_login = $this->session_helper->get_session_value('api_login');
                if($session_api_login == true){
                    // check if the method is post
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $ayat_name = isset($_POST['ayat_name']) ? $_POST['ayat_name'] : "";
                        $ayat_description = isset($_POST['ayat_description']) ? $_POST['ayat_description'] : "";
                        $ayat_image_blob = isset($_FILES['ayat_image']) ? file_get_contents($_FILES['ayat_image']['tmp_name']) : "";
                        $ayat_audio_blob = isset($_FILES['ayat_audio']) ? file_get_contents($_FILES['ayat_audio']['tmp_name']) : "";
                        
                        if(empty($ayat_name)){
                            echo 'ayat_name_not_provided';
                            die;
                        }else if(empty($ayat_description)){
                            echo 'ayat_description_not_provided';
                            die;
                        }else if(empty($ayat_image_blob)){
                            echo 'ayat_image_not_provided';
                            die;
                        }else if(empty($ayat_audio_blob)){
                            echo 'ayat_audio_not_provided';
                            die;
                        }

                        // insert the data to the database
                        $is_inserted = $this->apiModel->InsertAyat($ayat_name, $ayat_image_blob, $ayat_audio_blob, $ayat_description);
                        if($is_inserted == 1){
                            echo 'ayat_inserted';
                        }else{
                            echo "ayat_not_inserted";
                        }
                    }else{
                        echo 'invalid_request';
                        die;
                    }
                }    
            }else{
                echo 'no_login_session';
                die;
            }
        }

        public function admin_logout(){
            if($this->session_helper->is_session_exists('api_login')){
                // remove the admin api session
                $this->session_helper->unset_session_variable('api_login');
            }

            echo 'admin_logout';
            die;
        }
    }
?>