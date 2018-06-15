<?php
namespace NuTech\TestApi\Api;
 
interface TestApiInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function name($name);
    
}
