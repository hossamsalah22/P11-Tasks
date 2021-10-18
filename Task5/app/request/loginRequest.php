<?php 

class loginRequest {

    private $password;
    private $email;

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }



    public function passwordValidation()
    {
        $errors = [];
        // Pattern to verify Password 
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if (empty($this->password)) {
            $errors['password-required'] = "<div class='alert alert-danger'> Password is required </div>";
        } else {
            if(!preg_match($pattern,$this->password)){
                $errors['password-pattern'] = "<div class='alert alert-danger'> Wrong Data </div>";
            }
        }
        return $errors;
    }
}