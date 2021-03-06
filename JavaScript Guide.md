# JavaScript Guide

## Introduction
### What is JavaScript?

JavaScript is a cross-platform, object-oriented scripting language. It is a small and lightweight language. Inside a host environment (for example, a web browser), JavaScript can be connected to the objects of its environment to provide programmatic control over them.

JavaScript contains a standard library of objects, such as `Array`, `Date`, and `Math`, and a core set of language elements such as operators, control structures, and statements. Core JavaScript can be extended for a variety of purposes by supplementing it with additional objects; for example:

- *Client-side JavaScript* extends the core language by supplying objects to control a browser and its Document Object Model (DOM). For example, client-side extensions allow an application to place elements on an HTML form and respond to user events such as mouse clicks, form input, and page navigation.
- *Server-side JavaScript* extends the core language by supplying objects relevant to running JavaScript on a server. For example, server-side extensions allow an application to communicate with a database, provide continuity of information from one invocation to another of the application, or perform file manipulations on a server.

**JavaScript compared to Java**

| JavaScript                               | Java                                     |
| ---------------------------------------- | ---------------------------------------- |
| Object-oriented. No distinction between types of objects. Inheritance is through the prototype mechanism, and properties and methods can be added to any object dynamically. | Class-based. Objects are divided into classes and instances with all inheritance through the class hierarchy. Classes and instances cannot have properties or methods added dynamically. |
| Variable data types are not declared (dynamic typing). | Variable data types must be declared (static typing). |
| Cannot automatically write to hard disk. | Can automatically write to hard disk.    |

## Grammar and types

### Basics

JavaScript is **case-sensitive** and uses the **Unicode** character set.

### Declarations

There are three kinds of declarations in JavaScript.

- [`var`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/var)

  Declares a variable, optionally initializing it to a value.

- [`let`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/let)

  Declares a block scope local variable, optionally initializing it to a value.

- [`const`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/const)

  Declares a read-only named constant.

####Declaring variables

You can declare a variable in three ways:

- With the keyword [`var`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/var). For example, `var x = 42`. This syntax can be used to declare both local and global variables.
- By simply assigning it a value. For example, `x = 42`. This always declares a global variable. It generates a strict JavaScript warning. You shouldn't use this variant.
- With the keyword [`let`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/let). For example, `let y = 13`. This syntax can be used to declare a block scope local variable. See [Variable scope](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Variable_scope) below.

#### Evaluating variables

A variable declared using the `var` or `let` statement with no initial value specified has the value [`undefined`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/undefined).

An attempt to access an undeclared variable will result in a [`ReferenceError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/ReferenceError) exception being thrown.

You can use `undefined` to determine whether a variable has a value. 

The `undefined` value behaves as `false` when used in a boolean context.

The `undefined` value converts to `NaN` when used in numeric context.

When you evaluate a [`null`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/null) variable, the null value behaves as 0 in numeric contexts and as false in boolean contexts.

#### Variable scope

When you declare a variable outside of any function, it is called a *global* variable, because it is available to any other code in the current document. When you declare a variable within a function, it is called a *local* variable, because it is available only within that function.

JavaScript before ECMAScript 2015 does not have block statement scope; rather, a variable declared within a block is local to the function (or global scope) that the block resides within. For example the following code will log 5, because the scope of x is the function (or global context) within which x is declared, not the block, which in this case is an if statement.

```javascript
if (true) {
    var x = 5;
}
console.log(x); // x is 5
```

This behavior changes, when using the `let` declaration introduced in ECMAScript 2015.

```javascript
if (true) {
    let y = 5;
}
console.log(y);
```

#### Variable hoisting

Another unusual thing about variables in JavaScript is that you can refer to a variable declared later, without getting an exception. This concept is known as **hoisting**; variables in JavaScript are in a sense "hoisted" or lifted to the top of the function or statement. However, variables that are hoisted will return a value of `undefined`. So even if you declare and initialize after you use or refer to this variable, it will still return undefined.

```javascript
console.log(x === undefined); // true
var x = 3;

// will return a value of undefined
var myvar = "my value";
(function() {
    console.log(myvar); // undefined
    var myvar = "local value";
})();

// The abouve examples will be interpreted the same as:
var x;
console.log(x === undefined); // true
x = 3;

var myvar = "my value";

(function() {
    var myvar;
    console.log(myvar); // undefined
    myvar = "local value";
})();
```

Because of hoisting, all `var` statements in a function should be placed as near to the top of the function as possible. This best practice increases the clarity of the code.

In ECMAScript 2015, `let (const)` **will not hoist** the variable to the top of the block. However, referencing the variable in the block before the variable declaration results in a [`ReferenceError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/ReferenceError). The variable is in a "temporal dead zone" from the start of the block until the declaration is processed.

```javascript
console.log(x); // ReferenceError
let x = 3;
```

#### Function hoisting

For functions, only function declaration gets hoisted to the top and not the function expression.

```javascript
/* Function declaration */
foo(); // "bar"
function foo() {
    console.log("bar");
}

/* Function expression */
baz(); // TypeError: baz is not a function
var baz = function() {
    console.log("bar2");
}
```

#### Global variables

