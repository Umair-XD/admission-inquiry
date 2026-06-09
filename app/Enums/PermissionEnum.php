<?php

declare(strict_types=1);

namespace App\Enums;

class PermissionEnum
{
    // Dashboard
    public const DASHBOARD_VIEW = 'dashboard.view';

    // Faculty
    public const FACULTY_VIEW   = 'faculty.view';
    public const FACULTY_CREATE = 'faculty.create';
    public const FACULTY_EDIT   = 'faculty.edit';
    public const FACULTY_DELETE = 'faculty.delete';

    // Inquiry
    public const INQUIRY_VIEW   = 'inquiry.view';
    public const INQUIRY_CREATE = 'inquiry.create';
    public const INQUIRY_EDIT   = 'inquiry.edit';
    public const INQUIRY_DELETE = 'inquiry.delete';
    public const INQUIRY_STATUS = 'inquiry.status';

    // Department
    public const DEPARTMENT_VIEW   = 'department.view';
    public const DEPARTMENT_CREATE = 'department.create';
    public const DEPARTMENT_EDIT   = 'department.edit';
    public const DEPARTMENT_DELETE = 'department.delete';

    // Course
    public const COURSE_VIEW   = 'course.view';
    public const COURSE_CREATE = 'course.create';
    public const COURSE_EDIT   = 'course.edit';
    public const COURSE_DELETE = 'course.delete';

    // User
    public const USER_VIEW   = 'user.view';
    public const USER_CREATE = 'user.create';
    public const USER_EDIT   = 'user.edit';
    public const USER_DELETE = 'user.delete';

    // Role
    public const ROLE_VIEW   = 'role.view';
    public const ROLE_CREATE = 'role.create';
    public const ROLE_EDIT   = 'role.edit';
    public const ROLE_DELETE = 'role.delete';

    // Student
    public const STUDENT_VIEW   = 'student.view';

    public static function all(): array
    {
        return [
            self::DASHBOARD_VIEW,
            self::FACULTY_VIEW,
            self::FACULTY_CREATE,
            self::FACULTY_EDIT,
            self::FACULTY_DELETE,
            self::INQUIRY_VIEW,
            self::INQUIRY_CREATE,
            self::INQUIRY_EDIT,
            self::INQUIRY_DELETE,
            self::INQUIRY_STATUS,
            self::DEPARTMENT_VIEW,
            self::DEPARTMENT_CREATE,
            self::DEPARTMENT_EDIT,
            self::DEPARTMENT_DELETE,
            self::COURSE_VIEW,
            self::COURSE_CREATE,
            self::COURSE_EDIT,
            self::COURSE_DELETE,
            self::STUDENT_VIEW,
            self::USER_VIEW,
            self::USER_CREATE,
            self::USER_EDIT,
            self::USER_DELETE,
            self::ROLE_VIEW,
            self::ROLE_CREATE,
            self::ROLE_EDIT,
            self::ROLE_DELETE,
        ];
    }

    /**
     * All permissions granted to the super_admin role.
     */
    public static function superAdminPermissions(): array
    {
        return self::all();
    }
}
