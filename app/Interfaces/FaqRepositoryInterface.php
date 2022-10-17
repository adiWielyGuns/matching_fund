<?php

namespace App\Interfaces;

interface FaqRepositoryInterface
{
    public function getAllFaqs();
    public function getIdFaq();
    public function getFaqById($faqId);
    public function deleteFaq($faqId);
    public function createFaq(array $faqDetails);
    public function updateFaq($faqId, array $newDetails);
    public function getFaqWithEloquent($relation);
}
