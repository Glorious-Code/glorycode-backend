<?php

namespace App\Models;

enum MessageType: string
{
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';
    case INFO = 'information';
}
