---
defaults:
  layout: 'center'
layout: intro
canvasWidth: 750
---

# Lint All The Things

## Using advanced ESLint rules<br />to prevent bugs and avoid bad code patterns

<br />
<br />

### Evgeny Orekhov

---

<div style="text-align: center;">❌ Bad</div>

```tsx
function WhatIsESLint() {
  return (
    <p>
      ESLint
      <hr />
      The pluggable linting utility for JavaScript and JSX
    </p>
  );
}
```

<v-click>

```html
<p>ESLint</p>
<hr />
The pluggable linting utility for JavaScript and JSX
<p></p>
```

</v-click>

<v-click>

> `Warning: validateDOMNesting(...): <hr> cannot appear as a descendant of <p>`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```tsx
function WhatIsESLint() {
  return (
    <>
      <p>ESLint</p>
      <hr />
      <p>The pluggable linting utility for JavaScript and JSX</p>
    </>
  );
}
```

---

## [eslint-plugin-validate-jsx-nesting](https://github.com/MananTank/eslint-plugin-validate-jsx-nesting)

---

<div style="text-align: center;">❌ Bad</div>

```ts
test('ESLint author', async ({ page }) => {
  await page.goto('https://eslint.org/team/');
  expect(page.getByText('Nicholas C. Zakas')).toBeVisible();
});
```

<v-click>

> `Timed out`

</v-click>

<v-click>

> `Unhandled rejection`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```ts
test('ESLint author', async ({ page }) => {
  await page.goto('https://eslint.org/team/');
  await expect(page.getByText('Nicholas C. Zakas')).toBeVisible();
});
```

---

## [@typescript-eslint/no-floating-promises](https://typescript-eslint.io/rules/no-floating-promises/)

---

<div style="text-align: center;">❌ Bad</div>

```ts
await test('ESLint author', async ({ page }) => {
  await page.goto('https://eslint.org/team/');
  await expect(await page.getByText('Nicholas C. Zakas')).toBeVisible();
});
```

---

<div style="text-align: center;">✅ Good</div>

```ts
test('ESLint author', async ({ page }) => {
  await page.goto('https://eslint.org/team/');
  await expect(page.getByText('Nicholas C. Zakas')).toBeVisible();
});
```

---

## [@typescript-eslint/await-thenable](https://typescript-eslint.io/rules/await-thenable/)

---

<div style="text-align: center;">❌ Bad</div>

```ts
const hostname = new URL(url).hostname;
```

<v-click>

> `TypeError: Failed to construct 'URL': Invalid URL`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```ts
try {
  const hostname = new URL(url).hostname;
  // ...
} catch {
  // ...
}
```

---

## [total-functions/no-partial-url-constructor](https://github.com/danielnixon/eslint-plugin-total-functions#total-functionsno-partial-url-constructor)

---

<div style="text-align: center;">❌ Bad</div>

```ts
import { BrowserTracing } from '@sentry/tracing';
```

<v-click>

> `@sentry/tracing has been deprecated`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```ts
import { BrowserTracing } from '@sentry/react';
```

---

## [eslint-plugin-deprecation](https://www.npmjs.com/package/eslint-plugin-deprecation)

---

<div style="text-align: center;">❌ Bad</div>

```ts
function foo({ bar, baz } = { bar: false, baz: 123 }) {
  // ...
}
```

<v-click>

```ts
foo(); // OK
foo({}); // FAIL
foo({ bar: true }); // FAIL
foo({ baz: 456 }); // FAIL
foo({ bar: undefined, baz: undefined }); // FAIL
```

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```ts
function foo({ bar = false, baz = 123 } = {}) {
  // ...
}
```

```ts
foo(); // OK
foo({}); // OK
foo({ bar: true }); // OK
foo({ baz: 456 }); // OK
foo({ bar: undefined, baz: undefined }); // OK
```

---

## [unicorn/no-object-as-default-parameter](https://github.com/sindresorhus/eslint-plugin-unicorn/blob/main/docs/rules/no-object-as-default-parameter.md)

---

<div style="text-align: center;">❌ Bad</div>

