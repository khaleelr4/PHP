<?php
    class HomeModel extends Database{
        // insert the annomnymous user
        public function InsertAnnonymousUser(){
            $this->query("INSERT INTO user_net_address(ip_address, mac_address) VALUES(:ipaddress, :macaddress)");
            $this->bind(":ipaddress", CLIENT_IP_ADDRESS);
            $this->bind(":macaddress", CLIENT_MAC_ADDRESS);
            $this->execute();

            $net_id = $this->GetLastInsertedRowId();

            // insert the network id to the users
            $this->query("INSERT INTO users(net_id) VALUES(:net_id)");
            $this->bind(":net_id", $net_id);
            $this->execute();

            $user_id = $this->GetLastInsertedRowId();

            // update the network id row 
            $this->query("UPDATE user_net_address SET user_id = :userid WHERE id = :netid");
            $this->bind(":userid", $user_id);
            $this->bind(":netid", $net_id);
            return $this->execute();
        }

        // insert the user
        public function InsertUser($name, $email, $password, $phone){
            // insert the network address of the user
            $this->query("INSERT INTO user_net_address(ip_address, mac_address) VALUES(:ipaddress, :macaddress)");
            $this->bind(":ipaddress", CLIENT_IP_ADDRESS);
            $this->bind(":macaddress", CLIENT_MAC_ADDRESS);
            $this->execute();

            $net_id = $this->GetLastInsertedRowId();

            // insert the network id to the users
            $this->query("INSERT INTO users(name, email, password, phone, net_id) VALUES(:name, :email, :password, :phone, :net_id)");
            $this->bind(":name", $name);
            $this->bind(":email", $email);
            $this->bind(":password", $password);
            $this->bind(":phone", $phone);
            $this->bind(":net_id", $net_id);
            $this->execute();

            $user_id = $this->GetLastInsertedRowId();

            // update the network id row 
            $this->query("UPDATE user_net_address SET user_id = :userid WHERE id = :netid");
            $this->bind(":userid", $user_id);
            $this->bind(":netid", $net_id);
            return $this->execute();
        }

        // Get User Based on IP Address
        public function GetAnnonymousUser(){
            $this->query("SELECT * FROM user_net_address WHERE mac_address = :mac_address");
            $this->bind(":mac_address", CLIENT_MAC_ADDRESS);
            return $this->single();
        }

        public function GetAnnonymousUserExistance(){
            $this->query("SELECT * FROM user_net_address WHERE ip_address = :ipaddress AND mac_address = :macaddress");
            $this->bind(":ipaddress", CLIENT_IP_ADDRESS);
            $this->bind(":macaddress", CLIENT_MAC_ADDRESS);
            return $this->single();
        }

        // Update the ip address of the user based on the mac_address
        public function UpdateUserIpAddress($user_id){
            $this->query("INSERT INTO user_net_address(user_id, ip_address, mac_address) VALUES (:userid, :ipaddress, :macaddress)");
            $this->bind(":userid", $user_id);
            $this->bind(":ipaddress", CLIENT_IP_ADDRESS);
            $this->bind(":macaddress", CLIENT_MAC_ADDRESS);
            $this->execute();

            $net_id = $this->GetLastInsertedRowId();

            // update the network id of the user
            $this->query("UPDATE users SET net_id = :netid WHERE id = :userid");
            $this->bind(":netid", $net_id);
            $this->bind(":userid", $user_id);
            $this->execute();
            return $net_id;
        }

        // Get User by id
        public function GetUserById($id){
            $this->query('SELECT * FROM users WHERE id = :id');
            $this->bind(":id", $id);
            return $this->single();
        }
        // get the users based on the email and password
        public function GetUser($email, $password){
            $this->query('SELECT * FROM users WHERE email = :email AND password = :password');
            $this->bind(":email", $email);
            $this->bind(":password", $password);
            return $this->single();
        }

        // Update the IP Address and Mac Address based on the username and password
        public function UpdateLeadUser($network_id, $user_id){
            $this->query("UPDATE users SET net_id = :networkid WHERE id = :userid");
            $this->bind(":networkid", $network_id);
            $this->bind(":userid", $user_id);
            return $this->execute();
        }

        // update lead user credentials
        public function UpdateLeadUserCredentials($net_id, $user_id, $fullname, $email, $password, $phone){
            $this->query("UPDATE users SET name = :fullname, email = :email, password = :password, phone = :phone, net_id = :netid WHERE id = :userid");
            $this->bind(":userid", $user_id);
            $this->bind(":fullname", $fullname);
            $this->bind(":email", $email);
            $this->bind(":password", $password);
            $this->bind(":phone", $phone);
            $this->bind(":netid", $net_id);
            return $this->execute();
        }

        // get the user by email and password
        public function GetUserByEmailPass($email, $password){
            $this->query("SELECT * FROM users WHERE email = :email and password = :password");
            $this->bind(":email", $email);
            $this->bind(":password", $password);
            return $this->single();
        }

        // get the user by email
        public function GetUserByEmail($email){
            $this->query("SELECT * FROM users WHERE email = :email");
            $this->bind(":email", $email);
            return $this->single();
        }

        // get all ayats
        public function GetAllAyats(){
            $this->query("SELECT * FROM ayat");
            return $this->resultSet();
        }

        // get the ayat based on the id
        public function GetAyatById($id){
            $this->query("SELECT * FROM ayat WHERE id = :id");
            $this->bind(":id", $id);
            return $this->single();
        }

        // get the counter data based on the ayatid and userid
        public function GetCounterByData($ayatid, $userid){
            $this->query("SELECT * FROM counter WHERE user_id = :userid AND ayat_id = :ayatid");
            $this->bind(":userid", $userid);
            $this->bind(":ayatid", $ayatid);
            return $this->single();
        }

        // insert the counter data
        public function InsertCounterData($ayatid, $userid, $counter){
            $this->query("INSERT INTO counter(user_id, ayat_id, counts) VALUES (:userid, :ayatid, :count)");
            $this->bind(":userid", $userid);
            $this->bind(":ayatid", $ayatid);
            $this->bind(":count", $counter);
            return $this->execute();
        }

        // update the counter data
        public function UpdateCounterData($ayatid, $userid, $counter){
            $this->query("UPDATE counter SET counts = :count WHERE ayat_id = :ayatid AND user_id = :userid");
            $this->bind(":count", $counter);
            $this->bind(":ayatid", $ayatid);
            $this->bind(":userid", $userid);
            return $this->execute();
        }

        // get all the ayat stats
        public function GetAllAyatStats(){
            $ayat_stat_list = array();
            $ayat_array = $this->GetAllAyats();
            foreach($ayat_array as $ayat){
                $this->query("SELECT SUM(counter.counts) as ayat_counts FROM counter WHERE counter.ayat_id = :ayatid");
                $this->bind(":ayatid", $ayat->id);
                $ayat_count_obj = $this->single();
                array_push($ayat_stat_list, array("id" => $ayat->id, "ayat_name" => $ayat->ayat_name, "ayat_description" => $ayat->ayat_description, "ayat_counts" => $ayat_count_obj));              
            }
            return $ayat_stat_list;
        }

        // get all the ayat stats
        public function GetAllAyatUsersStats($user_id){
            $ayat_stat_list = array();
            $ayat_array = $this->GetAllAyats();
            foreach($ayat_array as $ayat){
                $this->query("SELECT SUM(counter.counts) as ayat_counts FROM counter WHERE counter.ayat_id = :ayatid AND user_id = :user_id");
                $this->bind(":ayatid", $ayat->id);
                $this->bind(":user_id", $user_id);
                $ayat_count_obj = $this->single();
                array_push($ayat_stat_list, array("id" => $ayat->id, "ayat_name" => $ayat->ayat_name, "ayat_description" => $ayat->ayat_description, "ayat_counts" => $ayat_count_obj));              
            }
            return $ayat_stat_list;
        }
    }
?>