<?php

namespace App\Repositories;

use App\Interfaces\FaqRepositoryInterface;
use App\Models\Faq;

class FaqRepository implements FaqRepositoryInterface
{
    public function getAllFaqs()
    {
        return Faq::all();
    }

    public function getFaqById($scheduleId)
    {
        return Faq::findOrFail($scheduleId);
    }

    public function deleteFaq($scheduleId)
    {
        Faq::destroy($scheduleId);
    }

    public function createFaq(array $scheduleDetails)
    {
        return Faq::create($scheduleDetails);
    }

    public function updateFaq($scheduleId, array $newDetails)
    {
        return Faq::whereId($scheduleId)->update($newDetails);
    }

    public function getIdFaq()
    {
        return Faq::max('id') + 1;
    }

    public function getFaqWithEloquent($relation)
    {
        return Faq::with($relation)->get();
    }
}