```ts
type User = {name: string; roleId: number};

const roles = [
    {id: 0, name: "superadmin"},
    {id: 1, name: "admin"},
    {id: 2, name: "user"},
];

function getUserRoleName(user) {
    const role = roles.find(role => role.id === user.role.id);
    return role.name;
}

getUserRoleName({ name: "Anders Hejlsberg", roleId: 3 });
```

<v-click>

> `TypeError: Cannot read properties of undefined (reading 'id')`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

<br />

<div style="text-align: center;">tsconfig.json</div>

```json
"compilerOptions": {
  ...
  "strict": true,
  ...
}
```

---

## [total-functions/require-strict-mode](https://github.com/danielnixon/eslint-plugin-total-functions#total-functionsrequire-strict-mode)

---

<div style="text-align: center;">❌ Bad</div>

```ts
type User = { name: string; roleId: number };

const roles = [
  { id: 0, name: "superadmin" },
  { id: 1, name: "admin" },
  { id: 2, name: "user" },
];

function getUserRoleName(user: any) {
  const role = roles.find((role) => role.id === user.role.id);
  return role!.name;
}

getUserRoleName({ name: "Anders Hejlsberg", roleId: 3 });
```

<v-click>

> `TypeError: Cannot read properties of undefined (reading 'id')`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```ts
type User = { name: string; roleId: number };

const roles = [
  { id: 0, name: "superadmin" },
  { id: 1, name: "admin" },
  { id: 2, name: "user" },
];

function getUserRoleName(user: User): string {
  const role = roles.find((role) => role.id === user.roleId);
  return role?.name || "";
}

getUserRoleName({ name: "Anders Hejlsberg", roleId: 3 });
```

---

## [@typescript-eslint/no-explicit-any](https://typescript-eslint.io/rules/no-explicit-any/)

<br />

## [@typescript-eslint/no-non-null-assertion](https://typescript-eslint.io/rules/no-non-null-assertion/)

<br />

## [@typescript-eslint/explicit-function-return-type](https://typescript-eslint.io/rules/explicit-function-return-type/)

---

<div style="text-align: center;">❌ Bad</div>

```tsx
import { AnswerToTheUltimateQuestion, Label } from "components";
import makeEverythingAwesome from "awesome";

export function FlawlessComponent(props) {
  return (
    <AnswerToTheUltimateQuestion
      items={props.items || []}
      options={{ optionA: "A", optionB: "B" }}
      label={<Label>{props.label}</Label>}
      onChange={() => {
        if (event.keyCode === 13) {
          makeEverythingAwesome(props.everything);
        }
      }}
    />
  );
}
```

<v-click>

> `ReferenceError: event is not defined`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```tsx
import { AnswerToTheUltimateQuestion, Label } from "components";
import makeEverythingAwesome from "awesome";

export function FlawlessComponent(props) {
  return (
    <AnswerToTheUltimateQuestion
      items={props.items || []}
      options={{ optionA: "A", optionB: "B" }}
      label={<Label>{props.label}</Label>}
      onChange={(event) => {
        if (event.keyCode === 13) {
          makeEverythingAwesome(props.everything);
        }
      }}
    />
  );
}
```

---

## [no-restricted-globals](https://eslint.org/docs/latest/rules/no-restricted-globals)

---

<div style="text-align: center;">❌ Bad</div>

```tsx
import { AnswerToTheUltimateQuestion, Label } from "components";
import makeEverythingAwesome from "awesome";

export function FlawlessComponent(props) {
  return (
    <AnswerToTheUltimateQuestion
      items={props.items || []}
      options={{ optionA: "A", optionB: "B" }}
      label={<Label>{props.label}</Label>}
      onChange={(event) => {
        if (event.keyCode === 13) {
          makeEverythingAwesome(props.everything);
        }
      }}
    />
  );
}
```

---

<div style="text-align: center;">✅ Good</div>