Global variables are in fact properties of the *global object*. In web pages the global object is [`window`](https://developer.mozilla.org/en-US/docs/Web/API/Window), so you can set and access global variables using the `window.*variable*` syntax.

Consequently, you can access global variables declared in one window or frame from another window or frame by specifying the window or frame name. 

#### Constants

You can create a read-only, named constant with the [`const`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/const) keyword. The syntax of a constant identifier is the same as for a variable identifier: it must start with a letter, underscore or dollar sign and can contain alphabetic, numeric, or underscore characters.

A constant cannot change value through assignment or be re-declared while the script is running. It has to be initialized to a value.

The scope rules for constants are the same as those for `let` block scope variables. If the `const` keyword is omitted, the identifier is assumed to represent a variable.

You cannot declare a constant with the same name as a function or variable in the same scope. For example:

```javascript
// THIS WILL CAUSE AN ERROR
function f() {
    const f = 5; // In fact, here is no error. It can be run normally.
}

// THIS WILL CAUSE AN ERROR ALSO
function f() {
    const g = 5;
    var g; // Identifier 'g' has already been declared
    // statements
}
```

However, object attributes are not protected, so the following statement is executed without problems.

```javascript
const MY_OBJECT = {"key": "value"};
MY_OBJECT.key = "otherValue";
```

### Data structures and types

#### Data types

The latest ECMAScript standard defines seven data types:

- Six data types that are [primitives](https://developer.mozilla.org/en-US/docs/Glossary/Primitive):
  - [Boolean](https://developer.mozilla.org/en-US/docs/Glossary/Boolean). `true` and `false`.
  - [null](https://developer.mozilla.org/en-US/docs/Glossary/null). A special keyword denoting a null value. Because JavaScript is case-sensitive, `null` is not the same as `Null`, `NULL`, or any other variant.
  - [undefined](https://developer.mozilla.org/en-US/docs/Glossary/undefined). A top-level property whose value is undefined.
  - [Number](https://developer.mozilla.org/en-US/docs/Glossary/Number). `42` or `3.14159`.
  - [String](https://developer.mozilla.org/en-US/docs/Glossary/String). "Howdy".
  - [Symbol](https://developer.mozilla.org/en-US/docs/Glossary/Symbol) (new in ECMAScript 2015). A data type whose instances are unique and immutable.
- and [Object](https://developer.mozilla.org/en-US/docs/Glossary/Object)

Although these data types are a relatively small amount, they enable you to perform useful functions with your applications. [`Objects`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object)and [`functions`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function) are the other fundamental elements in the language. You can think of objects as named containers for values, and functions as procedures that your application can perform.

#### Data type conversion

JavaScript is a dynamically typed language. That means you don't have to specify the data type of a variable when you declare it, and data types are converted automatically as needed during script execution. So, for example, you could define a variable as follows:

```javascript
var answer = 42;
```

And later, you could assign the same variable a string value, for example:

```javascript
answer = "Thanks for all the fish...";
```

Because JavaScript is dynamically typed, this assignment does not cause an error message.

In expressions involving numeric and string values with the + operator, JavaScript converts numeric values to strings. For example, consider the following statements:

```javascript
x = "The answer is " + 42 // "The answer is 42"
y = 42 + " is the answer" // "42 is the answer"
```

In statements involving other operators, JavaScript does not convert numeric values to strings. For example:

```javascript
"37" - 7 // 30
"37" + 7 // "377"
```
#### Converting strings to numbers

In the case that a value representing a number is in memory as a string, there are methods for conversion.

- [`parseInt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt)
- [`parseFloat()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseFloat)

`parseInt` will only return whole numbers, so its use is diminished for decimals. Additionally, a best practice for `parseInt` is to always include the radix parameter. The radix parameter is used to specify which numerical system is to be used.

An alternative method of retrieving a number from a string is with the `+` (unary plus) operator:

```javascript
"1.1" + "1.1" = "1.11.1"
(+"1.1") + (+"1.1") = 2.2
// Note: the parentheses are added for clarity, not required.
```

### Literals

You use literals to represent values in JavaScript. These are fixed values, not variables, that you *literally* provide in your script. This section describes the following types of literals:

- [Array literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Array_literals)
- [Boolean literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Boolean_literals)
- [Floating-point literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Floating-point_literals)
- [Integers](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Integers)
- [Object literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Object_literals)
- [RegExp literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#RegExp_literals)
- [String literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#String_literals)

#### Array literals

An array literal is a list of zero or more expressions, each of which represents an array element, enclosed in square brackets (`[]`). When you create an array using an array literal, it is initialized with the specified values as its elements, and its length is set to the number of arguments specified.

The following example creates the `coffees` array with three elements and a length of three:

```javascript
var coffees = ["French Roast", "Colombian", "Kona"];
```

**Note :** An array literal is a type of object initializer. See [Using Object Initializers](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects#Using_object_initializers).

If an array is created using a literal in a top-level script, JavaScript interprets the array each time it evaluates the expression containing the array literal. In addition, a literal used in a function is created each time the function is called.

Array literals are also `Array` objects. See [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) and [Indexed collections](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Indexed_collections) for details on `Array` objects.

##### Extra commas in array literals

You do not have to specify all elements in an array literal. If you put two commas in a row, the array is created with `undefined` for the unspecified elements. The following example creates the `fish` array:

```javascript
var fish = ["Lion", , "Angel"];
```

This array has two elements with values and one empty element (`fish[0]` is "Lion", `fish[1]` is `undefined`, and `fish[2]` is "Angel").

If you include a trailing comma at the end of the list of elements, the comma is ignored. In the following example, the length of the array is three. There is no `myList[3]`. All other commas in the list indicate a new element.

**Note :** Trailing commas can create errors in older browser versions and it is a best practice to remove them.

```javascript
var myList = ['home', , 'school', ];
```

In the following example, the length of the array is four, and `myList[0]` and `myList[2]` are missing.

```javascript
var myList = [ , 'home', , 'school'];
```

In the following example, the length of the array is four, and `myList[1]` and `myList[3]` are missing. Only the last comma is ignored.

```javascript
var myList = ['home', , 'school', , ];
```

Understanding the behavior of extra commas is important to understanding JavaScript as a language, however when writing your own code: explicitly declaring the missing elements as `undefined` will increase your code's clarity and maintainability.

#### Boolean literals

The Boolean type has two literal values: `true` and `false`.

Do not confuse the primitive Boolean values `true` and `false` with the true and false values of the Boolean object. The Boolean object is a wrapper around the primitive Boolean data type. See [`Boolean`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Boolean) for more information.

#### Integers

Integers can be expressed in decimal (base 10), hexadecimal (base 16), octal (base 8) and binary (base 2).

- Decimal integer literal consists of a sequence of digits without a leading 0 (zero).
- Leading 0 (zero) on an integer literal, or leading 0o (or 0O) indicates it is in octal. Octal integers can include only the digits 0-7.
- Leading 0x (or 0X) indicates hexadecimal. Hexadecimal integers can include digits (0-9) and the letters a-f and A-F.
- Leading 0b (or 0B) indicates binary. Binary integers can include digits only 0 and 1.

Some examples of integer literals are:

```javascript
0, 117 and -345 (decimal, base 10)
015, 0001 and -0o77 (octal, base 8)
0x1123, 0x00111 and -0xF1A7 (hexadecimal, "hex" or base 16)
0b11, 0b0011 and -0b11 (binary, base 2)
```

For more information, see [Numeric literals in the Lexical grammar reference](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Lexical_grammar#Numeric_literals).

#### Floating-point literals

- A decimal integer which can be signed (preceded by "+" or "-"),
- A decimal point ("."),
- A fraction (another decimal number),
- An exponent.

The exponent part is an "e" or "E" followed by an integer, which can be signed (preceded by "+" or "-"). A floating-point literal must have at least one digit and either a decimal point or "e" (or "E").

More succinctly, the syntax is:

```javascript
[(+|-)][digits][.digits][(E|e)[(+|-)]digits]
```

For example:

```javascript
3.1415926
-.123456789
-3.1E+12
.1e-23
```

#### Object literals

An object literal is a list of zero or more pairs of property names and associated values of an object, enclosed in curly braces (`{}`). You should not use an object literal at the beginning of a statement. This will lead to an error or not behave as you expect, because the { will be interpreted as the beginning of a block.

The following is an example of an object literal. The first element of the `car` object defines a property, `myCar`, and assigns to it a new string, "`Saturn`"; the second element, the `getCar` property, is immediately assigned the result of invoking the function `(carTypes("Honda"));` the third element, the `special` property, uses an existing variable (`sales`).

```javascript
var sales = "Toyota";
function carTypes(name) {
    if (name === "Honda") {
        return name;
    } else {
        return "Sorry, we don't sell " + name + ".";
    }
}
var car = {
    myCar: "Saturn",
    getCar: carTypes("Honda"),
    special: sales
};
console.log(car.myCar); // Saturn
console.log(car.getCar); // Honda
console.log(car.special); // Toyota
```

Additionally, you can use a numeric or string literal for the name of a property or nest an object inside another. The following example uses these options.

```javascript
var car = {
    manyCars: {
        a: "Saab",
        b: "Jeep"
    },
    7: "Mazda"
};
console.log(car.manyCars.b); // Jeep
console.log(car[7]); // Mazda
```

Object property names can be any string, including the empty string. If the property name would not be a valid JavaScript [identifier](https://developer.mozilla.org/en-US/docs/Glossary/Identifier) or number, it must be enclosed in quotes. Property names that are not valid identifiers also cannot be accessed as a dot (`.`) property, but can be accessed and set with the array-like notation("`[]`").

```javascript
var unusualPropertyNames = {
    "": "An empty string",
    "!": "Bang!"
};
console.log(unusualPropertyNames.""); // SyntaxError: Unexpected string
console.log(unusualPropertyNames[""]); // An empty string
console.log(unusualPropertyNames.!); // SyntaxError: Unexpected token !
console.log(unusualPropertyNames["!"]); // Bang!
```

In ES2015, object literals are extended to support setting the prototype at construction, shorthand for `foo: foo` assignments, defining methods, making super calls, and computing property names with expressions. Together, these also bring object literals and class declarations closer together, and let object-based design benefit from some of the same conveniences.

```javascript
var obj = {
    // __proto__
    __proto__: theProtoObj,
    // Shorthand for 'handler: handler'
    handle,
    // Methods
    toString() {
        // Super calls
        return "d " + super.toString();
    },
    // Computed (dynamic) property names
    ['prop_' + (() => 42)()]: 42
};
```

Please note:

```javascript
var foo = {
    a: "alpha",
    2: "two"
};
console.log(foo.a); // alpha
console.log(foo[2]); // two
console.log(foo.2); // Error: missing ) after argument list
console.log(foo[a]); // Error: a is not defined
console.log(foo["a"]); // alpha
console.log(foo["2"]); // two
```

#### RegExp literals

A regex literal is a pattern enclosed between slashes. The following is an example of an regex literal.

```javascript
var re = /ab + c/;
```

#### String literals

A string literal is zero or more characters enclosed in double (`"`) or single (`'`) quotation marks. A string must be delimited by quotation marks of the same type; that is, either both single quotation marks or both double quotation marks. The following are examples of string literals:

```javascript
"foo"
'bar'
"1234"
"one line \n another line"
"John's cat"
```

You can call any of the methods of the String object on a string literal value—JavaScript automatically converts the string literal to a temporary String object, calls the method, then discards the temporary String object. You can also use the `String.length` property with a string literal:

```javascript
console.log("John's cat".length); // 10
// Will print the number of symbols in the string including whitespace.
```

In ES2015, template literals are also available. Template strings provide syntactic sugar for constructing strings. This is similar to string interpolation features in Perl, Python and more. Optionally, a tag can be added to allow the string construction to be customized, avoiding injection attacks or constructing higher level data structures from string contents.

```javascript
// Basic literal string creation
`In JavaScript '\n' is a line-feed.`

// Multiline strings
`In JavaScript template strings can run over multiple lines,
but double and single quoted strings cannot`

// String interpolation
var name = "Bob", time = "today";
`Hello ${name}, how are you ${time}?`

// Construct an HTTP request prefix is used to interpret the replacements and construction
POST`http://foo.org/bar?a=${a}&b=${b}
     Content-Type: application/json
     X-Credentials: ${credentials}
     {
         "foo": ${foo},
         "bar": ${bar}}`(myOnReadyStateChangeHandler);
```

You should use string literals unless you specifically need to use a String object. See [`String`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String) for details on `String` objects.

##### Using special characters in strings

In addition to ordinary characters, you can also include special characters in strings, as shown in the following example.

```javascript
"One line \n another line"
```

The following table lists the special characters that you can use in JavaScript strings.

**Table: JavaScript special characters**

| Character   | Meaning                                  |
| ----------- | ---------------------------------------- |
| `\0`        | Null Byte                                |
| `\b`        | Backspace                                |
| `\f`        | Form feed                                |
| `\n`        | New line                                 |
| `\r`        | Carriage return                          |
| `\t`        | Tab                                      |
| `\v`        | Vertical tab                             |
| `\'`        | Apostrophe or single quote               |
| `\"`        | Double quote                             |
| `\\`        | Backslash character                      |
| `\XXX`      | The character with the Latin-1 encoding specified by up to three octal digits *XXX* between 0 and 377. For example, \251 is the octal sequence for the copyright symbol. |
|             |                                          |
| `\xXX`      | The character with the Latin-1 encoding specified by the two hexadecimal digits *XX* between 00 and FF. For example, \xA9 is the hexadecimal sequence for the copyright symbol. |
|             |                                          |
| `\uXXXX`    | The Unicode character specified by the four hexadecimal digits *XXXX*. For example, \u00A9 is the Unicode sequence for the copyright symbol. See [Unicode escape sequences](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Lexical_grammar#String_literals). |
| `\u{XXXXX}` | Unicode code point escapes. For example, \u{2F804} is the same as the simple Unicode escapes \uD87E\uDC04. |

##### Escaping characters

For characters not listed in the table, a preceding backslash is ignored, but this usage is deprecated and should be avoided.

You can insert a quotation mark inside a string by preceding it with a backslash. This is known as *escaping* the quotation mark. For example:

```javascript
var quote = "He read \"The Cremation of Sam McGee\" by R.W. Service.";
console.log(quote); // He read "The Cremation of Sam McGee" by R.W. Service.
```

To include a literal backslash inside a string, you must escape the backslash character. For example, to assign the file path `c:\temp` to a string, use the following:

```javascript
var home = "c:\\temp";
```

You can also escape line breaks by preceding them with backslash. The backslash and line break are both removed from the value of the string.

```javascript
var str = "this string \
is broken \
across multiple\
lines.";
console.log(str); // this string is broken across multiplelines.
```

Although JavaScript does not have "heredoc" syntax, you can get close by adding a line break escape and an escaped line break at the end of each line:

```javascript
var poem =
"Roses are red, \n\
Violets are blue, \n\
Sugar is sweer, \n\
and so is foo.";
console.log(poem);
```

## Control flow and error handling

### Block statement

**Important**: JavaScript prior to ECMAScript2015 does **not** have block scope. Variables introduced within a block are scoped to the containing function or script, and the effects of setting them persist beyond the block itself. In other words, block statements do not define a scope. "Standalone" blocks in JavaScript can produce completely different results from what they would produce in C or Java. For example:

```javascript
var x = 1;
{
    var x = 2;
}
console.log(x); // 2

var x = 1;
{
    let x = 2;
}
console.log(x); // 1
```

This outputs 2 because the `var x` statement within the block is in the same scope as the `var x` statement before the block. In C or Java, the equivalent code would have outputted 1.

Starting with ECMAScript2015, the `let` variable declaration is block scoped. See the [`let`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/let) reference page for more information.

### Conditional statements

#### `if...else` statement

It is advisable to not use simple assignments in a conditional expression, because the assignment can be confused with equality when glancing over the code. For example, do not use the following code:

```javascript
if (x = y) {
    /* statements here */
}
```

If you need to use an assignment in a conditional expression, a common practice is to put additional parentheses around the assignment. For example:

```javascript
if ((x = y)) {
    /* statements here */
}
```

##### Falsy values

The following values evaluate to false (also known as [Falsy](https://developer.mozilla.org/en-US/docs/Glossary/Falsy) values):

- `false`
- `undefined`
- `null`
- `0`
- `NaN`
- the empty string (`""`)

All other values, including all objects, evaluate to true when passed to a conditional statement.

Do not confuse the primitive boolean values `true` and `false` with the true and false values of the [`Boolean`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Boolean) object. For example:

```javascript
var b = new Boolean(false);
if (b) // this condition evaluates to true
if (b == true) // this condition evaluates to false
```

##### **Example**

In the following example, the function `checkData` returns `true` if the number of characters in a `Text` object is three; otherwise, it displays an alert and returns `false`.

```javascript
function checkData() {
    if (document.form1.threeChar.value.length == 3) {
        return true;
    } else {
        alert("Enter exactly three characters. " +
              document.form1.threeChar.value + " is not valid.");
        return false;
    }
}
```

### Exception handling statements

You can throw exceptions using the `throw` statement and handle them using the `try...catch` statements.

- [`throw` statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Control_flow_and_error_handling#throw_statement)
- [`try...catch` statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Control_flow_and_error_handling#try...catch_statement)

#### Exception types

Just about any object can be thrown in JavaScript. Nevertheless, not all thrown objects are created equal. While it is fairly common to throw numbers or strings as errors it is frequently more effective to use one of the exception types specifically created for this purpose:

- [ECMAScript exceptions](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Error#Error_types)
- [`DOMException`](https://developer.mozilla.org/en-US/docs/Web/API/DOMException) and [`DOMError`](https://developer.mozilla.org/en-US/docs/Web/API/DOMError)

#### `throw` statement

Use the `throw` statement to throw an exception. When you throw an exception, you specify the expression containing the value to be thrown:

> throw expression;

You may throw any expression, not just expressions of a specific type. The following code throws several exceptions of varying types:

```javascript
throw "Error2"; // String type
throw 42;       // Number type
throw true;     // Boolean type
throw {toString: function() {
    return "I'm an object!";
}}
```

**Note:** You can specify an object when you throw an exception. You can then reference the object's properties in the `catch` block. The following example creates an object `myUserException` of type `UserException` and uses it in a throw statement.

```javascript
// Create an object type UserException
function UserException(message) {
    this.message = message;
    this.name = "UserException";
}

// Make the exception convert to a pretty string when used as a string
// (e.g. by the error console)
UserException.prototype.toString = function() {
    return this.name + ': "' + this.message + '"';
};

// Create an instance of the object type and throw it
throw new UserException("Value too high");
```

#### `try...catch` statement

##### The `catch` block

You can use a `catch` block to handle all exceptions that may be generated in the `try` block.

> catch (catchId) {
> ​    statements
> }

The `catch` block specifies an identifier (`catchID` in the preceding syntax) that holds the value specified by the `throw` statement; you can use this identifier to get information about the exception that was thrown. JavaScript creates this identifier when the `catch` block is entered; the identifier lasts only for the duration of the `catch` block; after the `catch` block finishes executing, the identifier is no longer available.

##### The `finally` block

The `finally` block contains statements to execute after the `try` and `catch` blocks execute but before the statements following the `try...catch` statement. The `finally` block executes whether or not an exception is thrown. If an exception is thrown, the statements in the `finally` block execute even if no `catch` block handles the exception.

You can use the `finally` block to make your script fail gracefully when an exception occurs; for example, you may need to release a resource that your script has tied up. The following example opens a file and then executes statements that use the file (server-side JavaScript allows you to access files). If an exception is thrown while the file is open, the `finally` block closes the file before the script fails.

```javascript
openMyFile();
try {
    writeMyFile(theData); // This may throw a error
} catch (e) {
    handleError(e); // If we got a error we handle it
} finally {
    closeMyFile(); // always close the resource
}
```

If the `finally` block returns a value, this value becomes the return value of the entire `try-catch-finally` production, regardless of any `return` statements in the `try` and `catch` blocks:

```javascript
function f() {
    try {
        console.log(0);
        throw "bogus";
    } catch (e) {
        console.log(1);
        // this return statement is suspended until finally block has completed
        return true;
        console.log(2); // not reachable
    } finally {
        console.log(3);
        // overwrites the previous "return"
        return false;
        console.log(4); // not reachable
    }
    // "return false" is executed now
    console.log(5); // not reachable
}
f(); // console 0, 1, 3; returns false
```

Overwriting of return values by the `finally` block also applies to exceptions thrown or re-thrown inside of the `catch` block:

```javascript
function f() {
    try {
        throw "bogus";
    } catch (e) {
        console.log('caught inner "bogus"');
        // this throw statements is suspended until finally block has completed
        throw e;
    } finally {
        // overwrites the previous "throw"
        return false;
    }
    // "return false" is executed now
}
try {
    f();
} catch (e) {
    // this is never reached because the throw inside the catch is overwritten
    // by the return in finally
    console.log('caught outer "bogus"');
}
// OUTPUT
// caught inner "bogus"
```

#### Utilizing `Error` objects

Depending on the type of error, you may be able to use the 'name' and 'message' properties to get a more refined message. 'name' provides the general class of Error (e.g., 'DOMException' or 'Error'), while 'message' generally provides a more succinct message than one would get by converting the error object to a string.

If you are throwing your own exceptions, in order to take advantage of these properties (such as if your catch block doesn't discriminate between your own exceptions and system ones), you can use the Error constructor. For example:

```javascript
function doSomethingErrorProne() {
    if (ourCodeMakesAMistake()) {
        throw new Error('The message');
    } else {
        doSomethingToGetAJavaScriptError();
    }
}
// ...
try {
    doSomethingErrorProne();
} catch (e) {
    console.log(e.name); // logs 'Error'
    console.log(e.message); // logs 'The message' or a JavaScript error message
}
```

### Promises

Starting with ECMAScript2015, JavaScript gains support for [`Promise`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise) objects allowing you to control the flow of deferred and asynchronous operations.

A `Promise` is in one of these states:

- *pending*: initial state, not fulfilled or rejected.
- *fulfilled*: successful operation
- *rejected*: failed operation.
- *settled*: the Promise is either fulfilled or rejected, but not pending.

![](https://mdn.mozillademos.org/files/8633/promises.png)

#### Loading an image with XHR

A simple example using `Promise` and `XMLHttpRequest` to load an image is available at the MDN GitHub[ promise-test](https://github.com/mdn/promises-test/blob/gh-pages/index.html) repository. You can also [see it in action](http://mdn.github.io/promises-test/). Each step is commented and allows you to follow the Promise and XHR architecture closely. Here is the uncommented version, showing the `Promise` flow so that you can get an idea:

```javascript
function imgLoad(url) {
    return new Promise(function(resolve, reject) {
        var request = new XMLHttpRequest();
        request.open('GET', url);
        request.responseType = 'blob';
        request.onload = function() {
            if (request.status == 200) {
                resolve(request.response);
            } else {
                reject(Error('Image didn\'t load successfully; error code: '
                            + request.statusText));
            }
        };
        request.onerror = function() {
            reject(Error('There was a network error.'));
        };
    });
}
```

For more detailed information, see the [`Promise`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise) reference page.

## Loops and iteration

There are many different kinds of loops, but they all essentially do the same thing: they repeat an action some number of times (and it's actually possible that number could be zero). The various loop mechanisms offer different ways to determine the start and end points of the loop. There are various situations that are more easily served by one type of loop over the others.

The statements for loops provided in JavaScript are:

- [for statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#for_statement)
- [do...while statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#do...while_statement)
- [while statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#while_statement)
- [labeled statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#labeled_statement)
- [break statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#break_statement)
- [continue statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#continue_statement)
- [for...in statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#for...in_statement)
- [for...of statement](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Loops_and_iteration#for...of_statement)

### `labeled` statement

A [`label`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/label) provides a statement with an identifier that lets you refer to it elsewhere in your program. For example, you can use a label to identify a loop, and then use the `break` or `continue` statements to indicate whether a program should interrupt the loop or continue its execution.

The syntax of the labeled statement looks like the following:

> label :
> ​    statement

The value of *`label`* may be any JavaScript identifier that is not a reserved word. The *`statement`* that you identify with a label may be any statement.

### `break` statement

Use the [`break`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/break) statement to terminate a loop, `switch`, or in conjunction with a labeled statement.

- When you use `break` without a label, it terminates the innermost enclosing `while`, `do-while`, `for`, or `switch` immediately and transfers control to the following statement.
- When you use `break` with a label, it terminates the specified labeled statement.

The syntax of the `break` statement looks like this:

> break [*label*];

The first form of the syntax terminates the innermost enclosing loop or `switch`; the second form of the syntax terminates the specified enclosing labeled statement.

### `continue` statement

The [`continue`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/continue) statement can be used to restart a `while`, `do-while`, `for`, or `label` statement.

- When you use `continue` without a label, it terminates the current iteration of the innermost enclosing `while`, `do-while`, or `for`statement and continues execution of the loop with the next iteration. In contrast to the `break` statement, `continue` does not terminate the execution of the loop entirely. In a `while` loop, it jumps back to the condition. In a `for` loop, it jumps to the `increment-expression`.
- When you use `continue` with a label, it applies to the looping statement identified with that label.

The syntax of the `continue` statement looks like the following:

> continue [*label*];

### `for...in` statement

The [`for...in`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/for...in) statement iterates a specified variable over all the enumerable properties of an object. For each distinct property, JavaScript executes the specified statements. A `for...in` statement looks as follows:

> for (variable in object) {
> ​    statements
> }

#### **Arrays**

Although it may be tempting to use this as a way to iterate over [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) elements, the **for...in** statement will return the name of your user-defined properties in addition to the numeric indexes. Thus it is better to use a traditional [`for`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/for) loop with a numeric index when iterating over arrays, because the **for...in** statement iterates over user-defined properties in addition to the array elements, if you modify the Array object, such as adding custom properties or methods.

### `for...of` statement

The [`for...of`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/for...of) statement creates a loop Iterating over [iterable objects](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/iterable) (including [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array), [`Map`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Map), [`Set`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set), [`arguments`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/functions/arguments) object and so on), invoking a custom iteration hook with statements to be executed for the value of each distinct property.

> for (*variable* of *object*) {
> ​    statement
> }

The following example shows the difference between a `for...of` loop and a [`for...in`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/statements/for...in) loop. While `for...in` iterates over property names, `for...of` iterates over property values:

```javascript
let arr = [3, 5, 7];
arr.foo = "hello";
for (let i in arr) {
    console.log(i); // logs "0", "1", "2", "foo"
    console.info(typeof(i)); // string
}
for (let i of arr) {
    console.log(i); // logs 3, 5, 7
    console.info(typeof(i)); // number
}
```

## Functions

> Functions are one of the fundamental building blocks in JavaScript. A function is a JavaScript procedure—a set of statements that performs a task or calculates a value. To use a function, you must define it somewhere in the scope from which you wish to call it.

### Defining functions

#### Function declarations

Primitive parameters (such as a number) are passed to functions **by value**; the value is passed to the function, but if the function changes the value of the parameter, this change is not reflected globally or in the calling function.

If you pass an object (i.e. a non-primitive value, such as [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) or a user-defined object) as a parameter and the function changes the object's properties, that change is visible outside the function, as shown in the following example:

```javascript
function myFunc(theObject) {
    theObject.make = "Toyota";
}
var mycar = {make: "Honda", modal: "Accord", year: 1998};
var x, y;
x = mycar.make; // x gets the value "Honda"
myFunc(mycar); // the make property was changed by the function
y = mycar.make; // y gets the value "Toyota"
```

#### Function expressions

While the function declaration above is syntactically a statement, functions can also be created by a **function expression**. Such a function can be **anonymous**; it does not have to have a name. For example, the function `square` could have been defined as:

```javascript
var square = function(number) {
    return number * number;
};
var x = square(4);
```

However, a name can be provided with a function expression and can be used inside the function to refer to itself, or in a debugger to identify the function in stack traces:

```javascript
var factorial = function fac(n) {
    return n < 2 ? 1 : n * fac(n - 1);
};
console.log(factorial(3));
```

Function expressions are convenient when passing a function as an argument to another function. The following example shows a `map` function being defined and then called with an expression function as its first parameter:

```javascript
function map(f, a) {
    var result = [], /* Create a new Array*/
        i;
    for (i = 0; i != a.length; i++) {
        result[i] = f(a[i]);
    }
    return result;
}
var multiply = function(x) {
    return x * x * x;
};
map(multiply, [0, 1, 2, 5, 10]); // [0, 1, 8, 125, 1000]
```

In JavaScript, a function can be defined based on a condition. For example, the following function definition defines `myFunc` only if `num`equals 0:

```javascript
var myFunc;
if (num === 0) {
    myFunc = function(theObject) {
        theObject.make = "Toyota";
    };
}
```

In addition to defining functions as described here, you can also use the [`Function`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function) constructor to create functions from a string at runtime, much like [`eval()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/eval).

A **method** is a function that is a property of an object. Read more about objects and methods in [Working with objects](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects).

### Calling functions

Functions must be in scope when they are called, but the function declaration can be hoisted (appear below the call in the code), as in this example:

```javascript
console.log(square(5));
/* ... */
function squara(n) {
    return n * n;
}
```

The scope of a function is the function in which it is declared, or the entire program if it is declared at the top level.

**Note:** This works only when defining the function using the above syntax (i.e. `function funcName(){}`). The code below will not work. That means, function hoisting only works with function declaration and not with function expression.

```javascript
console.log(square); // square is hoisted with an initial value undefined.
console.log(square(5)); // TypeError: square is not a function
var square = function(n) {
    return n * n;
}
```

The arguments of a function are not limited to strings and numbers. You can pass whole objects to a function. The `show_props()`function (defined in [Working with objects](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects#Objects_and_Properties)) is an example of a function that takes an object as an argument.

A function can call itself. For example, here is a function that computes factorials recursively:

```javascript
function factorial(n) {
    if ((n === 0) || (n === 1)) {
        return 1;
    } else {
        return (n * factorial(n - 1));
    }
}
var a, b, c, d, e;
a = function(1);
b = function(2);
c = function(3);
d = function(4);
e = function(5);
```

There are other ways to call functions. There are often cases where a function needs to be called dynamically, or the number of arguments to a function vary, or in which the context of the function call needs to be set to a specific object determined at runtime. It turns out that functions are, themselves, objects, and these objects in turn have methods (see the Function object). One of these, the apply() method, can be used to achieve this goal.

### Function scope

Variables defined inside a function cannot be accessed from anywhere outside the function, because the variable is defined only in the scope of the function. However, a function can access all variables and functions defined inside the scope in which it is defined. In other words, a function defined in the global scope can access all variables defined in the global scope. A function defined inside another function can also access all variables defined in its parent function and any other variable to which the parent function has access.

```javascript
// The following variables are defined in the global scope
var num1 = 20, num2 = 3, name = "Chamahk";
// This function is defined in the global scope
function multiply() {
    return num1 * num2;
}
nultiply(); // 60
// A nested function example
function getScore() {
    var num1 = 2, num2 = 3;
    function add() {
        return name + " scored " + (num1 + num2);
    }
    return add();
}
getScore(); // "Chamahk scored 5"
```

### Scope and the function stack

#### Recursion

A function can refer to and call itself. There are three ways for a function to refer to itself:

1. the function's name
2. `arguments.callee`
3. an in-scope variable that refers to the function

For example, consider the following function definition:

```javascript
var foo = function bar() {
    // statements go here
};
```

Within the function body, the following are all equivalent:

1. `bar()`
2. `arguments.callee()`
3. `foo()`

A function that calls itself is called a *recursive function*. In some ways, recursion is analogous to a loop. Both execute the same code multiple times, and both require a condition (to avoid an infinite loop, or rather, infinite recursion in this case). For example, the following loop:

```javascript
var x = 0;
while (x < 10) { /* "x < 10" is the loop condition */
    // do stuff
    x++;
}
```

can be converted into a recursive function and a call to that function:

```javascript
function loop(x) {
    if (x >= 10) { /* "x >= 10" is the exit condition (equivalent to "!(x < 10)") */
        return;
    }
    // do stuff
    loop(x + 1);
}
```

However, some algorithms cannot be simple iterative loops. For example, getting all the nodes of a tree structure (e.g. the [DOM](https://developer.mozilla.org/en-US/docs/DOM)) is more easily done using recursion:

```javascript
function walkTree(node) {
    if (node == null) {
        return;
    }
    // do something with node
    for (var i = 0; i < node.childNodes.length; i++) {
        walkTree(node.childNodes[i]);
    }
}
```

Compared to the function `loop`, each recursive call itself makes many recursive calls here.

It is possible to convert any recursive algorithm to a non-recursive one, but often the logic is much more complex and doing so requires the use of a stack. In fact, recursion itself uses a stack: the function stack.

The stack-like behavior can be seen in the following example:

```javascript
function foo(i) {
    if (i < 0) {
        return;
    }
    console.log('begin: ' + i);
    foo(i - 1);
    console.log('end: ' + i);
}
foo(3);
```

#### Nested functions and closures

You can nest a function within a function. The nested (inner) function is private to its containing (outer) function. It also forms a *closure*. A closure is an expression (typically a function) that can have free variables together with an environment that binds those variables (that "closes" the expression).

Since a nested function is a closure, this means that a nested function can "inherit" the arguments and variables of its containing function. In other words, the inner function contains the scope of the outer function.

To summarize:

- The inner function can be accessed only from statements in the outer function.


- The inner function forms a closure: the inner function can use the arguments and variables of the outer function, while the outer function cannot use the arguments and variables of the inner function.

The following example shows nested functions:

```javascript
function addSquares(a, b) {
    function square() {
        return x * x;
    }
    return square(a) + square(b);
}
a = addSquares(2, 3);
b = addSquares(3, 4);
c = addSquares(4, 5);
```

Since the inner function forms a closure, you can call the outer function and specify arguments for both the outer and inner function:

```javascript
function outside(x) {
    function inside(y) {
        return x + y;
    }
    return inside;
}
// Think of it like: give me a function that adds 3 to whatever you give it
fn_inside = outside(3);
result = fn_inside(5); // 8

result1 = outside(3)(5); // 8
```

#### Preservation of variables

Notice how `x` is preserved when `inside` is returned. A closure must preserve the arguments and variables in all scopes it references. Since each call provides potentially different arguments, a new closure is created for each call to outside. The memory can be freed only when the returned `inside` is no longer accessible.

This is not different from storing references in other objects, but is often less obvious because one does not set the references directly and cannot inspect them.

#### Multiply-nested functions

Functions can be multiply-nested, i.e. a function (A) containing a function (B) containing a function (C). Both functions B and C form closures here, so B can access A and C can access B. In addition, since C can access B which can access A, C can also access A. Thus, the closures can contain multiple scopes; they recursively contain the scope of the functions containing it. This is called *scope chaining*. (Why it is called "chaining" will be explained later.)

Consider the following example:

```javascript
function A(x) {
    function B(y) {
        function C(z) {
            console.log(x + y + z);
        }
        C(3);
    }
    B(2);
}
A(1); // 6
```

In this example, `C` accesses `B`'s `y` and `A`'s `x`. This can be done because:

1. `B` forms a closure including `A`, i.e. `B` can access `A`'s arguments and variables.
2. `C` forms a closure including `B`.
3. Because `B`'s closure includes `A`, `C`'s closure includes `A`, `C` can access both `B` *and* `A`'s arguments and variables. In other words, `C`*chains* the scopes of `B` and `A` in that order.

The reverse, however, is not true. `A` cannot access `C`, because `A` cannot access any argument or variable of `B`, which `C` is a variable of. Thus, `C` remains private to only `B`.

#### Name conflicts

When two arguments or variables in the scopes of a closure have the same name, there is a *name conflict*. More inner scopes take precedence, so the inner-most scope takes the highest precedence, while the outer-most scope takes the lowest. This is the scope chain. The first on the chain is the inner-most scope, and the last is the outer-most scope. Consider the following:

```javascript
function outside() {
    var x = 10;
    function inside(x) {
        return x;
    }
    return inside;
}
result = outside()(20); // 20
```

### Closures

Closures are one of the most powerful features of JavaScript. JavaScript allows for the nesting of functions and grants the inner function full access to all the variables and functions defined inside the outer function (and all other variables and functions that the outer function has access to). However, the outer function does not have access to the variables and functions defined inside the inner function. This provides a sort of security for the variables of the inner function. Also, since the inner function has access to the scope of the outer function, the variables and functions defined in the outer function will live longer than the outer function itself, if the inner function manages to survive beyond the life of the outer function. A closure is created when the inner function is somehow made available to any scope outside the outer function.

```javascript
/* The outer function defines a variable called "name" */
var pet = function(name) {
    /* The inner function has access to the "name" variable of the outer function */
    var getName = function() {
        return name;
    };
    /* Return the inner function, thereby exposing it to outer scopes */
    return getName;
}, myPet = pet("Vivie");

myPet(); // "Vivie"
```

It can be much more complex than the code above. An object containing methods for manipulating the inner variables of the outer function can be returned.

```javascript
var createPet = function(name) {
    var sex;
    return {
        setName: function(newName) {
            name = newName;
        },
        getName: function() {
            return name;
        },
        getSex: function() {
            return sex;
        },
        setSex: function(newSex) {
            if (typeof newSex === "string" &&
                (newSex.toLowerCase() === "male" || newSex.toLowerCase() === "female")) {
                sex = newSex;
            }
        }
    };
};
var pet = createPet("Vivie");
pet.getName();
pet.setName("Oliver");
pet.setSex("male");
pet.getSex();
pet.getName();
```

In the code above, the `name` variable of the outer function is accessible to the inner functions, and there is no other way to access the inner variables except through the inner functions. The inner variables of the inner function act as safe stores for the inner functions. They hold "persistent", yet secure, data for the inner functions to work with. The functions do not even have to be assigned to a variable, or have a name.

```javascript
var getCode = (function() {
    var secureCode = "0]Eal(eh&2";
    return function() {
        return secureCode;
    };
})();

getCode(); // "0]Eal(eh&2"
```

There are, however, a number of pitfalls to watch out for when using closures. If an enclosed function defines a variable with the same name as the name of a variable in the outer scope, there is no way to refer to the variable in the outer scope again.

```javascript
/* Outer function defines a variable called "name" */
var createPet = function(name) {
    return {
        /* Enclosed function also defines a variable called "name" */
        setName: function(name) {
            /* ??? How do we access the "name" defined by the outer function ??? */
            name = name;
        }
    };
};
```

The magical `this` variable is very tricky in closures. They have to be used carefully, as what `this` refers to depends completely on where the function was called, rather than where it was defined.

### Using the arguments object

The arguments of a function are maintained in an array-like object. Within a function, you can address the arguments passed to it as follows:

> arguments[i]

where `i` is the ordinal number of the argument, starting at zero. So, the first argument passed to a function would be `arguments[0]`. The total number of arguments is indicated by `arguments.length`.

Using the `arguments` object, you can call a function with more arguments than it is formally declared to accept. This is often useful if you don't know in advance how many arguments will be passed to the function. You can use `arguments.length` to determine the number of arguments actually passed to the function, and then access each argument using the `arguments` object.

For example, consider a function that concatenates several strings. The only formal argument for the function is a string that specifies the characters that separate the items to concatenate. The function is defined as follows:

```javascript
function myConcat(separator) {
    var result = ""; // initialize list
    var i;
    // iterate through arguments
    for (i = 1; i < arguments.length; i++) {
        result += arguments[i] + separator;
    }
    return result;
}
```

You can pass any number of arguments to this function, and it concatenates each argument into a string "list":

```javascript
// "red, orange, blue, "
myConcat(", ", "red", "orange", "blue");
// "elephant; giraffe; lion; cheetah; "
myConcat("; ", "elephant", "giraffe", "lion", "cheetah");
// "sage. basil. oregano. pepper. parsley. "
myConcat(". ", "sage", "basil", "oregano", "pepper", "parsley");
```

**Note:** The `arguments` variable is "array-like", but not an array. It is array-like in that is has a numbered index and a `length` property. However, it does not possess all of the array-manipulation methods.

See the [`Function`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function) object in the JavaScript reference for more information.

### Function parameters

Starting with ECMAScript 6, there are two new kinds of parameters: default parameters and rest parameters.

#### Default parameters

In JavaScript, parameters of functions default to `undefined`. However, in some situations it might be useful to set a different default value. This is where default parameters can help.

In the past, the general strategy for setting defaults was to test parameter values in the body of the function and assign a value if they are `undefined`. If in the following example, no value is provided for `b` in the call, its value would be `undefined`  when evaluating `a*b` and the call to `multiply` would have returned `NaN`. However, this is caught with the second line in this example:

```javascript
function multiply(a, b) {
    b = typeof b !== 'undefined' ? b : 1;
    return a * b;
}
multiply(5); // 5
```

With default parameters, the check in the function body is no longer necessary. Now, you can simply put `1` as the default value for `b` in the function head:

```javascript
function multiply(a, b = 1) {
    return a * b;
}
multiply(5); // 5
```

Fore more details, see [default parameters](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/Default_parameters) in the reference.

#### Rest parameters

The [rest parameter](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/rest_parameters) syntax allows us to represent an indefinite number of arguments as an array. In the example, we use the rest parameters to collect arguments from the second one to the end. We then multiply them by the first one. This example is using an arrow function, which is introduced in the next section.

```javascript
function multiply(multiplier, ...theArgs) {
    return theArgs.map(x => multiplier * x);
}
var arr = multiply(2, 1, 2, 3);
console.log(arr); // [2, 4, 6]
```

### Arrow functions

An [arrow function expression](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/Arrow_functions) (also known as **fat arrow function**) has a shorter syntax compared to function expressions and lexically binds the `this` value. Arrow functions are always anonymous. See also this hacks.mozilla.org blog post: "[ES6 In Depth: Arrow functions](https://hacks.mozilla.org/2015/06/es6-in-depth-arrow-functions/)".

Two factors influenced the introduction of arrow functions: shorter functions and lexical `this`.

#### Shorter functions

In some functional patterns, shorter functions are welcome. Compare:

```javascript
var a = ["Hydrogen", "Helium", "Lithium", "Beryllium"];
var a2 = a.map(function(s) {
    return s.length;
});
console.log(a2); // [8, 6, 7, 9]
var a3 = a.map(s => s.length);
console.log(a3); // [8, 6, 7, 9]
```

#### Lexical `this`

Until arrow functions, every new function defined its own [this](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/this) value (a new object in case of a constructor, undefined in strict mode function calls, the context object if the function is called as an "object method", etc.). This proved to be annoying with an object-oriented style of programming.

```javascript
function Person() {
    // The Person() constructor defines `this` as itself.
    this.age = 0;
    setInterval(function growUp() {
        // In nonstrict mode, the growUp() function defines `this` as the global object,
        // which is different from the `this` defined by the Person() constructor.
        this.age++;
    }, 1000);
}
var p = new Person();
```

Alternatively, a [bound function](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/bind) could be created so that the proper `this` value would be passed to the `growUp()` function.

Arrow functions capture the `this` value of the enclosing context, so the following code works as expected.

```javascript
function Person() {
    this.age = 0;
    setInterval(() => {
        this.age++; // |this| properly refers to the person object
    });
}
var p = new Person();
```

### Predefined functions

JavaScript has several top-level, built-in functions:

[`eval()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/eval)

The **`eval()`** method evaluates JavaScript code represented as a string.

[`uneval()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/uneval) **

The **`uneval()`** method creates a string representation of the source code of an [`Object`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object).

[`isFinite()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/isFinite)

The global **`isFinite()`** function determines whether the passed value is a finite number. If needed, the parameter is first converted to a number.

[`isNaN()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/isNaN)

The **`isNaN()`** function determines whether a value is [`NaN`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NaN) or not. Note: coercion inside the `isNaN` function has [interesting](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/isNaN#Description) rules; you may alternatively want to use [`Number.isNaN()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isNaN), as defined in ECMAScript 6, or you can use `typeof` to determine if the value is Not-A-Number.

[`parseFloat()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseFloat)

The **`parseFloat()`** function parses a string argument and returns a floating point number.

[`parseInt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt)

The **`parseInt()`** function parses a string argument and returns an integer of the specified radix (the base in mathematical numeral systems).

[`decodeURI()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/decodeURI)

The **`decodeURI()`** function decodes a Uniform Resource Identifier (URI) previously created by [`encodeURI`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURI) or by a similar routine.

[`decodeURIComponent()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/decodeURIComponent)

The **`decodeURIComponent()`** method decodes a Uniform Resource Identifier (URI) component previously created by [`encodeURIComponent`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURIComponent) or by a similar routine.

[`encodeURI()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURI)

The **`encodeURI()`** method encodes a Uniform Resource Identifier (URI) by replacing each instance of certain characters by one, two, three, or four escape sequences representing the UTF-8 encoding of the character (will only be four escape sequences for characters composed of two "surrogate" characters).

[`encodeURIComponent()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURIComponent)

The **`encodeURIComponent()`** method encodes a Uniform Resource Identifier (URI) component by replacing each instance of certain characters by one, two, three, or four escape sequences representing the UTF-8 encoding of the character (will only be four escape sequences for characters composed of two "surrogate" characters).

[`escape()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/escape)

The deprecated **`escape()`** method computes a new string in which certain characters have been replaced by a hexadecimal escape sequence. Use [`encodeURI`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURI) or [`encodeURIComponent`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURIComponent) instead.

[`unescape()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/unescape)

The deprecated **`unescape()`** method computes a new string in which hexadecimal escape sequences are replaced with the character that it represents. The escape sequences might be introduced by a function like [`escape`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/escape). Because `unescape()` is deprecated, use [`decodeURI()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/decodeURI) or [`decodeURIComponent`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/decodeURIComponent) instead.

## Expressions and operators

### Operators

#### Assignment operators

##### Destructuring

For more complex assignments, the [destructuring assignment](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment) syntax is a JavaScript expression that makes it possible to extract data from arrays or objects using a syntax that mirrors the construction of array and object literals.

```javascript
var foo = ["one", "two", "three"];
// without destructuring
var one = foo[0];
var two = foo[1];
var three = foo[2];
// with destructuring
var [one, two, three] = foo;
```

#### Logical operators

Examples of expressions that can be converted to `false` are those that evaluate to null, 0, NaN, the empty string (""), or undefined.

```javascript
var a1 = true && true; // true
var a2 = true && false; // false
var a3 = false && true; // false
var a4 = false && (3 == 4); // false
var a5 = "Cat" && "Dog"; // "Dog"
var a6 = false && "Cat"; // false
var a7 = "Cat" && false; // false
var o1 = true || true; // true
var o2 = false || true; // true
var o3 = true || false; // true
var o4 = false || (3 == 4); // false
var o5 = "Cat" || "Dog"; // "Cat"
var o6 = false || "Cat"; // "Cat"
var o7 = "Cat" || false; // "Cat"
var n1 = !true; // false
var n2 = !false; // true
var n3 = !"Cat"; // false
```

##### Short-circuit evaluation

As logical expressions are evaluated left to right, they are tested for possible "short-circuit" evaluation using the following rules:

- `false` && *anything* is short-circuit evaluated to false.
- `true` || *anything* is short-circuit evaluated to true.
- The rules of logic guarantee that these evaluations are always correct. Note that the *anything* part of the above expressions is not evaluated, so any side effects of doing so do not take effect.

#### Comma operator

The [comma operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Comma_Operator) (`,`) simply evaluates both of its operands and returns the value of the last operand. This operator is primarily used inside a `for` loop, to allow multiple variables to be updated each time through the loop.

#### Unary operators

A unary operation is an operation with only one operand.

##### `delete`

The `delete` operator deletes an object, an object's property, or an element at a specified index in an array. The syntax is:

```javascript
delete objectName;
delete objectName.property;
delete objectName[index];
delete property; // legal only within a with statement
```

where `objectName` is the name of an object, `property` is an existing property, and `index` is an integer representing the location of an element in an array.

The fourth form is legal only within a `with` statement, to delete a property from an object.

You can use the `delete` operator to delete variables declared implicitly but not those declared with the `var` statement.

If the `delete` operator succeeds, it sets the property or element to `undefined`. The `delete` operator returns true if the operation is possible; it returns `false` if the operation is not possible.

```javascript
x = 42;
var y = 43;
myobj = new Number();
myobj.h = 4; // create property h
delete x; // true (can delete if declared implicitly)
delete y; // false (cannot delete if declared with var)
delete Math.PI; // false (cannot delete predefined properties)
delete myobj.h; // true (can delete user-defined properties)
delete myobj; // true (can delete if declared implicitly)
```

###### Deleting array elements

When you delete an array element, the array length is not affected. For example, if you delete `a[3]`, `a[4]` is still `a[4]` and `a[3]` is undefined.

When the `delete` operator removes an array element, that element is no longer in the array. In the following example, `trees[3]` is removed with `delete`. However, `trees[3]` is still addressable and returns `undefined`.

```javascript
var trees = ["redwood", "bay", "cedar", "oak", "maple"];
delete trees[3];
if (3 in trees) {
    // this does not get executed
}
```

If you want an array element to exist but have an undefined value, use the `undefined` keyword instead of the `delete`operator. In the following example, `trees[3]` is assigned the value `undefined`, but the array element still exists:

```javascript
var trees = ["redwood", "bay", "cedar", "oak", "maple"];
trees[3] = undefined;
if (3 in trees) {
    // this gets executed
}
```

##### `typeof`

The [`typeof` operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/typeof) is used in either of the following ways:

> typeof operand
> typeof (operand)

The `typeof` operator returns a string indicating the type of the unevaluated operand. `operand` is the string, variable, keyword, or object for which the type is to be returned. The parentheses are optional.

Suppose you define the following variables, the `typeof` operator returns the following results for these variables:

```javascript
var myFun = new Function("5 + 2");
var shape = "round";
var size = 1;
var today = new Date();
typeof myFun; // "function"
typeof shape; // "string"
typeof size; // "number"
typeof today; // "object"
typeof doesntExist; // "undefined"
```

For the keywords `true` and `null`, the `typeof` operator returns the following results:

```javascript
typeof true; // "boolean"
typeof null; // "object"
```

For a number or string, the `typeof` operator returns the following results:

```javascript
typeof 62; // "number"
typeof "Hello world"; // "string"
```

For property values, the `typeof` operator returns the type of value the property contains:

```javascript
typeof document.lastModified; // "string"
typeof window.length; // "number"
typeof Math.LN2; // "number"
```

For methods and functions, the `typeof` operator returns results as follows:

```javascript
typeof blur; // "function"
typeof eval; // "function"
typeof parseInt; // "function"
typeof shape.split; // "function"
```

For predefined objects, the `typeof` operator returns results as follows:

```javascript
typeof Date; // "function"
typeof Function; // "function"
typeof Math; // "object"
typeof Option; // "function"
typeof String; // "function"
```

##### `void`

The [`void` operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/void) is used in either of the following ways:

> void (expression)
> void expression

The `void` operator specifies an expression to be evaluated without returning a value. `expression` is a JavaScript expression to evaluate. The parentheses surrounding the expression are optional, but it is good style to use them.

You can use the `void` operator to specify an expression as a hypertext link. The expression is evaluated but is not loaded in place of the current document.

The following code creates a hypertext link that does nothing when the user clicks it. When the user clicks the link, `void(0)` evaluates to `undefined`, which has no effect in JavaScript.

```html
<a href="javascript:void(0)">Click here to do nothing</a>
```

The following code creates a hypertext link that submits a form when the user clicks it.

```html
<a href="javascript:void(document.form.submit())">Click here to submit</a>
```

#### Relational operators

A relational operator compares its operands and returns a `Boolean` value based on whether the comparison is true.

##### `in`

The [`in` operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/in) returns true if the specified property is in the specified object. The syntax is:

> propNameOrNumber in objectName

where `propNameOrNumber` is a string or numeric expression representing a property name or array index, and `objectName`is the name of an object.

The following examples show some uses of the `in` operator.

```javascript
// Arrays
var trees = ["redwood", "bay", "cedar", "oak", "maple"];
0 in trees; // true
3 in trees; // true
6 in trees; // true
"bay" in trees; // false (you must specify the index number, not the value at that index)
"length" in trees; // true (length is an Array property)
// built-in objects
"PI" in Math; // true
var myString = new String("coral");
"length" in myString; // true
// Custom objects
var mycar = {make: "Honda", model: "Accord", year: 1998};
"make" in mycar; // true
"model" in mycar; // true
```

##### `instanceof`

The [`instanceof` operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/instanceof) returns true if the specified object is of the specified object type. The syntax is:

> objectName instanceof objectType

where `objectName` is the name of the object to compare to `objectType`, and `objectType` is an object type, such as [`Date`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date) or [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array).

Use `instanceof` when you need to confirm the type of an object at runtime. For example, when catching exceptions, you can branch to different exception-handling code depending on the type of exception thrown.

For example, the following code uses `instanceof` to determine whether `theDay` is a `Date` object. Because `theDay` is a `Date`object, the statements in the `if` statement execute.

```javascript
var theDay = new Date(1995, 12, 17);
if (theDay instanceof Date) {
    // statements to execute
}
```

#### Operator precedence

The *precedence* of operators determines the order they are applied when evaluating an expression. You can override operator precedence by using parentheses.

The following table describes the precedence of operators, from highest to lowest.

**Operator precedence**

| Operator type          | Individual operators                     |
| ---------------------- | ---------------------------------------- |
| member                 | `. []`                                   |
| call / create instance | `() new`                                 |
| negation/increment     | `! ~ - + ++ -- typeof void delete`       |
| multiply/divide        | `* / %`                                  |
| addition/subtraction   | `+ -`                                    |
| bitwise shift          | `<< >> >>>`                              |
| relational             | `< <= > >= in instanceof`                |
| equality               | `== != === !==`                          |
| bitwise-and            | `&`                                      |
| bitwise-xor            | `^`                                      |
| bitwise-or             | `|`                                      |
| logical-and            | `&&`                                     |
| logical-or             | `||`                                     |
| conditional            | `?:`                                     |
| assignment             | `= += -= *= /= %= <<= >>= >>>= &= ^= |=` |
| comma                  | `,`                                      |

A more detailed version of this table, complete with links to additional details about each operator, may be found in [JavaScript Reference](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Operator_Precedence#Table).

### Expressions

An *expression* is any valid unit of code that resolves to a value.

Every syntactically valid expression resolves to some value but conceptually, there are two types of expressions: with side effects (for example: those that assign value to a variable) and those that in some sense evaluates and therefore resolves to value.

The expression `x = 7` is an example of the first type. This expression uses the =* operator* to assign the value seven to the variable `x`. The expression itself evaluates to seven.

The code `3 + 4` is an example of the second expression type. This expression uses the + operator to add three and four together without assigning the result, seven, to a variable.

JavaScript has the following expression categories:

- Arithmetic: evaluates to a number, for example 3.14159. (Generally uses [arithmetic operators](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Expressions_and_Operators#Arithmetic_operators).)
- String: evaluates to a character string, for example, "Fred" or "234". (Generally uses [string operators](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Expressions_and_Operators#String_operators).)
- Logical: evaluates to true or false. (Often involves [logical operators](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Expressions_and_Operators#Logical_operators).)
- Primary expressions: Basic keywords and general expressions in JavaScript.
- Left-hand-side expressions: Left values are the destination of an assignment.

#### Primary expressions

Basic keywords and general expressions in JavaScript.

##### `this`

Use the [`this` keyword](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/this) to refer to the current object. In general, `this` refers to the calling object in a method. Use `this`either with the dot or the bracket notation:

> this["propertyName"]
> this.propertyName

Suppose a function called `validate` validates an object's `value` property, given the object and the high and low values:

```javascript
function validate(obj, lowval, hival) {
    if ((obj.value < lowval) || (obj.value > hival)) {
        console.log("Invalid Value!");
    }
}
```

You could call `validate` in each form element's `onChange` event handler, using `this` to pass it the form element, as in the following example:

```html
<p>Enter a number between 18 and 99:</p>
<input type="text" name="age" size="3" onchange="validate(this, 18, 99);">
```

#### Left-hand-side expressions

Left values are the destination of an assignment.

##### `new`

You can use the [`new` operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/new) to create an instance of a user-defined object type or of one of the built-in object types. Use `new` as follows:

```javascript
var objectName = new objectType([param1, param2, ..., paramN]);
```

##### super

The [super keyword](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/super) is used to call functions on an object's parent. It is useful with [classes](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Classes) to call the parent constructor, for example.

> super([arguments]); // calls the parent constructor.
> super.functionOnParent([arguments]);

##### Spread operator

The [spread operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Spread_operator) allows an expression to be expanded in places where multiple arguments (for function calls) or multiple elements (for array literals) are expected.
Example: Today if you have an array and want to create a new array with the existing one being part of it, the array literal syntax is no longer sufficient and you have to fall back to imperative code, using a combination of push, splice, concat, etc. With spread syntax this becomes much more succinct:

```javascript
var parts = ['shoulder', 'knees'];
var lyrics = ['head', ...parts, 'and', 'toes'];
```

Similarly, the spread operator works with function calls:

```javascript
function f(x, y, z) {
    return x + y + z;
}
var args = [0, 1, 2];
f(...args); // 3
```

## Numbers and dates

### Numbers

In JavaScript, all numbers are implemented in [double-precision 64-bit binary format IEEE 754](https://en.wikipedia.org/wiki/Double-precision_floating-point_format) (i.e. a number between -(2^53^ -1) and 2^53^ -1). **There is no specific type for integers**. In addition to being able to represent floating-point numbers, the number type has three symbolic values: `+`[`Infinity`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Infinity), `-`[`Infinity`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Infinity), and [`NaN`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NaN) (not-a-number). See also [JavaScript data types and structures](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Data_structures) for context with other primitive types in JavaScript.

You can use four types of number literals: decimal, binary, octal, and hexadecimal.

#### Decimal numbers

```javascript
1234567890
42
// Caution when using leading zeros:
0888 // 888 parsed as decimal
0777 // parsed as octal in non-strict mode (511 in decimal)
```

Note that decimal literals can start with a zero (`0`) followed by another decimal digit, but if every digit after the leading `0` is smaller than 8, the number gets parsed as an octal number.

#### Binary numbers

Binary number syntax uses a leading zero followed by a lowercase or uppercase Latin letter "B" (`0b` or `0B`). If the digits after the `0b` are not 0 or 1, the following `SyntaxError` is thrown: "Missing binary digits after 0b".

```javascript
var FLT_SIGNBIT = 0b10000000000000000000000000000000; // 2147483648
var FLT_EXPONENT = 0b01111111100000000000000000000000; // 2139095040
var FLT_MANTISSA = 0B00000000011111111111111111111111; // 8388607
```

#### Octal numbers

Octal number syntax uses a leading zero. If the digits after the `0` are outside the range 0 through 7, the number will be interpreted as a decimal number.

```javascript
var n = 0755; // 493
var m = 0644; // 420
```

Strict mode in ECMAScript 5 forbids octal syntax. Octal syntax isn't part of ECMAScript 5, but it's supported in all browsers by prefixing the octal number with a zero: `0644 === 420` and`"\045" === "%"`. In ECMAScript 6 Octal number is supported with by prefixing a number with "`0`o". i.e. 

```javascript
var a = 0o10; // ES6: Octal
```

#### Hexadecimal numbers

Hexadecimal number syntax uses a leading zero followed by a lowercase or uppercase Latin letter "X" (`0x` or `0X)`. If the digits after 0x are outside the range (0123456789ABCDEF),  the following `SyntaxError` is thrown: "Identifier starts immediately after numeric literal".

```javascript
0xFFFFFFFFFFFFFFFFF // 295147905179352830000
0x123456789ABCDEF   // 81985529216486900
0XA                 // 10
```

#### Exponentiation

```javascript
1E3 // 1000
2e6 // 2000000
0.1e2 // 10
```

### `Number` object

The built-in [`Number`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number) object has properties for numerical constants, such as maximum value, not-a-number, and infinity. You cannot change the values of these properties and you use them as follows:

```javascript
var biggestNum = Number.MAX_VALUE;
var smallestNum = Number.MIN_VALUE;
var infiniteNum = Number.POSITIVE_INFINITY;
var negInfiniteNum = Number.NEGATIVE_INFINITY;
var notANum = Number.NaN;
```

You always refer to a property of the predefined `Number` object as shown above, and not as a property of a `Number` object you create yourself.

The following table summarizes the `Number` object's properties.

**Properties of `Number`**

| Property                                 | Description                              |
| ---------------------------------------- | ---------------------------------------- |
| [`Number.MAX_VALUE`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/MAX_VALUE) | The largest representable number         |
| [`Number.MIN_VALUE`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/MIN_VALUE) | The smallest representable number        |
| [`Number.NaN`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/NaN) | Special "not a number" value             |
| [`Number.NEGATIVE_INFINITY`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/NEGATIVE_INFINITY) | Special negative infinite value; returned on overflow |
| [`Number.POSITIVE_INFINITY`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/POSITIVE_INFINITY) | Special positive infinite value; returned on overflow |
| [`Number.EPSILON`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/EPSILON) | Difference between one and the smallest value greater than one that can be represented as a [`Number`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number). |
| [`Number.MIN_SAFE_INTEGER`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/MIN_SAFE_INTEGER) | Minimum safe integer in JavaScript.      |
| [`Number.MAX_SAFE_INTEGER`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/MAX_SAFE_INTEGER) | Maximum safe integer in JavaScript.      |

**Methods of `Number**`

| Method                                   | Description                              |
| ---------------------------------------- | ---------------------------------------- |
| [`Number.parseFloat()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/parseFloat) | Parses a string argument and returns a floating point number.Same as the global [`parseFloat()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseFloat) function. |
| [`Number.parseInt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/parseInt) | Parses a string argument and returns an integer of the specified radix or base.Same as the global [`parseInt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt) function. |
| [`Number.isFinite()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isFinite) | Determines whether the passed value is a finite number. |
| [`Number.isInteger()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isInteger) | Determines whether the passed value is an integer. |
| [`Number.isNaN()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isNaN) | Determines whether the passed value is [`NaN`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NaN). More robust version of the original global [`isNaN()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/isNaN). |
| [`Number.isSafeInteger()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isSafeInteger) | Determines whether the provided value is a number that is a safe integer. |

The `Number` prototype provides methods for retrieving information from `Number` objects in various formats. The following table summarizes the methods of `Number.prototype`.

**Methods of `Number.prototype`**

| Method                                   | Description                              |
| ---------------------------------------- | ---------------------------------------- |
| [`toExponential()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/toExponential) | Returns a string representing the number in exponential notation. |
| [`toFixed()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/toFixed) | Returns a string representing the number in fixed-point notation. |
| [`toPrecision()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/toPrecision) | Returns a string representing the number to a specified precision in fixed-point notation. |

### `Math` object

The built-in [`Math`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math) object has properties and methods for mathematical constants and functions. For example, the `Math`object's `PI` property has the value of pi (3.141...), which you would use in an application as

```javascript
Math.PI
```

Similarly, standard mathematical functions are methods of `Math`. These include trigonometric, logarithmic, exponential, and other functions. For example, if you want to use the trigonometric function sine, you would write

```javascript
Math.sin(1.56)
```

Note that all trigonometric methods of `Math` take arguments in radians.

The following table summarizes the `Math` object's methods.

**Methods of `Math`**

| Method                                   | Description                              |
| ---------------------------------------- | ---------------------------------------- |
| [`abs()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/abs) | Absolute value                           |
| [`sin()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/sin), [`cos()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/cos), [`tan()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/tan) | Standard trigonometric functions; argument in radians |
| [`asin()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/asin), [`acos()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/acos), [`atan()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/atan), [`atan2()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/atan2) | Inverse trigonometric functions; return values in radians |
| [`sinh()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/sinh), [`cosh()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/cosh), [`tanh()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/tanh) | Hyperbolic trigonometric functions; return values in radians. |
| [`asinh()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/asinh), [`acosh()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/acosh), [`atanh()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/atanh) | Inverse hyperbolic trigonometric functions; return values in radians. |
| [`pow()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/pow), [`exp()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/exp), [`expm1()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/expm1), [`log10()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/log10), [`log1p()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/log1p), [`log2()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/log2) | Exponential and logarithmic functions.   |
| [`floor()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/floor), [`ceil()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/ceil) | Returns largest/smallest integer less/greater than or equal to argument |
| [`min()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/min), [`max()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/max) | Returns lesser or greater (respectively) of comma separated list of numbers arguments |
| [`random()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random) | Returns a random number between 0 and 1. |
| [`round()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/round), [`fround()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/fround), [`trunc()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/trunc), | Rounding and truncation functions.       |
| [`sqrt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/sqrt), [`cbrt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/cbrt), [`hypot()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/hypot) | Square root, cube root, Square root of the sum of square arguments. |
| [`sign()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/sign) | The sign of a number, indicating whether the number is positive, negative or zero. |
| [`clz32()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/clz32),[`imul()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/imul) | Number of leading zero bits in the 32-bit binary representation.The result of the C-like 32-bit multiplication of the two arguments. |

Unlike many other objects, you never create a `Math` object of your own. You always use the built-in `Math` object.

### `Date` object

JavaScript does not have a date data type. However, you can use the [`Date`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date) object and its methods to work with dates and times in your applications. The `Date` object has a large number of methods for setting, getting, and manipulating dates. It does not have any properties.

JavaScript handles dates similarly to Java. The two languages have many of the same date methods, and both languages store dates as the number of milliseconds since January 1, 1970, 00:00:00.

The `Date` object range is -100,000,000 days to 100,000,000 days relative to 01 January, 1970 UTC.

To create a `Date` object:

```javascript
var dateObjectName = new Date([parameters]);
```

where `dateObjectName` is the name of the `Date` object being created; it can be a new object or a property of an existing object.

Calling `Date` without the `new` keyword returns a string representing the current date and time.

The `parameters` in the preceding syntax can be any of the following:

- Nothing: creates today's date and time. For example, `today = new Date();`.
- A string representing a date in the following form: "Month day, year hours:minutes:seconds." For example, `var Xmas95 = new Date("December 25, 1995 13:30:00")`. If you omit hours, minutes, or seconds, the value will be set to zero.
- A set of integer values for year, month, and day. For example, `var Xmas95 = new Date(1995, 11, 25)`.
- A set of integer values for year, month, day, hour, minute, and seconds. For example, `var Xmas95 = new Date(1995, 11, 25, 9, 30, 0);`.

#### Methods of the `Date` object

The `Date` object methods for handling dates and times fall into these broad categories:

- "set" methods, for setting date and time values in `Date` objects.
- "get" methods, for getting date and time values from `Date` objects.
- "to" methods, for returning string values from `Date` objects.
- parse and UTC methods, for parsing `Date` strings.

With the "get" and "set" methods you can get and set seconds, minutes, hours, day of the month, day of the week, months, and years separately. There is a `getDay` method that returns the day of the week, but no corresponding `setDay`method, because the day of the week is set automatically. These methods use integers to represent these values as follows:

- Seconds and minutes: 0 to 59
- Hours: 0 to 23
- Day: 0 (Sunday) to 6 (Saturday)
- Date: 1 to 31 (day of the month)
- Months: 0 (January) to 11 (December)
- Year: years since 1900

For example, suppose you define the following date:

```javascript
var Xmas95 = new Date("December 25, 1995");
```

Then `Xmas95.getMonth()` returns 11, and `Xmas95.getFullYear()` returns 1995.

The `getTime` and `setTime` methods are useful for comparing dates. The `getTime` method returns the number of milliseconds since January 1, 1970, 00:00:00 for a `Date` object.

For example, the following code displays the number of days left in the current year:

```javascript
var today = new Date();
var endYear = new Date(1995, 11, 31, 23, 59, 59, 999); // Set day and month
endYear.setFullYear(today.getFullYear()); // Set year to this year
var msPerDay = 24 * 60 * 60 * 1000; // Number of milliseconds per day
var daysLeft = (endYear.getTime() - today.getTime()) / msPerDay;
var daysLeft = Math.round(daysLeft); // returns days left in the year
```

This example creates a `Date` object named `today` that contains today's date. It then creates a `Date` object named `endYear`and sets the year to the current year. Then, using the number of milliseconds per day, it computes the number of days between `today` and `endYear`, using `getTime` and rounding to a whole number of days.

The `parse` method is useful for assigning values from date strings to existing `Date` objects. For example, the following code uses `parse` and `setTime` to assign a date value to the `IPOdate` object:

```javascript
var IPOdate = new Date();
IPOdate.setTime(Date.parse("Aug 9, 1995"));
```

#### Example

In the following example, the function `JSClock()` returns the time in the format of a digital clock.

```javascript
function JSClock() {
    var time = new Date();
    var hour = time.getHours();
    var minute = time.getMinutes();
    var second = time.getSeconds();
    var temp = "" + ((hour > 12) ? hour - 12 : hour);
    if (hour == 0) {
        temp = "12";
    }
    temp += ((minute < 10) ? ":0" : ":") + minute;
    temp += ((second < 10) ? ":0" : ":") + second;
    temp += (hour > 12) ? " P.M." : " A.M.";
    return temp;
}
```

The `JSClock` function first creates a new `Date` object called `time`; since no arguments are given, time is created with the current date and time. Then calls to the `getHours`, `getMinutes`, and `getSeconds` methods assign the value of the current hour, minute, and second to `hour`, `minute`, and `second`.

The next four statements build a string value based on the time. The first statement creates a variable `temp`, assigning it a value using a conditional expression; if `hour` is greater than 12, (`hour - 12`), otherwise simply hour, unless hour is 0, in which case it becomes 12.

The next statement appends a `minute` value to `temp`. If the value of `minute` is less than 10, the conditional expression adds a string with a preceding zero; otherwise it adds a string with a demarcating colon. Then a statement appends a seconds value to `temp` in the same way.

Finally, a conditional expression appends "P.M." to `temp` if `hour` is 12 or greater; otherwise, it appends "A.M." to `temp`.

## Text formatting

### Strings

JavaScript's [String](https://developer.mozilla.org/en-US/docs/Glossary/String) type is used to represent textual data. It is a set of "elements" of 16-bit unsigned integer values. Each element in the String occupies a position in the String. The first element is at index 0, the next at index 1, and so on. The length of a String is the number of elements in it. You can create strings using string literals or string objects.

#### String literals

You can create simple strings using either single or double quotes:

```javascript
'foo'
'bar'
```

More advanced strings can be created using escape sequences:

##### Hexadecimal escape sequences

The number after \x is interpreted as a [hexadecimal](https://en.wikipedia.org/wiki/Hexadecimal) number.

```javascript
'\xA9' // "©"
```

##### Unicode escape sequences

The Unicode escape sequences require at least four characters following `\u`.

```javascript
'\u00A9' // "©"
```

##### Unicode code point escapes

New in ECMAScript 6. With Unicode code point escapes, any character can be escaped using hexadecimal numbers so that it is possible to use Unicode code points up to `0x10FFFF`. With simple Unicode escapes it is often necessary to write the surrogate halves separately to achieve the same.

See also [`String.fromCodePoint()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/fromCodePoint) or [`String.prototype.codePointAt()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/codePointAt).

```javascript
'\u{2F804}'

// the same with simple Unicode escapes
'\uD87E\uDC04'
```

#### String objects

The [`String`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String) object is a wrapper around the string primitive data type.

```javascript
var s = new String("foo"); // Creates a String object
console.log(s); // Displays: {0: "f", 1: "o", 2: "0"}
typeof s; // "object"
```

You can call any of the methods of the `String` object on a string literal value—JavaScript automatically converts the string literal to a temporary `String` object, calls the method, then discards the temporary `String` object. You can also use the `String.length` property with a string literal.

You should use string literals unless you specifically need to use a `String` object, because `String` objects can have counterintuitive behavior. For example:

```javascript
var s1 = "2 + 2";
var s2 = new String("2 + 2");
eval(s1); // 4
eval(s2); // "2 + 2"
```

A `String` object has one property, `length`, that indicates the number of characters in the string. For example, the following code assigns `x` the value 13, because "Hello, World!" has 13 characters, you can access each character using an array bracket style, you can't change characters since strings are immutable array-like objects:

```javascript
var mystring = "Hello, World!";
var x = mystring.length;
mystring[0] = "L"; // This has no effect
mystring[0]; // "H"
```

A `String` object has a variety of methods: for example those that return a variation on the string itself, such as `substring` and `toUpperCase`.

The following table summarizes the methods of [`String`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String) objects.

##### Methods of `String`

| Method                                   | Description                              |
| ---------------------------------------- | ---------------------------------------- |
| [`charAt`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/charAt), [`charCodeAt`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/charCodeAt), [`codePointAt`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/codePointAt) | Return the character or character code at the specified position in string. |
| [`indexOf`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/indexOf), [`lastIndexOf`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/lastIndexOf) | Return the position of specified substring in the string or last position of specified substring, respectively. |
| [`startsWith`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/startsWith), [`endsWith`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/endsWith), [`includes`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/includes) | Returns whether or not the string starts, ends or contains a specified string. |
| [`concat`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/concat) | Combines the text of two strings and returns a new string. |
| [`fromCharCode`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/fromCharCode), [`fromCodePoint`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/fromCodePoint) | Constructs a string from the specified sequence of Unicode values. This is a method of the String class, not a String instance. |
| [`split`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/split) | Splits a `String` object into an array of strings by separating the string into substrings. |
| [`slice`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/slice) | Extracts a section of a string and returns a new string. |
| [`substring`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/substring), [`substr`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/substr) | Return the specified subset of the string, either by specifying the start and end indexes or the start index and a length. |
| [`match`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/match), [`replace`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace), [`search`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/search) | Work with regular expressions.           |
| [`toLowerCase`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/toLowerCase), [`toUpperCase`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/toUpperCase) | Return the string in all lowercase or all uppercase, respectively. |
| [`normalize`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/normalize) | Returns the Unicode Normalization Form of the calling string value. |
| [`repeat`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/repeat) | Returns a string consisting of the elements of the object repeated the given times. |
| [`trim`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/trim) | Trims whitespace from the beginning and end of the string. |

#### Multi-line template literals

[Template literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals) are string literals allowing embedded expressions. You can use multi-line strings and string interpolation features with them.

Template literals are enclosed by the back-tick (` `) ([grave accent](https://en.wikipedia.org/wiki/Grave_accent)) character instead of double or single quotes. Template literals can contain place holders. These are indicated by the Dollar sign and curly braces (`${expression}`).

##### Multi-lines

Any new line characters inserted in the source are part of the template literal. Using normal strings, you would have to use the following syntax in order to get multi-line strings:

```javascript
console.log("string text line 1\n\string text line 2");
```

To get the same effect with multi-line strings, you can now write:

```javascript
console.log(`string text line 1
string text line 2`);
```

##### Embedded expressions

In order to embed expressions within normal strings, you would use the following syntax:

```javascript
var a = 5, b = 10;
console.log("Fifteen is " + (a + b) + " and\nnot " + (2 * a + b) + ".");
```

Now, with template literals, you are able to make use of the syntactic sugar making substitutions like this more readable:

```javascript
var a = 5, b = 10;
console.log(`Fifteen is ${a + b} and\nnot ${2 * a + b}.`);
```

For more information, read about [Template literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals) in the [JavaScript reference](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference).

### Internationalization

The [`Intl`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl) object is the namespace for the ECMAScript Internationalization API, which provides language sensitive string comparison, number formatting, and date and time formatting. The constructors for [`Collator`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Collator), [`NumberFormat`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NumberFormat), and [`DateTimeFormat`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/DateTimeFormat) objects are properties of the `Intl` object.

#### Date and time formatting

The [`DateTimeFormat`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/DateTimeFormat) object is useful for formatting date and time. The following formats a date for English as used in the United States. (The result is different in another time zone.)

```javascript
var msPerDay = 24 * 60 * 60 * 1000;

// December 15, 2016 00:00:00 UTC
var dec152016 = new Date(msPerDay * (46 * 365 + 11 + 349));
var current = new Date();
var options = {
    year: "2-digit", month: "2-digit", day: "2-digit",
    hour: "2-digit", minute: "2-digit", timeZoneName: "short"
};
var americanDateTime = new Intl.DateTimeFormat("en-US", options).format;
var chineseDateTime = new Intl.DateTimeFormat("zh-CN", options).format;
console.log(americanDateTime(dec152016)); // 12/15/16, 8:00 AM GMT+8
console.log(chineseDateTime(dec152016)); // 16/12/15 GMT+8 上午8:00
console.log(americanDateTime(current)); // 12/15/16, 4:33 PM GMT+8
console.log(chineseDateTime(current)); // 16/12/15 GMT+8 下午4:33
```

#### Number formatting

The [`NumberFormat`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NumberFormat) object is useful for formatting numbers, for example currencies.

```javascript
var gasPrice = new Intl.NumberFormat("en-US",
                        {style: "currency", currency: "USD", minimumFractionDigits: 3});
console.log(gasPrice.format(5.259)); // $5.259
var hanDecimalRMBInChina = new Intl.NumberFormat("zh-CN-u-nu-hanidec",
                                    {style: "currency", currency: "CNY"});
console.log(hanDecimalRMBInChina.format(1314.25)); // ￥一,三一四.二五
var decimalRMBInChina = new Intl.NumberFormat("zh-CN",
                                    {style: "currency", currency: "CNY"});
console.log(hanDecimalRMBInChina.format(1314.25)); // ￥1,314.25
```

#### Collation

The [`Collator`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Collator) object is useful for comparing and sorting strings.

For more information about the [`Intl`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl) API, see also [Introducing the JavaScript Internationalization API](https://hacks.mozilla.org/2014/12/introducing-the-javascript-internationalization-api/).

## Regular Expressions

> Regular expressions are patterns used to match character combinations in strings. In JavaScript, regular expressions are also objects. These patterns are used with the [`exec`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp/exec) and [`test`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp/test) methods of [`RegExp`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp), and with the [`match`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/match), [`replace`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace), [`search`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/search), and [`split`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/split) methods of [`String`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String). This chapter describes JavaScript regular expressions.

### Creating a regular expression

You construct a regular expression in one of two ways:

```javascript
var re = /ab+c/;
```

Regular expression literals provide compilation of the regular expression when the script is loaded. When the regular expression will remain constant, use this for better performance.

Or calling the constructor function of the [`RegExp`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp) object, as follows:

```javascript
var re = new RegExp("ab+c");
```

Using the constructor function provides runtime compilation of the regular expression. Use the constructor function when you know the regular expression pattern will be changing, or you don't know the pattern and are getting it from another source, such as user input.

### Writing a regular expression pattern

A regular expression pattern is composed of simple characters, such as `/abc/`, or a combination of simple and special characters, such as `/ab*c/` or `/Chapter (\d+)\.\d*/`. The last example includes parentheses which are used as a memory device. The match made with this part of the pattern is remembered for later use, as described in [Using parenthesized substring matches](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions#Using_parenthesized_substring_matches).

#### Using simple patterns

Simple patterns are constructed of characters for which you want to find a direct match. For example, the pattern `/abc/` matches character combinations in strings only when exactly the characters 'abc' occur together and in that order. Such a match would succeed in the strings "Hi, do you know your abc's?" and "The latest airplane designs evolved from slabcraft." In both cases the match is with the substring 'abc'. There is no match in the string 'Grab crab' because while it contains the substring 'ab c', it does not contain the exact substring 'abc'.

#### [Using special characters](//developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions#Using_special_characters)

When the search for a match requires something more than a direct match, such as finding one or more b's, or finding white space, the pattern includes special characters. For example, the pattern `/ab*c/` matches any character combination in which a single 'a' is followed by zero or more 'b's (`*` means 0 or more occurrences of the preceding item) and then immediately followed by 'c'. In the string "cbbabbbbcdebc," the pattern matches the substring 'abbbbc'.

#### [Using parentheses](//developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions#Using_parentheses)

### Working with regular expressions

Regular expressions are used with the `RegExp` methods `test` and `exec` and with the `String` methods `match`, `replace`, `search`, and `split`. These methods are explained in detail in the [JavaScript reference](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference).

**Methods that use regular expressions**

| Method                                   | Description                              |
| ---------------------------------------- | ---------------------------------------- |
| [`exec`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp/exec) | A `RegExp` method that executes a search for a match in a string. It returns an array of information or null on a mismatch. |
| [`test`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp/test) | A `RegExp` method that tests for a match in a string. It returns true or false. |
| [`match`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/match) | A `String` method that executes a search for a match in a string. It returns an array of information or null on a mismatch. |
| [`search`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/search) | A `String` method that tests for a match in a string. It returns the index of the match, or -1 if the search fails. |
| [`replace`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace) | A `String` method that executes a search for a match in a string, and replaces the matched substring with a replacement substring. |
| [`split`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/split) | A `String` method that uses a regular expression or a fixed string to break a string into an array of substrings. |

When you want to know whether a pattern is found in a string, use the `test` or `search` method; for more information (but slower execution) use the `exec` or `match` methods. If you use `exec` or `match` and if the match succeeds, these methods return an array and update properties of the associated regular expression object and also of the predefined regular expression object, `RegExp`. If the match fails, the `exec` method returns `null` (which coerces to `false`).

In the following example, the script uses the `exec` method to find a match in a string.

```javascript
var myRe = /d(b+)d/g;
var myArray = myRe.exec("cdbbdbsbz"); // ["dbbd", "bb"]
```

If you do not need to access the properties of the regular expression, an alternative way of creating `myArray` is with this script:

```javascript
var myArray = /d(b+)d/g.exec("cdbbdbsbz"); // equivalent to "cdbbdbsbz".match(/d(b+)d/g);
```

If you want to construct the regular expression from a string, yet another alternative is this script:

```javascript
var myRe = new RegExp("d(b+)d", "g");
var myArray = myRe.exec("cdbbdbsbz"); // ["dbbd", "bb"]
```

With these scripts, the match succeeds and returns the array and updates the properties shown in the following table.

**Results of regular expression execution.**

| Object    | Property or index | Description                              | In this example  |
| --------- | ----------------- | ---------------------------------------- | ---------------- |
| `myArray` |                   | The matched string and all remembered substrings. | `["dbbd", "bb"]` |
|           | `index`           | The 0-based index of the match in the input string. | `1`              |
|           | `input`           | The original string.                     | `"cdbbdbsbz"`    |
|           | `[0]`             | The last matched characters.             | `"dbbd"`         |
| `myRe`    | `lastIndex`       | The index at which to start the next match. (This property is set only if the regular expression uses the g option, described in [Advanced Searching With Flags](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions#Advanced_searching_with_flags).) | `5`              |
|           | `source`          | The text of the pattern. Updated at the time that the regular expression is created, not executed. | `"d(b+)d"`       |

As shown in the second form of this example, you can use a regular expression created with an object initializer without assigning it to a variable. If you do, however, every occurrence is a new regular expression. For this reason, if you use this form without assigning it to a variable, you cannot subsequently access the properties of that regular expression. For example, assume you have this script:

```javascript
var myRe = /d(b+)d/g;
var myArray = myRe.exec("cdbbdbsbz");
// The value of lastIndex is 5
console.log("The value of lastIndex is " + myRe.lastIndex);
```

However, if you have this script:

```javascript
var myArray = /d(b+)d/g.exec("cdbbdbsbz");
// The value of lastIndex is 0
console.log("The value of lastIndex is " + /d(b+)d/g.lastIndex);
```

The occurrences of `/d(b+)d/g` in the two statements are different regular expression objects and hence have different values for their `lastIndex` property. If you need to access the properties of a regular expression created with an object initializer, you should first assign it to a variable.

#### Using parenthesized substring matches

Including parentheses in a regular expression pattern causes the corresponding submatch to be remembered. For example, `/a(b)c/`matches the characters 'abc' and remembers 'b'. To recall these parenthesized substring matches, use the `Array` elements `[1]`, ..., `[n]`.

The number of possible parenthesized substrings is unlimited. The returned array holds all that were found. The following examples illustrate how to use parenthesized substring matches.

The following script uses the [`replace()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace) method to switch the words in the string. For the replacement text, the script uses the `$1` and `$2` in the replacement to denote the first and second parenthesized substring matches.

```javascript
var re = /(\w+)\s(\w+)/;
var str = "John Smith";
var newstr = str.replace(re, "$2, $1");
console.log(newstr); // Smith, John
```

#### Advanced searching with flags

Regular expressions have four optional flags that allow for global and case insensitive searching. These flags can be used separately or together in any order, and are included as part of the regular expression.

**Regular expression flags**

| Flag | Description                              |
| ---- | ---------------------------------------- |
| `g`  | Global search.                           |
| i    | Case-insensitive search.                 |
| m    | Multi-line search.                       |
| y    | Perform a "sticky" search that matches starting at the current position in the target string. See [`sticky`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp/sticky) |

To include a flag with the regular expression, use this syntax:

```javascript
var re = /pattern/flags;
// or
var re = new RegExp("pattern", "flags");
```

Note that the flags are an integral part of a regular expression. They cannot be added or removed later.

For example, `re = /\w+\s/g` creates a regular expression that looks for one or more characters followed by a space, and it looks for this combination throughout the string.

```javascript
var re = /\w+\s/g;
// var re = new RegExp("\\w+\\s", "g");
var str = "fee fi fo fum";
var myArray = str.match(re);
console.log(myArray); // ["fee ", "fi ", "fo "]
```

The `m` flag is used to specify that a multiline input string should be treated as multiple lines. If the `m` flag is used, `^` and `$` match at the start or end of any line within the input string instead of the start or end of the entire string.

### Examples

The following examples show some uses of regular expressions.

#### Changing the order in an input string

The following example illustrates the formation of regular expressions and the use of `string.split()` and `string.replace()`. It cleans a roughly formatted input string containing names (first name first) separated by blanks, tabs and exactly one semicolon. Finally, it reverses the name order (last name first) and sorts the list.

```javascript
// The name string contains multiple spaces and tabs,
// and may have multiple spaces between first and last names.
var names = "Harry Trump ;Fred Barney; Helen Rigby ; Bill Abel ; Chris Hand ";
var output = ["---------- Original String\n", names + "\n"];
// Prepare two regular expression patterns and array storage.
// Split the string into array elements.
// pattern: possible white space then semicolon then possible white space
var pattern = /\s*;\s*/;
// Break the string into pieces separated by the pattern above and
// store the pieces in an array called nameList
var nameList = names.split(pattern);
// new pattern: one or more characters then spaces then characters.
// Use parentheses to "memorize" portions of the pattern.
// The memorized portions are refered to later.
pattern = /(\w+)\s+(\w+)/;
// New array for holding names being processed.
var bySurnameList = [];
// Display the name array and populate the new array
// with comma-separated names, last first.
//
// The replace method removes anything matching the pattern and
// replaces it with the memorized string-second memorized portion
// followed by comma space followed by first memorized portion.
//
// The variables $1 and $2 refer to the portions
// memorized while matching the pattern
output.push("---------- After Split by Regular Expression");
var i, len;
for (i = 0, len = nameList.length; i < len; i++) {
    output.push(nameList[i]);
    bySurnameList[i] = nameList[i].replace(pattern, "$2, $1");
}
// Display the new array
output.push("---------- Names Reversed");
for (i = 0, len = bySurnameList.length; i < len; i++) {
    output.push(bySurnameList[i]);
}
// Sort by last name, then display the sorted array.
bySurnameList.sort();
output.push("---------- Sorted");
for (i = 0, len = bySurnameList.length; i < len; i++) {
    output.push(bySurnameList[i]);
}
output.push("---------- End");
console.log(output.join("\n"));
```

#### Using special characters to verify input

In the following example, the user is expected to enter a phone number. When the user presses the "Check" button, the script checks the validity of the number. If the number is valid (matches the character sequence specified by the regular expression), the script shows a message thanking the user and confirming the number. If the number is invalid, the script informs the user that the phone number is not valid.

Within non-capturing parentheses `(?:` , the regular expression looks for three numeric characters `\d{3}` OR `|` a left parenthesis `\(`followed by three digits` \d{3}`, followed by a close parenthesis `\)`, (end non-capturing parenthesis `)`), followed by one dash, forward slash, or decimal point and when found, remember the character `([-\/\.])`, followed by three digits `\d{3}`, followed by the remembered match of a dash, forward slash, or decimal point `\1`, followed by four digits `\d{4}`.

The `Change` event activated when the user presses Enter sets the value of `RegExp.input`.

```html
<form>
    <input id="phone"><button onclick="testInfo(document.getElementById('phone'));">Check</button>
</form>
<script>
var re = /(?:\d{3}|\(\d{3}\))([-\/\.])\d{3}\1\d{4}/;
function testInfo(phoneInput) {
    var number = re.exec(phoneInput.value);
    if(!number) {
        console.error(phoneInput.value + " isn't a phone number with area code!");
    } else {
        // OK = ["888-888-8888", "-", index: 0, input: "888-888-8888"]
        console.info("Thanks, your phone number is " + OK[0]);
    }
}
</script>
```

## Indexed collections

> introduces collections of data which are ordered by an index value.

### `Array` object

An *array* is an ordered set of values that you refer to with a name and an index. For example, you could have an array called `emp` that contains employees' names indexed by their employee number. So `emp[1]` would be employee number one, `emp[2]` employee number two, and so on.

JavaScript does not have an explicit array data type. However, you can use the predefined `Array` object and its methods to work with arrays in your applications. The `Array` object has methods for manipulating arrays in various ways, such as joining, reversing, and sorting them. It has a property for determining the array length and other properties for use with regular expressions.

#### Creating an array

The following statements create equivalent arrays:

```javascript
var arr = new Array(element0, element1, ..., elementN);
var arr = Array(element0, element1, ..., elementN);
var arr = [element0, element1, ..., elementN]
```

`element0, element1, ..., elementN` is a list of values for the array's elements. When these values are specified, the array is initialized with them as the array's elements. The array's `length` property is set to the number of arguments.

The bracket syntax is called an "array literal" or "array initializer." It's shorter than other forms of array creation, and so is generally preferred. See [Array literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Array_literals) for details.

To create an array with non-zero length, but without any items, either of the following can be used:

```javascript
var arr = new Array(arrayLength);
var arr = Array(arrayLength);
// This has exactly the same effect
var arr = [];
arr.length = arrayLength;
```

**Note :** in the above code, `arrayLength` must be a `Number`. Otherwise, an array with a single element (the provided value) will be created. Calling `arr.length` will return `arrayLength`, but the array actually contains empty (undefined) elements. Running a [`for...in`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...in) loop on the array will return none of the array's elements.

In addition to a newly defined variable as shown above, arrays can also be assigned as a property of a new or an existing object:

```javascript
var obj = {};
// ...
obj.prop = [element0, element1, ..., elementN];
// OR
var obj = {prop: [element0, element1, ..., elementN]};
```

If you wish to initialize an array with a single element, and the element happens to be a `Number`, you must use the bracket syntax. When a single `Number` value is passed to the Array() constructor or function, it is interpreted as an `arrayLength`, not as a single element.

```javascript
// Creates an array with only one element: the number 42.
var arr = [42];
// Creates an array with no elements and arr.length set to 42;
var arr = Array(42);
// this is equivalent to:
var arr = [];
arr.length = 42;
```

Calling `Array(N)` results in a `RangeError`, if `N` is a non-whole number whose fractional portion is non-zero. The following example illustrates this behavior.

```javascript
var arr = Array(9.3); // RangeError: Invalid array length
```

If your code needs to create arrays with single elements of an arbitrary data type, it is safer to use array literals. Or, create an empty array first before adding the single element to it.

#### Populating an array

You can populate an array by assigning values to its elements. For example,

```javascript
var emp = [];
emp[0] = "Casey Jones";
emp[1] = "Phil Lesh";
emp[2] = "August West";
emp["foo"] = "foo";
console.debug(emp); // ["Casey Jones", "Phil Lesh", "August West", foo: "foo"]
```

**Note :** if you supply a non-integer value to the array operator in the code above, a property will be created in the object representing the array, instead of an array element.

```javascript
var arr = [];
arr[3.4] = "Oranges";
console.log(arr.length); // 0
console.log(arr.hasOwnProperty(3.4)); // true
```

You can also populate an array when you create it:

```javascript
var myArray = new Array("Hello", myVar, 3.14159);
var myArray = ["Mango", "Apple", "Orange"];
```

#### Referring to array elements

You refer to an array's elements by using the element's ordinal number. For example, suppose you define the following array:

```javascript
var myArray = ["Wind", "Rain", "Fire"];
```

You then refer to the first element of the array as `myArray[0]` and the second element of the array as `myArray[1]`. The index of the elements begins with zero.

**Note :** the array operator (square brackets) is also used for accessing the array's properties (arrays are also objects in JavaScript). For example,

```javascript
var arr = ["one", "two", "three"];
arr[2]; // "three"
arr["length"]; // 3
```

#### Understanding length

At the implementation level, JavaScript's arrays actually store their elements as standard object properties, using the array index as the property name. The `length` property is special; it always returns the index of the last element plus one (in the following example, Dusty is indexed at 30, so cats.length returns 30 + 1). Remember, JavaScript Array indexes are 0-based: they start at 0, not 1. This means that the `length` property will be one more than the highest index stored in the array:

```javascript
var cats = [];
cats[30] = ["Dusty"];
console.log(cats.length);
```

You can also assign to the `length` property. Writing a value that is shorter than the number of stored items truncates the array; writing 0 empties it entirely:

```javascript
var cats = ["Dusty", "Misty", "Twiggy"];
console.log(cats.length); // 3
cats.length = 2;
console.log(cats); // ["Dusty", "Misty"]
cats.length = 0;
console.log(cats); // []
cats.length = 3;
console.log(cats); // []
```

#### Iterating over arrays

A common operation is to iterate over the values of an array, processing each one in some way. The simplest way to do this is as follows:

```javascript
var colors = ["red", "green", "blue"];
for (var i = 0; i < color.length; i++) {
    console.log(colors[i]);
}
```

If you know that none of the elements in your array evaluate to `false` in a boolean context — if your array consists only of [DOM](https://developer.mozilla.org/en-US/docs/DOM) nodes, for example, you can use a more efficient idiom:

```javascript
var divs = document.getElementsByTagName("div");
for (var i = 0, div; div = divs[i]; i++) {
    /* Process div in some way */
}
```

This avoids the overhead of checking the length of the array, and ensures that the `div` variable is reassigned to the current item each time around the loop for added convenience.

The [`forEach()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach) method provides another way of iterating over an array:

```javascript
var colors = ["red", "green", "blue"];
colors.forEach(function(color) {
    console.log(color);
});
```

The function passed to `forEach` is executed once for every item in the array, with the array item passed as the argument to the function. Unassigned values are not iterated in a `forEach` loop.

Note that the elements of array omitted when the array is defined are not listed when iterating by `forEach`, but are listed when `undefined` has been manually assigned to the element:

```javascript
var array = ["first", "second", "fourth"];
// first second fourth
array.forEach(function(element) {
    console.log(element);
});
if (array[2] === undefined) {
    console.log("array[2] is undefined");
}
var array = ["first", "second", undefined, "fourth"];
// first second undefined fourth
array.forEach(function(element) {
    console.log(element);
});
```

Since JavaScript elements are saved as standard object properties, it is not advisable to iterate through JavaScript arrays using [`for...in`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...in) loops because normal elements and all enumerable properties will be listed.

#### Array methods

The [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) object has the following methods:

[`concat()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/concat) joins two arrays and returns a new array.

```javascript
var myArray = new Array("1", "2", "3");
myArray = myArray.concat("a", "b", "c");
// myArray is now ["1", "2", "3", "a", "b", "c"]
```

[`join(deliminator = ',')`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/join) joins all elements of an array into a string.

```javascript
var myArray = new Array("Wind", "Rain", "Fire");
var list = myArray.join(" - "); // list is "Wind - Rain - Fire"
```

[`push()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/push) adds one or more elements to the end of an array and returns the resulting length of the array.

```javascript
var myArray = new Array("1", "2");
myArray.push("3"); // myArray is now ["1", "2", "3"]
```

[`pop()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/pop) removes the last element from an array and returns that element.

```javascript
var myArray = new Array("1", "2", "3");
var last = myArray.pop();
// myArray is now ["1", "2"], last = "3"
```

[`shift()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/shift) removes the first element from an array and returns that element.

```javascript
var myArray = new Array("1", "2", "3");
var first = myArray.shift();
// myArray is now ["2", "3"], first is "1"
```

[`unshift()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/unshift) adds one or more elements to the front of an array and returns the new length of the array.

```javascript
var myArray = new Array("1", "2", "3");
myArray.unshift("4", "5");
// myArray becomes ["4", "5", "1", "2", "3"]
```

[`slice(start_index, upto_index)`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/slice) extracts a section of an array and returns a new array.

```javascript
var myArray = new Array("a", "b", "c", "d", "e");
myArray = myArray.slice(1, 4);
// start at index 1 and extracts all elements
// until index 3, returning ["b", "c", "d"]
```

[`splice(index, count_to_remove, addElement1, addElement2, ...)`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/splice) removes elements from an array and (optionally) replaces them. It returns the items which were removed from the array.

```javascript
var myArray = new Array("1", "2", "3", "4", "5");
myArray.splice(1, 3, "a", "b", "c", "d"); // return ["2", "3", "4"]
// myArray is now ["1", "a", "b", "c", "d", "5"]
// This code started at index one (or where the "2" was),
// removed 3 elements there, and then inserted all consecutive
// elements in its place.
```

[`reverse()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reverse) transposes the elements of an array: the first array element becomes the last and the last becomes the first.

```javascript
var myArray = new Array("1", "2", "3");
myArray.reverse();
// transposes the array so that myArray = ["3", "2", "1"]
```

[`sort()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/sort) sorts the elements of an array.

```javascript
var myArray = new Array("Wind", "Rain", "Fire");
myArray.sort();
// sorts the array so that myArray = ["Fire", "Rain", "Wind"]
```

`sort()` can also take a callback function to determine how array elements are compared. The function compares two values and returns one of three values:

For instance, the following will sort by the last letter of a string:

```javascript
var myArray = new Array("Wind", "Rain", "Fire");
var sortFn = function(a, b) {
    if (a[a.length - 1] < b[b.length - 1])
        return -1;
    if (a[a.length - 1] > b[b.length - 1])
        return 1;
    if (a[a.length - 1] == b[b.length - 1])
        return 0;
};
myArray.sort(sortFn);
// sorts the array so that array = ["Wind", "Fire", "Rain"]
```
[`indexOf(searchElement[, fromIndex\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf) searches the array for `searchElement` and returns the index of the first match.

```javascript
var a = ["a", "b", "a", "b", "a"];
console.log(a.indexOf("b")); // 1
console.log(a.indexOf("b", 2)); // 3
console.log(a.indexOf("z")); // -1
```

[`lastIndexOf(searchElement[, fromIndex\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/lastIndexOf) works like `indexOf`, but starts at the end and searches backwards.

```javascript
var a = ["a", "b", "c", "d", "a", "b"];
console.log(a.lastIndexOf("b")); // 5
console.log(a.lastIndexOf("b", 4)); // 1
console.log(a.lastIndexOf("z")); // -1
```

[`forEach(callback[, thisObject\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach) executes `callback` on every array item.

```javascript
var a = ["a", "b", "c"];
a.forEach(function(element) {
    console.log(element);
});
// logs each item in turn
```

[`map(callback[, thisObject\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/map) returns a new array of the return value from executing `callback` on every array item.

```javascript
var a1 = ["a", "b", "c"];
var a2 = al.map(function(item) {
    return item.toUpperCase();
});
console.log(a2); // ["A", "B", "C"]
```

[`filter(callback[, thisObject\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter) returns a new array containing the items for which callback returned true.

```javascript
var a1 = ["a", 10, "b", 20, "c", 30];
var a2 = a1.filter(function(item) {
    return typeof item === "number";
});
console.log(a2); // [10, 20, 30]
```

[`every(callback[, thisObject\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/every) returns true if `callback` returns true for every item in the array.

```javascript
function isNumber(value) {
    return typeof value === "number";
}
var a1 = [1, 2, 3];
console.log(a1.every(isNumber)); // true
var a2 = [1, "2", 3];
console.log(a2.every(isNumber)); // false
```

[`some(callback[, thisObject\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/some) returns true if `callback` returns true for at least one item in the array.

```javascript
function isNumber(value) {
    return typeof value === "number";
}
var a1 = [1, 2, 3];
console.log(a1.some(isNumber)); // true
var a2 = [1, "2", 3];
console.log(a2.some(isNumber)); // true
var a3 = ["1", "2", "3"];
console.log(a3.some(isNumber)); // false
```

The methods above that take a callback are known as *iterative methods*, because they iterate over the entire array in some fashion. Each one takes an optional second argument called `thisObject`. If provided, `thisObject` becomes the value of the `this` keyword inside the body of the callback function. If not provided, as with other cases where a function is invoked outside of an explicit object context, `this` will refer to the global object ([`window`](https://developer.mozilla.org/en-US/docs/Web/API/Window)).

The callback function is actually called with three arguments. The first is the value of the current item, the second is its array index, and the third is a reference to the array itself. JavaScript functions ignore any arguments that are not named in the parameter list so it is safe to provide a callback function that only takes a single argument, such as `alert`.

[`reduce(callback[, initialValue\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce) applies `callback(firstValue, secondValue)` to reduce the list of items down to a single value.

```javascript
var a = [10, 20, 30];
var total = a.reduce(function(first, second) {
    return first + second;
}, 0);
console.log(total); // 60
```

[`reduceRight(callback[, initialValue\])`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduceRight) works like `reduce()`, but starts with the last element.

`reduce` and `reduceRight` are the least obvious of the iterative array methods. They should be used for algorithms that combine two values recursively in order to reduce a sequence down to a single value.

#### Multi-dimensional arrays

Arrays can be nested, meaning that an array can contain another array as an element. Using this characteristic of JavaScript arrays, multi-dimensional arrays can be created.

The following code creates a two-dimensional array.

```javascript
var a = new Array(4);
for (var i = 0; i < 4; i++) {
    a[i] = new Array(4);
    for (var j = 0; j < 4; j++) {
        a[i][j] = "[" + i + ", " + j + "]";
    }
}
```

This example creates an array with the following rows:

```javascript
Row 0: [0,0] [0,1] [0,2] [0,3]
Row 1: [1,0] [1,1] [1,2] [1,3]
Row 2: [2,0] [2,1] [2,2] [2,3]
Row 3: [3,0] [3,1] [3,2] [3,3]
```

#### Arrays and regular expressions

When an array is the result of a match between a regular expression and a string, the array returns properties and elements that provide information about the match. An array is the return value of [`RegExp.exec()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp/exec), [`String.match()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/match), and [`String.split()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/split). For information on using arrays with regular expressions, see [Regular Expressions](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions).

#### Working with array-like objects

Some JavaScript objects, such as the [`NodeList`](https://developer.mozilla.org/en-US/docs/Web/API/NodeList) returned by [`document.getElementsByTagName()`](https://developer.mozilla.org/en-US/docs/Web/API/Document/getElementsByTagName) or the [`arguments`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/arguments) object made available within the body of a function, look and behave like arrays on the surface but do not share all of their methods. The `arguments` object provides a [`length`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/length) attribute but does not implement the [`forEach()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach) method, for example.

Array prototype methods can be called against other array-like objects. for example:

```javascript
function printArguments() {
    Array.prototype.forEach.call(arguments, function(item) {
        console.log(item);
    });
}
```

Array prototype methods can be used on strings as well, since they provide sequential access to their characters in a similar way to arrays:

```javascript
Array.prototype.forEach.call("a string", function(chr) {
    console.log(chr);
});
```

### Typed Arrays

[JavaScript typed arrays](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Typed_arrays) are array-like objects and provide a mechanism for accessing raw binary data. As you already know, [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array)objects grow and shrink dynamically and can have any JavaScript value. JavaScript engines perform optimizations so that these arrays are fast. However, as web applications become more and more powerful, adding features such as audio and video manipulation, access to raw data using [WebSockets](https://developer.mozilla.org/en-US/docs/WebSockets), and so forth, it has become clear that there are times when it would be helpful for JavaScript code to be able to quickly and easily manipulate raw binary data in typed arrays.

#### Buffers and views: typed array architecture

To achieve maximum flexibility and efficiency, JavaScript typed arrays split the implementation into **buffers** and **views**. A buffer (implemented by the [`ArrayBuffer`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/ArrayBuffer) object) is an object representing a chunk of data; it has no format to speak of, and offers no mechanism for accessing its contents. In order to access the memory contained in a buffer, you need to use a view. A view provides a context — that is, a data type, starting offset, and number of elements — that turns the data into an actual typed array.

![Typed arrays in an ArrayBuffer](https://mdn.mozillademos.org/files/8629/typed_arrays.png)

#### ArrayBuffer

The [`ArrayBuffer`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/ArrayBuffer) is a data type that is used to represent a generic, fixed-length binary data buffer. You can't directly manipulate the contents of an `ArrayBuffer`; instead, you create a typed array view or a [`DataView`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/DataView) which represents the buffer in a specific format, and use that to read and write the contents of the buffer.

#### Typed array views

Typed array views have self descriptive names and provide views for all the usual numeric types like `Int8`, `Uint32`, `Float64` and so forth. There is one special typed array view, the `Uint8ClampedArray`. It clamps the values between 0 and 255. This is useful for [Canvas data processing](https://developer.mozilla.org/en-US/docs/Web/API/ImageData), for example.

| Type                                     | Size in bytes | Description                            | Web IDL type          | Equivalent C type |
| ---------------------------------------- | ------------- | -------------------------------------- | --------------------- | ----------------- |
| [`Int8Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Int8Array) | 1             | 8-bit two's complement signed integer  | `byte`                | `int8_t`          |
| [`Uint8Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Uint8Array) | 1             | 8-bit unsigned integer                 | `octet`               | `uint8_t`         |
| [`Uint8ClampedArray`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Uint8ClampedArray) | 1             | 8-bit unsigned integer (clamped)       | `octet`               | `uint8_t`         |
| [`Int16Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Int16Array) | 2             | 16-bit two's complement signed integer | `short`               | `int16_t`         |
| [`Uint16Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Uint16Array) | 2             | 16-bit unsigned integer                | `unsigned short`      | `uint16_t`        |
| [`Int32Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Int32Array) | 4             | 32-bit two's complement signed integer | `long`                | `int32_t`         |
| [`Uint32Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Uint32Array) | 4             | 32-bit unsigned integer                | `unsigned long`       | `uint32_t`        |
| [`Float32Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Float32Array) | 4             | 32-bit IEEE floating point number      | `unrestricted float`  | `float`           |
| [`Float64Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Float64Array) | 8             | 64-bit IEEE floating point number      | `unrestricted double` | `double`          |

For more information, see [JavaScript typed arrays](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Typed_arrays) and the reference documentation for the different [`TypedArray`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/TypedArray) objects.

## Keyed collections

> introduces collections of data which are ordered by a key; Map and Set objects contain elements which are iterable in the order of insertion.

### Maps

#### Map object

ECMAScript 6 introduces a new data structure to map values to values. A [`Map`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Map) object is a simple key/value map and can iterate its elements in insertion order.

The following code shows some basic operations with a `Map`. See also the [`Map`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Map) reference page for more examples and the complete API. You can use a [`for...of`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...of) loop to return an array of `[key, value]` for each iteration.

```javascript
var sayings = new Map();
sayings.set("dog", "woof");
sayings.set("cat", "meow");
sayings.set("elephant", "toot");
sayings.size; // 3
sayings.get("fox"); // undefined
sayings.has("bird"); // false
sayings.delete("dog"); // true
sayings.has("dog"); // false
for (var [key, value] of sayings) {
    console.log(key + " goes " + value);
}
// cat goes meow
// elephant goes toot
sayings.clear();
sayings.size; // 0
```

#### `Object` and `Map` compared

Traditionally, [objects](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object) have been used to map strings to values. Objects allow you to set keys to values, retrieve those values, delete keys, and detect whether something is stored at a key. `Map` objects, however, have a few more advantages that make them better maps.

- The keys of an `Object` are [`Strings`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String), where they can be of any value for a `Map`.
- You can get the size of a `Map` easily while you have to manually keep track of size for an `Object`.
- The iteration of maps is in insertion order of the elements.
- An `Object` has a prototype, so there are default keys in the map. (this can be bypassed using `map = Object.create(null)`).

These three tips can help you to decide whether to use a `Map` or an `Object`:

- Use maps over objects when keys are unknown until run time, and when all keys are the same type and all values are the same type.
- Use maps in case if there is a need to store primitive values as keys because object treats each key as a string whether it's a number value, boolean value or any other primitive value.
- Use objects when there is logic that operates on individual elements.

#### `WeakMap` object

The [`WeakMap`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/WeakMap) object is a collection of key/value pairs in which the **keys are objects only** and the values can be arbitrary values. The object references in the keys are held *weakly* meaning that they are target of garbage collection (GC) if there is no other reference to the object anymore. The `WeakMap` API is the same as the `Map` API.

One difference to `Map` objects is that `WeakMap` keys are not enumerable (i.e. there is no method giving you a list of the keys). If they were, the list would depend on the state of garbage collection, introducing non-determinism.

For more information and example code, see also "Why *Weak*Map?" on the [`WeakMap`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/WeakMap) reference page.

One use case of `WeakMap` objects is to store private data for an object or to hide implementation details. The following example is from Nick Fitzgerald blog post ["Hiding Implementation Details with ECMAScript 6 WeakMaps"](http://fitzgeraldnick.com/weblog/53/). The private data and methods belong inside the object and are stored in the `privates` WeakMap object. Everything exposed on the instance and prototype is public; everything else is inaccessible from the outside world because `privates` is not exported from the module.

```javascript
const privates = new WeakMap();
function Public() {
    const me = {
        // Private data goes here
    };
    privates.set(this, me);
}
Public.prototype.method = function() {
    const me = privates.get(this);
    // Do stuff with private data in `me` ...
};
module.exports = Public;
```

### Sets

#### `Set` object

[`Set`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set) objects are collections of values. You can iterate its elements in insertion order. A value in a `Set` may only occur once; it is unique in the `Set`'s collection.

The following code shows some basic operations with a `Set`. See also the [`Set`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set) reference page for more examples and the complete API.

```javascript
var mySet = new Set();
mySet.add(1);
mySet.add("some text");
mySet.add("foo");
mySet.has(1); // true
mySet.delete("foo"); // true
mySet.size; // 2
for (let item of mySet) {
    console.log(item);
}
// 1
// some text
```

#### Converting between Array and Set

You can create an [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) from a Set using [`Array.from`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/from) or the [spread operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Spread_operator). Also, the `Set` constructor accepts an `Array` to convert in the other direction. Note again that `Set` objects store unique values, so any duplicate elements from an Array are deleted when converting.

```javascript
Array.from(mySet); // [1, "some text"]

mySet2 = new Set([1, 2, 3, 4]); // Set {1, 2, 3, 4}
```

#### `Array` and `Set` compared

Traditionally, a set of elements has been stored in arrays in JavaScript in a lot of situations. The new `Set` object, however, has some advantages:

- Checking whether an element exists in an collection using [`indexOf`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/indexOf) for arrays is slow.
- `Set` objects let you delete elements by their value. With an array you would have to splice based on a element's index.
- The value [`NaN`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NaN) cannot be found with `indexOf` in array.
- `Set` objects store unique values, you don't have to keep track of duplicates by yourself.

#### `WeakSet` object

[`WeakSet`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/WeakSet) objects are collections of objects. An object in the `WeakSet` may only occur once; it is unique in the `WeakSet`'s collection and objects are not enumerable.

The main differences to the [`Set`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set) object are:

- In contrast to `Sets`, `WeakSets` are **collections of objects only** and not of arbitrary values of any type.
- The `WeakSet` is *weak*: References to objects in the collection are held weakly. If there is no other reference to an object stored in the `WeakSet`, they can be garbage collected. That also means that there is no list of current objects stored in the collection. `WeakSets` are not enumerable.

The use cases of `WeakSet` objects are limited. They will not leak memory so it can be safe to use DOM elements as a key and mark them for tracking purposes, for example.

### Key and value equality of `Map` and `Set`

Both, the key equality of `Map` objects and the value equality of `Set` objects, are based on the "[same-value-zero algorithm](https://people.mozilla.org/~jorendorff/es6-draft.html#sec-samevaluezero)":

- Equality works like the identity comparison operator `===`.
- `-0` and `+0` are considered equal.
- [`NaN`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/NaN) is considered equal to itself (contrary to `===`).

## Working with objects

> JavaScript is designed on a simple object-based paradigm. An object is a collection of properties, and a property is an association between a name (or *key*) and a value. A property's value can be a function, in which case the property is known as a method. In addition to objects that are predefined in the browser, you can define your own objects.

### Objects and properties

A JavaScript object has properties associated with it. A property of an object can be explained as a variable that is attached to the object. Object properties are basically the same as ordinary JavaScript variables, except for the attachment to objects. The properties of an object define the characteristics of the object. You access the properties of an object with a simple dot-notation:

> objectName.propertyName

Like all JavaScript variables, both the object name (which could be a normal variable) and property name are case sensitive. You can define a property by assigning it a value. Unassigned properties of an object are [`undefined`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/undefined) (and not [`null`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/null)). Properties of JavaScript objects can also be accessed or set using a bracket notation (for more details see [property accessors](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Property_Accessors)). Objects are sometimes called *associative arrays*, since each property is associated with a string value that can be used to access it.

An object property name can be any valid JavaScript string, or anything that can be converted to a string, including the empty string. However, any property name that is not a valid JavaScript identifier (for example, a property name that has a space or a hyphen, or that starts with a number) can only be accessed using the square bracket notation. This notation is also very useful when property names are to be dynamically determined (when the property name is not determined until runtime). Examples are as follows:

```javascript
// four variables are created and assigned in a single go, separated by commas
var myObj = new Object(), str = "myString", rand = Math.random(), obj = new Object();
myObj.type = "Dot syntax";
myObj["date created"] = "String with space";
myObj[str] = "String value";
myObj[rand] = "Random Number";
myObj[obj] = "Object";
myObj[""] = "Even an empty string";
console.log(myObj);
```

You can also access properties by using a string value that is stored in a variable:

```javascript
var myCar = new Object();
// myCar.make = "Ford";
// myCar.model = "Mustang";
// myCar.year = 1969;
// myCar["make"] = "Ford";
// myCar["model"] = "Mustang";
myCar["year"] = 1969;
var propertyName = "make";
myCar[propertyName] = "Ford";
propertyName = "model";
myCar[propertyName] = "Mustang";
console.log(myCar);
```

You can use the bracket notation with `for...in` to iterate over all the enumerable properties of an object. To illustrate how this works, the following function displays the properties of the object when you pass the object and the object's name as arguments to the function:

```javascript
function showProps(obj, objName) {
    var result = "";
    for (var i in obj) {
        if (obj.hasOwnProperty(i)) {
            result += objName + "." + i + " = " + obj[i] + "\n";
        }
    }
    return result;
}
```

So, the function call `showProps(myCar, "myCar")` would return the following:

```javascript
showProps(myCar, "myCar");
// "myCar.make = Ford
// myCar.model = Mustang
// myCar.year = 1969
// "
```

### Enumerate the properties of an object

Starting with [ECMAScript 5](https://developer.mozilla.org/en-US/docs/Web/JavaScript/New_in_JavaScript/ECMAScript_5_support_in_Mozilla), there are three native ways to list/traverse object properties:

- `for...in` loops
  This method traverses all enumerable properties of an object and its prototype chain
- [`Object.keys(o)`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/keys)
  This method returns an array with all the own (not in the prototype chain) enumerable properties' names ("keys") of an object `o`.
- [`Object.getOwnPropertyNames(o)`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/getOwnPropertyNames)
  This method returns an array containing all own properties' names (enumerable or not) of an object `o`.

Before ECMAScript 5, there was no native way to list all properties of an object. However, this can be achieved with the following function:

```javascript
function listAllProperties(o) {
    var objectToInspect;
    var result = [];
    for (objectToInspect = 0; objectToInspect !== null;
         objectToInspect = Object.getPrototypeOf(objectToInspect)) {
        result = result.concat(Object.getOwnPropertyNames(objectToInspect));
    }
    return result;
}
```

This can be useful to reveal "hidden" properties (properties in the prototype chain which are not accessible through the object, because another property has the same name earlier in the prototype chain). Listing accessible properties only can easily be done by removing duplicates in the array.

### Creating new objects

JavaScript has a number of predefined objects. In addition, you can create your own objects. You can create an object using an [object initializer](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Object_initializer). Alternatively, you can first create a constructor function and then instantiate an object using that function and the `new`operator.

> [JDC | 京东设计中心 » JavaScript写类的前世今生](//jdc.jd.com/archives/2942)

#### Using object initializers

In addition to creating objects using a constructor function, you can create objects using an [object initializer](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Object_initializer). Using object initializers is sometimes referred to as creating objects with literal notation. "Object initializer" is consistent with the terminology used by C++.

The syntax for an object using an object initializer is:

```javascript
var obj = {
    property_1: value_1,  // property_# may be an identifier...
    2:          value_2,  // or a number...
    // ...,
    "property n": value_n // or a string
};
```

where `obj` is the name of the new object, each `property_*i*` is an identifier (either a name, a number, or a string literal), and each `value_*i*` is an expression whose value is assigned to the `property_*i*`. The `obj` and assignment is optional; if you do not need to refer to this object elsewhere, you do not need to assign it to a variable. (Note that you may need to wrap the object literal in parentheses if the object appears where a statement is expected, so as not to have the literal be confused with a block statement.)

Object initializers are expressions, and each object initializer results in a new object being created whenever the statement in which it appears is executed. Identical object initializers create distinct objects that will not compare to each other as equal. Objects are created as if a call to `new Object()` were made; that is, objects made from object literal expressions are instances of `Object`.

The following statement creates an object and assigns it to the variable `x` if and only if the expression `cond` is true:

```javascript
if (cond) var x = {greeting: "hi there"};
```

The following example creates `myHonda` with three properties. Note that the `engine` property is also an object with its own properties.

```javascript
var myHonda = {color: "red", wheels: 4, engine: {cylinders: 4, size: 2.2}};
```

You can also use object initializers to create arrays. See [array literals](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Grammar_and_types#Array_literals).

#### Using a constructor function

Alternatively, you can create an object with these two steps:

1. Define the object type by writing a constructor function. There is a strong convention, with good reason, to use a capital initial letter.
2. Create an instance of the object with `new`.

To define an object type, create a function for the object type that specifies its name, properties, and methods. For example, suppose you want to create an object type for cars. You want this type of object to be called `car`, and you want it to have properties for make, model, and year. To do this, you would write the following function:

```javascript
function Car(make, model, year) {
    this.make = make;
    this.model = model;
    this.year = year;
}
```

Notice the use of `this` to assign values to the object's properties based on the values passed to the function.

Now you can create an object called `mycar` as follows:

```javascript
var mycar = new Car("Eagle", "Talon TSi", 1993);
console.log(mycar); // Car {make: "Eagle", model: "Talon TSi", year: 1993}
```

This statement creates `mycar` and assigns it the specified values for its properties. Then the value of `mycar.make` is the string "Eagle", `mycar.year` is the integer 1993, and so on.

You can create any number of `car` objects by calls to `new`. For example,

```javascript
var kenscar = new Car("Nissan", "300ZX", 1992);
var vpgscar = new Car("Mazda", "Miata", 1990);
```

An object can have a property that is itself another object. For example, suppose you define an object called `person` as follows:

```javascript
function Person(name, age, sex) {
    this.name = name;
    this.age = age;
    this.sex = sex;
}
```

and then instantiate two new `person` objects as follows:

```javascript
var rand = new Person("Rand McKinnon", 33, "M");
var ken = new Person("Ken Jones", 39, "M");
```

Then, you can rewrite the definition of `car` to include an `owner` property that takes a `person` object, as follows:

```javascript
function Car(make, model, year, owner) {
    this.make = make;
    this.model = model;
    this.year = year;
    this.owner = owner;
}
```

To instantiate the new objects, you then use the following:

```javascript
var car1 = new Car("Eagle", "Talon TSi", 1993, rand);
var car2 = new Car("Nissan", "300ZX", 1992, ken);
```

Notice that instead of passing a literal string or integer value when creating the new objects, the above statements pass the objects `rand` and `ken` as the arguments for the owners. Then if you want to find out the name of the owner of car2, you can access the following property:

```javascript
console.log(car2.owner.name); // Ken Jones
```

Note that you can always add a property to a previously defined object. For example, the statement

```javascript
car1.color = "black";
```

adds a property `color` to car1, and assigns it a value of "black." However, this does not affect any other objects. To add the new property to all objects of the same type, you have to add the property to the definition of the `car` object type.

#### Using the `Object.create` method

Objects can also be created using the [`Object.create()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/create) method. This method can be very useful, because it allows you to choose the prototype object for the object you want to create, without having to define a constructor function.

```javascript
// Animal properties and method encapsulation
var Animal = {
    type: "Invertebrates", // Default value of properties
    displayType: function() { // Method which will display type of Animal
        console.log(this.type);
    }
};
// Create new animal type called animal1
var animal1 = Object.create(Animal);
animal1.displayType(); // Invertebrates
// Create new animal type called Fishes
var fish = Object.create(Animal);
fish.type = "Fishes";
fish.displayType(); // Fishes
```

### Inheritance

All objects in JavaScript inherit from at least one other object. The object being inherited from is known as the prototype, and the inherited properties can be found in the `prototype` object of the constructor. See [Inheritance and the prototype chain](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Inheritance_and_the_prototype_chain) for more information.

### Indexing object properties

You can refer to a property of an object either by its property name or by its ordinal index. If you initially define a property by its name, you must always refer to it by its name, and if you initially define a property by an index, you must always refer to it by its index.

This restriction applies when you create an object and its properties with a constructor function (as we did previously with the `Car`object type) and when you define individual properties explicitly (for example, `myCar.color = "red"`). If you initially define an object property with an index, such as `myCar[5] = "25 mpg"`, you can subsequently refer to the property only as `myCar[5]`.

The exception to this rule is objects reflected from HTML, such as the `forms` array. You can always refer to objects in these arrays by either their ordinal number (based on where they appear in the document) or their name (if defined). For example, if the second `FORM` tag in a document has a `NAME` attribute of "myForm", you can refer to the form as `document.forms[1]` or `document.forms["myForm"]` or `document.forms.myForm`.

### Defining properties for an object type

You can add a property to a previously defined object type by using the `prototype` property. This defines a property that is shared by all objects of the specified type, rather than by just one instance of the object. The following code adds a `color` property to all objects of type `car`, and then assigns a value to the `color` property of the object `car1`.

```javascript
Car.prototype.color = null;
car1.color = "black";
```

See the [`prototype` property](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/prototype) of the `Function` object in the [JavaScript reference](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference) for more information.

### Defining methods

A *method* is a function associated with an object, or, simply put, a method is a property of an object that is a function. Methods are defined the way normal functions are defined, except that they have to be assigned as the property of an object. See also [method definitions](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/Method_definitions) for more details. An example is:

```javascript
objectName.methodname = function_name;
var myObj = {
    myMethod: function(params) {
        // ...do something
    }
};
```

where `objectName` is an existing object, `methodname` is the name you are assigning to the method, and `function_name` is the name of the function.

You can then call the method in the context of the object as follows:

```javascript
object.methodname(params);
```

You can define methods for an object type by including a method definition in the object constructor function. For example, you could define a function that would format and display the properties of the previously-defined `car` objects; for example,

```javascript
function displayCar() {
    var result = "A Beautiful " + this.year + " " + this.make + " " + this.model;
    pretty_print(result);
}
```

where `pretty_print` is a function to display a horizontal rule and a string. Notice the use of `this` to refer to the object to which the method belongs.

You can make this function a method of `car` by adding the statement

```javascript
this.displayCar = displayCar;
```

to the object definition. So, the full definition of `car` would now look like

```javascript
function Car(make, model, year, owner) {
    this.make = make;
    this.model = model;
    this.year = year;
    this.owner = owner;
    this.displayCar = displayerCar;
}
```

Then you can call the `displayCar` method for each of the objects as follows:

```javascript
car1.displayCar();
car2.displayCar();
```

### Using `this` for object references

JavaScript has a special keyword, `this`, that you can use within a method to refer to the current object. For example, suppose you have a function called `validate` that validates an object's `value` property, given the object and the high and low values:

```javascript
function validate(obj, lowval, hival) {
    if ((obj.value < lowval) || (obj.value > hival)) {
        alert("Invalid Valuel");
    }
}
```

Then, you could call `validate` in each form element's `onchange `event handler, using `this` to pass it the element, as in the following example:

```html
<input type="text" name="age" size="3" onchange="validate(this, 18, 19)">
```

In general, `this` refers to the calling object in a method.

When combined with the `form` property, `this` can refer to the current object's parent form. In the following example, the form `myForm`contains a `Text` object and a button. When the user clicks the button, the value of the `Text` object is set to the form's name. The button's `onclick` event handler uses `this.form` to refer to the parent form, `myForm`.

```html
<form name="myForm">
    <p><label>Form name: <input name="text1" type="text" value="Beluga"></label></p>  
    <p><input name="button1" type="button" value="Show Form Name" onclick="this.form.text1.value = this.form.name"></p>
</form>
```

### Defining getters and setters

A [getter](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get) is a method that gets the value of a specific property. A [setter](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/set) is a method that sets the value of a specific property. You can define getters and setters on any predefined core object or user-defined object that supports the addition of new properties. The syntax for defining getters and setters uses the object literal syntax.

The following illustrates how getters and setters could work for a user-defined object `o`.

```javascript
var o = {
    a: 7,
    get b() {
        return this.a + 1;
    },
    set c(x) {
        this.a = x / 2;
    }
};
console.log(o.a); // 7
console.log(o.b); // 8
o.c = 50;
console.log(o.a); // 25
```

The `o` object's properties are:

- `o.a` — a number
- `o.b` — a getter that returns `o.a` plus 1
- `o.c` — a setter that sets the value of `o.a` to half of the value `o.c` is being set to

Please note that function names of getters and setters defined in an object literal using "[gs]et *property*()" (as opposed to `__define[GS]etter__` ) are not the names of the getters themselves, even though the `[gs]et *propertyName*(){ }` syntax may mislead you to think otherwise. To name a function in a getter or setter using the "[gs]et *property*()" syntax, define an explicitly named function programmatically using `Object.defineProperty` (or the `Object.prototype.__defineGetter__` legacy fallback).

The following code illustrates how getters and setters can extend the [`Date`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date) prototype to add a `year` property to all instances of the predefined `Date` class. It uses the `Date` class's existing `getFullYear` and `setFullYear` methods to support the `year` property's getter and setter.

These statements define a getter and setter for the year property:

```javascript
var d = Date.prototype;
Object.defineProperty(d, "year", {
    get: function() {
        return this.getFullYear();
    },
    set: function(y) {
        this.setFullYear(y);
    }
});
```

These statements use the getter and setter in a `Date` object:

```javascript
var now = new Date();
console.log(now.year); // 2016
now.year = 2017;
console.log(now); // Tue Dec 26 2017 10:47:12 GMT+0800 (中国 (標準時))
```

In principle, getters and setters can be either

- defined using [object initializers](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects#Using_object_initializers), or
- added later to any object at any time using a getter or setter adding method.

When defining getters and setters using [object initializers](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Working_with_Objects#Using_object_initializers) all you need to do is to prefix a getter method with `get` and a setter method with `set`. Of course, the getter method must not expect a parameter, while the setter method expects exactly one parameter (the new value to set). For instance:

```javascript
var o = {
    a: 7,
    get b() {
        return this.a + 1;
    },
    set c(x) {
        this.a = x / 2;
    }
};
```

Getters and setters can also be added to an object at any time after creation using the `Object.defineProperties` method. This method's first parameter is the object on which you want to define the getter or setter. The second parameter is an object whose property names are the getter or setter names, and whose property values are objects for defining the getter or setter functions. Here's an example that defines the same getter and setter used in the previous example:

```javascript
var o = {a: 0};
Object.defineProperties(o, {
    "b": {
        get: function() {
            return this.a + 1;
        }
    },
    "c": {
        set: function(x) {
            this.a = x / 2;
        }
    }
});
o.c = 10;
console.log(o.b); // 6
```

Which of the two forms to choose depends on your programming style and task at hand. If you already go for the object initializer when defining a prototype you will probably most of the time choose the first form. This form is more compact and natural. However, if you need to add getters and setters later — because you did not write the prototype or particular object — then the second form is the only possible form. The second form probably best represents the dynamic nature of JavaScript — but it can make the code hard to read and understand.

### Deleting properties

You can remove a non-inherited property by using the `delete` operator. The following code shows how to remove a property.

```javascript
var myobj = new Object;
myobj.a = 5;
myobj.b = 12;
delete myobj.a; // true
console.log("a" in myobj); // false
```

You can also use `delete` to delete a global variable if the `var` keyword was not used to declare the variable:

```javascript
g = 17;
delete g; // true
```

### Comparing Objects

In JavaScript objects are a reference type. Two distinct objects are never equal, even if they have the same properties. Only comparing the same object reference with itself yields true.

```javascript
// Two variables, two distinct objects with the same properties
var fruit = {name: "apple"};
var fruitbear = {name: "apple"};
fruit == fruitbear; // false
fruit === fruitbear; // false
// Two variables, a single object
fruitbear = fruit; // assign fruit object reference to fruitbear
fruit == fruitbear; // true
fruit === fruitbear; // true
fruit.name = "grape";
console.log(fruitbear.name); // grape
```

For more information about comparison operators, see [Comparison operators](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Comparison_Operators).

### See also

- To dive deeper, read about the [details of javaScript's objects model](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Details_of_the_Object_Model).
- To learn about ECMAScript6 classes (a new way to create objects), read the [JavaScript classes](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Classes) chapter.

## Details of the object model

> JavaScript is an object-based language based on prototypes, rather than being class-based. Because of this different basic, it can be less apparent how JavaScript allows you to create hierarchies of objects and to have inheritance of properties and their values.

### Class-based vs. prototype-based languages

Class-based object-oriented languages, such as Java and C++, are founded on the concept of two distinct entities: classes and instances.

- A *class* defines all of the properties (considering methods and fields in Java, or members in C++, to be properties) that characterize a certain set of objects. A class is an abstract thing, rather than any particular member of the set of objects it describes. For example, the `Employee` class could represent the set of all employees.


- An *instance*, on the other hand, is the instantiation of a class; that is, one of its members. For example, `Victoria` could be an instance of the `Employee` class, representing a particular individual as an employee. An instance has exactly the same properties of its parent class (no more, no less).

A prototype-based language, such as JavaScript, does not make this distinction: it simply has objects. A prototype-based language has the notion of a *prototypical object*, an object used as a template from which to get the initial properties for a new object. Any object can specify its own properties, either when you create it or at run time. In addition, any object can be associated as the *prototype* for another object, allowing the second object to share the first object's properties.

#### Defining a class

In class-based languages, you define a class in a separate *class definition*. In that definition you can specify special methods, called *constructors*, to create instances of the class. A constructor method can specify initial values for the instance's properties and perform other processing appropriate at creation time. You use the `new` operator in association with the constructor method to create class instances.

JavaScript follows a similar model, but does not have a class definition separate from the constructor. Instead, you define a constructor function to create objects with a particular initial set of properties and values. Any JavaScript function can be used as a constructor. You use the `new` operator with a constructor function to create a new object.

#### Subclasses and inheritance

In a class-based language, you create a hierarchy of classes through the class definitions. In a class definition, you can specify that the new class is a *subclass* of an already existing class. The subclass inherits all the properties of the superclass and additionally can add new properties or modify the inherited ones. For example, assume the `Employee` class includes only the `name` and `dept` properties, and `Manager` is a subclass of `Employee` that adds the `reports` property. In this case, an instance of the `Manager` class would have all three properties: `name`, `dept`, and `reports`.

JavaScript implements inheritance by allowing you to associate a prototypical object with any constructor function. So, you can create exactly the `Employee` — `Manager` example, but you use slightly different terminology. First you define the `Employee` constructor function, specifying the `name` and `dept` properties. Next, you define the `Manager` constructor function, calling the `Empl``oyee` constructor and specifying the `reports` property. Finally, you assign a new object derived from `Employee.prototype` as the `prototype` for the `Manager` constructor function. Then, when you create a new `Manager`, it inherits the `name` and `dept` properties from the `Employee`object.

#### Adding and removing properties

In class-based languages, you typically create a class at compile time and then you instantiate instances of the class either at compile time or at run time. You cannot change the number or the type of properties of a class after you define the class. In JavaScript, however, at run time you can add or remove properties of any object. If you add a property to an object that is used as the prototype for a set of objects, the objects for which it is the prototype also get the new property.

#### Summary of differences

The following table gives a short summary of some of these differences. The rest of this chapter describes the details of using JavaScript constructors and prototypes to create an object hierarchy and compares this to how you would do it in Java.

**Comparison of class-based (Java) and prototype-based (JavaScript) object systems**

| Class-based (Java)                       | Prototype-based (JavaScript)             |
| ---------------------------------------- | ---------------------------------------- |
| Class and instance are distinct entities. | All objects can inherit from another object. |
| Define a class with a class definition; instantiate a class with constructor methods. | Define and create a set of objects with constructor functions. |
| Create a single object with the `new` operator. | Same.                                    |
| Construct an object hierarchy by using class definitions to define subclasses of existing classes. | Construct an object hierarchy by assigning an object as the prototype associated with a constructor function. |
| Inherit properties by following the class chain. | Inherit properties by following the prototype chain. |
| Class definition specifies *all* properties of all instances of a class. Cannot add properties dynamically at run time. | Constructor function or prototype specifies an *initial set* of properties. Can add or remove properties dynamically to individual objects or to the entire set of objects. |

### The employee example

The remainder of this chapter uses the employee hierarchy shown in the following figure.

A simple object hierarchy with the following objects:

![img](https://mdn.mozillademos.org/files/3060/figure8.1.png)

- `Employee` has the properties `name` (whose value defaults to the empty string) and `dept` (whose value defaults to "general").
- `Manager` is based on `Employee`. It adds the `reports` property (whose value defaults to an empty array, intended to have an array of `Employee` objects as its value).
- `WorkerBee` is also based on `Employee`. It adds the `projects` property (whose value defaults to an empty array, intended to have an array of strings as its value).
- `SalesPerson` is based on `WorkerBee`. It adds the `quota` property (whose value defaults to 100). It also overrides the `dept` property with the value "sales", indicating that all salespersons are in the same department.
- `Engineer` is based on `WorkerBee`. It adds the `machine` property (whose value defaults to the empty string) and also overrides the `dept` property with the value "engineering".

### Creating the hierarchy

There are several ways to define appropriate constructor functions to implement the Employee hierarchy. How you choose to define them depends largely on what you want to be able to do in your application.

This section shows how to use very simple (and comparatively inflexible) definitions to demonstrate how to get the inheritance to work. In these definitions, you cannot specify any property values when you create an object. The newly-created object simply gets the default values, which you can change at a later time.

In a real application, you would probably define constructors that allow you to provide property values at object creation time (see [More flexible constructors](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Details_of_the_Object_Model#More_flexible_constructors) for information). For now, these simple definitions demonstrate how the inheritance occurs.

The following Java and JavaScript `Employee` definitions are similar. The only difference is that you need to specify the type for each property in Java but not in JavaScript (this is due to Java being a [strongly typed language](http://en.wikipedia.org/wiki/Strong_and_weak_typing) while JavaScript is a weakly typed language).

```javascript
function Employee() {
    this.name = "";
    this.dept = "general";
}
```

```java
public class Employee {
    public String name = "";
    public String dept = "general";
}
```

The `Manager` and `WorkerBee` definitions show the difference in how to specify the next object higher in the inheritance chain. In JavaScript, you add a prototypical instance as the value of the `prototype` property of the constructor function. You can do so at any time after you define the constructor. In Java, you specify the superclass within the class definition. You cannot change the superclass outside the class definition.

```javascript
function Manager() {
    Employee.call(this);
    this.reports = [];
}
Manager.prototype = Object.create(Employee.prototype);

function WorkerBee() {
    Employee.call(this);
    this.projects = [];
}
WorkerBee.prototype = Object.create(Employee.prototype);
```

```java
public class Manager extends Employee {
    public Employee[] reports = new Employee[0];
}

public class WorkerBee extends Employee {
    public String[] projects = new String[0];
}
```

The `Engineer` and `SalesPerson` definitions create objects that descend from `WorkerBee` and hence from `Employee`. An object of these types has properties of all the objects above it in the chain. In addition, these definitions override the inherited value of the `dept`property with new values specific to these objects.

```javascript
function SalesPerson() {
    WorkerBee.call(this);
    this.dept = "sales";
    this.quota = 100;
}
SalesPerson.prototype = Object.create(WorkerBee.prototype);

function Engineer() {
    WorkerBee.call(this);
    this.dept = "engineering";
    this.machine = "";
}
Engineer.prototype = Object.create(WorkerBee.prototype);
```

```java
public class SalesPerson extends WorkerBee {
    public String dept = "sales";
    public double quota = 100.0；
}

public class Engineer extends WorkerBee {  
    public String dept = "engineering";
    public String machine = ""
}
```

Using these definitions, you can create instances of these objects that get the default values for their properties. The next figure illustrates using these JavaScript definitions to create new objects and shows the property values for the new objects.

**Note:** The term *instance* has a specific technical meaning in class-based languages. In these languages, an instance is an individual instantiation of a class and is fundamentally different from a class. In JavaScript, "instance" does not have this technical meaning because JavaScript does not have this difference between classes and instances. However, in talking about JavaScript, "instance" can be used informally to mean an object created using a particular constructor function. So, in this example, you could informally say that `jane` is an instance of `Engineer`. Similarly, although the terms *parent, child, ancestor*, and *descendant* do not have formal meanings in JavaScript; you can use them informally to refer to objects higher or lower in the prototype chain.

#### Creating objects with simple definitions

##### Object hierarchy

The following hierarchy is created using the code on the right side.

![img](https://mdn.mozillademos.org/files/10412/=figure8.3.png)

##### individual objects

```javascript
var jim = new Employee;
var sally = new Manager;
var mark = new WorkerBee;
var fred = new SalesPerson;
var jane = new Engineer;
```

### Object properties

This section discusses how objects inherit properties from other objects in the prototype chain and what happens when you add a property at run time.

#### Inheriting properties

Suppose you create the `mark` object as a `WorkerBee` with the following statement:

```javascript
var mark = new WorkerBee;
```

When JavaScript sees the `new` operator, it creates a new generic object and passes this new object as the value of the `this` keyword to the `WorkerBee` constructor function. The constructor function explicitly sets the value of the `projects` property, and implicitly sets the value of the internal `__proto__` property to the value of `WorkerBee.prototype`. (That property name has two underscore characters at the front and two at the end.) The `__proto__` property determines the prototype chain used to return property values. Once these properties are set, JavaScript returns the new object and the assignment statement sets the variable `mark` to that object.

This process does not explicitly put values in the `mark` object (*local* values) for the properties that `mark` inherits from the prototype chain. When you ask for the value of a property, JavaScript first checks to see if the value exists in that object. If it does, that value is returned. If the value is not there locally, JavaScript checks the prototype chain (using the `__proto__` property). If an object in the prototype chain has a value for the property, that value is returned. If no such property is found, JavaScript says the object does not have the property. In this way, the `mark` object has the following properties and values:

```javascript
mark.name = "";
mark.dept = "general";
mark.projects = [];
```

The `mark` object inherits values for the `name` and `dept` properties from the prototypical object in `mark.__proto__`. It is assigned a local value for the `projects` property by the `WorkerBee` constructor. This gives you inheritance of properties and their values in JavaScript. Some subtleties of this process are discussed in [Property inheritance revisited](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Details_of_the_Object_Model#Property_inheritance_revisited).

Because these constructors do not let you supply instance-specific values, this information is generic. The property values are the default ones shared by all new objects created from `WorkerBee`. You can, of course, change the values of any of these properties. So, you could give specific information for `mark` as follows:

```javascript
mark.name = "Doe, Mark";
mark.dept = "admin";
mark.projects = ["navigator"];
```

#### Adding properties

In JavaScript, you can add properties to any object at run time. You are not constrained to use only the properties provided by the constructor function. To add a property that is specific to a single object, you assign a value to the object, as follows:

```
mark.bonus = 3000;
```

Now, the `mark` object has a `bonus` property, but no other `WorkerBee` has this property.

If you add a new property to an object that is being used as the prototype for a constructor function, you add that property to all objects that inherit properties from the prototype. For example, you can add a `specialty` property to all employees with the following statement:

```javascript
Employee.prototype.specialty = "none";
```

As soon as JavaScript executes this statement, the `mark` object also has the `specialty` property with the value of `"none"`. The following figure shows the effect of adding this property to the `Employee` prototype and then overriding it for the `Engineer` prototype.

![img](https://developer.mozilla.org/@api/deki/files/4422/=figure8.4.png)
**Adding properties**

### More flexible constructors

The constructor functions shown so far do not let you specify property values when you create an instance. As with Java, you can provide arguments to constructors to initialize property values for instances. The following figure shows one way to do this.

![img](https://developer.mozilla.org/@api/deki/files/4423/=figure8.5.png)**Specifying properties in a constructor, take 1**

The following table shows the Java and JavaScript definitions for these objects.

```javascript
function Employee(name, dept) {
    this.name = name || "";
    this.dept = dept || "general";
}

function WorkerBee(projs) {
    this.projects = projs || [];
}
WorkerBee.prototype = new Employee;

function Engineer(mach) {
    this.dept = "engineering";
    this.machine = mach || "";
}
Engineer.prototype = new WorkerBee;
```

```java
class Employee {
    public String name;
    public String dept;
    public Employee() {
        this("", "general");
    }
    public Employee(String name) {
        this(name, "general");
    }
    public Employee(String name, String dept) {
        this.name = name;
        this.dept = dept;
    }
}
class WorkerBee extends Employee {
    public String[] projects;
    public WorkerBee() {
        this(new String[0]);
    }
    public WorkerBee(String[] projs) {
        this.projects = projs;
    }
}
class Engineer extends WorkerBee {
    public String machine;
    public Engineer() {
        this.dept = "engineering";
        this.machine = "";
    }
    public Engineer(String mach) {
        this.dept = "engineering";
        this.machine = mach;
    }
}
```

These JavaScript definitions use a special idiom for setting default values:

The JavaScript logical OR operator (`||`) evaluates its first argument. If that argument converts to true, the operator returns it. Otherwise, the operator returns the value of the second argument. Therefore, this line of code tests to see if `name` has a useful value for the `name` property. If it does, it sets `this.name` to that value. Otherwise, it sets `this.name` to the empty string. This chapter uses this idiom for brevity; however, it can be puzzling at first glance.

**Note:** This may not work as expected if the constructor function is called with arguments which convert to `false` (like `0` (zero) and empty string (`""`). In this case the default value will be chosen.

With these definitions, when you create an instance of an object, you can specify values for the locally defined properties. You can use the following statement to create a new `Engineer`:

```javascript
var jane = new Engineer("belau");
```

`Jane`'s properties are now:

```javascript
jane.name == "";
jane.dept == "engineering";
jane.projects == [];
jane.machine == "belau";
```

Notice that with these definitions, you cannot specify an initial value for an inherited property such as `name`. If you want to specify an initial value for inherited properties in JavaScript, you need to add more code to the constructor function.

So far, the constructor function has created a generic object and then specified local properties and values for the new object. You can have the constructor add more properties by directly calling the constructor function for an object higher in the prototype chain. The following figure shows these new definitions.

![img](https://developer.mozilla.org/@api/deki/files/4430/=figure8.6.png)

**Specifying properties in a constructor, take 2**

Let's look at one of these definitions in detail. Here's the new definition for the `Engineer` constructor:

```javascript
function Engineer(name, projs, mach) {
    this.base = WorkerBee;
    this.base(name, "engineering", projs);
    this.machine = mach || "";
}
```

Suppose you create a new `Engineer` object as follows:

```javascript
var jane = new Engineer("Doe, Jane", ["navigator", "javascript"], "belau");
```

JavaScript follows these steps:

1. The `new` operator creates a generic object and sets its `__proto__` property to `Engineer.prototype`.
2. The `new` operator passes the new object to the `Engineer` constructor as the value of the `this` keyword.
3. The constructor creates a new property called `base` for that object and assigns the value of the `WorkerBee` constructor to the `base` property. This makes the `WorkerBee` constructor a method of the `Engineer` object. The name of the ` base` property is not special. You can use any legal property name; `base` is simply evocative of its purpose.
4. The constructor calls the `base` method, passing as its arguments two of the arguments passed to the constructor (`"Doe, Jane"` and `["navigator", "javascript"]`) and also the string `"engineering"`. Explicitly using `"engineering"` in the constructor indicates that all `Engineer` objects have the same value for the inherited `dept` property, and this value overrides the value inherited from `Employee`.
5. Because `base` is a method of `Engineer`, within the call to `base`, JavaScript binds the `this` keyword to the object created in Step 1. Thus, the `WorkerBee` function in turn passes the `"Doe, Jane"` and `"engineering"` arguments to the `Employee` constructor function. Upon return from the `Employee` constructor function, the `WorkerBee` function uses the remaining argument to set the `projects` property.
6. Upon return from the `base` method, the `Engineer` constructor initializes the object's `machine` property to `"belau"`.
7. Upon return from the constructor, JavaScript assigns the new object to the `jane` variable.

You might think that, having called the `WorkerBee` constructor from inside the `Engineer` constructor, you have set up inheritance appropriately for `Engineer` objects. This is not the case. Calling the `WorkerBee` constructor ensures that an `Engineer` object starts out with the properties specified in all constructor functions that are called. However, if you later add properties to the `Employee` or `WorkerBee` prototypes, those properties are not inherited by the `Engineer` object. For example, assume you have the following statements:

```javascript
function Engineer(name, projs, mach) {
    this.base = WorkerBee;
    this.base(name, "engineering", projs);
    this.machine = mach || "";
}
var jane = new Engineer("Doe, Jane", ["navigator", "javascript"], "belau");
Employee.prototype.specialty = "none";
```

The `jane` object does not inherit the `specialty` property. You still need to explicitly set up the prototype to ensure dynamic inheritance. Assume instead you have these statements:

```javascript
function Engineer(name, projs, mach) {
    this.base = WorkerBee;
    this.base(name, "engineering", projs);
    this.machine = mach || "";
}
Engineer.prototype = new WorkerBee;
var jane = new Engineer("Doe, Jane", ["navigator", "javascript"], "belau");
Employee.prototype.specialty = "none";
```

Now the value of the `jane` object's `specialty` property is "none".

Another way of inheriting is by using the `call()` / [`apply()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/apply) methods. Below are equivalent:

```javascript
function Engineer(name, projs, mach) {
    this.base = WorkerBee;
    this.base(name, "engineering", projs);
    this.machine = mach || "";
}
/*************************************/
function Engineer(name, projs, mach) {
    WorkerBee.call(this, name, "engineering", projs);
    this.machine = mach || "";
}
```

Using the javascript `call()` method makes a cleaner implementation because the `base` is not needed anymore.

### Property inheritance revisited

The preceding sections described how JavaScript constructors and prototypes provide hierarchies and inheritance. This section discusses some subtleties that were not necessarily apparent in the earlier discussions.

#### Local versus inherited values

When you access an object property, JavaScript performs these steps, as described earlier in this chapter:

1. Check to see if the value exists locally. If it does, return that value.
2. If there is not a local value, check the prototype chain (using the `__proto__` property).
3. If an object in the prototype chain has a value for the specified property, return that value.
4. If no such property is found, the object does not have the property.


The outcome of these steps depends on how you define things along the way. The original example had these definitions:

```javascript
function Employee() {
    this.name = "";
    this.dept = "general";
}
function WorkerBee() {
    this.projects = [];
}
WorkerBee.prototype = new Employee;
```

With these definitions, suppose you create `amy` as an instance of `WorkerBee` with the following statement:

```javascript
var amy = new WorkerBee;
```

The `amy` object has one local property, `projects`. The values for the `name` and `dept` properties are not local to `amy` and so derive from the `amy` object's `__proto__` property. Thus, `amy` has these property values:

```javascript
amy.name == ""
amy.dept == "general";
amy.projects == [];
```

Now suppose you change the value of the `name` property in the prototype associated with `Employee`:

```javascript
Employee.prototype.name = "Unknown";
```

At first glance, you might expect that new value to propagate down to all the instances of `Employee`. However, it does not.

When you create *any* instance of the `Employee` object, that instance gets a **local value** for the `name` property (the empty string). This means that when you set the `WorkerBee` prototype by creating a new `Employee` object, `WorkerBee.prototype` has a local value for the `name` property. Therefore, when JavaScript looks up the `name` property of the `amy` object (an instance of `WorkerBee`), JavaScript finds the local value for that property in `WorkerBee.prototype`. It therefore does not look further up the chain to `Employee.prototype`.

If you want to change the value of an object property at run time and have the new value be inherited by all descendants of the object, you cannot define the property in the object's constructor function. Instead, you add it to the constructor's associated prototype. For example, assume you change the preceding code to the following:

```javascript
function Employee() {
    this.dept = "general";
}
Employee.prototype.name = "";
function WorkerBee() {
    this.projects = [];
}
WorkerBee.prototype = new Employee;
var amy = new WorkerBee;
Employee.prototype.name = "Unknown";
```

In this case, the `name` property of `amy` becomes "Unknown".

As these examples show, if you want to have default values for object properties and you want to be able to change the default values at run time, you should set the properties in the constructor's prototype, not in the constructor function itself.

#### Determining instance relationships

Property lookup in JavaScript looks within an object's own properties and, if the property name is not found, it looks within the special object property `__proto__`. This continues recursively; the process is called "lookup in the prototype chain".

The special property `__proto__` is set when an object is constructed; it is set to the value of the constructor's `prototype` property. So the expression `new Foo()` creates an object with `__proto__ == Foo.prototype`. Consequently, changes to the properties of `Foo.prototype` alters the property lookup for all objects that were created by `new Foo()`.

Every object has a `__proto__` object property (except `Object`); every function has a `prototype` object property. So objects can be related by 'prototype inheritance' to other objects. You can test for inheritance by comparing an object's `__proto__` to a function's `prototype` object. JavaScript provides a shortcut: the `instanceof` operator tests an object against a function and returns true if the object inherits from the function prototype. For example,

```javascript
var f = new Foo();
var isTrue = (f instanceof Foo);
```

For a more detailed example, suppose you have the same set of definitions shown in [Inheriting properties](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Details_of_the_Object_Model#Inheriting_properties). Create an `Engineer` object as follows:

```javascript
var chris = new Engineer("Pigman, Chris", ["jsd"], "fiji");
```

With this object, the following statements are all true:

```javascript
chris.__proto__ == Engineer.prototype;
chris.__proto__.__proto__ == WorkerBee.prototype;
chris.__proto__.__proto__.__proto__ == Employee.prototype;
chris.__proto__.__proto__.__proto__.__proto__ == Object.prototype;
chris.__proto__.__proto__.__proto__.__proto__.__proto__ == null;
```

Given this, you could write an `instanceOf` function as follows:

```javascript
function instanceOf(object, constructor) {
    object = object.__proto__;
    while (object != null) {
        if (object == constructor.prototype) {
            return true;
        }
        if (typeof object == "xml") {
            return constructor.prototype == XML.prototype;
        }
        object = object.__proto__;
    }
    return false;
}
```

**Note:** The implementation above checks the type of the object against "xml" in order to work around a quirk of how XML objects are represented in recent versions of JavaScript. See [bug 634150](https://bugzilla.mozilla.org/show_bug.cgi?id=634150) if you want the nitty-gritty details.

Using the instanceOf function defined above, these expressions are true:

```javascript
instanceOf(chris, Engineer);
instanceOf(chris, WorkerBee);
instanceOf(chris, Employee);
instanceOf(chris, Object);
```

But the following expression is false:

```javascript
instanceOf(chris, SalesPerson);
```

#### Global information in constructors

When you create constructors, you need to be careful if you set global information in the constructor. For example, assume that you want a unique ID to be automatically assigned to each new employee. You could use the following definition for `Employee` :

```javascript
var idCounter = 1;
function Employee(name, dept) {
    this.name = name || "";
    this.dept = dept || "general";
    this.id = idCouter++;
}
```

With this definition, when you create a new `Employee`, the constructor assigns it the next ID in sequence and then increments the global ID counter. So, if your next statement is the following, `victoria.id` is 1 and `harry.id` is 2:

```javascript
var victoria = new Employee("Pigbert, Victoria", "pubs");
var harry = new Employee("Tschopik, Harry", "sales");
```

At first glance that seems fine. However, `idCounter` gets incremented every time an `Employee` object is created, for whatever purpose. If you create the entire `Employee` hierarchy shown in this chapter, the `Employee` constructor is called every time you set up a prototype. Suppose you have the following code:

```javascript
var idCounter = 1;
function Employee(name, dept) {
    this.name = name || "";
    this.dept = dept || "general";
    this.id = idCouter++;
}
function Manager(name, dept, reports) {
    //...
}
Manager.prototype = new Employee;
function WorkerBee(name, dept, projs) {
    //...
}
WorkerBee.prototype = new Employee;
function Engineer(name, projs, mach) {
    //...
}
Engineer.prototype = new WorkerBee;
function SalesPerson(name, projs, quota) {
    //...
}
SalesPerson.prototype = new WorkerBee;
var mac = new Engineer("Wood, Mac");
```

Further assume that the definitions omitted here have the `base` property and call the constructor above them in the prototype chain. In this case, by the time the `mac` object is created, `mac.id` is 5.

Depending on the application, it may or may not matter that the counter has been incremented these extra times. If you care about the exact value of this counter, one possible solution involves instead using the following constructor:

```javascript
function Employee(name, dept) {
    this.name = name || "";
    this.dept = dept || "general";
    if (name) {
        this.id = idCounter++;
    }
}
```

When you create an instance of `Employee` to use as a prototype, you do not supply arguments to the constructor. Using this definition of the constructor, when you do not supply arguments, the constructor does not assign a value to the id and does not update the counter. Therefore, for an `Employee` to get an assigned id, you must specify a name for the employee. In this example, `mac.id` would be 1.

#### No multiple inheritance

Some object-oriented languages allow multiple inheritance. That is, an object can inherit the properties and values from unrelated parent objects. JavaScript does not support multiple inheritance.

Inheritance of property values occurs at run time by JavaScript searching the prototype chain of an object to find a value. Because an object has a single associated prototype, JavaScript cannot dynamically inherit from more than one prototype chain.

In JavaScript, you can have a constructor function call more than one other constructor function within it. This gives the illusion of multiple inheritance. For example, consider the following statements:

```javascript
function Hobbyist(hobby) {
    this.hobby = hobby || "scuba";
}
function Engineer(name, projs, mach, hobby) {
    this.base1 = WorkerBee;
    this.base1(name, "engineering", projs);
    this.base2 = Hobbyist;
    this.base2(hobby);
    this.machine = mach || "";
}
Engineer.prototype = new WorkerBee;
var dennis = new Engineer("Doe, Dennis", ["collabra"], "hugo");
```

Further assume that the definition of `WorkerBee` is as used earlier in this chapter. In this case, the `dennis` object has these properties:

```javascript
dennis.name == "Doe, Dennis";
dennis.dept == "engineering";
dennis.projects == ["collabra"];
dennis.machine == "hugo";
dennis.hobby == "scuba";
```

So `dennis` does get the `hobby` property from the `Hobbyist` constructor. However, assume you then add a property to the `Hobbyist` constructor's prototype:

```javascript
Hobbyist.prototype.quipment = ["mask", "fins", "regulator", "bcd"];
```

The `dennis` object does not inherit this new property.

## Iterators and generators

> Processing each of the items in a collection is a very common operation. JavaScript provides a number of ways of iterating over a collection, from simple [`for`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for) loops to [`map()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/map) and [`filter()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter). Iterators and Generators bring the concept of iteration directly into the core language and provide a mechanism for customizing the behavior of [`for...of`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...of) loops.

### Iterators

An object is an **iterator** when it knows how to access items from a collection one at a time, while keeping track of its current position within that sequence. In JavaScript an iterator is an object that provides a `next()` method which returns the next item in the sequence. This method returns an object with two properties: `done` and `value` .

Once created, an iterator object can be used explicitly by repeatedly calling `next()`.

```javascript
function makeIterator(array) {
    var nextIndex = 0;
    return {
        next: function() {
            return nextIndex < array.length ? {
                value : array[nextIndex++],
                done: false
            } : {
                done: true
            };
        }
    };
}
```

Once initialized, the `next()` method can be called to access key-value pairs from the object in turn:

```javascript
var it = makeIterator(["yo", "ya"]);
console.log(it.next().value); // yo
console.log(it.next().value); // ya
console.log(it.next().done); // true
```

### Generators

While custom iterators are a useful tool, their creation requires careful programming due to the need to explicitly maintain their internal state. **Generators** provide a powerful alternative: they allow you to define an iterative algorithm by writing a single function which can maintain its own state.

A generator is a special type of function that works as a factory for iterators. A function becomes a generator if it contains one or more [`yield`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/yield) expressions and if it uses the [`function*`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/function*) syntax.

```javascript
function* idMaker() {
    var index = 0;
    while (true) {
        yield index++;
    }
    var gen = idMaker();
    console.log(gen.next().value); // 0
    console.log(gen.next().value); // 1
    console.log(gen.next().value); // 2
}
```

### Iterables

An object is **iterable** if it defines its iteration behavior, such as what values are looped over in a [`for..of`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...of) construct. Some built-in types, such as [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) or [`Map`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Map) , have a default iteration behavior, while other types (such as [`Object`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object)) do not.

In order to be **iterable**, an object must implement the **@@iterator** method, meaning that the object (or one of the objects up its [prototype chain](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Inheritance_and_the_prototype_chain)) must have a property with a [`Symbol.iterator`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Symbol/iterator) key:

#### User-defined iterables

We can make our own iterables like this:

```javascript
var myIterable = {};
myIterable[Symbol.iterator] = function* () {
    yield 1;
    yield 2;
    yield 3;
};
for (let value of myIterable) {
    console.log(value);
}
// 1
// 2
// 3
[...myIterable] // [1, 2, 3] // incredible!
```

#### Built-in iterables

[`String`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String) , [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array) , [`TypedArray`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/TypedArray) , [`Map`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Map) and [`Set`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set) are all built-in iterables, because the prototype objects of them all have a [`Symbol.iterator`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Symbol/iterator) method.

#### Syntaxes expecting iterables

Some statements and expressions are expecting iterables, for example the [`for-of`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...of) loops, [spread operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Spread_operator) , [`yield* `](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/yield*) , and [destructuring assignment](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment) .

```javascript
for (let value of ["a", "b", "c"]) {
    console.log(value);
}
// a
// b
// c
[..."abc"] // ["a", "b", "c"]
function* gen() {
    yield* ["a", "b", "c"]
}
gen().next(); // Object {value: "a", done: false}
[a, b, c] = new Set(["a", "b", "c"]);
a; // "a"
```

### Advanced generators

Generators compute their yielded values on demand, which allows them to efficiently represent sequences that are expensive to compute, or even infinite sequences as demonstrated above.

The [`next()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Generator/next) method also accepts a value which can be used to modify the internal state of the generator. A value passed to `next()` will be treated as the result of the last `yield` expression that paused the generator.

Here is the fibonacci generator using `next(x)` to restart the sequence:

```javascript
function* fibonacci() {
    var fn1 = 0, fn2 = 1;
    while (true) {
        var current = fn1;
        fn1 = fn2;
        fn2 = current + fn1;
        var reset = yield current;
        if (reset) {
            fn1 = 0;
            fn2 = 1;
        }
    }
}
var sequence = fibonacci();
console.log(sequence.next().value); // 0
console.log(sequence.next().value); // 1
console.log(sequence.next().value); // 1
console.log(sequence.next().value); // 2
console.log(sequence.next().value); // 3
console.log(sequence.next().value); // 5
console.log(sequence.next().value); // 8
console.log(sequence.next(true).value); // 0
console.log(sequence.next().value); // 1
console.log(sequence.next().value); // 1
console.log(sequence.next().value); // 2
```

**Note:** As a point of interest, calling `next(undefined)` is equivalent to calling `next()` . However, starting a newborn generator with any value other than undefined when calling `next()` will result in a `TypeError` exception.

You can force a generator to throw an exception by calling its [`throw()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Generator/throw) method and passing the exception value it should throw. This exception will be thrown from the current suspended context of the generator, as if the `yield` that is currently suspended were instead a `throw value` statement.

If a `yield` is not encountered during the processing of the thrown exception, then the exception will propagate up through the call to `throw() `, and subsequent calls to `next()` will result in the `done` property being `true` .

Generators have a [`return(value)`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Generator/return) method that returns the given value and finishes the generator itself.

## Meta programming

> Starting with ECMAScript 6, JavaScript gains support for the [`Proxy`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy) and [`Reflect`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect) objects allowing you to intercept and define custom behavior for fundamental language operations (e.g. property lookup, assignment, enumeration, function invocation, etc). With the help of these two objects you are able to program at the meta level of JavaScript.

### Proxies

Introduced in ECMAScript 6, [`Proxy`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy) objects allow you to intercept certain operations and to implement custom behaviors. For example getting a property on an object:

```javascript
var handler = {
    get: function(target, name) {
        return name in target ? target[name] : 42;
    }
};
var p = new Proxy({}, handler);
p.a = 1;
console.log(p.a, p.b); // 1 42
```

The `Proxy` object defines a *target* (an object here) and a *handler* object in which a `get` *trap* is implemented. Here, an object that is proxied will not return `undefined` when getting undefined properties, but will instead return the number 42.

Additional examples are available on the [`Proxy`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy) reference page.

#### Terminology

The following terms are used when talking about the functionality of proxies.

**[handler](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/handler)**

Placeholder object which contains traps.

**traps**

The methods that provide property access. This is analogous to the concept of traps in operating systems.

**target**

Object which the proxy virtualizes. It is often used as storage backend for the proxy. Invariants (semantics that remain unchanged) regarding object non-extensibility or non-configurable properties are verified against the target.

**invariants**

Semantics that remain unchanged when implementing custom operations are called *invariants*. If you violate the invariants of a handler, a [`TypeError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/TypeError) will be thrown.

### [Handlers and traps](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Meta_programming#Handlers_and_traps)

The following table summarizes the available traps available to `Proxy` objects. See the [reference pages](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/handler) for detailed explanations and examples.

### Revocable `Proxy`

The [`Proxy.revocable()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/revocable) method is used to create a revocable `Proxy` object. This means that the proxy can be revoked via the function `revoke` and switches the proxy off. Afterwards, any operation leads on the proxy leads to a [`TypeError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/TypeError).

```javascript
var revocable = Proxy.revocable({}, {
    get: function(target, name) {
        return "[[" + name + "]]";
    }
});
var proxy = revocable.proxy;
console.log(proxy.foo); // [[foo]]
revocable.revoke();
console.log(proxy.foo); // Uncaught TypeError
proxy.foo = 1; // Uncaught TypeError
delete proxy.foo; // Uncaught TypeError
typeof proxy; // "object" // typeof doesn't trigger any trap
```

### Reflection

[`Reflect`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect) is a built-in object that provides methods for interceptable JavaScript operations. The methods are the same as those of the [proxy handlers](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/handler) . `Reflect` is not a function object.

`Reflect` helps with forwarding default operations from the handler to the target.

With [`Reflect.has()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect/has) for example, you get the [`in` operator](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/in) as a function:

```javascript
Reflect.has(Object, "assign"); // true
```

#### A better `apply` function

In ES5, you typically use the [`Function.prototype.apply()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/apply) method to call a function with a given `this` value and `arguments` provided as an array (or an [array-like object](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Indexed_collections#Working_with_array-like_objects)).

```javascript
Function.prototype.apply.call(Math.floor, undefined, [1.75]); // 1
```

With [`Reflect.apply`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect/apply) this becomes less verbose and easier to understand:

```javascript
Reflect.apply(Math.floor, undefined, [1.75]); // 1
Reflect.apply(String.fromCharCode, undefined, [104, 101, 108, 108, 111]); // "hello"
Reflect.apply(RegExp.prototype.exec, /ab/, ["confabulation"]).index; // 4
Reflect.apply("".charAt, "ponines", [3]); // i
```

#### Checking if property definition has been successful

With [`Object.defineProperty`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/defineProperty), which returns an object if successful, or throws a [`TypeError`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/TypeError) otherwise, you would use a [`try...catch`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/try...catch)block to catch any error that occurred while defining a property. Because [`Reflect.defineProperty`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Reflect/defineProperty) returns a Boolean success status, you can just use an [`if...else`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/if...else) block here:

```javascript
if (Reflect.defineProperty(target, property, attributes)) {
    // success
} else {
    // failure
}
```

