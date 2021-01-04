<?php
namespace App\Security;

use Exception;

class ForbiddenException extends Exception {
    
    public function error(){
        return 'error 404';
    }
    
}