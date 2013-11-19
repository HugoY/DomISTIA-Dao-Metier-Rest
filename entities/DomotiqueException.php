<?php
/**
 * Description of DomotiqueException
 *
 * @author Hugo
 */
class DomotiqueException extends Exception {
    public function __construct($message, $code=NULL){
        parent::__construct($message, $code);
    }
}
