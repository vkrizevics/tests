<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

trait PostData {
    protected array $postData = [];

    public function readPostData(): static 
    {
        $this->postData = json_decode(file_get_contents("php://input"), true);
    }

    public function getPostData($key, $defaultValue = null)
    {
        return $postData[$key] ?? $defaultValue;
    } 
}