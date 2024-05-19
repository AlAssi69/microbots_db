<?php

namespace App\Enums;

enum ExcelSheetEnum: string
{
    case Members = 'المتطوعون';
    case Projects = 'المشاريع';
    case Courses = 'الدورات';
    case Colors = 'التقسيمات اللونية';
    case ProjectLevels = 'مستويات المشاريع';
}
