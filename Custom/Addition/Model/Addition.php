<?php
namespace NuTech\Addition\Model;
use NuTech\Addition\Api\AdditionApiInterface;
 
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
