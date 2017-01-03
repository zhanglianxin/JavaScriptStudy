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
- Built-in objects and functions (`JSON`, `Math`, `Array.prototype` methods, Object introspection methods...)
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