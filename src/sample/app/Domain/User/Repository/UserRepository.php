<?php

namespace App\Domain\User\Repository;

use Illuminate\Support\Collection;

interface UserRepository{
    function getUserProgressData() : Collection;
}