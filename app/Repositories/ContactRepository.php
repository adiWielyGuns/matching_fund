<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAllContacts()
    {
        return Contact::all();
    }

    public function getContactById($contactId)
    {
        return Contact::findOrFail($contactId);
    }

    public function deleteContact($contactId)
    {
        Contact::destroy($contactId);
    }

    public function createContact(array $contactDetails)
    {
        return Contact::create($contactDetails);
    }

    public function updateContact($contactId, array $newDetails)
    {
        return Contact::whereId($contactId)->update($newDetails);
    }

    public function getIdContact()
    {
        return Contact::max('id') + 1;
    }

    public function getContactWithEloquent($condition, $relation)
    {
        return Contact::max('id') + 1;
    }
}
