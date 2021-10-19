<?php 

class changeEmailRequest {
    
    private $email;

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
    

    public function checkIfSameEmail()
    {
        $errors = [];
        if($this->email == $_SESSION['user']->email) {
            $errors['new-is-old'] = "<div class='alert alert-danger'> You Entered Your Old Email</div>";
        }
        return $errors;
    }
}