# Can We Live Without This?

---

![Edsger W. Dijkstra](https://github.com/EvgenyOrekhov/talks/raw/master/can-we-live-without-this/img/dijkstra.jpg)

@css[fragment](Edsger W. Dijkstra)

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

<br>

@div[fragment]
```fortran
if ( x.le.5) then
   y=0
else
   y=(x=5.)**2
endif
```
@divend

+++

## ~~GO TO~~

---

![Ole-Johan Dahl and Kristen Nygaard](https://github.com/EvgenyOrekhov/talks/raw/master/can-we-live-without-this/img/dahl-and-nygaard.jpg)

@css[fragment](Ole-Johan Dahl and Kristen Nygaard)

+++

## Simula 67 (1967)

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

## ~~function&ast; &pointers~~

## ~~&ast;&ast;virtual &ast; tables~~

---

![Alonzo Church](https://github.com/EvgenyOrekhov/talks/raw/master/can-we-live-without-this/img/church.jpg)

@css[fragment](Alonzo Church)

+++

## λ-calculus (1936)

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

## JavaScript keywords

with void yield async await class extends super static delete in finally
continue for while do else var let switch case break default instanceof this
throw try catch new typeof if import export const return function

## @css[fragment](36)

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
ooo.eee.oo.ah_ah.ting.tang.walla.walla.bing = true;
ooo.eee.oo.ah_ah.ting.tang.walla.walla.bang = true;
```

@div[fragment]
```js
with (ooo.eee.oo.ah_ah.ting.tang.walla.walla) {
    bing = true;
    bang = true;
}
```
@divend

+++

```js
with (object) {
    a = b;
}
```

```js
1. a = b;
2. a = object.b;
3. object.a = b;
4. object.a = object.b;
```

@[-](?)

+++

```js
with (ooo.eee.oo.ah_ah.ting.tang.walla.walla) {
    bing = true;
    bang = true;
}
```

@div[fragment]
```js
var walla = ooo.eee.oo.ah_ah.ting.tang.walla.walla;
walla.bing = true;
walla.bang = true;
```
@divend

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
```

+++

```js
function makeGenerator(array) {
    var i = 0;
    return function generate() {
        if (i < array.length) {
            var value = array[i];
            i += 1;
            return value;
        }
    };
}
```

@div[fragment]
```js
var generate = makeGenerator([1, 2, 3]);

generate(); // 1
generate(); // 2
generate(); // 3
generate(); // undefined
```
@divend

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
    .catch(console.error);
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

@div[fragment]
```js
object.property = undefined;
```
@divend

+++

## ~~delete~~

---

## in

+++

```js
var greeting = "Hello, World!";

greeting.length; // 13

"length" in greeting;
```

@[-](?)
@[-](TypeError: Cannot use 'in' operator to search for 'length' in Hello, World!)

+++

```js
if ("property" in object) {

}
```

@div[fragment]
```js
if (object.property !== undefined) {

}
```
@divend

+++

```js
for (var property in object) {

}
```

@div[fragment]
```js
Object.keys(object).forEach(function (property) {

});
```
@divend

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
var count = 0;
while (count < 10) {
    count += 1;
    if (count % 2 !== 0) {
        continue;
    }
    console.log(count);
}
```

@div[fragment]
```js
var count = 0;
while (count < 10) {
    count += 1;
    if (count % 2 === 0) {
        console.log(count);
    }
}
```
@divend

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
.reduceRight(callback)
.filter(predicate)
.some(predicate)
.every(predicate)
.find(predicate)
.findIndex(predicate)
```

+++

```js
var count = 1;
while (count <= 10) {
    if (count % 2 === 0) {
        console.log(count);
    }
    count += 1;
}
```

@div[fragment]
```js
(function logEvenUntil10(count = 1) {
    if (count <= 10) {
        if (count % 2 === 0) {
            console.log(count);
        }
        return logEvenUntil10(count + 1);
    }
}());
```
@divend

+++

```js
function quicksort([pivot, ...rest]) {
    return pivot === undefined
        ? rest
        : [
            ...quicksort(rest.filter((item) => item <= pivot)),
            pivot,
            ...quicksort(rest.filter((item) => item > pivot))
        ];
}
```

+++

## ~~for~~

## ~~while~~

## ~~do...while~~

---

## else

+++

```js
function isNumber(arg) {
    var result;
    if (typeof arg === "number") {
        result = true;
    } else {
        result = false;
    }
    return result;
}
```

@div[fragment]
```js
function isNumber(arg) {
    var result = false;
    if (typeof arg === "number") {
        result = true;
    }
    return result;
}
```
@divend

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

@css[fragment](11 11 11 11 11 11 11 11 11 11)

@div[fragment]
```js
for (let i = 1; i <= 10; i++) {
    setTimeout(function () {
        console.log(i);
    }, 100);
}
```
@divend

@css[fragment](1 2 3 4 5 6 7 8 9 10)

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

@div[fragment]
```js
const object = {};

object.property = "const forbids reassignment, not mutation";
```
@divend

+++

## ~~let~~

---

## switch

## case

## break

## default

+++

```js
function greet(name, language) {
    switch (language) {
    case "ru":
        name = `Привет, ${name}!`;
    case "es":
        name = `¡Hola, ${name}!`;
    default:
        name = `Hello, ${name}!`;
    }
    console.log(name);
}

greet("Деннис", "ru");
```

@[-](?)
@[-](Hello, ¡Hola, Привет, Деннис!!!)

+++

```js
function greet(name, language) {
    switch (language) {
    case "ru":
        name = `Привет, ${name}!`;
        break;
    case "es":
        name = `¡Hola, ${name}!`;
        break;
    default:
        name = `Hello, ${name}!`;
    }
    console.log(name);
}

greet("Деннис", "ru"); // Привет, Деннис!
```

+++

```js
switch (language) {
case "ru":
    name = `Привет, ${name}!`;
    break;
case "es":
    name = `¡Hola, ${name}!`;
    break;
default:
    name = `Hello, ${name}!`;
}
```

+++

```js
const cases = Object.create(null);
cases.ru = function () {
    name = `Привет, ${name}!`;
};
cases.es = function () {
    name = `¡Hola, ${name}!`;
};
cases.default = function () {
    name = `Hello, ${name}!`;
};
const runCase = cases[language] || cases.default;
runCase();
```

+++

```js
function isNaN(value) {
    switch (value) {
    case NaN:
        return true;
    default:
        return false;
    }
}

isNaN(NaN);
```

@[-](?)
@[-](false)

+++

```js
function switchCase(
    value,
    cases,
    defaultCase = () => undefined
) {
    const map = new Map(cases);
    const runCase = map.get(value) || defaultCase;
    return runCase();
}
```

@div[fragment]
```js
function isNaN(value) {
    return switchCase(
        value,
        [
            [NaN, () => true]
        ],
        () => false
    );
}

isNaN(NaN); // true
```
@divend

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
        console.log(`${this.name} jumps!`);
    };
};
const lada = {brand: "lada"};
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
        console.log(`${this.name} jumps!`);
    };
};
const lada = {brand: "lada"};
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
        console.log(`${this.name} jumps!`);
    };
};
const lada = {brand: "lada"};
Rabbit.prototype = lada;
const kalina = Object.create(lada);
if (typeof kalina.jump === "function") { // false
    kalina.jump();
}
```

+++

## ~~instanceof~~

---

## Can we live without this?

+++

## Can we live without $this?

+++

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

@div[fragment]
```js
function Rectangle() {
  Shape.call(this);
}

