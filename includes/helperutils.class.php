<?php

class helperUtils {

    protected $var;

    public function clean_input($var) {
        $this->var = $var;
        $this->var = trim($this->var);
        $this->var = stripslashes($this->var);
        $this->var = htmlspecialchars($this->var);
        return $this->var;
    }

}

?>
