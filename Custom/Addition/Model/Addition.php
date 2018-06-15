<?php
namespace Custom\Addition\Model;
use Custom\Addition\Api\AdditionApiInterface;
 
class Addition implements AdditionApiInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function details($details) {
        return "Total: " . $details;
    }
    
}