```tsx
import { AnswerToTheUltimateQuestion, Label } from "components";
import makeEverythingAwesome from "awesome";

export function FlawlessComponent(props) {
  return (
    <AnswerToTheUltimateQuestion
      items={props.items || []}
      options={{ optionA: "A", optionB: "B" }}
      label={<Label>{props.label}</Label>}
      onChange={(event) => {
        if (event.key === 'Enter') {
          makeEverythingAwesome(props.everything);
        }
      }}
    />
  );
}
```

---

## [unicorn/prefer-keyboard-event-key](https://github.com/sindresorhus/eslint-plugin-unicorn/blob/main/docs/rules/prefer-keyboard-event-key.md)

---

<div style="text-align: center;">❌ Bad</div>

```ts
import { AnswerToTheUltimateQuestion, Label } from "components";
import makeEverythingAwesome from "awesome";

export function FlawlessComponent(props) {
  return (
    <AnswerToTheUltimateQuestion
      items={props.items || []}
      options={{ optionA: "A", optionB: "B" }}
      label={<Label>{props.label}</Label>}
      onChange={(event) => {
        if (event.key === 'Enter') {
          makeEverythingAwesome(props.everything);
        }
      }}
    />
  );
}
```

<v-click>

> `Cannot find module 'awesome'`

</v-click>

---

<div style="text-align: center;">✅ Good</div>

<br />

<div style="text-align: center;">package.json</div>

```json
"dependencies": {
  ...
  "awesome": "^1.2.3",
  ...
}
```

---

## [import/no-extraneous-dependencies](https://github.com/import-js/eslint-plugin-import/blob/main/docs/rules/no-extraneous-dependencies.md)

---

<div style="text-align: center;">❌ Bad</div>

```tsx
import { AnswerToTheUltimateQuestion, Label } from "components";
import makeEverythingAwesome from "awesome";

export function FlawlessComponent(props) {
  return (
    <AnswerToTheUltimateQuestion
      items={props.items || []}
      options={{ optionA: "A", optionB: "B" }}
      label={<Label>{props.label}</Label>}
      onChange={(event) => {
        if (event.key === 'Enter') {
          makeEverythingAwesome(props.everything);
        }
      }}
    />
  );
}
```

<v-click>

> ``[Violation] `click` handler took 1516ms``

</v-click>

---

<div style="text-align: center;">✅ Good</div>

```tsx
const defaultItems = [];
const options = { optionA: "A", optionB: "B" };

export function FlawlessComponent(props) {
  const label = useMemo(() => <Label>{props.label}</Label>, [props.label]);

  const handleChange = useCallback((event) => {
    if (event.key === 'Enter') {
      makeEverythingAwesome(props.everything);
    }
  }, [props.everything]);

  return (
    <AnswerToTheUltimateQuestion
      items={props.items || defaultItems}
      options={options}
      label={label}
      onChange={handleChange}
    />
  );
}
```

---

## [eslint-plugin-react-perf](https://github.com/cvazac/eslint-plugin-react-perf)

---

<div style="text-align: center;">❌ Bad</div>

```ts
const defaultItems = [];
const options = { optionA: "A", optionB: "B" };

export function FlawlessComponent(props) {
  const label = useMemo(() => <Label>{props.label}</Label>, [props.label]);

  const handleChange = useCallback((event) => {
    if (event.key === 'Enter') {
      makeEverythingAwesome(props.everything);
    }
  }, [props.everything]);

  return (
    <AnswerToTheUltimateQuestion
      items={props.items || defaultItems}
      options={options}
      label={label}
      onChange={handleChange}
    />
  );
}
```

---

<div style="text-align: center;">✅ Good</div>

---

## [import/no-unused-modules](https://github.com/import-js/eslint-plugin-import/blob/main/docs/rules/no-unused-modules.md)

---

## Linting helps us

<br />

✅ prevent errors

✅ control code complexity

✅ optimize app performance

✅ maintain code consistency

✅ reduce code review time

✅ boost knowledge

---

## Pro Tips

<br />

- Use more rules, not just recommended ones
- Set all rules to `"error"` severity
- Look for plugins
  - for your framework
  - for your libraries
- Read about rules

---

## [eslint-config-hardcore](https://github.com/EvgenyOrekhov/eslint-config-hardcore)
