<?php 

class checkCodeRequest {
    private $code;

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
    function codeValidation () {
        $errors = [];
        if(empty($this->code)) {
            $errors['code-required'] = "<div class='alert alert-danger'> Code is required</div>";
        } else {
            if(!is_numeric($this->code)) {
                $errors['code-numeric'] = "<div class='alert alert-danger'> Code Must be a Number</div>";
            }
            if(strlen($this->code) != 5){
                $errors['code-lentgh'] = "<div class='alert alert-danger'> Wrong Code</div>";
            }
        }
        
        return $errors;

    }

}