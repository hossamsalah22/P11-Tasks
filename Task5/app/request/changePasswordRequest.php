<?php 

class changePasswordRequest {
    
    private $oldPassword;
    private $newPassword;
    

    /**
     * Get the value of oldPassword
     */ 
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * Set the value of oldPassword
     *
     * @return  self
     */ 
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    /**
     * Get the value of newPassword
     */ 
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @return  self
     */ 
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function checkIfSamePassword()
    {
        $errors = [];
        if($this->newPassword == $this->oldPassword) {
            $errors['new-is-old'] = "<div class='alert alert-danger'> New Password Can't Be The Old Password</div>";
        }
        return $errors;
    }
}