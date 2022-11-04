<?php
    class APIModel extends Database{
        public function GetAllContacts(){
            $this->query("SELECT * FROM `contact`");
            return $this->resultSet();
        }

        public function GetAllUserList(){
            $this->query("SELECT * FROM `users`");
            return $this->resultSet();
        }

        public function GetUserById($id){
            $this->query("SELECT * FROM users WHERE id = :id");
            $this->bind(":id", $id);
            return $this->single();
        }

        public function GetAllNetworkProfiles(){
            $this->query("SELECT * FROM user_net_address");
            return $this->resultSet();
        }

        public function GetNetworkProfileById($id){
            $this->query("SELECT * FROM user_net_address WHERE id = :id");
            $this->bind(":id", $id);
            return $this->single();
        }

        public function GetNetworkProfileByUserId($userid){
            $this->query("SELECT * FROM user_net_address WHERE user_id = :userid");
            $this->bind(":userid", $userid);
            return $this->resultSet();
        }

        public function GetAllAyatsList(){
            $this->query("SELECT * FROM `ayat`");
            return $this->resultSet();
        }

        public function GetAyatById($id){
            $this->query("SELECT * FROM ayat WHERE id = :id");
            $this->bind(":id", $id);
            return $this->single();
        }

        public function GetAllAyatStats(){
            $ayat_stats_list = array();
            $ayat_array = $this->GetAllAyatsList();
            foreach($ayat_array as $ayat){
                $this->query("SELECT SUM(counter.counts) as ayat_counts FROM counter WHERE counter.ayat_id = :ayatid");
                $this->bind(":ayatid", $ayat->id);
                $ayat_count_obj = $this->single();
                array_push($ayat_stats_list, array("id" => $ayat->id, "ayat_name" => $ayat->ayat_name, "ayat_description" => $ayat->ayat_description, "ayat_counts" => $ayat_count_obj));
            }
            return $ayat_stats_list;
        }

        public function GetAllAyatUsersStats($user_id){
            $ayat_stat_list = array();
            $ayat_array = $this->GetAllAyatsList();
            foreach($ayat_array as $ayat){
                $this->query("SELECT SUM(counter.counts) as ayat_counts FROM counter WHERE counter.ayat_id = :ayatid AND user_id = :user_id");
                $this->bind(":ayatid", $ayat->id);
                $this->bind(":user_id", $user_id);
                $ayat_count_obj = $this->single();
                array_push($ayat_stat_list, array("id" => $ayat->id, "ayat_name" => $ayat->ayat_name, "ayat_description" => $ayat->ayat_description, "ayat_counts" => $ayat_count_obj));              
            }
            return $ayat_stat_list;
        }

        public function InsertAyat($ayat_name, $ayat_image_blob, $ayat_audio_blob, $ayat_description){
            $this->query("INSERT INTO ayat(ayat_name, ayat_image, ayat_audio, ayat_description) VALUES (:ayatname, :ayatimage, :ayataudio, :ayatdescription)");
            $this->bind(":ayatname", $ayat_name);
            $this->bind(":ayatimage", $ayat_image_blob);
            $this->bind(":ayataudio", $ayat_audio_blob);
            $this->bind(":ayatdescription", $ayat_description);
            return $this->execute();
        }

        public function GetNetworkObj(){
            $this->query("SELECT * FROM user_net_address WHERE ip_address = :ipaddress AND mac_address = :macaddress");
            $this->bind(":ipaddress", CLIENT_IP_ADDRESS);
            $this->bind(":macaddress", CLIENT_MAC_ADDRESS);
            return $this->single();
        }

        public function GetNetworkId(){
            $net_obj = $this->GetNetworkObj();
            if(!$net_obj){
                $this->query("INSERT INTO user_net_address(ip_address, mac_address) VALUES (:ipaddress, :macaddress)");
                $this->bind(":ipaddress", CLIENT_IP_ADDRESS);
                $this->bind(":macaddress", CLIENT_MAC_ADDRESS);
                $this->execute();

                $net_id = $this->GetLastInsertedRowId();
                return $net_id;
            }else{
                return $net_obj->id;
            }
        }

        public function InsertUser($name, $email, $phone, $net_id){
            $this->query("INSERT INTO users(name, email, phone, net_id) VALUES (:name, :email, :phone, :netid)");
            $this->bind(":name", $name);
            $this->bind(":email", $email);
            $this->bind(":phone", $phone);
            $this->bind(":netid", $net_id);
            $this->execute();

            $user_id = $this->GetLastInsertedRowId();
            return $user_id;
        }

        public function UpdateUserNetworkAddress($user_id, $net_id){
            $this->query("UPDATE user_net_address SET user_id = :userid WHERE id = :netid");
            $this->bind(":userid", $user_id);
            $this->bind(":netid", $net_id);
            return $this->execute();
        }

        public function InsertUserCount($user_id, $ayat_id, $tasbeeh_count){
            $this->query("INSERT INTO counter(user_id, ayat_id, counts) VALUES (:userid, :ayatid, :counter)");
            $this->bind(":userid", $user_id);
            $this->bind(":ayatid", $ayat_id);
            $this->bind(":counter", $tasbeeh_count);
            return $this->execute();
        }
    }
?>