#JavaScript Introductory

## JavaScript technologies overview

> The umbrella term "JavaScript" as understood in a web browser context contains several very different elements. One of them is the core language (ECMAScript), another is the collection of the [Web APIs](https://developer.mozilla.org/en-US/docs/Web/Reference/API), including the DOM (Document Object Model).

### JavaScript, the core language (ECMAScript)

The core language of JavaScript is standardized by the ECMA TC39 committee as a language named [ECMAScript](https://developer.mozilla.org/en-US/docs/JavaScript/Language_Resources). The latest version of the specification is [ECMAScript 6.0](http://www.ecma-international.org/ecma-262/6.0/).

This core language is also used in non-browser environments, for example in [node.js](http://nodejs.org/).

#### What falls under the ECMAScript scope?

Among other things, ECMAScript defines:

- Language syntax (parsing rules, keywords, control flow, object literal initialization...)
- Error handling mechanisms (throw, try/catch, ability to create user-defined Error types)
- Types (boolean, number, string, function, object...)
- The global object. In a browser, this global object is the window object, but ECMAScript only defines the APIs not specific to browsers, e.g. `parseInt`, `parseFloat`, `decodeURI`, `encodeURI`...
- A prototype-based inheritance mechanism
- Built-in objects and functions (`JSON`, `Math`, `Array.prototype` methods, Object introspection methods...)
- Strict mode

#### Browser support

As of October 2016, the current versions of the major Web browsers implement [ECMAScript 5.1](https://developer.mozilla.org/en-US/docs/Web/JavaScript/New_in_JavaScript/ECMAScript_5_support_in_Mozilla) and [ECMAScript 2015 aka ES6](https://developer.mozilla.org/en-US/docs/Web/JavaScript/New_in_JavaScript/ECMAScript_6_support_in_Mozilla), but older versions (still in use) implement ECMAScript 5 only.

#### Future

The major 6th Edition of ECMAScript was officially approved and published as a standard on June 17, 2015 by the ECMA General Assembly. Since then ECMAScript Editions are published on a yearly basis.

#### Internationalization API

The [ECMAScript Internationalization API Specification](http://ecma-international.org/ecma-402/1.0/) is an addition to the ECMAScript Language Specification, also standardized by Ecma TC39. The internationalization API provides collation (string comparison), number formatting, and date-and-time formatting for JavaScript applications, letting the applications choose the language and tailor the functionality to their needs. The initial standard was approved in December 2012; the status of implementations in browsers is tracked in the documentation of the [`Intl` object](https://developer.mozilla.org/en-US/docs/JavaScript/Reference/Global_Objects/Intl). The Internationalization specification is nowadays also ratified on a yearly basis and browsers constantly improve their implementation.

### DOM APIs

#### WebIDL

The [WebIDL specification](http://www.w3.org/TR/WebIDL/) provides the glue between the DOM technologies and ECMAScript.

#### The Core of the DOM

The Document Object Model (DOM) is a cross-platform, **language-independent convention** for representing and interacting with objects in HTML, XHTML and XML documents. Objects in the **DOM tree** may be addressed and manipulated by using methods on the objects. The [W3C](https://developer.mozilla.org/en-US/docs/Glossary/W3C) standardizes the Core Document Object Model, which defines language-agnostic interfaces that abstract HTML and XML documents as objects, and also defines mechanisms to manipulate this abstraction. Among the things defined by the DOM, we can find:

- The document structure, a tree model, and the DOM Event architecture in [DOM core](http://dvcs.w3.org/hg/domcore/raw-file/tip/Overview.html): `Node`, `Element`, `DocumentFragment`, `Document`, `DOMImplementation`, `Event`, `EventTarget`, …
- A less rigorous definition of the DOM Event Architecture, as well as specific events in [DOM events](http://dev.w3.org/2006/webapi/DOM-Level-3-Events/html/DOM3-Events.html).
- Other things such as [DOM Traversal](http://www.w3.org/TR/DOM-Level-2-Traversal-Range/traversal.html) and [DOM Range](http://html5.org/specs/dom-range.html).

From the ECMAScript point of view, objects defined in the DOM specification are called "host objects".

#### HTML DOM

[HTML](http://www.whatwg.org/html), the Web's markup language, is specified in terms of the DOM. Layered above the abstract concepts defined in DOM Core, HTML also defines the *meaning* of elements. The HTML DOM includes such things as the `className` property on HTML elements, or APIs such as [`document.body`](https://developer.mozilla.org/en-US/docs/Web/API/Document/body).

The HTML specification also defines restrictions on documents; for example, it requires all children of a `ul` element, which represents an unordered list, to be `li` elements, as those represent list items. In general, it also forbids using elements and attributes that aren't defined in a standard.

Looking for the [`Document` object](https://developer.mozilla.org/en-US/docs/DOM/document), [`Window` object](https://developer.mozilla.org/en-US/docs/DOM/window), and the other DOM elements? Read the [DOM documentation](https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model).

### Other notable APIs

- The `setTimeout` and `setInterval` functions were first specified on the `Window` interface in HTML Standard.
- [XMLHttpRequest](https://dvcs.w3.org/hg/xhr/raw-file/tip/Overview.html) makes it possible to send asynchronous HTTP requests.
- The [CSS Object Model](http://dev.w3.org/csswg/cssom/) abstract CSS rules as objects.
- [WebWorkers ](http://www.whatwg.org/specs/web-workers/current-work/)allows parallel computation.
- [WebSockets](http://www.whatwg.org/C/#network) allows low-level bidirectional communication.
- [Canvas 2D Context](http://www.whatwg.org/html/#2dcontext) is a drawing API for [`canvas`](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/canvas).

#### Browser support

As every web developer has experienced, [the DOM is a mess](http://ejohn.org/blog/the-dom-is-a-mess/). Browser support uniformity varies a lot from feature to feature, mainly because many important DOM features have very unclear, specifications (if any), and different web browsers add incompatible features for overlapping use cases (like the Internet Explorer event model). As of June 2011, the W3C and particularly the WHATWG are defining older features in detail to improve interoperability, and browsers in turn can improve their implementations based on these specifications.

One common, though perhaps not the most reliable, approach to cross-browser compatibility is to use JavaScript libraries, which abstract DOM features and keep their APIs working the same in different browsers. Some of the most widely used frameworks are [jQuery](http://jquery.com/), [prototype](http://www.prototypejs.org/), and [YUI](http://developer.yahoo.com/yui/).

## Introduction to Object-Oriented JavaScript

> Object-oriented to the core, JavaScript features powerful, flexible [OOP](https://developer.mozilla.org/en-US/docs/Glossary/OOP) capabilities. This article does not describe the newer syntax for [object-oriented programming in ECMAScript 6](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Classes).

### Object-oriented programming

JavaScript is a prototype-based programming language (probably prototype-based scripting language is more correct definition). It employs cloning and not inheritance. A prototype-based programming language is a style of object-oriented programming that uses functions as constructors for classes. Although Javascript has a keyword class, it has no class statement. This distinction is important when comparing JavaScript to other OOP languages.

### Prototype-based programming

Prototype-based programming is an OOP model that doesn't use classes, but rather it first accomplishes the behavior of any class and then reuses it (equivalent to inheritance in class-based languages) by decorating (or expanding upon) existing *prototype* objects. (Also called classless, prototype-oriented, or instance-based programming.)

#### JavaScript object oriented programming

#### Namespace

A namespace is a container which allows developers to bundle up functionality under a unique, application-specific name. **In JavaScript a namespace is just another object containing methods, properties, and objects.**

**Note:** It's important to note that in JavaScript, there's no language-level difference between regular objects and namespaces. This differs from many other object-oriented languages, and can be a point of confusion for new JavaScript programmers.

The idea behind creating a namespace in JavaScript is simple: create one global object, and all variables, methods, and functions become properties of that object. Use of namespaces also reduces the chance of name conflicts in an application, since each application's objects are properties of an application-defined global object.

Let's create a global object called MYAPP:

```javascript
// global namespace
var MYAPP = MYAPP || {};
```

In the above code sample, we first checked whether `MYAPP` is already defined (either in same file or in another file). If yes, then use the existing MYAPP global object, otherwise create an empty object called `MYAPP` which will encapsulate methods, functions, variables, and objects.

We can also create sub-namespaces (keep in mind that the global object needs to be defined first):

```javascript
// sub namespace
MYAPP.event = {};
```

The following is code syntax for creating a namespace and adding variables, functions, and a method:

```javascript
// Create container called MYAPP.commonMethod for common method and properties
MYAPP.commonMethod = {
    regExForName: "", // define regex for name validation
    regExForPhone: "", // define regex for phone no validation
    validateName: function(name) {
        // Do something with name, you can access regExForName variable
        // using "this.regExForName"
    },
    validatePhoneNo: function(phoneNo) {
        // do something with phone number
    }
};
// Object together with the method declarations
MYAPP.event = {
    addListener: function(el, type, fn) {
        // code stuff
    },
    removeListener: function(el, type, fn) {
        // code stuff
    },
    getEvent: function(e) {
        // code stuff
    }
    // Can add another method and properties
};
// Syntax for Using addListener method:
MYAPP.event.addListener("yourel", "type", callback);
```

#### Standard built-in objects

JavaScript has several objects included in its core, for example, there are objects like [`Math`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math), [`Object`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object), [`Array`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array), and [`String`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String). The example below shows how to use the `Math` object to get a random number by using its `random()` method.

```javascript
console.log(Math.random());
```

**Note:** This and all further examples presume a function named [`console.log()`](https://developer.mozilla.org/en-US/docs/Web/API/Console/log) is defined globally. The `console.log()` function is not actually a part of JavaScript itself, but many browsers implement it to aid in debugging.

See [JavaScript Reference: Standard built-in objects](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects) for a list of the core objects in JavaScript.

Every object in JavaScript is an instance of the object [`Object`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object) and therefore inherits all its properties and methods.

#### Custom objects

##### The class

JavaScript is a prototype-based language and contains no `class` statement, such as is found in C++ or Java. This is sometimes confusing for programmers accustomed to languages with a `class` statement. Instead, JavaScript uses functions as constructors for classes. Defining a class is as easy as defining a function. In the example below we define a new class called Person with an empty constructor.

```javascript
var Person = function() {};
```

##### The object (class instance)

To create a new instance of an object `obj` we use the statement `new obj`, assigning the result (which is of type `obj`) to a variable to access it later.

In the example above we define a class named `Person`. In the example below we create two instances (`person1` and `person2`).

```javascript
var person1 = new Person();
var person2 = new Person();
```

**Note:** Please see [`Object.create()`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/create) for a new, additional, instantiation method that creates an uninitialized instance.

##### The constructor

The constructor is called at the moment of instantiation (the moment when the object instance is created). The constructor is a method of the class. In JavaScript the function serves as the constructor of the object, therefore there is no need to explicitly define a constructor method. Every action declared in the class gets executed at the time of instantiation.

The constructor is used to set the object's properties or to call methods to prepare the object for use. Adding class methods and their definitions occurs using a different syntax described later in this article.

In the example below, the constructor of the class `Person` logs a message when a `Person` is instantiated.

```javascript
var Person = function() {
    console.log("instance create.");
};
var person1 = new Person();
var person2 = new Person();
```

##### The property (object attribute)

Properties are variables contained in the class; every instance of the object has those properties. Properties are set in the constructor (function) of the class so that they are created on each instance.

The keyword `this`, which refers to the current object, lets you work with properties from within the class. Accessing (reading or writing) a property outside of the class is done with the syntax: `InstanceName.Property`, just like in C++, Java, and several other languages. (Inside the class the syntax `this.Property` is used to get or set the property's value.)

In the example below, we define the `firstName` property for the `Person` class at instantiation:

```javascript
var Person = function(firstName) {
    this.firstName = firstName;
    console.log("Person instantiated.");
};
var person1 = new Person("Alice");
var person2 = new Person("Bob");
// Show the firstName properties of the objects
console.log("person1 is " + person1.firstName);
console.log("person2 is " + person2.firstName);
```

##### The methods

Methods are functions (and defined like functions), but otherwise follow the same logic as properties. Calling a method is similar to accessing a property, but you add `()` at the end of the method name, possibly with parameters. To define a method, assign a function to a named property of the class's `prototype` property. Later, you can call the method on the object by the same name as you assigned the function to.

In the example below, we define and use the method `sayHello()` for the `Person` class.

```javascript
var Person = function(firstName) {
    this.firstName = firstName;
};
Person.prototype.sayHello = function() {
    console.log("Hello, I'm " + this.firstName);
};
var person1 = new Person("Alice");
var person2 = new Person("Bob");
person1.sayHello();
person2.sayHello();
```

In JavaScript, methods are regular function objects bound to an object as a property, which means you can invoke methods "out of the context". Consider the following example code:

```javascript
var Person = function(firstName) {
    this.firstName = firstName;
};
Person.prototype.sayHello = function() {
    console.log("Hello, I'm " + this.firstName);
};
var person1 = new Person("Alice");
var person2 = new Person("Bob");
var helloFunction = person1.sayHello;
person1.sayHello();
person2.sayHello();
helloFunction(); // Hello, I'm undefined
console.log(helloFunction === person1.sayHello); // true
console.log(helloFunction === Person.prototype.sayHello); // true
helloFunction.call(person1); // Hello, I'm Alice
```

As that example shows, all of the references we have to the `sayHello` function— the one on `person1`, on `Person.prototype`, in the `helloFunction` variable, etc.— refer to the *same function*. The value of `this` during a call to the function depends on how we call it. Most commonly, when we call `this` in an expression where we got the function from an object property— `person1.sayHello()`— `this` is set to the object we got the function from (`person1`), which is why `person1.sayHello()` uses the name "Alice" and `person2.sayHello()`uses the name "Bob". But if we call it other ways, `this` is set differently: calling `this` from a variable— `helloFunction()`— sets `this` to the global object (`window`, on browsers). Since that object (probably) doesn't have a `firstName` property, we end up with "Hello, I'm undefined". (That's in loose mode code; it would be different [an error] in [strict mode](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Strict_mode), but to avoid confusion we won't go into detail here.) Or we can set `this` explicitly using [call](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/call) (or [apply](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/apply)), as shown at the end of the example.

**Note:** See more about `this` on [call](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/call) and [apply](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/apply)

##### Inheritance

Inheritance is a way to create a class as a specialized version of one or more classes (*JavaScript only supports single inheritance*). The specialized class is commonly called the *child*, and the other class is commonly called the *parent*. In JavaScript you do this by assigning an instance of the parent class to the child class, and then specializing it. In modern browsers you can also use [Object.create](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/create#Classical_inheritance_with_Object.create) to implement inheritance.

**Note:** JavaScript does not detect the child class `prototype.constructor` (see [Object.prototype](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/prototype)), so we must state that manually. See the question "[Why is it necessary to set the prototype constructor?](https://stackoverflow.com/questions/8453887/why-is-it-necessary-to-set-the-prototype-constructor)" on Stackoverflow.

In the example below, we define the class `Student` as a child class of `Person`. Then we redefine the `sayHello()` method and add the `sayGoodBye()` method.

```javascript
var Person = function(firstName) {
    this.firstName = firstName;
};
Person.prototype.walk = function() {
    console.log("I am walking!");
};
Person.prototype.sayHello = function() {
    console.log("Hello, I'm " + this.firstName);
};
function Student(firstName, subject) {
    // Call the parent constructor, making sure (using call) 
    // that "this" is set conrrectly during the call
    Person.call(this, firstName);
    // Initialize our Student-specific properties
    this.subject = subject;
}
// Create a Student.prototype object that inherits from Person.prototype.
// Note: A common error here is to use "new Person()" to create the Student.prototype.
// That's incorrect for several reasons, not least that we don't have anything 
// to give Person for the "firstName" parameter.
// The correct place to call Person is above, where we call it from Student.
Student.prototype = Object.create(Person.prototype);
// Set the "constructor" property to refer to Student
Student.prototype.constructor = Student;
// Replace the "sayHello" method
Student.prototype.sayHello = function() {
    console.log("Hello, I'm " + this.firstName + ". I'm studying " + this.subject + ".");
};
// Add a "sayGoodBye" method
Student.prototype.sayGoodBye = function() {
    console.log("Goodbye!");
};
var student1 = new Student("Janet", "Applied Physics");
student1.sayHello();
student1.walk();
student1.sayGoodBye();
console.log(student1 instanceof Person); // true
console.log(student1 instanceof Student); // true
```

##### Encapsulation

In the previous example, `Student` does not need to know how the `Person` class's `walk()` method is implemented, but still can use that method; the `Student` class doesn't need to explicitly define that method unless we want to change it. This is called **encapsulation**, by which every class packages data and methods into a single unit.

##### Abstraction

Abstraction is a mechanism that allows you to model the current part of the working problem, either by inheritance (specialization) or composition. JavaScript achieves specialization by inheritance, and composition by letting class instances be the values of other objects' attributes.

The JavaScript Function class inherits from the Object class (this demonstrates specialization of the model) and the [`Function.prototype`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Function/prototype) property is an instance of [`Object`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object) (this demonstrates composition).

```javascript
var foo = function() {};
console.log("foo is a Function: " + (foo instanceof Function)); // true
console.log("foo.prototype is an Object: " + (foo.prototype instanceof Object)); // true
```

##### Polymorphism

Just as all methods and properties are defined inside the prototype property, different classes can define methods with the same name; methods are scoped to the class in which they're defined, unless the two classes hold a parent-child relation (i.e. one inherits from the other in a chain of inheritance).

