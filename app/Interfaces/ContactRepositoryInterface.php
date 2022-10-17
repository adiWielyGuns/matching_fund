<?php

namespace App\Interfaces;

interface ContactRepositoryInterface
{
    public function getAllContacts();
    public function getIdContact();
    public function getContactById($contactId);
    public function deleteContact($contactId);
    public function createContact(array $contactDetails);
    public function updateContact($contactId, array $newDetails);
    public function getContactWithEloquent($condition, $relation);
}
