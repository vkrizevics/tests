<?php
namespace Api\Classes\Controller;

/**
 * Traits, kas nolasa POST pieprasījumu ievaddatus, kurus React ir padevis tam ērtajā veidā
 */
trait PostData {
    /**
     * Decodēts JSON no pieprasījuma
     * 
     * @var array
     */
    protected array $postData = [];

    /**
     * Obligāti jāizsauc pirms getPostData, lai noparsētu ievaddatus pirms tiem varētu piekļūt
     * 
     * @return $this
     */
    public function readPostData(): static 
    {
        $this->postData = json_decode(file_get_contents("php://input"), true);

        return $this;
    }

    /**
     * Sākumā izsauc readPostData, citādi vienmēr dabūsi tikai $defaultValue
     * 
     * @param string $key
     * @param mixed|null $defaultValue
     * 
     * @return string
     */
    public function getPostData(string $key, $defaultValue = null): string
    {
        return strip_tags($this->postData[$key] ?? $defaultValue);
    } 
}