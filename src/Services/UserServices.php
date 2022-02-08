<?php

namespace App\Services;

use Exception;

class UserServices
{
    private $id;
    private $firstName;
    private $lastName;
    private $users;

    public function __construct(int $id=0)
    {
        $this->users = $this->loadDbUsers();
        $this->id = $id;

        if (!$this->isValidId()) {
            throw new Exception("L'ID utilisateur n'existe pas");
        }

        // Chargement des informations utilisateur
        $this->getUserInfo();
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    private function getUserInfo()
    {
        $this->setFirstName($this->users[$this->id]['firstName']);
        $this->setLastName($this->users[$this->id]['lastName']);
    }

    private function loadDbUsers()
    {
        $this->users[0] = ['firstName' => 'Guest', 'lastName' => 'Guest'];
        $this->users[1] = ['firstName' => 'Xavier', 'lastName' => 'Le Gal'];
        $this->users[2] = ['firstName' => 'Michel', 'lastName' => 'Bichara'];
        $this->users[3] = ['firstName' => 'Serge', 'lastName' => 'Robinson'];

        return $this->users;
    }

    public function isValidId()
    {
        return array_key_exists($this->id, $this->users);
    }
}
