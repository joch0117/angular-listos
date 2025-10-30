<?php

namespace App\Enum;

enum BoardType: string
{
    case CHECKLIST = 'checklist';
    case KANBAN = 'kanban';
}