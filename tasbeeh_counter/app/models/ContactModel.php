<?php
    class ContactModel extends Database{
        public function InsertContact($name, $email, $phone, $message){
            $this->query('INSERT INTO `contact`(name, email, phone, message) VALUES (:name, :email, :phone, :message)');
            $this->bind(":name", $name);
            $this->bind(":email", $email);
            $this->bind(":phone", $phone);
            $this->bind(":message", $message);
            return $this->execute();
        }
    }
?>