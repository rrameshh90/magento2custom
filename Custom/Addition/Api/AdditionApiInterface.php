<?php
namespace Custom\Addition\Api;
 
interface AdditionApiInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function details($details);
    
}
