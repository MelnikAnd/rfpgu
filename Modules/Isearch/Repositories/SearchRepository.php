<?php

namespace Modules\Isearch\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface SearchRepository extends BaseRepository
{
    public function whereSearch($searchphrase);

}
