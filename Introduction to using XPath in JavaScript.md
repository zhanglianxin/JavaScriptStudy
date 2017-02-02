# [Introduction to using XPath in JavaScript](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript)

本文档描述了在 JavaScript 内部以扩展形式和网站中使用 [XPath](https://developer.mozilla.org/en-US/docs/XPath) 的接口。Mozilla 实现了大量的 [DOM 3 XPath](http://www.w3.org/TR/DOM-Level-3-XPath/xpath.html)，这意味着 XPath 表达式可以针对 HTML 和 XML 文档运行。

使用 XPath 的主要接口是 [document](https://developer.mozilla.org/en-US/Web/API/document) 对象的 [evaluate](https://developer.mozilla.org/en-US/docs/Web/API/document.evaluate) 函数。

## document.evaluate

此方法针对基于 [XML](https://developer.mozilla.org/en-US/docs/Glossary/XML) 的文档（包括 HTML 文档）评估 XPath 表达式，并返回 [XPathResult](https://developer.mozilla.org/en-US/docs/XPathResult) 对象，该对象可以是单个节点或一组节点。这个方法的现有文档位于 [document.evaluate](https://developer.mozilla.org/en-US/docs/Web/API/Document.evaluate)，但是对于我们现在的需求来说它相当稀疏；下面将给出更全面的研究。

```javascript
var xpathResult = document.evaluate(xpathExpression, contextNode, namespaceResolver, resultType, result);
```

### 参数

[evaluate](https://developer.mozilla.org/en-US/docs/Web/API/Document.evaluate) 函数共有五个参数：

- `xpathExpression`：包含要评估的 XPath 表达式的字符串.
- `contextNode`：应评估 `xpathExpression` 的文档中的节点，包括其任何和所有子节点。document 节点是最常用的。

- `namespaceResolver`：将传递包含在 `xpathExpression` 中的任何命名空间前缀的函数，它返回一个表示与该前缀关联的命名空间 URI 的字符串。这使得能够在 XPath 表达式中使用的前缀和文档中使用的可能不同的前缀之间进行转换。该转换函数可以是：

  * 使用 [`XPathEvaluator`](https://developer.mozilla.org/en-US/docs/Using_XPath#Node-specific_evaluator_function) 对象的 [`createNSResolver`](https://developer.mozilla.org/en-US/docs/Web/API/Document.createNSResolver) 方法[创建](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Implementing_a_Default_Namespace_Resolver)。
  * `null`。其可以用于 HTML 文档或者当不使用命名空间前缀时。注意，如果 `xpathExpression` 包含命名空间前缀，这将导致一个带有 `NAMESPACE_ERR` 的 `DOMException` 抛出。
  * 用户定义的函数。有关详细信息，请参阅附录中的 [使用一个用户定义的命名空间解析器](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Implementing_a_User_Defined_Namespace_Resolver) 部分。
- `resultType`：指定作为评估结果返回的所需结果类型的[常数](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#XPathResult_Defined_Constants)。最常传递的常量是 `XPathResult.ANY_TYPE`，它将返回 XPath 表达式的结果作为最自然的类型。附录中有一个部分，其中包含[可用常数](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#XPathResult_Defined_Constants)的完整列表。它们在下面“[指定返回类型](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Specifying_the_Return_Type)”部分中进行解释。
- `result`：如果指定了现有的 `XPathResult` 对象，它将被重用以返回结果。指定 `null` 将创建一个新的 `XPathResult` 对象。

### 返回值

返回 `xpathResult`，它是 `resultType` 参数中[指定的](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Specifying_the_Return_Type)类型的 `XPathResult` 对象。`XPathResult` 在[这里](http://mxr.mozilla.org/mozilla-central/source/dom/interfaces/xpath/nsIDOMXPathResult.idl)定义.

### 实现默认的命名空间解析器

我们使用 document 对象的 `createNSResolver` 方法创建一个命名空间解析器。

```javascript
var nsResolver = document.createNSResolver(contextNode.ownerDocument == null ? contextNode.documentElement : contextNode.ownerDocument.documentElement);
```

然后传递 `document.evaluate`，将 `nsResolver` 变量作为 `namespaceResolver` 参数。

注意：XPath 定义不带前缀的 QNames，以仅匹配 null 命名空间中的元素。XPath 没有办法选择应用于常规元素引用的默认命名空间（例如，`p[@id='_myid']` 对应于 `xmlns='http://www.w3.org/1999/xhtml'`）。要匹配非命名空间中的默认元素，您必须使用如 `[namespace-uri()='http://www.w3.org/1999/xhtml' and name()='p' and @id='_id']`（[这种方法](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Using_XPath_functions_to_reference_elements_with_a_default_namespace)适用于命名空间未知的动态 XPath），或者使用前缀名测试，并创建一个命名空间解析器将前缀映射到命名空间。如果你想采取后一种方法，阅读更多关于[如何创建一个用户定义的命名空间解析器](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Implementing_a_User_Defined_Namespace_Resolver)。

### 注意

适应任何 DOM 节点以解析命名空间，以便可以相对于文档中出现的节点的上下文轻松地评估 XPath 表达式。此适配器的工作方式类似于 DOM 级别 3 方法 `lookupNamespaceURI` 在解析 `namespaceuRI` 时节点的层次结构中的可用的当前信息的节点。也正确解析了隐式 `xml` 前缀。

### 指定返回类型

`document.evaluate` 返回的变量 `xpathResult` 可以由单个节点（[简单类型](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Simple_Types)）或节点集合（[节点集类型](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Node-Set_Types)）组成。

#### 简单类型

当 `resultType` 中的所需结果类型指定为：

- `NUMBER_TYPE` - a double
- `STRING_TYPE` - a string
- `BOOLEAN_TYPE` - a boolean

我们通过分别访问 `XPathResult` 对象的以下属性来获取表达式的返回值。

- `numberValue`
- `stringValue`
- `booleanValue`

##### 例

以下使用 XPath 表达式 `count(//p)` 来获取 HTML 文档中的 `<p>` 元素数：

```javascript
var paragraphCount = document.evaluate('count(//p)', document, null, XPathResult.ANY_TYPE, null);
alert('This document contains ' + paragraphCount.numberValue + ' paragraph elements');
```

虽然 JavaScript 允许我们将数字转换为一个字符串进行显示，但 XPath 接口不会自动转换数字结果，如果 `stringValue` 属性被请求，所以下面的代码将**不**工作：

```javascript
var paragraphCount = document.evaluate('count(//p)', document, null, XPathResult.ANY_TYPE, null);
alert('This document contains ' + paragraphCount.stringValue + ' paragraph elements');
```

相反，它将返回一个带有 `NS_DOM_TYPE_ERROR` 的异常。

#### 节点集类型

`XPathResult` 对象允许以 3 种主要不同类型返回节点集：

- [Iterators](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Iterators)
- [Snapshots](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#Snapshots)
- [First Nodes](https://developer.mozilla.org/en-US/docs/Introduction_to_using_XPath_in_JavaScript#First_Node)

##### Iterators

当 `resultType` 参数中的指定结果类型为：

- `UNORDERED_NODE_ITERATOR_TYPE`
- `ORDERED_NODE_ITERATOR_TYPE`

返回的 `XPathResult` 对象是一个匹配节点的节点集，它将作为迭代器，允许我们使用 `XPathResult` 的 `iterateNext()` 方法访问包含的各个节点。