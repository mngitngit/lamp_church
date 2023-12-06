<?php

namespace App\Enums;

abstract class AttendanceType
{
    const Physical = 'Physical';
    const OnsiteCheckIn = 'Onsite Check In';
    const OnlineCheckIn = 'Online Check In';
    const Pending = 'Pending';
}