Rectangle.prototype = Object.create(Shape.prototype);
Rectangle.prototype.constructor = Rectangle;

const rect = new Rectangle();
```
@divend

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

@[-](?)
@[-](TypeError: Illegal invocation)

+++

```js
$.ajax("http://example.com").done(console.log.bind(console));
```

+++

```js
function Point(x, y) {
    this.x = x;
    this.y = y;
}

const point = Point(4, 2);

console.log(point.x + point.y);
```

@[-](?)
@[-](TypeError: Cannot read property 'x' of undefined)
@[6](missing `new`)

+++

```js
function Point(x, y) {
    this.x = x;
    this.y = y;
}

const point = Point(4, 2);

console.log(x + y);
```

@[-](?)
@[-](6)
@[2-3](this === window)

+++

![Douglas Crockford](https://github.com/EvgenyOrekhov/talks/raw/master/can-we-live-without-this/img/crockford.jpg)

@css[fragment](Douglas Crockford)

+++?image=can-we-live-without-this/img/javascript-the-good-parts.jpg&size=contain

+++

## Closures

## (замыкания)

+++?image=can-we-live-without-this/img/closure-1.jpg&size=contain

+++?image=can-we-live-without-this/img/closure-2.jpg&size=contain

+++

```js
function addClickHandler() {
    const message = $("#message");

    $("#button").on("click", function showMessage() {
        message.toggle();
    });
}
```

+++

```js
function makeCounter() {
    let count = 0;
    return function next() {
        count += 1;
        return count;
    }
}
```

@div[fragment]
```js
const counter = makeCounter();

