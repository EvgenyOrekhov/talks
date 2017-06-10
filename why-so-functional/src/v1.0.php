<?php

$employees = [
    [
        'name' => 'John',
        'profession' => 'system administrator',
        'skills' => [
            ['name' => 'bash', 'experience' => 2],
        ],
    ],
    [
        'name' => 'Jane',
        'profession' => 'programmer',
        'skills' => [
            ['name' => 'bash', 'experience' => 3],
            ['name' => 'php', 'experience' => 2],
            ['experience' => 0],
        ],
    ],
    [
        'name' => 'Jack',
        'profession' => 'system administrator',
        'skills' => [],
    ],
];

$sum = 0;
$count = 0;

foreach ($employees as $employee) {
    if ($employee['profession'] === 'programmer') {
        foreach ($employee['skills'] as $skill) {
            if (
                isset($skill['name'])
                && $skill['name'] === 'bash'
            ) {
                $sum += $skill['experience'];
                $count++;
            }
        }
    }
}

$result = $count
    ? $sum / $count
    : 0;

echo $result; // 3
