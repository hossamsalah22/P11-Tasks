<?php

require_once __DIR__ . "\..\database\models\User.php";

class registerRequest
{
    private $email;
    private $password;
    private $confirmPassword;
    private $phone;
    private $first_name;
    private $last_name;
    private $gender;
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
     * Get the value of confirmPassword
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of confirmPassword
     *
     * @return  self
     */
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }


    public function emailValidation()
    {
        $errors = [];
        // Pattern to verify email addresses
        $pattern = "/^[0-9a-zA-Z]+([0-9a-zA-Z]*[-._+])*[0-9a-zA-Z]+@[0-9a-zA-Z]+([-.][0-9a-zA-Z]+)*([0-9a-zA-Z]*[.])[a-zA-Z]{2,6}$/";
        if (empty($this->email)) {
            $errors['email-required'] = "<div class='alert alert-danger'> Email is required </div>";
        } else {
            // check the Pattern to verify email addresses
            if (!preg_match($pattern, $this->email)) {
                $errors['email-pattern'] = "<div class='alert alert-danger'> Email is Invalid </div>";
            }
        }
        return $errors;
    }

    public function passwordValidation()
    {
        $errors = [];
        // Pattern to verify Password 
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if (empty($this->password)) {
            $errors['password-required'] = "<div class='alert alert-danger'> Password is required </div>";
        }
        if (empty($this->confirmPassword)) {
            $errors['confirmPassword-required'] = "<div class='alert alert-danger'> Confirm Password is required </div>";
        }

        if (empty($errors)) {
            if ($this->password !== $this->confirmPassword) {
                $errors['password-confirm'] = "<div class='alert alert-danger'> Password Does not match </div>";
            }
            if (!preg_match($pattern, $this->password)) {
                $errors['password-pattern'] = "<div class='alert alert-danger'> Password must be Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character </div>";
            }
        }
        return $errors;
    }

    public function emailExists()
    {
        $errors = [];
        $userObject = new User;
        $userObject->setEmail($this->email);
        $result = $userObject->checkifEmailExists();
        if ($result) {
            $errors['email-unique'] = "<div class='alert alert-danger'> Email is Allready exists </div>";
        }
        return $errors;
    }


    public function phoneValidation()
    {
        $errors = [];
        // Egypt's PhoneNumber Pattern
        $pattern = "/^01[0-2,5]{1}[0-9]{8}$/";
        if(empty($this->phone)) {
            $errors["phone-required"] = "<div class='alert alert-danger'> Phone Number is required</div>";
        }
        if(empty($errors)) {
            if(!preg_match($pattern,$this->phone)) {
                $errors["phone-pattern"] = "<div class='alert alert-danger'> Phone Number is invalid</div>";
            }
        }
        return $errors;
    }

    public function phoneExists()
    {
        $errors = [];
        $phoneObject = new User;
        $phoneObject->setPhone($this->phone);
        $result = $phoneObject->checkIfPhoneExists();
        if($result) {
            $errors["phone-unique"] = "<div class='alert alert-danger'> Phone Number is Allready Exist</div>";
        }
        return $errors;
    }

    // Check Username Validation
    public function firstNameValidation()
    {
        $errors = [];
        if(empty($this->first_name)) {
            $errors['first_name-required'] = "<div class='alert alert-danger'> First Name Is required</div>";
        }
        return $errors;
    }
    public function lastNameValidation()
    {
        $errors = [];
        if(empty($this->last_name)) {
            $errors['last_name-required'] = "<div class='alert alert-danger'> Last Name Is required</div>";
        }
        return $errors;
    }
    public function genderValidation()
    {
        $errors = [];
        if(empty($this->gender)) {
            $errors['gender-required'] = "<div class='alert alert-danger'> Please Select Your Gender</div>";
        }
        return $errors;
    }
}
