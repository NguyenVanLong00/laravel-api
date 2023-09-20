<?php

namespace App\Enums;

enum Permission
{

    /**
     * user
     */
    case VIEW_USER;
    case CREATE_USER;

    /**
     * permisson
     */
    case SA_ROLE;

    /**
     * @return string
     */
    public function pattern(): string
    {
        return 'can:' . $this->name;
    }
}
