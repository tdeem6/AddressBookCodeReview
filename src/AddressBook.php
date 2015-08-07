<?php
    class Contact
    {
          private $name;
          private $phone;
          private $address;

          function __construct($name, $phone, $address)
          {
                $this->name = $name;
                $this->phone = $phone;
                $this->address = $address;
          }

          function worthCalling($name, $phone, $address)
          {
                if (empty($name)) {
                  return $this->name == $name;
                } elseif (empty($phone)) {
                    return $this->phone == $phone;
                } elseif (empty($address)) {
                    return $this->address == $address;
                }
          }

          function setName($new_name)
          {
                $this->name = $name;
          }

          function getName()
          {
                return $this->name;
          }

          function setPhone($new_phone)
          {
                $this->phone = $phone;
          }

          function getPhone()
          {
                return $this->phone;
          }

          function setAddress($new_address)
          {
                $this->address = $address;
          }

          function getAddress()
          {
                return $this->address;
          }

          static function getAll()
          {
              return $_SESSION['allcontacts'];
          }

          function save ()
          {
                array_push($_SESSION['allcontacts'], $this);
          }

          static function deleteAll()
          {
                $_SESSION['allcontacts'] = array();
          }
    }
    ?>
