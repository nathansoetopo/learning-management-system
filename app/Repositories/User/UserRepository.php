<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository{

    public function getProfile($id);
    public function userClass($master_class_id, $class_id);
    public function update($id, array $request);
}
