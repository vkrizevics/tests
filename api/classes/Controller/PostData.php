<?php
namespace Api\Classes\Controller;

/**
 * Traits, kas nolasa POST pieprasījumu ievaddatos, kurus React ir padevis tam ērtajā veidā
 */
trait PostData {
    /**
     * Decodēts JSON no pieprasījuma
     */
    protected array $postData = [];

    /**
     * Obligāti jāizsauc pirms getPostData, lai noparsētu ievaddatus pirms tiem varētu piekļūt
     */
    public function readPostData(): static 
    {
        $this->postData = json_decode(file_get_contents("php://input"), true);

        return $this;
    }

    /**
     * Sākumā izsauc readPostData, citādi vienmēr dabūsi tikai $defaultValue
     */
    public function getPostData($key, $defaultValue = null)
    {
        return strip_tags($this->postData[$key] ?? $defaultValue);
    } 
}