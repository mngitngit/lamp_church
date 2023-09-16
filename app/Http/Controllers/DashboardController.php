<?php

namespace App\Http\Controllers;

use App\Enums\RegistrationType;
use App\Models\Attendance;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $color_assignment = config('settings.chart_color');

        $local_churches = array_keys(config('clustergroups'));

        return view('dashboard', [
            'all' => (object) $this->get_local_churches_attendance($color_assignment, $local_churches),
            'members' => (object) $this->get_member_attendance($color_assignment, $local_churches),
            'guests' => (object) $this->get_guest_attendance($color_assignment, $local_churches),
            'trend' => (object) $this->get_all_attendance(),
            'progress' => (object) $this->get_attendance_progress()
        ]);
    }

    private function get_local_churches_attendance($color_assignment, $local_churches)
    {
        $data = [
            'data' => [
                'labels' => $local_churches,
                'datasets' => []
            ],
            'options' => [
                'responsive' => true
            ]
        ];

        foreach (config('settings.slots_allotment') as $day => $slots) {
            $count = [];

            foreach ($local_churches as $local_church) {
                $attendance = Attendance::where('local_church', $local_church)->whereIn('slot_id', $slots)->count();

                $count[] = $attendance;
            }

            $data['data']['datasets'][] = [
                'label' => $day,
                'data' => $count,
                'backgroundColor' => $color_assignment[$day]['all'],
            ];
        }

        return $data;
    }

    private function get_member_attendance($color_assignment, $local_churches)
    {
        $data = [
            'data' => [
                'labels' => $local_churches,
                'datasets' => []
            ],
            'options' => [
                'responsive' => true
            ]
        ];

        foreach (config('settings.slots_allotment') as $day => $slots) {
            $count = [];

            foreach ($local_churches as $local_church) {
                $attendance = Attendance::where('local_church', $local_church)->where('registration_type', RegistrationType::Member)->whereIn('slot_id', $slots)->count();

                $count[] = $attendance;
            }

            $data['data']['datasets'][] = [
                'label' => $day,
                'data' => $count,
                'backgroundColor' => $color_assignment[$day]['member'],
            ];
        }

        return $data;
    }

    private function get_guest_attendance($color_assignment, $local_churches)
    {
        $data = [
            'data' => [
                'labels' => $local_churches,
                'datasets' => []
            ],
            'options' => [
                'responsive' => true
            ]
        ];

        foreach (config('settings.slots_allotment') as $day => $slots) {
            $count = [];

            foreach ($local_churches as $local_church) {
                $attendance = Attendance::where('local_church', $local_church)->where('registration_type', RegistrationType::Guest)->whereIn('slot_id', $slots)->count();

                $count[] = $attendance;
            }

            $data['data']['datasets'][] = [
                'label' => $day,
                'data' => $count,
                'backgroundColor' => $color_assignment[$day]['guest'],
            ];
        }

        return $data;
    }

    private function get_all_attendance()
    {
        $data = [
            'labels' => array_keys(config('settings.slots_allotment')),
            'datasets' => [
                [
                    'label' => 'Member',
                    'backgroundColor' => '#87bc45',
                    'data' => []
                ],
                [
                    'label' => 'Guests',
                    'backgroundColor' => '#27aeef',
                    'data' => []
                ],
                [
                    'label' => 'Over all',
                    'backgroundColor' => '#b33dc6',
                    'data' => []
                ]
            ]
        ];

        foreach (config('settings.slots_allotment') as $day => $slots) {
            $data['datasets'][0]['data'][] = Attendance::where('registration_type', RegistrationType::Member)->whereIn('slot_id', $slots)->count();
            $data['datasets'][1]['data'][] = Attendance::where('registration_type', RegistrationType::Guest)->whereIn('slot_id', $slots)->count();
            $data['datasets'][2]['data'][] = Attendance::whereIn('slot_id', $slots)->count();
        }

        return $data;
    }

    private function get_attendance_progress()
    {
        $data = [];

        foreach (config('clustergroups') as $local_church => $clusters) {
            $actual_attendance = Attendance::where('local_church', $local_church)->whereIn('slot_id', [config('settings.member_booking_limit'), config('settings.guest_booking_limit')])->count();
            $expected_attendance = Booking::where('local_church', $local_church)->whereIn('slot_id', [config('settings.member_booking_limit'), config('settings.guest_booking_limit')])->count();

            $percentage = $expected_attendance === 0 ? 0 : number_format(($actual_attendance / $expected_attendance) * 100, 2);
            $data[] = [
                'local_church' => $local_church . ' Church',
                'percentage' => $percentage,
                'actual_attendance' => $actual_attendance,
                'expected_attendance' => $expected_attendance
            ];
        }

        return $data;
    }
}
