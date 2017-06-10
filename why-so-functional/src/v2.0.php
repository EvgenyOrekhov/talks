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

$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});

$programmersSkills = array_map(function ($employee) {
    return $employee['skills'];
}, $programmers);

$allSkills = array_merge(...$programmersSkills);

$bashSkills = array_filter($allSkills, function ($skill) {
    return isset($skill['name']) && $skill['name'] === 'bash';
});

$bashExperience = array_map(function ($bashSkill) {
    return $bashSkill['experience'];
}, $bashSkills);

$result = $bashExperience
    ? array_sum($bashExperience) / count($bashExperience)
    : 0;

echo $result; // 3
