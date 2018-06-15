<?php
namespace Custom\TestApi\Model;
use Custom\TestApi\Api\TestApiInterface;
 
class Hello implements TestApiInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function name($name) {
        return "Hello, " . $name;
    }
    
}
