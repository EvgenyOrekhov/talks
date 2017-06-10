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

$curry = function ($f) {
    $length = (new ReflectionFunction($f))->getNumberOfParameters();

    $partial = function (...$args) use ($f, $length, &$partial) {
        return count($args) < $length
            ? function (...$rest) use ($partial, $args) {
                return $partial(...$args, ...$rest);
            }
            : $f(...$args);
    };

    return $partial;
};

$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$filter = $curry(function ($f, $array) {
    return array_filter($array, $f);
});

$map = $curry(function ($f, $array) {
    return array_map($f, $array);
});

$flat = function ($arrayOfArrays) {
    return array_merge(...$arrayOfArrays);
};

$average = function ($array) {
    return $array
        ? array_sum($array) / count($array)
        : 0;
};

$compose = function ($f, $g) {
    return function ($x) use ($f, $g) {
        return $f($g($x));
    };
};

$composeMany = function ($fs) use ($compose) {
    return array_reduce(
        $fs,
        $compose,
        function ($x) {
            return $x;
        }
    );
};

$pipe = $compose($composeMany, 'array_reverse');

$flatMap = function ($f) use ($pipe, $map, $flat) {
    return $pipe([$map($f), $flat]);
};

$averageBashExpForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);

echo $averageBashExpForProgrammers($employees); // 3
