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

---?image=http://cdn1.thedataschool.co.uk/wp-content/uploads/2017/04/18225042/df4dbbdfd57a1e99f7c18a9628b4ba82_since-ychallenge-accepted-meme-meme-challenge-accepted_1920-1200.jpeg&size=contain

<!-- .slide: data-background-transition="none" -->

---

```php
$sum = 0; $count = 0;











```

+++

```php
$sum = 0; $count = 0;
foreach ($employees as $employee) {








}

```

+++

```php
$sum = 0; $count = 0;
foreach ($employees as $employee) {
    if ($employee['profession'] === 'programmer') {






    }
}

```

+++

```php
$sum = 0; $count = 0;
foreach ($employees as $employee) {
    if ($employee['profession'] === 'programmer') {
        foreach ($employee['skills'] as $skill) {




        }
    }
}

```

+++

```php
$sum = 0; $count = 0;
foreach ($employees as $employee) {
    if ($employee['profession'] === 'programmer') {
        foreach ($employee['skills'] as $skill) {
            if ($skill['name'] === 'bash') {


            }
        }
    }
}

```

+++

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

```

+++

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
```

+++

> **Notice**: Undefined index: name

+++?image=http://memedad.com/memes/172636.gif&size=contain

+++

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
```

@[5-8]
@[-]

---

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});













```

+++

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});
$programmersSkills = array_map(function ($employee) {
    return $employee['skills'];
}, $programmers);










```

+++

```php
$programmers = array_filter($employees, function ($employee) {
    return $employee['profession'] === 'programmer';
});
$programmersSkills = array_map(function ($employee) {
    return $employee['skills'];
}, $programmers);
$allSkills = array_merge(...$programmersSkills);









```

+++

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

+++

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

+++

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
```

+++

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
```

+++

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
```

@[4-6]
@[11-13]
@[1-3]
@[8-10]

---

# Currying

## (каррирование)

+++

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};










```

+++

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);








```

+++

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$inc = $add(1);

$inc(1); // 2






```

+++

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

+++

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

+++

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

+++

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

+++

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$add(1)(2); // 3
```

+++

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};

$add(1)(2); // (‿ꜟ‿)
```

+++

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

+++

```php
$add = function ($a) {
    return function ($b) use ($a) {
        return $a + $b;
    };
};
```

+++

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});
```

+++

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
```

+++

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
```

+++

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
$add(1)()()(2); // 3
```

+++

```php
$add = $curry(function ($a, $b) {
   return $a + $b;
});

$add(1, 2); // 3
$add(1)(2); // 3
$add(1)()()(2); // 3

$inc = $add(1);

```

+++

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

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});
```

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmersSkills = $prop('skills', $programmer);
```

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmersSkills = $prop('skills', $programmer);

$programmersSkills = $prop('skills')($programmer);
```

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmersSkills = $prop('skills', $programmer);

$programmersSkills = $prop('skills')($programmer);

$programmersSkills = array_map(
    function ($programmer) {
        return $programmer['skills'];
    },
    $programmers
);
```

@[7]
@[10-12]
@[-]

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmersSkills = $prop('skills', $programmer);

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

+++

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});
```

+++

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$isProgrammer = $propEq('profession', 'programmer', $employee);
```

+++

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$isProgrammer = $propEq('profession', 'programmer', $employee);

$isProgrammer = $propEq('profession', 'programmer')($employee);
```

+++

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$isProgrammer = $propEq('profession', 'programmer', $employee);

$isProgrammer = $propEq('profession', 'programmer')($employee);

$programmers = array_filter(
    $employees,
    function ($employee) {
        return $employee['profession'] === 'programmer';
    }
);
```

@[7]
@[11-13]
@[-]

+++

```php
$propEq = $curry(function ($property, $value, $array) {
    return ($array[$property] ?? null) === $value;
});

$isProgrammer = $propEq('profession', 'programmer', $employee);

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
```

+++

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

+++

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
```

+++

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
```

+++

```php
$result = $average(
    $map(
        $prop('experience'),
        $filter(
            $propEq('name', 'bash'),
            $flat(
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
```

@[11]
@[9-12]
@[7-13]
@[6-14]
@[4-15]
@[2-16]

+++

```php
$result = $average(
    $map(
        $prop('experience'),
        $filter(
            $propEq('name', 'bash'),
            $flat(
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

+++

```php
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);






```

+++

```php
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);

$flatMap = function ($f) use ($pipe, $map, $flat) {
    return $pipe([$map($f), $flat]);
};


```

+++

```php
$programmersSkills = $map($prop('skills'), $programmers);
$allSkills = $flat($programmersSkills);

$flatMap = function ($f) use ($pipe, $map, $flat) {
    return $pipe([$map($f), $flat]);
};

$allSkills = $flatMap($prop('skills'), $programmers);
```

@[1-2]
@[8]

+++

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
```

@[5-6]
@[-]

+++

```php
$programmers = $filter(
    $propEq('profession', 'programmer'),
    $employees
);

$allSkills = $flatMap($prop('skills'), $programmers);
$bashSkills = $filter($propEq('name', 'bash'), $allSkills);
$bashExperience = $map($prop('experience'), $bashSkills);
$result = $average($bashExperience);
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

+++

```php
$averageBashExpForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);

echo $averageBashExpForProgrammers($employees); // 3
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
```

+++

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

## [Pramda](https://github.com/kapolos/pramda) (PHP)
## [Ramda](http://ramdajs.com) (JS)
