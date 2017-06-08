# Why So Functional?

---

```php
$people = [
    [
        'name' => 'John',
        'isMarried' => false,
        'children' => [
            [
                'name' => 'Mike',
                'yearOfBirth' => 2015,
                'gender' => 'male',
            ],
        ],
    ],
    [
        'name' => 'Jane',
        'isMarried' => true,
        'children' => [
            [
                'name' => 'Kith',
                'yearOfBirth' => 2014,
                'gender' => 'male',
            ],
            [
                'name' => 'Samantha',
                'yearOfBirth' => 2015,
                'gender' => 'female',
            ],
            [
                'name' => 'Jim',
                'yearOfBirth' => 2016,
                'gender' => 'male',
            ],
        ],
    ],
    [
        'name' => 'Jack',
        'isMarried' => false,
        'children' => [],
    ],
];
```

---

Определить количество мальчиков, рождённых после 2015 года, у которых
родитель находится в браке

---

```php
$result = 0;
foreach ($people as $person) {
    if ($person['isMarried']) {
        foreach ($person['children'] as $child) {
            if (
                $child['gender'] === 'male'
                && $child['yearOfBirth'] >= 2015
            ) {
                $result++;
            }
        }
    }
}
```

---

```php
$marriedPeople = array_filter($people, function ($person) {
    return $person['isMarried'];
});
$peoplesChildren = array_map(function ($person) {
    return $person['children'];
}, $marriedPeople);
$allChildren = array_merge(...$peoplesChildren);
$babyBoys = array_filter($allChildren, function ($child) {
    return (
        $child['gender'] === 'male'
        && $child['yearOfBirth'] >= 2015
    );
});
$result = count($babyBoys);
```

@[1-3]
@[1-6]
@[1-7]
@[1-13]
@[1-14]
@[1-6]

---

# Currying (каррирование)

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

$add(1)(2); // 3
```

@[1-5]
@[1-7]
@[1-7]
@[1-9]
@[1-10]
@[1-12]
@[1-15]
@[17]

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

@[1-3]
@[1-5]
@[1-6]
@[1-7]
@[1-7]
@[1-10]

---

```php
$marriedPeople = array_filter($people, function ($person) {
    return $person['isMarried'];
});
$peoplesChildren = array_map(function ($person) {
    return $person['children'];
}, $marriedPeople);

$prop = $curry(function ($property, $array) {
    return $array[$property];
});

$marriedPeople = array_filter($people, $prop('isMarried'));
$peoplesChildren = array_map($prop('children'), $marriedPeople);

$allChildren = array_merge(...$peoplesChildren);
$babyBoys = array_filter($allChildren, function ($child) {
    return (
        $child['gender'] === 'male'
        && $child['yearOfBirth'] >= 2015
    );
});
$result = count($babyBoys);
```

@[1-3]
@[1-5]
@[1-6]
@[1-7]
@[1-7]
@[1-10]

---

```php
$marriedPeople = array_filter($people, $prop('isMarried'));
$peoplesChildren = array_map($prop('children'), $marriedPeople);
$allChildren = array_merge(...$peoplesChildren);
$babyBoys = array_filter($allChildren, function ($child) {
    return (
        $child['gender'] === 'male'
        && $child['yearOfBirth'] >= 2015
    );
});
$result = count($babyBoys);
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

```php
$flat = function ($arrayOfArrays) {
    return array_merge(...$arrayOfArrays);
};
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

---

```php
$flatMap = function ($f) use ($pipe, $map, $flat) {
    return $pipe([
        $map($f),
        $flat,
    ]);
};
```

---

```php
$countBabyBoys = $pipe([
    $filter($prop('isMarried')),
    $flatMap($prop('children')),
    $filter(function ($child) {
        return (
            $child['gender'] === 'male'
            && $child['yearOfBirth'] >= 2015
        );
    }),
    'count',
]);

echo $countBabyBoys($people);
```
