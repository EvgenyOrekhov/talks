# Can We Live Without This?

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

![Ole-Johan Dahl and Kristen Nygaard](https://history-computer.com/ModernComputer/Software/images/Dahl_and_Nygaard.jpg)

Ole-Johan Dahl and Kristen Nygaard

<!-- .element: class="fragment" -->

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

![Alonzo Church](https://www.biografiasyvidas.com/biografia/c/fotos/church_alonzo.jpg)

Alonzo Church

<!-- .element: class="fragment" -->

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

with void yield async await class extends super static delete in finally
continue for while do else var let switch case break default instanceof this
throw try catch new typeof if import export const return function

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
let count = 1;
while (count <= 10) {
    if (count % 2 === 0) {
        console.log(count);
    }
    count += 1;
}
```

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

<!-- .element: class="fragment" -->

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
const lada = {brand: "lada"};
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
        cosnole.log(`${this.name} jumps!`);
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
        cosnole.log(`${this.name} jumps!`);
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

```js
function Rectangle() {
  Shape.call(this);
}

Rectangle.prototype = Object.create(Shape.prototype);
Rectangle.prototype.constructor = Rectangle;

const rect = new Rectangle();
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

@[-](6)
@[2-3](this === window)

+++

![Douglas Crockford](https://upload.wikimedia.org/wikipedia/commons/2/24/Douglas_Crockford%2C_February_2013.jpg)

Douglas Crockford

<!-- .element: class="fragment" -->

+++?image=https://i.redd.it/h7nt4keyd7oy.jpg&size=contain

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

```js
const counter = makeCounter();

counter(); // 1
counter(); // 2
counter(); // 3
```

<!-- .element: class="fragment" -->

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

```js
const object = makeObject({abc: 123});

object.methodB();
```

<!-- .element: class="fragment" -->

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

    return Object.assign(anotherObject, {
        method
    });
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

    return Object.assign(anotherObject, someOtherObject, {
        method
    });
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

    return Object.assign(anotherObject, {
        method
    });
}
```

```js
const object = makeObject({abc: 123});
```

<!-- .element: class="fragment" -->

```js
const someOtherObject = makeSomeOtherObject();

const object = makeObject({abc: 123}, someOtherObject);
```

<!-- .element: class="fragment" -->

+++

## ~~this~~

## ~~new~~

<!-- .element: class="fragment" -->

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

<!-- .element: class="fragment" -->

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

```js
try {
    const data = readFile("/etc/passwd");
    const json = JSON.parse(data);
    console.log(json);
} catch (err) {
    console.error(err);
}
```

<!-- .element: class="fragment" -->

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

```js
readFile("/etc/passwd")
    .then(JSON.parse)
    .then(console.log)
    .catch(console.error);
```

<!-- .element: class="fragment" -->

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
