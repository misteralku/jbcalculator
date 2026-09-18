<?php

class CalculatorController
{
    public function index(): void
    {
        $config = require BASE_PATH . '/app/config.php';

        view('main', [
            'meta'     => $config['meta'],
            'packages' => $config['packages'],

            'jsConfig' => [
                'packages'          => $config['packages'],
                'meetingsPerWeek'   => $config['meetings_per_week'],
                'durationOffsetDays' => $config['duration_offset_days'],
            ],
        ]);
    }
}