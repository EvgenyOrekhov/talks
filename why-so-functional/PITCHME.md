# Why So Functional?

---

### Imperative -> Functional

### @css[fragment](in PHP!)

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

---?image=why-so-functional/img/challenge-accepted.jpeg&size=contain

---

# v1.0

+++

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

+++?image=why-so-functional/img/picard.gif&size=contain

> **Notice**: Undefined index: name

+++

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

+++?image=why-so-functional/img/yo-dawg.png&size=contain

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

---

# v2.0

+++

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

@[1-3, 8-10]
@[4-6, 11-13]

---

# Currying

## (каррирование)

+++

## Каррированная функция

функция, которая будет возвращать новую функцию, пока не примет все свои
аргументы

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
$curry = function (callable $f): callable {
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
@[5, 17]
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

---?image=why-so-functional/img/fowler.jpg&size=contain

+++

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

$programmerSkills = $prop('skills', $programmer);
```

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmerSkills = $prop('skills', $programmer);

$programmerSkills = $prop('skills')($programmer);
```

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmerSkills = $prop('skills', $programmer);

$programmerSkills = $prop('skills')($programmer);

$programmersSkills = array_map(
    function ($programmer) {
        return $programmer['skills'];
    },
    $programmers
);
```

@[7, 10-12]
@[-]

+++

```php
$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$programmerSkills = $prop('skills', $programmer);

$programmerSkills = $prop('skills')($programmer);

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

@[7, 11-13]
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

---?image=why-so-functional/img/bender.jpg&size=contain

<h2 style="padding-bottom: 35%; color: #fff;">_underdash.php</h2>

<br>
<br>

+++?image=why-so-functional/img/bender.jpg&size=contain

<h2 style="padding-bottom: 35%; color: #fff;">_underdash.php/fp</h2>

<br>
<br>

+++

```php
$filter = $curry(function ($f, $array) {
    return array_filter($array, $f);
});
```

@div[fragment]
```php
$map = $curry(function ($f, $array) {
    return array_map($f, $array);
});
```
@divend

@div[fragment]
```php
$flat = function (array $arrays) {
    return array_merge(...$arrays);
};
```
@divend

@div[fragment]
```php
$average = function ($array) {
    return $array
        ? array_sum($array) / count($array)
        : 0;
};
```
@divend

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

+++?image=why-so-functional/img/we-need-to-go-deeper.jpg&size=contain

---

## Function Composition

## (композиция функций)

применение одной функции к результату другой

+++?image=why-so-functional/img/function-composition-1.jpg&size=contain

+++?image=why-so-functional/img/function-composition-2.jpg&size=contain

+++?image=why-so-functional/img/function-composition-3.jpg&size=contain

+++

## (g ∘ f)(x) = g(f(x))

+++

```php
$compose = function (callable $g, callable $f): callable {
    return function ($x) use ($g, $f) {
        return $g($f($x));
    };
};
```

+++

```php
$compose = function (callable $g, callable $f): callable {
    return function ($x) use ($g, $f) {
        return $g($f($x));
    };
};

$composeMany = function (array $fs) use ($compose): callable {
    return array_reduce(
        $fs,
        $compose,
        function ($x) {
            return $x;
        }
    );
};
```

@[7]
@[8-9]
@[10, 1-5]
@[11-13]
@[-]

+++

```php
$pipe = function (array $fs) use ($composeMany) {
    return $composeMany(array_reverse($fs));
};
```

+++

```php
$pipe = $compose($composeMany, 'array_reverse');
```

+++?image=why-so-functional/img/yo-dawg.png&size=contain

```php
$pipe = $compose($composeMany, 'array_reverse');
```

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

@[1-2, 8]

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

@[6-8]
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

# v9000.0

+++

```php
$averageBashExperienceForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);


```

+++

```php
$averageBashExperienceForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);

echo $averageBashExperienceForProgrammers($employees); // 3
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
$averageBashExperienceForProgrammers = $pipe([
    $filter($propEq('profession', 'programmer')),
    $flatMap($prop('skills')),
    $filter($propEq('name', 'bash')),
    $map($prop('experience')),
    $average,
]);
```

---

## Преимущества

- сниженная до миниума цикломатическая сложность
- декларативность
- переиспользуемость
- краткость
- создание новых функций путём вызова уже существующих
- разделение данных и вычислений
- подкреплено математическими теориями

---?image=why-so-functional/img/oop.png&size=contain

+++

```php
$app = $pipe([
    $controller,
    $model,
    $view,
]);

echo $app($_REQUEST);
```

---

## [Phunctional](https://github.com/Lambdish/phunctional) (PHP)

## [Pramda](https://github.com/kapolos/pramda) (PHP)

## [Ramda](https://ramdajs.com) (JS)

<br>

### [Жаргон функционального программирования](https://habrahabr.ru/post/310172/)

---?include=repo-link.md