counter(); // 1
counter(); // 2
counter(); // 3
```
@divend

+++

```js
function makeObject(options) {










}
```

+++

```js
function makeObject(options) {
    const state = {/* ... */};









}
```

+++

```js
function makeObject(options) {
    const state = {/* ... */};
    function methodA() {
        /* options, state */
    }
    function methodB() {
        /* options, state, methodA */
    }



}
```

+++

```js
function makeObject(options) {
    const state = {/* ... */};
    function methodA() {
        /* options, state */
    }
    function methodB() {
        /* options, state, methodA */
    }
    return {
        methodB
    };
}
```

+++

```js
function makeObject(options) {
    const state = {/* ... */};
    function methodA() {
        /* options, state */
    }
    function methodB() {
        /* options, state, methodA */
    }
    return {
        methodB
    };
}
```

@div[fragment]
```js
const object = makeObject({abc: 123});

object.methodB();
```
@divend

+++

## Inheritance

+++

## ~~Inheritance~~

+++

## Composition

+++

```js
function makeObject(options) {









}
```

+++

```js
function makeObject(options) {
    const anotherObject = makeAnotherObject(options);








}
```

+++

```js
function makeObject(options) {
    const anotherObject = makeAnotherObject(options);

    function method() {
        anotherObject.anotherMethod();
    }




}
```

+++

```js
function makeObject(options) {
    const anotherObject = makeAnotherObject(options);

    function method() {
        anotherObject.anotherMethod();
    }

    return {
        ...anotherObject,
        method
    };
}
```

+++

```js
function makeObject(options) {
    const anotherObject = makeAnotherObject(options);
    const someOtherObject = makeSomeOtherObject(options);

    function method() {
        anotherObject.anotherMethod();
        someOtherObject.someOtherMethod();
    }

    return {
        ...anotherObject,
        ...someOtherObject,
        method
    };
}
```

+++

```js
function makeObject(options) {
    const anotherObject = makeAnotherObject(options);
    const someOtherObject = makeSomeOtherObject(options);

    function method() {
        anotherObject.anotherMethod();
        someOtherObject.someOtherMethod();
    }

    return {
        method
    };
}
```

+++

```js
function makeObject(
    options,
    anotherObject = makeAnotherObject(options)
) {
    function method() {
        anotherObject.anotherMethod();
    }

    return {
        ...anotherObject,
        method
    };
}
```

@div[fragment]
```js
const object = makeObject({abc: 123});
```
@divend

@div[fragment]
```js
const someOtherObject = makeSomeOtherObject();

const object = makeObject({abc: 123}, someOtherObject);
```
@divend

+++

## ~~this~~

## @css[fragment](~~new~~)

@div[fragment]
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
@divend

---

## throw

## try

## catch

+++

```js
function readFile(name) {
    if (doesFileExist(name)) {
        return actualReadFile(name);
    }
    throw new Error("File not found");
}
```

@div[fragment]
```js
try {
    const data = readFile("/etc/passwd");
    const json = JSON.parse(data);
    console.log(json);
} catch (err) {
    console.error(err);
}
```
@divend

+++

```js
function readFile(name) {
    if (doesFileExist(name)) {
        return Promise.resolve(
            actualReadFile(name)
        );
    }
    return Promise.reject(
        new Error("File not found")
    );
}
```

@div[fragment]
```js
readFile("/etc/passwd")
    .then(JSON.parse)
    .then(console.log)
    .catch(console.error);
```
@divend

+++

## ~~throw~~

## ~~try~~

## ~~catch~~

---

~~with void yield async await class extends super static delete in finally
continue for while do else var let switch case break default instanceof this
throw try catch~~

new typeof if import export const return function

## 8 / 36

+++

~~with void yield async await class extends super static delete in finally
continue for while do else var let switch case break default instanceof this~~

throw try catch new typeof if import export const return function

## 11 / 36

---

## [JSLint](http://jslint.com)

---?include=repo-link.md
