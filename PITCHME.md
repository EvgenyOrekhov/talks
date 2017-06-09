# Why So Functional?

---

```php
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
```

---

Вычислить среднее количество лет опыта работы с bash у программистов

---

```php
$sum = 0; $count = 0;
foreach ($employees as $employee) {
    if ($employee['profession'] === 'programmer') {
        foreach ($employee['skills'] as $skill) {
            if ($skill['name'] === 'bash') {
                $sum += $skill['experience'];
                $count++;
            }
        }
    }
}
$result = $count ? $sum / $count : 0;

echo $result;
```

---

> **Notice**: Undefined index: name

---

```php
$sum = 0; $count = 0;
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
$result = $count ? $sum / $count : 0;

echo $result;
```

@[5-8]
@[-]

---

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});













```

---

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});
$programmersSkills = array_map(function ($employee) {
    return $employee['skills'];
}, $programmers);










```

---

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});
$programmersSkills = array_map(function ($employee) {
    return $employee['skills'];
}, $programmers);
$allSkills = array_merge(...$programmersSkills);









```

---

```php
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






```

---

```php
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



```

---

```php
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

echo $result;
```

@[4-6]
@[11-13]
@[1-3]
@[8-10]

---

# Currying (каррирование)

## (каррирование)

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};










```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);








```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);

$inc(1); // 2






```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);

$inc(1); // 2
$inc(4); // 5





```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);

$inc(1); // 2
$inc(4); // 5

$dec = $add(-1);



```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);

$inc(1); // 2
$inc(4); // 5

$dec = $add(-1);

$dec(1); // 0

```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);

$inc(1); // 2
$inc(4); // 5

$dec = $add(-1);

$dec(1); // 0
$dec(4); // 3
```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$add(1)(2); // 3
```

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$add(1)(2); // (‿ꜟ‿)
```

---

```php
$curry = function ($f) {
    $length = (new ReflectionFunction($f))
        ->getNumberOfParameters();

    $partial = function (...$args) use (
        $f,
        $length,
        &$partial
    ) {
        return count($args) < $length
            ? function (...$rest) use ($partial, $args) {
                return $partial(...$args, ...$rest);
            }
            : $f(...$args);
    };

    return $partial;
};
```

@[1]
@[2-3]
@[5]
@[17]
@[10-14]

---

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};
```

---

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});
```

---

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
```

---

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
```

---

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
$add(1)()()(2); // 3
```

---

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
$add(1)()()(2); // 3

$inc = $add(1);

```

---

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
$add(1)()()(2); // 3

$inc = $add(1);
$inc(2); // 3
```

---

```php
$programmersSkills = array_map(function ($employee) {
    return $employee['skills'];
}, $programmers);
```

```php
$bashExperience = array_map(function ($bashSkill) {
    return $bashSkill['experience'];
}, $bashSkills);
```

---

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});
```

---

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmersSkills = $prop('skills', $programmer);
```

---

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmersSkills = $prop('skills', $programmer);

$programmersSkills = $prop('skills')($programmer);
```

---

```php
$programmersSkills = $prop('skills')($programmer);

$programmersSkills = array_map(
    function ($programmer) {
        return $programmer['skills'];
    },
    $programmers
);
```

@[1]
@[4-6]

---

```php
$programmersSkills = $prop('skills')($programmer);

$programmersSkills = array_map(
    $prop('skills'),
    $programmers
);
```

---

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});
```

```php
$bashSkills = array_filter($allSkills, function ($skill) {
    return isset($skill['name']) && $skill['name'] === 'bash';
});
```

---

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});
```

---

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$isProgrammer = $propEq('profession', 'programmer', $employee);
```

---

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$isProgrammer = $propEq('profession', 'programmer', $employee);

$isProgrammer = $propEq('profession', 'programmer')($employee);
```

---

```php
$isProgrammer = $propEq('profession', 'programmer')($employee);

$programmers = array_filter(
    $employees,
    function ($employee) {
        return $employee['profession'] === 'programmer';
    }
);
```

@[1]
@[5-7]

---

```php
$isProgrammer = $propEq('profession', 'programmer')($employee);

$programmers = array_filter(
    $employees,
    $propEq('profession', 'programmer')
);
```

---

```php
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

echo $result;
```

---

```php
$programmers = array_filter(
    $employees,
    $propEq('profession', 'programmer')
);
$programmersSkills = array_map($prop('skills'), $programmers);
$allSkills = array_merge(...$programmersSkills);
$bashSkills = array_filter($allSkills, $propEq('name', 'bash'));
$bashExperience = array_map($prop('experience'), $bashSkills);
$result = $bashExperience
    ? array_sum($bashExperience) / count($bashExperience)
    : 0;

echo $result;
```

---

```php
$filter = $curry(function ($f, $array) {
    return array_filter($array, $f);
});
```

```php
$map = $curry(function ($f, $array) {
    return array_map($f, $array);
});
```

<!-- .element: class="fragment" -->

```php
$flat = function ($arrayOfArrays) {
    return array_merge(...$arrayOfArrays);
};
```

<!-- .element: class="fragment" -->

```php
$average = $curry(function ($array) {
    return $array
        ? array_sum($array) / count($array)
        : 0;
});
```

<!-- .element: class="fragment" -->

---

```php
$programmers = array_filter(
    $employees,
    $propEq('profession', 'programmer')
);
$programmersSkills = array_map($prop('skills'), $programmers);
$allSkills = array_merge(...$programmersSkills);
$bashSkills = array_filter($allSkills, $propEq('name', 'bash'));
$bashExperience = array_map($prop('experience'), $bashSkills);
$result = $bashExperience
    ? array_sum($bashExperience) / count($bashExperience)
    : 0;

echo $result;
```

---

```php
$programmers = $filter(
    $propEq('profession', 'programmer'),
    $employees
);
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);
$bashSkills = $filter($propEq('name', 'bash'), $allSkills);
$bashExperience = $map($prop('experience'), $bashSkills);
$result = $average($bashExperience);

echo $result;
```

---

```php
$result = $average(
    $map(
        $prop('experience'),
        $filter(
            $propEq('name', 'bash'),
            $merge(
                $map(
                    $prop('skills'),
                    $filter(
                        $propEq('profession', 'programmer'),
                        $employees
                    )
                )
            )
        )
    )
);

echo $result;
```

---

```php
$pipe = function ($fs) {
    return array_reduce(
        $fs,
        function ($f, $g) {
            return function ($x) use ($f, $g) {
                return $g($f($x));
            };
        },
        function ($x) {
            return $x;
        }
    );
};
```

@[1]
@[2-3]
@[4-8]
@[9-11]

---

```php
$flatMap = function ($f) use ($pipe, $map, $flat) {
    return $pipe([$map($f), $flat]);
};
```

---

```php
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);


```

---

```php
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);

$allSkills = $flatmap($prop('skills'), $programmers);
```

---

```php
$programmers = $filter(
    $propEq('profession', 'programmer'),
    $employees
);
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);
$bashSkills = $filter($propEq('name', 'bash'), $allSkills);
$bashExperience = $map($prop('experience'), $bashSkills);
$result = $average($bashExperience);

echo $result;
```

---

```php
$averageBashExpForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);


```

---

```php
$averageBashExpForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);

echo $averageBashExpForProgrammers($employees);
```

---

```php
$sum = 0; $count = 0;
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
$result = $count ? $sum / $count : 0;

echo $result;
```

---

```php
$averageBashExpForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);

echo $averageBashExpForProgrammers($employees);
```
