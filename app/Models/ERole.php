<?php

namespace App\Models;

enum ERole: string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';
    case COMPANY_OWNER = 'company_owner';
    case RECRUITER = 'recruiter';
    case COMPANY_EMPLOYEE = 'company_employee';
    case STUDENT = 'student';
    case TUTOR = 'tutor';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::MODERATOR => 'Moderator',
            self::USER => 'User',
            self::COMPANY_OWNER => 'Company Owner',
            self::COMPANY_EMPLOYEE => 'Company Employee',
            self::RECRUITER => 'Recruiter',
            self::STUDENT => 'Student',
            self::TUTOR => 'Tutor'
        };
    }
}
