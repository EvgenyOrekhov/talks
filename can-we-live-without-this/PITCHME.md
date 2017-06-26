# Can we live without this?

+++

# Can we live without $this?

---

![Edsger W. Dijkstra](http://cs-exhibitions.uni-klu.ac.at/fileadmin/template/documents/picture/EWD_thinking_1963.jpg)

Edsger W. Dijkstra

<!-- .element: class="fragment" -->

+++

## Go To Statement Considered Harmful (1968)

+++

```fortran
    if ( b**2-4*a*c) 100,200,300
100    print *, 'Roots are Complex'
    go to 400
200    print *, 'Single Real Root'
    go to 400
300    print *, 'Two Real Roots'
400 continue
```

```fortran
if ( x.le.5) then
   y=0
else
   y=(x=5.)**2
endif
```

<!-- .element: class="fragment" -->

+++

## ~~GO TO~~

---

![Alan Kay](http://s7.computerhistory.org/is/image/CHM/500004717-03-01?$re-medium$)

Alan Kay

<!-- .element: class="fragment" -->

+++

```c
typedef struct sCommClass {
    int (*open)(struct sCommClass *self, char *fspec);
} tCommClass;
static int httpOpen (tCommClass *http, char *fspec) {
    printf ("Opening HTTP: %s\n", fspec);
    return 0;
}
static int httpInit (tCommClass *http) {
    http->open = &httpOpen;
    return 0;
}
```

```c
int main (void) {
    int status;
    tCommClass commHttp;
    httpInit (&commHttp);
    status = (commHttp.open)(&commHttp, "http://example.com");
    return 0;
}
```

+++

```php
interface Openable
{
    public function open(string fspec): int;
}
class Http implements Openable
{
    public function open(string fspec): int
    {
        echo "Opening HTTP: $fspec\n";
        return 0;
    }
}
```

```php
class Main
{
    public function __construct(Openable $openable)
    {
        $status = $openable->open("http://example.com");
    }
}
```

+++

## ~~function* &pointers~~
## ~~&ast;&ast;virtual * tables~~

---

![Alonzo Church](https://www.biografiasyvidas.com/biografia/c/fotos/church_alonzo.jpg)

Alonzo Church

<!-- .element: class="fragment" -->

+++

```haskell
greeting = "Hello, World!"

greeting = "HELLO, WORLD!"
```

@[-](Error: Multiple declarations of ‘greeting’)

+++

```haskell
greeting = "Hello, World!"

uppercasedGreeting = "HELLO, WORLD!"
```

+++

## ≠

---

<div style="text-align: left;">

with void yield async await class extends super static delete in finally

continue for while do else var let switch case break default instanceof this

throw new try catch typeof if import export const return function

</div>

## 36

<!-- .element: class="fragment" -->

+++

```js
Object.prototype.__proto__
Object.prototype.constructor
Object.setPrototypeOf()
Object.prototype.isPrototypeOf()
Object.prototype.hasOwnProperty()
Object.create()

Function.prototype.bind()
Function.prototype.call()
Function.prototype.apply()
```

---

## with

+++

```js
with (obj) {
    a = b;
}
```

```js
1. a = b;
2. a = obj.b;
3. obj.a = b;
4. obj.a = obj.b;
```

<!-- .element: class="fragment" -->

?

<!-- .element: class="fragment" -->

+++

## ~~with~~

---

## void

+++

## ~~void~~

---

## yield

+++

```js
function makeGenerator(...) {
    // The generator's state variables
    return function generate() {
        // compute the new value
        // and update the state variables
        return value;
    };
}

const generate = makeGenerator();
```

+++

```js
function makeGenerator(array) {
    let i = 0;

    return function generate() {
        if (i < array.length) {
            const value = array[i];
            i += 1;
            return value;
        }
    };
}
```

```js
const generate = makeGenerator([1, 2, 3]);

generate(); // 1
generate(); // 2
generate(); // 3
generate(); // undefined
```

<!-- .element: class="fragment" -->

+++

## ~~yield~~

---

## async

## await

+++

```js
fs.readFile("/etc/passwd", function (err, data) {
    if (err) {
        console.error(err);
    }

    console.log(data);
});
```

```js
fs
    .readFile("/etc/passwd")
    .then(console.log)
    .catch(console.error)
```

+++

## ~~async~~

## ~~await~~

---

## class

## extends

## super

## static

+++

```js
function Shape() {
  this.x = 0;
  this.y = 0;
}

Shape.prototype.move = function (x, y) {
  this.x += x;
  this.y += y;
  console.info("Shape moved.");
};
```

```js
function Rectangle() {
  Shape.call(this);
}

Rectangle.prototype = Object.create(Shape.prototype);
Rectangle.prototype.constructor = Rectangle;

var rect = new Rectangle();
```

+++

## ~~class~~

## ~~extends~~

## ~~super~~

## ~~static~~

---

## delete

+++

```js
delete object.property;
```

```js
object.property = undefined;
```

<!-- .element: class="fragment" -->

+++

## ~~delete~~

---

## in

+++

```js
if ("property" in object) {

}
```

```js
if (object.property) {

}
```

<!-- .element: class="fragment" -->

+++

```js
for (var property in object) {

}
```

```js
Object.keys(object).forEach(function (property) {

});
```

<!-- .element: class="fragment" -->

+++

```js
for (var property in object) {
    if (object.hasOwnProperty(property)) {

    }
}
```

```js
Object.keys(object).forEach(function (property) {

});
```

+++

```js
for (var property in object) {
    if (Object.prototype.hasOwnProperty.call(object, property)) {

    }
}
```

```js
Object.keys(object).forEach(function (property) {

});
```

+++

## ~~in~~

---

## finally

+++

```js
(function () {
    try {
        throw new Error();
    } catch (err) {
        return 1;
    } finally {
        return 2;
    }
    return 3;
}());
```

@[-](?)
@[-](2)
@[6-8](GO TO)

+++

## ~~finally~~

---

## continue

+++

```js
let count = 0;
while (count < 10) {
    count += 1;
    if (count % 2 !== 0) {
        continue;
    }
    console.log(count);
}
```

```js
let count = 0;
while (count < 10) {
    count += 1;
    if (count % 2 === 0) {
        console.log(count);
    }
}
```

<!-- .element: class="fragment" -->

+++

## ~~continue~~

---

## for

## while

## do...while

+++

```js
.forEach(callback)
.map(callback)
.reduce(callback)
.filter(predicate)
.some(predicate)
.every(predicate)
.find(predicate)
.findIndex(predicate)
```

+++

```js
let count = 0;
while (count < 10) {
    count += 1;
    if (count % 2 === 0) {
        console.log(count);
    }
}
```

```js
function logEvenUntil10(count) {
    if (count <= 10) {
        if (count % 2 === 0) {
            console.log(count);
        }
        return logEvenUntil10(count + 1);
    }
}

logEvenUntil10(1);
```

<!-- .element: class="fragment" -->

+++

## ~~for~~

## ~~while~~

## ~~do...while~~

---

## else

+++

```js
function isNumber(arg) {
    let result;
    if (typeof arg === "number") {
        result = true;
    } else {
        result = false;
    }
    return result;
}
```

```js
function isNumber(arg) {
    let result = false;
    if (typeof arg === "number") {
        result = true;
    }
    return result;
}
```

<!-- .element: class="fragment" -->

+++

## ~~else~~

---

## var

+++

```js
for (var i = 1; i <= 10; i++) {
    setTimeout(function () {
        console.log(i);
    }, 100);
}
```

11 11 11 11 11 11 11 11 11 11

<!-- .element: class="fragment" -->

```js
for (let i = 1; i <= 10; i++) {
    setTimeout(function () {
        console.log(i);
    }, 100);
}
```

<!-- .element: class="fragment" -->

1 2 3 4 5 6 7 8 9 10

<!-- .element: class="fragment" -->

+++

## ~~var~~

---

## let

+++

```js
function greet(name) {
    let greeting = `Hello, ${name}!`;
    greeting = greeting.toUpperCase();
    return greeting;
}
```

+++

```js
function greet(name) {
    let greeting = `Hello, ${name}!`;
    greeting = greeting.toUpperCase();
    return greeting; // LIE!
}
```

+++

```js
function greet(name) {
    let greeting = `Hello, ${name}!`;
    greeting = greeting.toUpperCase();
    return greeting; // LIE!
}
```

```js
function greet(name) {
    const greeting = `Hello, ${name}!`;
    const uppercasedGreeting = greeting.toUpperCase();
    return uppercasedGreeting;
}
```

```js
const object = {};

object.property = "const forbids reassignment, not mutation";
```

<!-- .element: class="fragment" -->

+++

## ~~let~~

---

## switch

## case

## break

## default

+++

```js
function log(number) {
    let result = "You passed number ";
    switch (number) {
    case 0:
        result += `zero`;
    case 1:
        result += `one`;
    default:
        result += "greater than one";
    }
    console.log(result);
}

log(0);
```

@[-](?)
@[-](You passed number zeroonegreater than one)

+++

```js
function log(number) {
    let result = "You passed number ";
    switch (number) {
    case 0:
        result += `zero`;
        break;
    case 1:
        result += `one`;
        break;
    default:
        result += "greater than one";
    }
    console.log(result);
}

log(0);
```

+++

```js
switch (number) {
case 0:
    result += `zero`;
    break;
case 1:
    result += `one`;
    break;
default:
    result += "greater than one";
}
```

+++

```js
const cases = {
    0: function () {
        result += `zero`;
    },
    1: function () {
        result += `one`;
    },
    default: function () {
        result += "greater than one";
    }
};
const changeResult = cases[number] || cases.default;
changeResult();
```

+++

## ~~switch~~

## ~~case~~

## ~~break~~

## ~~default~~

---

## instanceof

+++

```js
typeof "Hello" === "string"; // true
"Hello" instanceof String; // false
```

```js
typeof 42 === "number"; // true
42 instanceof Number; // false
```

```js
typeof true === "boolean"; // true
true instanceof Boolean; // false
```

+++

```js
function Rabbit(name) {
    this.name = name;
    this.jump = function () {
        cosnole.log(`${this.name} jumps!`);
    };
};
var lada = {brand: "lada"};
Rabbit.prototype = lada;
const kalina = Object.create(lada);
if (kalina instanceof Rabbit) {
    kalina.jump();
}
```

+++

```js
function Rabbit(name) {
    this.name = name;
    this.jump = function () {
        cosnole.log(`${this.name} jumps!`);
    };
};
var lada = {brand: "lada"};
Rabbit.prototype = lada;
const kalina = Object.create(lada);
if (kalina instanceof Rabbit) { // true
    kalina.jump();
}
```

@[-](TypeError: kalina.jump is not a function)

+++

## Duck Typing

+++

```js
function Rabbit(name) {
    this.name = name;
    this.jump = function () {
        cosnole.log(`${this.name} jumps!`);
    };
};
var lada = {brand: "lada"};
Rabbit.prototype = lada;
const kalina = Object.create(lada);
if (kalina instanceof Rabbit) { // true
    kalina.jump();
}
```

+++

```js
function Rabbit(name) {
    this.name = name;
    this.jump = function () {
        cosnole.log(`${this.name} jumps!`);
    };
};
var lada = {brand: "lada"};
Rabbit.prototype = lada;
const kalina = Object.create(lada);
if (typeof kalina.jump === "function") { // false
    kalina.jump();
}
```

+++

## ~~instanceof~~

---

## this

+++

```js
function Shape() {
  this.x = 0;
  this.y = 0;
}

Shape.prototype.move = function (x, y) {
  this.x += x;
  this.y += y;
  console.info("Shape moved.");
};
```

```js
function Rectangle() {
  Shape.call(this);
}

Rectangle.prototype = Object.create(Shape.prototype);
Rectangle.prototype.constructor = Rectangle;

var rect = new Rectangle();
```

<!-- .element: class="fragment" -->

+++

## var self = this;

+++

```js
function MyObject() {
    this.doSomething = function () {};

    var self = this;

    $("#foobar").on("click", function () {
        self.doSomethng()
    });
}
```

+++

## =>

+++

```js
describe("my suite", () => {
    it("my test", () => {
        // should set the timeout of this test to 1000 ms;
        // instead will fail
        this.timeout(1000);
        assert.ok(true);
    });
});
```

+++

```js
$.ajax("http://example.com").done(console.log);
```

@[-](TypeError: Illegal invocation)

+++

```js
$.ajax("http://example.com").done(console.log);
```

```js
$.ajax("http://example.com").done(console.log.bind(console));
```

+++

## Closures

## (замыкания)

+++

```js
function makeObject(options) {
    const privateProperties = {foo: "bar"};

    function privateFunction() {

    }

    return {
        publicProperty: "qwerty",
        publicMethod: function () {

        }
    };
}
```

```js
const object = makeObject({abc: 123});

object.publicProperty; // "qwerty"

object.publicMethod();
```

<!-- .element: class="fragment" -->

+++

## ~~this~~

---

<div style="text-align: left;">
    ~~with void yield async await class extends super static delete in finally
    continue for while do else var let switch case break default instanceof this
    throw new try catch~~
</div>

<div style="text-align: left;">
    typeof if import export const return function
</div>

## 7 / 36

+++

<div style="text-align: left;">
    ~~with void yield async await class extends super static delete in finally
    continue for while do else var let switch case break default instanceof
    this~~
</div>

<div style="text-align: left;">
    throw new try catch typeof if import export const return function
</div>

## 11 / 36
