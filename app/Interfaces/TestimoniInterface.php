<?php

namespace App\Interfaces;

interface TestimoniInterface
{
    public function getAll($type = 'all', $limit = null);
    
    public function getById($id);
    
    public function create($data);
    
    public function update($id, $data);
    
    public function delete($id);
}