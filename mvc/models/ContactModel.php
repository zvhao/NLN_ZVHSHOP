<?php
class ContactModel extends DB
{
    


    function insertContact($name, $phone, $email, $content, $created_at) {
        $sql = "INSERT INTO contact(name, phone, email, content, created_at) VALUES('$name', '$phone', '$email', '$content', '$created_at')";
        return $this->pdo_execute($sql);
    }

}
