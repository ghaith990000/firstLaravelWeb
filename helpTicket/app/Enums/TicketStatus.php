<?php

namespace App\Enums;

enum TicketStatus {
    case OPEN;
    case RESOLVED;
    case REJECTED;
}