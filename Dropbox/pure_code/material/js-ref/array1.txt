Array

The JavaScript Array object is a global object that is used in the construction of arrays; which are high-level, list-like objects.

Create an Array
`
var fruits = ['Apple', 'Banana'];

console.log(fruits.length);
// 2
`
Access (index into) an Array item
`
var first = fruits[0];
// Apple

var last = fruits[fruits.length - 1];
// Banana
`
Loop over an Array

fr`uits.forEach(function(item, index, array) {
  console.log(item, index);
});
// Apple 0
// Banana 1
`
Add to the end of an Array
`
var newLength = fruits.push('Orange');
// ["Apple", "Banana", "Orange"]
`
Remove from the end of an Array
`
var last = fruits.pop(); // remove Orange (from the end)
// ["Apple", "Banana"];
`
Remove from the front of an Array
`
var first = fruits.shift(); // remove Apple from the front
// ["Banana"];
`
Add to the front of an Array
`
var newLength = fruits.unshift('Strawberry') // add to the front
// ["Strawberry", "Banana"];
`
Find the index of an item in the Array
`
fruits.push('Mango');
// ["Strawberry", "Banana", "Mango"]

var pos = fruits.indexOf('Banana');
// 1
`
Remove an item by index position
`
var removedItem = fruits.splice(pos, 1); // this is how to remove an item
                                        
// ["Strawberry", "Mango"]
`
Remove items from an index position
`
var vegetables = ['Cabbage', 'Turnip', 'Radish', 'Carrot'];
console.log(vegetables); 
// ["Cabbage", "Turnip", "Radish", "Carrot"]

var pos = 1, n = 2;

var removedItems = vegetables.splice(pos, n); 
// this is how to remove items, n defines the number of items to be removed,
// from that position(pos) onward to the end of array.

console.log(vegetables); 
// ["Cabbage", "Carrot"] (the original array is changed)

console.log(removedItems); 
// ["Turnip", "Radish"]
`
Copy an Array
`
var shallowCopy = fruits.slice(); // this is how to make a copy
// ["Strawberry", "Mango"]
`
Syntax

[element0, element1, ..., elementN]
new Array(element0, element1[, ...[, elementN]])
new Array(arrayLength)

Parameters

elementN
    A JavaScript array is initialized with the given elements, except in the case where a single argument is passed to the Array constructor and that argument is a number (see the arrayLength parameter below). Note that this special case only applies to JavaScript arrays created with the Array constructor, not array literals created with the bracket syntax.
arrayLength
    If the only argument passed to the Array constructor is an integer between 0 and 232-1 (inclusive), this returns a new JavaScript array with its length property set to that number (Note: this implies an array of arrayLength empty slots, not slots with actual undefined values). If the argument is any other number, a RangeError exception is thrown.

Description

Arrays are list-like objects whose prototype has methods to perform traversal and mutation operations. Neither the length of a JavaScript array nor the types of its elements are fixed.
 Since an array's length can change at any time, and data can be stored at non-contiguous locations in the array, JavaScript arrays are not guaranteed to be dense;'
  this depends on how the programmer chooses to use them. In general, these are convenient characteristics; but if these features are not desirable for your particular use, you might consider using typed arrays.

Arrays cannot use strings as element indexes (as in an associative array) but must use integers. Setting or accessing via non-integers using bracket notation (or dot notation) will not set or retrieve an element from the array list itself, but will set or access a variable associated with that array's object property collection. The array's object properties and list of array elements are separate, and the array's traversal and mutation operations cannot be applied to these named properties.
Accessing array elements

JavaScript arrays are zero-indexed: the first element of an array is at index 0, and the last element is at the index equal to the value of the array's length property minus 1. Using an invalid index number returns undefined.

`
var arr = ['this is the first element', 'this is the second element', 'this is the last element'];
console.log(arr[0]);              // logs 'this is the first element'
console.log(arr[1]);              // logs 'this is the second element'
console.log(arr[arr.length - 1]); // logs 'this is the last element'
`

Array elements are object properties in the same way that toString is a property, but trying to access an element of an array as follows throws a syntax error because the property name is not valid:
`
console.log(arr.0); // a syntax error
`
There is nothing special about JavaScript arrays and the properties that cause this. JavaScript properties that begin with a digit cannot be referenced with dot notation; and must be accessed using bracket notation. For example, if you had an object with a property named '3d', it can only be referenced using bracket notation. E.g.:
`
var years = [1950, 1960, 1970, 1980, 1990, 2000, 2010];
console.log(years.0);   // a syntax error
console.log(years[0]);  // works properly

renderer.3d.setTexture(model, 'character.png');     // a syntax error
renderer['3d'].setTexture(model, 'character.png');  // works properly
`
Note that in the 3d example, '3d' had to be quoted. It's possible to quote the JavaScript array indexes as well (e.g., years['2'] instead of years[2]), although it's not necessary. The 2 in years[2] is coerced into a string by the JavaScript engine through an implicit toString conversion. It is, for this reason, that '2' and '02' would refer to two different slots on the years object and the following example could be true:
`
console.log(years['2'] != years['02']);
`
Similarly, object properties which happen to be reserved words(!) can only be accessed as string literals in bracket notation (but it can be accessed by dot notation in firefox 40.0a2 at least):
`
var promise = {
  'var'  : 'text',
  'array': [1, 2, 3, 4]
};

console.log(promise['var']);
`
Relationship between length and numerical properties

A JavaScript array's length property and numerical properties are connected. Several of the built-in array methods (e.g., join(), slice(), indexOf(), etc.) take into account the value of an array's length property when they're called. Other methods (e.g., push(), splice(), etc.) also result in updates to an array's length property.
`
var fruits = [];
fruits.push('banana', 'apple', 'peach');

console.log(fruits.length); // 3
`
When setting a property on a JavaScript array when the property is a valid array index and that index is outside the current bounds of the array, the engine will update the array's length property accordingly:
`
fruits[5] = 'mango';
console.log(fruits[5]); // 'mango'
console.log(Object.keys(fruits));  // ['0', '1', '2', '5']
console.log(fruits.length); // 6
`
Increasing the length.
`
fruits.length = 10;
console.log(Object.keys(fruits)); // ['0', '1', '2', '5']
console.log(fruits.length); // 10
`
Decreasing the length property does, however, delete elements.
`
fruits.length = 2;
console.log(Object.keys(fruits)); // ['0', '1']
console.log(fruits.length); // 2
`
This is explained further on the Array.length page.
Creating an array using the result of a match

The result of a match between a regular expression and a string can create a JavaScript array. This array has properties and elements which provide information about the match. Such an array is returned by RegExp.exec, String.match, and String.replace. To help explain these properties and elements, look at the following example and then refer to the table below:
`
// Match one d followed by one or more b's followed by one d
// Remember matched b's and the following d
// Ignore case

var myRe = /d(b+)(d)/i;
var myArray = myRe.exec('cdbBdbsbz');
`
The properties and elements returned from this match are as follows:
Property/Element 	Description 	Example
input 	A read-only property that reflects the original string against which the regular expression was matched. 	cdbBdbsbz
index 	A read-only property that is the zero-based index of the match in the string. 	1
[0] 	A read-only element that specifies the last matched characters. 	dbBd
[1], ...[n] 	Read-only elements that specify the parenthesized substring matches, if included in the regular expression. The number of possible parenthesized substrings is unlimited. 	[1]: bB
[2]: d
Properties

Array.length
    The Array constructor's length property whose value is 1.
get Array[@@species]
    The constructor function that is used to create derived objects.
Array.prototype
    Allows the addition of properties to all array objects.

Methods

Array.from()
    Creates a new Array instance from an array-like or iterable object.
Array.isArray()
    Returns true if a variable is an array, if not false.
Array.of()
    Creates a new Array instance with a variable number of arguments, regardless of number or type of the arguments.

Array instances

All Array instances inherit from Array.prototype. The prototype object of the Array constructor can be modified to affect all Array instances.
Properties

Array.prototype.constructor
    Specifies the function that creates an object's prototype.
Array.prototype.length
    Reflects the number of elements in an array.
Array.prototype[@@unscopables]
    A symbol containing property names to exclude from a with binding scope.

Methods
Mutator methods

These methods modify the array:

Array.prototype.copyWithin()
    Copies a sequence of array elements within the array.
Array.prototype.fill()
    Fills all the elements of an array from a start index to an end index with a static value.
Array.prototype.pop()
    Removes the last element from an array and returns that element.
Array.prototype.push()
    Adds one or more elements to the end of an array and returns the new length of the array.
Array.prototype.reverse()
    Reverses the order of the elements of an array in place — the first becomes the last, and the last becomes the first.
Array.prototype.shift()
    Removes the first element from an array and returns that element.
Array.prototype.sort()
    Sorts the elements of an array in place and returns the array.
Array.prototype.splice()
    Adds and/or removes elements from an array.
Array.prototype.unshift()
    Adds one or more elements to the front of an array and returns the new length of the array.

Accessor methods

These methods do not modify the array and return some representation of the array.

Array.prototype.concat()
    Returns a new array comprised of this array joined with other array(s) and/or value(s).
Array.prototype.includes()
    Determines whether an array contains a certain element, returning true or false as appropriate.
Array.prototype.indexOf()
    Returns the first (least) index of an element within the array equal to the specified value, or -1 if none is found.
Array.prototype.join()
    Joins all elements of an array into a string.
Array.prototype.lastIndexOf()
    Returns the last (greatest) index of an element within the array equal to the specified value, or -1 if none is found.
Array.prototype.slice()
    Extracts a section of an array and returns a new array.
Array.prototype.toSource()
    Returns an array literal representing the specified array; you can use this value to create a new array. Overrides the Object.prototype.toSource() method.
Array.prototype.toString()
    Returns a string representing the array and its elements. Overrides the Object.prototype.toString() method.
Array.prototype.toLocaleString()
    Returns a localized string representing the array and its elements. Overrides the Object.prototype.toLocaleString() method.

Iteration methods

Several methods take as arguments functions to be called back while processing the array. When these methods are called, the length of the array is sampled, and any element added beyond this length from within the callback is not visited. Other changes to the array (setting the value of or deleting an element) may affect the results of the operation if the method visits the changed element afterwards. While the specific behavior of these methods in such cases is well-defined, you should not rely upon it so as not to confuse others who might read your code. If you must mutate the array, copy into a new array instead.

Array.prototype.entries()
    Returns a new Array Iterator object that contains the key/value pairs for each index in the array.
Array.prototype.every()
    Returns true if every element in this array satisfies the provided testing function.
Array.prototype.filter()
    Creates a new array with all of the elements of this array for which the provided filtering function returns true.
Array.prototype.find()
    Returns the found value in the array, if an element in the array satisfies the provided testing function or undefined if not found.
Array.prototype.findIndex()
    Returns the found index in the array, if an element in the array satisfies the provided testing function or -1 if not found.
Array.prototype.forEach()
    Calls a function for each element in the array.
Array.prototype.keys()
    Returns a new Array Iterator that contains the keys for each index in the array.
Array.prototype.map()
    Creates a new array with the results of calling a provided function on every element in this array.
Array.prototype.reduce()
    Apply a function against an accumulator and each value of the array (from left-to-right) as to reduce it to a single value.
Array.prototype.reduceRight()
    Apply a function against an accumulator and each value of the array (from right-to-left) as to reduce it to a single value.
Array.prototype.some()
    Returns true if at least one element in this array satisfies the provided testing function.
Array.prototype.values()
    Returns a new Array Iterator object that contains the values for each index in the array.
Array.prototype[@@iterator]()
    Returns a new Array Iterator object that contains the values for each index in the array.

Array generic methods

Array generics are non-standard, deprecated and will get removed in the near future.

Sometimes you would like to apply array methods to strings or other array-like objects (such as function arguments). By doing this, you treat a string as an array of characters (or otherwise treat a non-array as an array). For example, in order to check that every character in the variable str is a letter, you would write:

`
function isLetter(character) {
  return character >= 'a' && character <= 'z';
}

if (Array.prototype.every.call(str, isLetter)) {
  console.log("The string '" + str + "' contains only letters!");
}
`
This notation is rather wasteful and JavaScript 1.6 introduced a generic shorthand:
`
if (Array.every(str, isLetter)) {
  console.log("The string '" + str + "' contains only letters!");
}
`
Generics are also available on String.

These are not part of ECMAScript standards and they are not supported by non-Gecko browsers. As a standard alternative, you can convert your object to a proper array using Array.from(); although that method may not be supported in old browsers:
`
if (Array.from(str).every(isLetter)) { 
  console.log("The string '" + str + "' contains only letters!"); 
}
`
Examples
Creating an array

The following example creates an array, msgArray, with a length of 0, then assigns values to msgArray[0] and msgArray[99], changing the length of the array to 100.
`
var msgArray = [];
msgArray[0] = 'Hello';
msgArray[99] = 'world';

if (msgArray.length === 100) {
  console.log('The length is 100.');
}
`
Creating a two-dimensional array

The following creates a chess board as a two-dimensional array of strings. The first move is made by copying the 'p' in (6,4) to (4,4). The old position (6,4) is made blank.
`
var board = [ 
  ['R','N','B','Q','K','B','N','R'],
  ['P','P','P','P','P','P','P','P'],
  [' ',' ',' ',' ',' ',' ',' ',' '],
  [' ',' ',' ',' ',' ',' ',' ',' '],
  [' ',' ',' ',' ',' ',' ',' ',' '],
  [' ',' ',' ',' ',' ',' ',' ',' '],
  ['p','p','p','p','p','p','p','p'],
  ['r','n','b','q','k','b','n','r'] ];

console.log(board.join('\n') + '\n\n');

// Move King's Pawn forward 2
board[4][4] = board[6][4];
board[6][4] = ' ';
console.log(board.join('\n'));

Here is the output:

R,N,B,Q,K,B,N,R
P,P,P,P,P,P,P,P
 , , , , , , , 
 , , , , , , , 
 , , , , , , , 
 , , , , , , , 
p,p,p,p,p,p,p,p
r,n,b,q,k,b,n,r

R,N,B,Q,K,B,N,R
P,P,P,P,P,P,P,P
 , , , , , , , 
 , , , , , , , 
 , , , ,p, , , 
 , , , , , , , 
p,p,p,p, ,p,p,p
r,n,b,q,k,b,n,r

Using an array to tabulate a set of values

values = [];
for (var x = 0; x < 10; x++){
 values.push([
  2 ** x,
  2 * x ** 2
 ])
};
console.table(values)
`
Results in

0	1	0
1	2	2
2	4	8
3	8	18
4	16	32
5	32	50
6	64	72
7	128	98
8	256	128
9	512	162

(First column is the (index))

-------------------------------------------------2
array.@@iterator

The initial value of the @@iterator property is the same function object as the initial value of the values() property.
Syntax

arr[Symbol.iterator]()

Return value

The initial value given by the values() iterator. By default, using arr[Symbol.iterator] will return the values() function.
Examples
Iteration using for...of loop

var arr = ['w', 'y', 'k', 'o', 'p'];
var eArr = arr[Symbol.iterator]();
// your browser must support for..of loop
// and let-scoped variables in for loops
// const and var could also be used
for (let letter of eArr) {
  console.log(letter);
}

Alternative iteration

var arr = ['w', 'y', 'k', 'o', 'p'];
var eArr = arr[Symbol.iterator]();
console.log(eArr.next().value); // w
console.log(eArr.next().value); // y
console.log(eArr.next().value); // k
console.log(eArr.next().value); // o
console.log(eArr.next().value); // p
----------------------------------------------------3
Array.@@species

The Array[@@species] accessor property returns the Array constructor.
Syntax

Array[Symbol.species]

Return value

The Array constructor.
Description

The species accessor property returns the default constructor for Array objects. Subclass constructors may override it to change the constructor assignment.
Examples

The species property returns the default constructor function, which is the Array constructor for Array objects:

Array[Symbol.species]; // function Array()

In a derived collection object (e.g. your custom array MyArray), the MyArray species is the MyArray constructor. However, you might want to overwrite this, in order to return parent Array objects in your derived class methods:

class MyArray extends Array {
  // Overwrite MyArray species to the parent Array constructor
  static get [Symbol.species]() { return Array; }
}
-----------------------------------------------------------------------4
array.@@unscopables

The @@unscopable symbol property contains property names that were not included in the ECMAScript standard prior to the ES2015 version. These properties are excluded from with statement bindings.
Syntax

arr[Symbol.unscopables]

Description

The default array properties that are excluded from with bindings are: copyWithin, entries, fill, find, findIndex, includes, keys, and values.

See Symbol.unscopables for how to set unscopables for your own objects.
Property attributes of Array.prototype[@@unscopables]
Writable 	no
Enumerable 	no
Configurable 	yes
Examples

The following code works fine in ES5 and below. However, in ECMAScript 2015 and later, the Array.prototype.keys() method was introduced. That means that inside with environments, "keys" would now be the method and not the variable. This is where now the built-in @@unscopables Array.prototype[@@unscopables] symbol property comes into play and prevents that some of the Array methods are being scoped into the with statement.

var keys = [];

with (Array.prototype) {
  keys.push('something');
}

Object.keys(Array.prototype[Symbol.unscopables]); 
// ["copyWithin", "entries", "fill", "find", "findIndex", 
//  "includes", "keys", "values"]
---------------------------------------------------------------------------------------------------5
array.concat

The concat() method is used to merge two or more arrays. This method does not change the existing arrays, but instead returns a new array.

var array1 = ['a', 'b', 'c'];
var array2 = ['d', 'e', 'f'];

console.log(array1.concat(array2));
// expected output: Array ["a", "b", "c", "d", "e", "f"]


Syntax

var new_array = old_array.concat([value1[, value2[, ...[, valueN]]]])

Parameters

valueN Optional
    Arrays and/or values to concatenate into a new array. If valueN is undefined, concat returns a shallow copy of the existing array on which it is called. See the description below for more details.

Return value

A new Array instance.
Description

The concat method creates a new array consisting of the elements in the object on which it is called, followed in order by, for each argument, the elements of that argument (if the argument is an array) or the argument itself (if the argument is not an array). It does not recurse into nested array arguments.

The concat method does not alter this or any of the arrays provided as arguments but instead returns a shallow copy that contains copies of the same elements combined from the original arrays. Elements of the original arrays are copied into the new array as follows:

    Object references (and not the actual object): concat copies object references into the new array. Both the original and new array refer to the same object. That is, if a referenced object is modified, the changes are visible to both the new and original arrays. This includes elements of array arguments that are also arrays.
    Data types such as strings, numbers and booleans (not String, Number, and Boolean objects): concat copies the values of strings and numbers into the new array.

Note: Concatenating array(s)/value(s) will leave the originals untouched. Furthermore, any operation on the new array (except operations on elements which are object references) will have no effect on the original arrays, and vice versa.
Examples
Concatenating two arrays

The following code concatenates two arrays:

var alpha = ['a', 'b', 'c'];
var numeric = [1, 2, 3];

alpha.concat(numeric);
// result in ['a', 'b', 'c', 1, 2, 3]

Concatenating three arrays

The following code concatenates three arrays:

var num1 = [1, 2, 3],
    num2 = [4, 5, 6],
    num3 = [7, 8, 9];

var nums = num1.concat(num2, num3);

console.log(nums); 
// results in [1, 2, 3, 4, 5, 6, 7, 8, 9]

Concatenating values to an array

The following code concatenates three values to an array:

var alpha = ['a', 'b', 'c'];

var alphaNumeric = alpha.concat(1, [2, 3]);

console.log(alphaNumeric); 
// results in ['a', 'b', 'c', 1, 2, 3]

Concatenating nested arrays

The following code concatenates nested arrays and demonstrates retention of references:

var num1 = [[1]];
var num2 = [2, [3]];

var nums = num1.concat(num2);

console.log(nums);
// results in [[1], 2, [3]]

// modify the first element of num1
num1[0].push(4);

console.log(nums);
// results in [[1, 4], 2, [3]]
----------------------------------------------------------------------------------------------------------------------------------------
array.copyWithin

The copyWithin() method shallow copies part of an array to another location in the same array and returns it, without modifying its size.

var array1 = [1, 2, 3, 4, 5];

// place at position 0 the element between position 3 and 4
console.log(array1.copyWithin(0, 3, 4));
// expected output: Array [4, 2, 3, 4, 5]

// place at position 1 the elements after position 3
console.log(array1.copyWithin(1, 3));
// expected output: Array [4, 4, 5, 4, 5]

Syntax

arr.copyWithin(target[, start[, end]])

Parameters

target
    Zero based index at which to copy the sequence to. If negative, target will be counted from the end.
    If target is at or greater than arr.length, nothing will be copied. If target is positioned after start, the copied sequence will be trimmed to fit arr.length.
start Optional
    Zero based index at which to start copying elements from. If negative, start will be counted from the end.
    If start is omitted, copyWithin will copy from the start (defaults to 0).
end Optional
    Zero based index at which to end copying elements from. copyWithin copies up to but not including end. If negative, end will be counted from the end.
    If end is omitted, copyWithin will copy until the end (default to arr.length).

Return value

The modified array.
Description

The copyWithin works like C and C++'s memmove, and is a high-performance method to shift the data of an Array. This especially applies to the TypedArray method of the same name. The sequence is copied and pasted as one operation; pasted sequence will have the copied values even when the copy and paste region overlap.

The copyWithin function is intentionally generic, it does not require that its this value be an Array object.

The copyWithin method is a mutable method. It does not alter the length of this, but will change its content and create new properties if necessary.
Examples

[1, 2, 3, 4, 5].copyWithin(-2);
// [1, 2, 3, 1, 2]

[1, 2, 3, 4, 5].copyWithin(0, 3);
// [4, 5, 3, 4, 5]

[1, 2, 3, 4, 5].copyWithin(0, 3, 4);
// [4, 2, 3, 4, 5]

[1, 2, 3, 4, 5].copyWithin(-2, -3, -1);
// [1, 2, 3, 3, 4]

[].copyWithin.call({length: 5, 3: 1}, 0, 3);
// {0: 1, 3: 1, length: 5}

// ES2015 Typed Arrays are subclasses of Array
var i32a = new Int32Array([1, 2, 3, 4, 5]);

i32a.copyWithin(0, 2);
// Int32Array [3, 4, 5, 4, 5]

// On platforms that are not yet ES2015 compliant: 
[].copyWithin.call(new Int32Array([1, 2, 3, 4, 5]), 0, 3, 4);
// Int32Array [4, 2, 3, 4, 5]

Polyfill

if (!Array.prototype.copyWithin) {
  Array.prototype.copyWithin = function(target, start/*, end*/) {
    // Steps 1-2.
    if (this == null) {
      throw new TypeError('this is null or not defined');
    }

    var O = Object(this);

    // Steps 3-5.
    var len = O.length >>> 0;

    // Steps 6-8.
    var relativeTarget = target >> 0;

    var to = relativeTarget < 0 ?
      Math.max(len + relativeTarget, 0) :
      Math.min(relativeTarget, len);

    // Steps 9-11.
    var relativeStart = start >> 0;

    var from = relativeStart < 0 ?
      Math.max(len + relativeStart, 0) :
      Math.min(relativeStart, len);

    // Steps 12-14.
    var end = arguments[2];
    var relativeEnd = end === undefined ? len : end >> 0;

    var final = relativeEnd < 0 ?
      Math.max(len + relativeEnd, 0) :
      Math.min(relativeEnd, len);

    // Step 15.
    var count = Math.min(final - from, len - to);

    // Steps 16-17.
    var direction = 1;

    if (from < to && to < (from + count)) {
      direction = -1;
      from += count - 1;
      to += count - 1;
    }

    // Step 18.
    while (count > 0) {
      if (from in O) {
        O[to] = O[from];
      } else {
        delete O[to];
      }

      from += direction;
      to += direction;
      count--;
    }

    // Step 19.
    return O;
  };
}
------------------------------------------------------------------------------------------------------------------------------------------------------------
array.entries

The entries() method returns a new Array Iterator object that contains the key/value pairs for each index in the array.

var array1 = ['a', 'b', 'c'];

var iterator1 = array1.entries();

console.log(iterator1.next().value);
// expected output: Array [0, "a"]

console.log(iterator1.next().value);
// expected output: Array [1, "b"]

Syntax

array.entries()

Return value

A new Array iterator object.
Examples
Using a for…of loop

var a = ['a', 'b', 'c'];
var iterator = a.entries();

for (let e of iterator) {
  console.log(e);
}
// [0, 'a']
// [1, 'b']
// [2, 'c'] 
----------------------------------------------------------------------------------------------------------------------------------------------------
array.every

The every() method tests whether all elements in the array pass the test implemented by the provided function.

Note: This method returns true for any condition put on an empty array.

function isBelowThreshold(currentValue) {
  return currentValue < 40;
}

var array1 = [1, 30, 39, 29, 10, 13];

console.log(array1.every(isBelowThreshold));
// expected output: true

Syntax

arr.every(callback(element[, index[, array]])[, thisArg])

Parameters

callback
    Function to test for each element, taking three arguments:

    element
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array every was called upon.

thisArgOptional
    Optional. Value to use as this when executing callback.

Return value

true if the callback function returns a truthy value for every array element; otherwise, false.
Description

The every method executes the provided callback function once for each element present in the array until it finds one where callback returns a falsy value. If such an element is found, the every method immediately returns false. Otherwise, if callback returns a truthy value for all elements, every returns true. callback is invoked only for indexes of the array which have assigned values; it is not invoked for indexes which have been deleted or which have never been assigned values.

callback is invoked with three arguments: the value of the element, the index of the element, and the Array object being traversed.

If a thisArg parameter is provided to every, it will be used as callback's this value. Otherwise, the value undefined will be used as its this value. The this value ultimately observable by callback is determined according to the usual rules for determining the this seen by a function.

every does not mutate the array on which it is called.

The range of elements processed by every is set before the first invocation of callback. Elements which are appended to the array after the call to every begins will not be visited by callback. If existing elements of the array are changed, their value as passed to callback will be the value at the time every visits them; elements that are deleted are not visited.

every acts like the "for all" quantifier in mathematics. In particular, for an empty array, it returns true. (It is vacuously true that all elements of the empty set satisfy any given condition.)
Examples
Testing size of all array elements

The following example tests whether all elements in the array are bigger than 10.

function isBigEnough(element, index, array) {
  return element >= 10;
}
[12, 5, 8, 130, 44].every(isBigEnough);   // false
[12, 54, 18, 130, 44].every(isBigEnough); // true

Testing every object of an array for a value

[{a:1, b:2, c:3, d:4}, {a:1, x:2, y:3, z:4}, {a:1, x:2, y:3, z:4}].every(obj => obj.a === 1); //true
[{a:1, b:2, c:3, d:4}, {a:1, x:2, y:3, z:4}, {a:2, x:2, y:3, z:4}].every(obj => obj.a === 1); //false

Using arrow functions

Arrow functions provide a shorter syntax for the same test.

[12, 5, 8, 130, 44].every(x => x >= 10); // false
[12, 54, 18, 130, 44].every(x => x >= 10); // true

Polyfill

every was added to the ECMA-262 standard in the 5th edition; as such it may not be present in other implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of every in implementations which do not natively support it. This algorithm is exactly the one specified in ECMA-262, 5th edition, assuming Object and TypeError have their original values and that callbackfn.call evaluates to the original value of Function.prototype.call

if (!Array.prototype.every) {
  Array.prototype.every = function(callbackfn, thisArg) {
    'use strict';
    var T, k;

    if (this == null) {
      throw new TypeError('this is null or not defined');
    }

    // 1. Let O be the result of calling ToObject passing the this 
    //    value as the argument.
    var O = Object(this);

    // 2. Let lenValue be the result of calling the Get internal method
    //    of O with the argument "length".
    // 3. Let len be ToUint32(lenValue).
    var len = O.length >>> 0;

    // 4. If IsCallable(callbackfn) is false, throw a TypeError exception.
    if (typeof callbackfn !== 'function') {
      throw new TypeError();
    }

    // 5. If thisArg was supplied, let T be thisArg; else let T be undefined.
    if (arguments.length > 1) {
      T = thisArg;
    }

    // 6. Let k be 0.
    k = 0;

    // 7. Repeat, while k < len
    while (k < len) {

      var kValue;

      // a. Let Pk be ToString(k).
      //   This is implicit for LHS operands of the in operator
      // b. Let kPresent be the result of calling the HasProperty internal 
      //    method of O with argument Pk.
      //   This step can be combined with c
      // c. If kPresent is true, then
      if (k in O) {

        // i. Let kValue be the result of calling the Get internal method
        //    of O with argument Pk.
        kValue = O[k];

        // ii. Let testResult be the result of calling the Call internal method
        //     of callbackfn with T as the this value and argument list 
        //     containing kValue, k, and O.
        var testResult = callbackfn.call(T, kValue, k, O);

        // iii. If ToBoolean(testResult) is false, return false.
        if (!testResult) {
          return false;
        }
      }
      k++;
    }
    return true;
  };
}
-----------------------------------------------------------------------------------------------------------------------------
array.fill

The fill() method fills all the elements of an array from a start index to an end index with a static value. The end index is not included.

var array1 = [1, 2, 3, 4];

// fill with 0 from position 2 until position 4
console.log(array1.fill(0, 2, 4));
// expected output: [1, 2, 0, 0]

// fill with 5 from position 1
console.log(array1.fill(5, 1));
// expected output: [1, 5, 5, 5]

console.log(array1.fill(6));
// expected output: [6, 6, 6, 6]


Syntax

arr.fill(value[, start[, end]])

Parameters

value
    Value to fill an array.
start Optional
    Start index, defaults to 0.
end Optional
    End index, defaults to this.length.

Return value

The modified array.
Description

The fill method takes up to three arguments value, start and end. The start and end arguments are optional with default values of 0 and the length of the this object.

If start is negative, it is treated as length+start where length is the length of the array. If end is negative, it is treated as length+end.

fill is intentionally generic, it does not require that its this value be an Array object.

fill is a mutable method, it will change this object itself, and return it, not just return a copy of it.

When fill gets passed an object, it will copy the reference and fill the array with references to that object.
Examples

[1, 2, 3].fill(4);               // [4, 4, 4]
[1, 2, 3].fill(4, 1);            // [1, 4, 4]
[1, 2, 3].fill(4, 1, 2);         // [1, 4, 3]
[1, 2, 3].fill(4, 1, 1);         // [1, 2, 3]
[1, 2, 3].fill(4, 3, 3);         // [1, 2, 3]
[1, 2, 3].fill(4, -3, -2);       // [4, 2, 3]
[1, 2, 3].fill(4, NaN, NaN);     // [1, 2, 3]
[1, 2, 3].fill(4, 3, 5);         // [1, 2, 3]
Array(3).fill(4);                // [4, 4, 4]
[].fill.call({ length: 3 }, 4);  // {0: 4, 1: 4, 2: 4, length: 3}

// Objects by reference.
var arr = Array(3).fill({}) // [{}, {}, {}];
arr[0].hi = "hi"; // [{ hi: "hi" }, { hi: "hi" }, { hi: "hi" }]

Polyfill

if (!Array.prototype.fill) {
  Object.defineProperty(Array.prototype, 'fill', {
    value: function(value) {

      // Steps 1-2.
      if (this == null) {
        throw new TypeError('this is null or not defined');
      }

      var O = Object(this);

      // Steps 3-5.
      var len = O.length >>> 0;

      // Steps 6-7.
      var start = arguments[1];
      var relativeStart = start >> 0;

      // Step 8.
      var k = relativeStart < 0 ?
        Math.max(len + relativeStart, 0) :
        Math.min(relativeStart, len);

      // Steps 9-10.
      var end = arguments[2];
      var relativeEnd = end === undefined ?
        len : end >> 0;

      // Step 11.
      var final = relativeEnd < 0 ?
        Math.max(len + relativeEnd, 0) :
        Math.min(relativeEnd, len);

      // Step 12.
      while (k < final) {
        O[k] = value;
        k++;
      }

      // Step 13.
      return O;
    }
  });
}

If you need to support truly obsolete JavaScript engines that don't support Object.defineProperty, it's best not to polyfill Array.prototype methods at all, as you can't make them non-enumerable.
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
array.filter

The filter() method creates a new array with all elements that pass the test implemented by the provided function.

var words = ['spray', 'limit', 'elite', 'exuberant', 'destruction', 'present'];

const result = words.filter(word => word.length > 6);

console.log(result);
// expected output: Array ["exuberant", "destruction", "present"]

Syntax

var newArray = arr.filter(callback(element[, index[, array]])[, thisArg])

Parameters

callback
    Function is a predicate, to test each element of the array. Return true to keep the element, false otherwise. It accepts three arguments:

    element
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array filter was called upon.

thisArgOptional
    Optional. Value to use as this when executing callback.

Return value

A new array with the elements that pass the test. If no elements pass the test, an empty array will be returned.
Description

filter() calls a provided callback function once for each element in an array, and constructs a new array of all the values for which callback returns a value that coerces to true. callback is invoked only for indexes of the array which have assigned values; it is not invoked for indexes which have been deleted or which have never been assigned values. Array elements which do not pass the callback test are simply skipped, and are not included in the new array.

callback is invoked with three arguments:

    the value of the element
    the index of the element
    the Array object being traversed

If a thisArg parameter is provided to filter, it will be used as the callback's this value. Otherwise, the value undefined will be used as its this value. The this value ultimately observable by callback is determined according to the usual rules for determining the this seen by a function.

filter() does not mutate the array on which it is called.

The range of elements processed by filter() is set before the first invocation of callback. Elements which are appended to the array after the call to filter() begins will not be visited by callback. If existing elements of the array are changed, or deleted, their value as passed to callback will be the value at the time filter() visits them; elements that are deleted are not visited.
Examples
Filtering out all small values

The following example uses filter() to create a filtered array that has all elements with values less than 10 removed.

function isBigEnough(value) {
  return value >= 10;
}

var filtered = [12, 5, 8, 130, 44].filter(isBigEnough);
// filtered is [12, 130, 44]

Filtering invalid entries from JSON

The following example uses filter() to create a filtered json of all elements with non-zero, numeric id.

var arr = [
  { id: 15 },
  { id: -1 },
  { id: 0 },
  { id: 3 },
  { id: 12.2 },
  { },
  { id: null },
  { id: NaN },
  { id: 'undefined' }
];

var invalidEntries = 0;

function isNumber(obj) {
  return obj !== undefined && typeof(obj) === 'number' && !isNaN(obj);
}

function filterByID(item) {
  if (isNumber(item.id) && item.id !== 0) {
    return true;
  } 
  invalidEntries++;
  return false; 
}

var arrByID = arr.filter(filterByID);

console.log('Filtered Array\n', arrByID); 
// Filtered Array
// [{ id: 15 }, { id: -1 }, { id: 3 }, { id: 12.2 }]

console.log('Number of Invalid Entries = ', invalidEntries); 
// Number of Invalid Entries = 5

Searching in array

Following example uses filter() to filter array content based on search criteria

var fruits = ['apple', 'banana', 'grapes', 'mango', 'orange'];

/**
 * Array filters items based on search criteria (query)
 */
function filterItems(query) {
  return fruits.filter(function(el) {
      return el.toLowerCase().indexOf(query.toLowerCase()) > -1;
  })
}

console.log(filterItems('ap')); // ['apple', 'grapes']
console.log(filterItems('an')); // ['banana', 'mango', 'orange']

ES2015 Implementation

const fruits = ['apple', 'banana', 'grapes', 'mango', 'orange'];

/**
 * Array filters items based on search criteria (query)
 */
const filterItems = (query) => {
  return fruits.filter((el) =>
    el.toLowerCase().indexOf(query.toLowerCase()) > -1
  );
}

console.log(filterItems('ap')); // ['apple', 'grapes']
console.log(filterItems('an')); // ['banana', 'mango', 'orange']

Polyfill

filter() was added to the ECMA-262 standard in the 5th edition; as such it may not be present in all implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of filter() in ECMA-262 implementations which do not natively support it. This algorithm is exactly equivalent to the one specified in ECMA-262, 5th edition, assuming that fn.call evaluates to the original value of Function.prototype.bind(), and that Array.prototype.push() has its original value.

if (!Array.prototype.filter){
  Array.prototype.filter = function(func, thisArg) {
    'use strict';
    if ( ! ((typeof func === 'Function' || typeof func === 'function') && this) )
        throw new TypeError();
   
    var len = this.length >>> 0,
        res = new Array(len), // preallocate array
        t = this, c = 0, i = -1;
    if (thisArg === undefined){
      while (++i !== len){
        // checks to see if the key was set
        if (i in this){
          if (func(t[i], i, t)){
            res[c++] = t[i];
          }
        }
      }
    }
    else{
      while (++i !== len){
        // checks to see if the key was set
        if (i in this){
          if (func.call(thisArg, t[i], i, t)){
            res[c++] = t[i];
          }
        }
      }
    }
   
    res.length = c; // shrink down array to proper size
    return res;
  };
}
-------------------------------------------------------------------------------------------------------------------------------

array.find

The find() method returns the value of the first element in the array that satisfies the provided testing function. Otherwise undefined is returned.

var array1 = [5, 12, 8, 130, 44];

var found = array1.find(function(element) {
  return element > 10;
});

console.log(found);
// expected output: 12

See also the findIndex() method, which returns the index of a found element in the array instead of its value.

If you need to find the position of an element or whether an element exists in an array, use Array.prototype.indexOf() or Array.prototype.includes().
Syntax

arr.find(callback(element[, index[, array]])[, thisArg])

Parameters

callback
    Function to execute on each value in the array, taking three arguments:

    element
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array find was called upon.

thisArg Optional
    Object to use as this when executing callback.

Return value

The value of the first element in the array that satisfies the provided testing function; otherwise, undefined is returned.
Description

The find method executes the callback function once for each index of the array until it finds one where callback returns a true value. If such an element is found, find immediately returns the value of that element. Otherwise, find returns undefined. callback is invoked for every index of the array from 0 to length - 1 and is invoked for all indexes, not just those that have been assigned values. This may mean that it's less efficient for sparse arrays than other methods that only visit indexes that have been assigned a value.

callback is invoked with three arguments: the value of the element, the index of the element, and the Array object being traversed.

If a thisArg parameter is provided to find, it will be used as the this for each invocation of the callback. If it is not provided, then undefined is used.

find does not mutate the array on which it is called.

The range of elements processed by find is set before the first invocation of callback. Elements that are appended to the array after the call to find begins will not be visited by callback. If an existing, unvisited element of the array is changed by callback, its value passed to the visiting callback will be the value at the time that find visits that element's index; elements that are deleted are still visited.
Examples
Find an object in an array by one of its properties

var inventory = [
    {name: 'apples', quantity: 2},
    {name: 'bananas', quantity: 0},
    {name: 'cherries', quantity: 5}
];

function isCherries(fruit) { 
    return fruit.name === 'cherries';
}

console.log(inventory.find(isCherries)); 
// { name: 'cherries', quantity: 5 }

Using ES2015 arrow function

const inventory = [
    {name: 'apples', quantity: 2},
    {name: 'bananas', quantity: 0},
    {name: 'cherries', quantity: 5}
];

const result = inventory.find( fruit => fruit.name === 'cherries' );

console.log(result) // { name: 'cherries', quantity: 5 }

Find a prime number in an array

The following example finds an element in the array that is a prime number (or returns undefined if there is no prime number).

function isPrime(element, index, array) {
  var start = 2;
  while (start <= Math.sqrt(element)) {
    if (element % start++ < 1) {
      return false;
    }
  }
  return element > 1;
}

console.log([4, 6, 8, 12].find(isPrime)); // undefined, not found
console.log([4, 5, 8, 12].find(isPrime)); // 5

The following examples show that non-existent and deleted elements are visited and that the value passed to the callback is their value when visited.

// Declare array with no element at index 2, 3 and 4
var array = [0,1,,,,5,6];

// Shows all indexes, not just those that have been assigned values
array.find(function(value, index) {
  console.log('Visited index ' + index + ' with value ' + value); 
});

// Shows all indexes, including deleted
array.find(function(value, index) {

  // Delete element 5 on first iteration
  if (index == 0) {
    console.log('Deleting array[5] with value ' + array[5]);
    delete array[5];
  }
  // Element 5 is still visited even though deleted
  console.log('Visited index ' + index + ' with value ' + value); 
});
// expected output:
// Deleting array[5] with value 5 
// Visited index 0 with value 0 
// Visited index 1 with value 1 
// Visited index 2 with value undefined 
// Visited index 3 with value undefined 
// Visited index 4 with value undefined 
// Visited index 5 with value undefined 
// Visited index 6 with value 6

Polyfill

This method has been added to the ECMAScript 2015 specification and may not be available in all JavaScript implementations yet. However, you can polyfill Array.prototype.find with the following snippet:

// https://tc39.github.io/ecma262/#sec-array.prototype.find
if (!Array.prototype.find) {
  Object.defineProperty(Array.prototype, 'find', {
    value: function(predicate) {
     // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If IsCallable(predicate) is false, throw a TypeError exception.
      if (typeof predicate !== 'function') {
        throw new TypeError('predicate must be a function');
      }

      // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
      var thisArg = arguments[1];

      // 5. Let k be 0.
      var k = 0;

      // 6. Repeat, while k < len
      while (k < len) {
        // a. Let Pk be ! ToString(k).
        // b. Let kValue be ? Get(O, Pk).
        // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
        // d. If testResult is true, return kValue.
        var kValue = o[k];
        if (predicate.call(thisArg, kValue, k, o)) {
          return kValue;
        }
        // e. Increase k by 1.
        k++;
      }

      // 7. Return undefined.
      return undefined;
    },
    configurable: true,
    writable: true
  });
}

If you need to support truly obsolete JavaScript engines that don't support Object.defineProperty, it's best not to polyfill Array.prototype methods at all,
 as you can't make them non-enumerable.
-------------------------------------------------------------------------------------

array.findIndex

The findIndex() method returns the index of the first element in the array that satisfies the provided testing function. Otherwise, it returns -1, indicating no element passed the test.


var array1 = [5, 12, 8, 130, 44];

function findFirstLargeNumber(element) {
  return element > 13;
}

console.log(array1.findIndex(findFirstLargeNumber));
// expected output: 3

See also the find() method, which returns the value of an array element, instead of that element's index.
Syntax

arr.findIndex(callback(element[, index[, array]])[, thisArg])

Parameters

callback
    A function to execute on each value in the array until the function returns true, indicating the desired element was found. It takes 3 arguments:

    element
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array findIndex was called upon.

thisArgOptional
    Optional. Object to use as this when executing callback.

Return value

An index in the array if an element passes the test; otherwise, -1.
Description

The findIndex method executes the callback function once for every array index 0..length-1 (inclusive) in the array until it finds one where callback returns a truthy value (a value that coerces to true).

If such an element is found, findIndex immediately returns that found element's index. If the callback never returns a truthy value or the array's length is 0, findIndex returns -1. Unlike some other array methods such as Array.some, in sparse arrays the callback is called even for indexes of entries not present in the array.

callback is invoked with 3 arguments:

    The value of the element
    The index of the element
    The Array object being traversed

If a thisArg parameter is passed to findIndex, it will be used as the this inside each invocation of the callback. If it is not provided, then undefined is used.

The range of elements processed by findIndex is set before the first invocation of callback. Elements appended to the array after the call to findIndex begins will not be processed by callback. If an existing, unvisited element of the array is changed by callback, its value passed to the callback will be the value at the time that findIndex visits that element's index; elements that are deleted are still visited.
Examples
Find the index of a prime number in an array

The following example returns the index of an element in the array that is a prime number, or -1 if there is no prime number.

function isPrime(element, index, array) {
  var start = 2;
  while (start <= Math.sqrt(element)) {
    if (element % start < 1) {
      return false;
    } else {
      start++;
    }
  }
  return element > 1;
}

console.log([4, 6, 8, 12].findIndex(isPrime)); // -1, not found
console.log([4, 6, 7, 12].findIndex(isPrime)); // 2 (array[2] is 7)

Find index using arrow function

The following example finds the index of a fruit using an arrow function:

const fruits = ["apple", "banana", "cantaloupe", "blueberries", "grapefruit"];

const index = fruits.findIndex(fruit => fruit === "blueberries");

console.log(index); // 3
console.log(fruits[index]); // blueberries

Polyfill

// https://tc39.github.io/ecma262/#sec-array.prototype.findindex
if (!Array.prototype.findIndex) {
  Object.defineProperty(Array.prototype, 'findIndex', {
    value: function(predicate) {
     // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If IsCallable(predicate) is false, throw a TypeError exception.
      if (typeof predicate !== 'function') {
        throw new TypeError('predicate must be a function');
      }

      // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
      var thisArg = arguments[1];

      // 5. Let k be 0.
      var k = 0;

      // 6. Repeat, while k < len
      while (k < len) {
        // a. Let Pk be ! ToString(k).
        // b. Let kValue be ? Get(O, Pk).
        // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
        // d. If testResult is true, return k.
        var kValue = o[k];
        if (predicate.call(thisArg, kValue, k, o)) {
          return k;
        }
        // e. Increase k by 1.
        k++;
      }

      // 7. Return -1.
      return -1;
    },
    configurable: true,
    writable: true
  });
}

If you need to support truly obsolete JavaScript engines that don't support Object.defineProperty, it's best not to polyfill Array.prototype methods at all, as you can't make them non-enumerable.
--------------------------------------------------------------------------------------------------------------
array.flat

This is an experimental technology
Check the Browser compatibility table carefully before using this in production.

The flat() method creates a new array with all sub-array elements concatenated into it recursively up to the specified depth.
Syntax

var newArray = arr.flat([depth]);

Parameters

depth Optional
    The depth level specifying how deep a nested array structure should be flattened. Defaults to 1.

Return value

A new array with the sub-array elements concatenated into it.
Examples
Flattening nested arrays

var arr1 = [1, 2, [3, 4]];
arr1.flat(); 
// [1, 2, 3, 4]

var arr2 = [1, 2, [3, 4, [5, 6]]];
arr2.flat();
// [1, 2, 3, 4, [5, 6]]

var arr3 = [1, 2, [3, 4, [5, 6]]];
arr3.flat(2);
// [1, 2, 3, 4, 5, 6]

Flattening and array holes

The flat method removes empty slots in arrays:

var arr4 = [1, 2, , 4, 5];
arr4.flat();
// [1, 2, 4, 5]

Alternative
reduce and concat

var arr1 = [1, 2, [3, 4]];
arr1.flat();

//to flat single level array
arr1.reduce((acc, val) => acc.concat(val), []);// [1, 2, 3, 4]

//or
const flatSingle = arr => [].concat(...arr);

//to enable deep level flatten use recursion with reduce and concat
var arr1 = [1,2,3,[1,2,3,4, [2,3,4]]];

function flattenDeep(arr1) {
   return arr1.reduce((acc, val) => Array.isArray(val) ? acc.concat(flattenDeep(val)) : acc.concat(val), []);
}
flattenDeep(arr1);// [1, 2, 3, 1, 2, 3, 4, 2, 3, 4]

//non recursive flatten deep using a stack
var arr1 = [1,2,3,[1,2,3,4, [2,3,4]]];
function flatten(input) {
  const stack = [...input];
  const res = [];
  while (stack.length) {
    // pop value from stack
    const next = stack.pop();
    if (Array.isArray(next)) {
      // push back array items, won't modify the original input
      stack.push(...next);
    } else {
      res.push(next);
    }
  }
  //reverse to restore input order
  return res.reverse();
}
flatten(arr1);// [1, 2, 3, 1, 2, 3, 4, 2, 3, 4]
-------------------------------------------------------------------------------------
array.flatMap

This is an experimental technology
Check the Browser compatibility table carefully before using this in production.

The flatMap() method first maps each element using a mapping function, then flattens the result into a new array. It is identical to a map followed by a flat of depth 1, but flatMap is often quite useful, as merging both into one method is slightly more efficient.
Syntax

var new_array = arr.flatMap(function callback(currentValue[, index[, array]]) {
    // return element for new_array
}[, thisArg])

Parameters

callback
    Function that produces an element of the new Array, taking three arguments:

    currentValue
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array map was called upon.

thisArgOptional
    Value to use as this when executing callback.

Return value

A new array with each element being the result of the callback function and flattened to a depth of 1.
Description

See Array.prototype.map() for a detailed description of the callback function. The flatMap method is identical to a map followed by a call to flat of depth 1.
Examples
map and flatMap

let arr1 = [1,2, 3, 4];

arr1.map(x => [x * 2]); 
// [[2], [4], [6], [8]]

arr1.flatMap(x => [x * 2]);
// [2, 4, 6, 8]

// only one level is flattened
arr1.flatMap(x => [[x * 2]]);
// [[2], [4], [6], [8]]

While the above could have been achieved by using map itself, here is an example showing usecase of flatMap better.

Let's generate a list of words from a list of sentences.

let arr1 = ["it's Sunny in", "", "California"];

arr1.map(x => x.split(" "));
// [["it's","Sunny","in"],[""],["California"]]

arr1.flatMap(x => x.split(" "));
// ["it's","Sunny","in", "", "California"]

Notice, the output list length can be different from the input list length.
//=> [1, 2, 3, 4, 5, 6, 7, 8, 9]
Alternative
reduce and concat

var arr1 = [1,2, 3, 4];

arr1.flatMap(x => [x * 2]);
// is equivalent to
arr1.reduce((acc, x) => acc.concat([x * 2]), []);
// [2, 4, 6, 8]

//=> [1, 2, 3, 4, 5, 6, 7, 8, 9]
--------------------------------------------------------------------
array.forEach

The forEach() method executes a provided function once for each array element.


var array1 = ['a', 'b', 'c'];

array1.forEach(function(element) {
  console.log(element);
});

// expected output: "a"
// expected output: "b"
// expected output: "c"


Syntax

arr.forEach(function callback(currentValue[, index[, array]]) {
    //your iterator
}[, thisArg]);

Parameters

callback
    Function to execute for each element, taking three arguments:

    currentValue
        The value of the current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array that forEach() is being applied to.

thisArg Optional

    Value to use as this (i.e the reference Object) when executing callback.

Return value

undefined.
Description

forEach() executes the provided callback once for each element present in the array in ascending order. It is not invoked for index properties that have been deleted or are uninitialized (i.e. on sparse arrays).

callback is invoked with three arguments:

    the element value
    the element index
    the array being traversed

If a thisArg parameter is provided to forEach(), it will be used as callback's this value. Otherwise, the value undefined will be used as its this value. The this value ultimately observable by callback is determined according to the usual rules for determining the this seen by a function.

The range of elements processed by forEach() is set before the first invocation of callback. Elements that are appended to the array after the call to forEach() begins will not be visited by callback. If the values of existing elements of the array are changed, the value passed to callback will be the value at the time forEach() visits them; elements that are deleted before being visited are not visited. If elements that are already visited are removed (e.g. using shift()) during the iteration, later elements will be skipped - see example below.

forEach() executes the callback function once for each array element; unlike map() or reduce() it always returns the value undefined and is not chainable. The typical use case is to execute side effects at the end of a chain.

forEach() does not mutate the array on which it is called (although callback, if invoked, may do so).

There is no way to stop or break a forEach() loop other than by throwing an exception. If you need such behavior, the forEach() method is the wrong tool.

Early termination may be accomplished with:

    A simple loop
    A for...of loop
    Array.prototype.every()
    Array.prototype.some()
    Array.prototype.find()
    Array.prototype.findIndex()

The other Array methods: every(), some(), find(), and findIndex() test the array elements with a predicate returning a truthy value to determine if further iteration is required.
Examples
Converting a for loop to forEach

before

const items = ['item1', 'item2', 'item3'];
const copy = [];

for (let i=0; i<items.length; i++) {
  copy.push(items[i])
}

after

const items = ['item1', 'item2', 'item3'];
const copy = [];

items.forEach(function(item){
  copy.push(item)
});

Printing the contents of an array

The following code logs a line for each element in an array:

function logArrayElements(element, index, array) {
  console.log('a[' + index + '] = ' + element);
}

// Notice that index 2 is skipped since there is no item at
// that position in the array.
[2, 5, , 9].forEach(logArrayElements);
// logs:
// a[0] = 2
// a[1] = 5
// a[3] = 9

Using thisArg

The following (contrived) example updates an object's properties from each entry in the array:

function Counter() {
  this.sum = 0;
  this.count = 0;
}
Counter.prototype.add = function(array) {
  array.forEach(function(entry) {
    this.sum += entry;
    ++this.count;
  }, this);
  // ^---- Note
};

const obj = new Counter();
obj.add([2, 5, 9]);
obj.count;
// 3 
obj.sum;
// 16

Since the thisArg parameter (this) is provided to forEach(), it is passed to callback each time it's invoked, for use as its this value.

If passing the function argument using an arrow function expression the thisArg parameter can be omitted as arrow functions lexically bind the this value.
An object copy function

The following code creates a copy of a given object. There are different ways to create a copy of an object; the following is just one way and is presented to explain how Array.prototype.forEach() works by using ECMAScript 5 Object.* meta property functions.

function copy(obj) {
  const copy = Object.create(Object.getPrototypeOf(obj));
  const propNames = Object.getOwnPropertyNames(obj);

  propNames.forEach(function(name) {
    const desc = Object.getOwnPropertyDescriptor(obj, name);
    Object.defineProperty(copy, name, desc);
  });

  return copy;
}

const obj1 = { a: 1, b: 2 };
const obj2 = copy(obj1); // obj2 looks like obj1 now

If the array is modified during iteration, other elements might be skipped.

The following example logs "one", "two", "four". When the entry containing the value "two" is reached, the first entry of the whole array is shifted off, which results in all remaining entries moving up one position. Because element "four" is now at an earlier position in the array, "three" will be skipped. forEach() does not make a copy of the array before iterating.

var words = ['one', 'two', 'three', 'four'];
words.forEach(function(word) {
  console.log(word);
  if (word === 'two') {
    words.shift();
  }
});
// one
// two
// four

Polyfill

forEach() was added to the ECMA-262 standard in the 5th edition; as such it may not be present in other implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of forEach() in implementations that don't natively support it. This algorithm is exactly the one specified in ECMA-262, 5th edition, assuming Object and TypeError have their original values and that callback.call() evaluates to the original value of Function.prototype.call().

// Production steps of ECMA-262, Edition 5, 15.4.4.18
// Reference: http://es5.github.io/#x15.4.4.18
if (!Array.prototype.forEach) {

  Array.prototype.forEach = function(callback/*, thisArg*/) {

    var T, k;

    if (this == null) {
      throw new TypeError('this is null or not defined');
    }

    // 1. Let O be the result of calling toObject() passing the
    // |this| value as the argument.
    var O = Object(this);

    // 2. Let lenValue be the result of calling the Get() internal
    // method of O with the argument "length".
    // 3. Let len be toUint32(lenValue).
    var len = O.length >>> 0;

    // 4. If isCallable(callback) is false, throw a TypeError exception. 
    // See: http://es5.github.com/#x9.11
    if (typeof callback !== 'function') {
      throw new TypeError(callback + ' is not a function');
    }

    // 5. If thisArg was supplied, let T be thisArg; else let
    // T be undefined.
    if (arguments.length > 1) {
      T = arguments[1];
    }

    // 6. Let k be 0.
    k = 0;

    // 7. Repeat while k < len.
    while (k < len) {

      var kValue;

      // a. Let Pk be ToString(k).
      //    This is implicit for LHS operands of the in operator.
      // b. Let kPresent be the result of calling the HasProperty
      //    internal method of O with argument Pk.
      //    This step can be combined with c.
      // c. If kPresent is true, then
      if (k in O) {

        // i. Let kValue be the result of calling the Get internal
        // method of O with argument Pk.
        kValue = O[k];

        // ii. Call the Call internal method of callback with T as
        // the this value and argument list containing kValue, k, and O.
        callback.call(T, kValue, k, O);
      }
      // d. Increase k by 1.
      k++;
    }
    // 8. return undefined.
  };
}

------------------------------------------------------------------------------------------------------

Array.from

The Array.from() method creates a new, shallow-copied Array instance from an array-like or iterable object.

console.log(Array.from('foo'));
// expected output: Array ["f", "o", "o"]

console.log(Array.from([1, 2, 3], x => x + x));
// expected output: Array [2, 4, 6]


Syntax

Array.from(arrayLike[, mapFn[, thisArg]])

Parameters

arrayLike
    An array-like or iterable object to convert to an array.
mapFnOptional
    Map function to call on every element of the array.
thisArgOptional
    Value to use as this when executing mapFn.

Return value

A new Array instance.
Description

Array.from() lets you create Arrays from:

    array-like objects (objects with a length property and indexed elements) or
    iterable objects (objects where you can get its elements, such as Map and Set).

Array.from() has an optional parameter mapFn, which allows you to execute a map function on each element of the array (or subclass object) that is being created. More clearly, Array.from(obj, mapFn, thisArg) has the same result as Array.from(obj).map(mapFn, thisArg), except that it does not create an intermediate array. This is especially important for certain array subclasses, like typed arrays, since the intermediate array would necessarily have values truncated to fit into the appropriate type.

The length property of the from() method is 1.

In ES2015, the class syntax allows for sub-classing of both built-in and user defined classes; as a result, static methods such as Array.from are "inherited" by subclasses of Array and create new instances of the subclass, not Array.
Examples
Array from a String

Array.from('foo'); 
// ["f", "o", "o"]

Array from a Set

var s = new Set(['foo', window]); 
Array.from(s); 
// ["foo", window]

Array from a Map

var m = new Map([[1, 2], [2, 4], [4, 8]]);
Array.from(m);
// [[1, 2], [2, 4], [4, 8]]

var mapper = new Map([['1', 'a'], ['2', 'b']]);
Array.from(mapper.values());
// ['a', 'b'];

Array.from(mapper.keys());
// ['1', '2'];

Array from an Array-like object (arguments)

function f() {
  return Array.from(arguments);
}

f(1, 2, 3);

// [1, 2, 3]

Using arrow functions and Array.from

// Using an arrow function as the map function to
// manipulate the elements
Array.from([1, 2, 3], x => x + x);      
// [2, 4, 6]


// Generate a sequence of numbers
// Since the array is initialized with `undefined` on each position,
// the value of `v` below will be `undefined`
Array.from({length: 5}, (v, i) => i);
// [0, 1, 2, 3, 4]

Sequence generator (range)

// Sequence generator function (commonly referred to as "range", e.g. Clojure, PHP etc)
const range = (start, stop, step) => Array.from({ length: (stop - start) / step }, (_, i) => start + (i * step));

// Generate numbers range 0..4
range(0, 5, 1);
// [0, 1, 2, 3, 4]

// Generate the alphabet using Array.from making use of it being ordered as a sequence
range('A'.charCodeAt(0), 'Z'.charCodeAt(0) + 1, 1).map(x => String.fromCharCode(x));
// ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"]

Polyfill

Array.from was added to the ECMA-262 standard in the 6th edition (ES2015); as such it may not be present in other implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of Array.from in implementations that don't natively support it. This algorithm is exactly the one specified in ECMA-262, 6th edition, assuming Object and TypeError have their original values and that callback.call evaluates to the original value of Function.prototype.call. In addition, since true iterables can not be polyfilled, this implementation does not support generic iterables as defined in the 6th edition of ECMA-262.

// Production steps of ECMA-262, Edition 6, 22.1.2.1
if (!Array.from) {
  Array.from = (function () {
    var toStr = Object.prototype.toString;
    var isCallable = function (fn) {
      return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
    };
    var toInteger = function (value) {
      var number = Number(value);
      if (isNaN(number)) { return 0; }
      if (number === 0 || !isFinite(number)) { return number; }
      return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
    };

    var toLength = function (value) {
      var len = toInteger(value);
      return len >>> 0;
    };

    // The length property of the from method is 1.
    return function from(arrayLike/*, mapFn, thisArg */) {
      // 1. Let C be the this value.
      var C = this;

      // 2. Let items be ToObject(arrayLike).
      var items = Object(arrayLike);

      // 3. ReturnIfAbrupt(items).
      if (arrayLike == null) {
        throw new TypeError('Array.from requires an array-like object - not null or undefined');
      }

      // 4. If mapfn is undefined, then let mapping be false.
      var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
      var T;
      if (typeof mapFn !== 'undefined') {
        // 5. else
        // 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
        if (!isCallable(mapFn)) {
          throw new TypeError('Array.from: when provided, the second argument must be a function');
        }

        // 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
        if (arguments.length > 2) {
          T = arguments[2];
        }
      }

      // 10. Let lenValue be Get(items, "length").
      // 11. Let len be ToLength(lenValue).
      var len = toLength(items.length);

      // 13. If IsConstructor(C) is true, then
      // 13. a. Let A be the result of calling the [[Construct]] internal method 
      // of C with an argument list containing the single item len.
      // 14. a. Else, Let A be ArrayCreate(len).
      var A = isCallable(C) ? Object(new C(len)) : new Array(len);

      // 16. Let k be 0.
      var k = 0;
      // 17. Repeat, while k < len… (also steps a - h)
      var kValue;
      while (k < len) {
        kValue = items[k];
        if (mapFn) {
          A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
        } else {
          A[k] = kValue;
        }
        k += 1;
      }
      // 18. Let putStatus be Put(A, "length", len, true).
      A.length = len;
      // 20. Return A.
      return A;
    };
  }());
}
--------------------------------------------------------------------------------------------------

array.includes

The includes() method determines whether an array includes a certain element, returning true or false as appropriate.

var array1 = [1, 2, 3];

console.log(array1.includes(2));
// expected output: true

var pets = ['cat', 'dog', 'bat'];

console.log(pets.includes('cat'));
// expected output: true

console.log(pets.includes('at'));
// expected output: false

Syntax

arr.includes(searchElement[, fromIndex])

Parameters

searchElement
    The element to search for.
fromIndex Optional
    The position in this array at which to begin searching for searchElement. A negative value searches from the index of array.length - fromIndex by asc. Defaults to 0.

Return value

A Boolean which is true if the value searchElement is found within the array (or the part of the array beginning at the index fromIndex, if specified). Values of zero are all considered to be equal regardless of sign (that is, -0 is considered to be equal to both 0 and +0), but false is not considered to be the same as 0.

Note: Technically speaking, includes() uses the sameValueZero algorithm to determine whether the given element is found.
Examples

[1, 2, 3].includes(2);     // true
[1, 2, 3].includes(4);     // false
[1, 2, 3].includes(3, 3);  // false
[1, 2, 3].includes(3, -1); // true
[1, 2, NaN].includes(NaN); // true

fromIndex is greater than or equal to the array length

If fromIndex is greater than or equal to the length of the array, false is returned. The array will not be searched.

var arr = ['a', 'b', 'c'];

arr.includes('c', 3);   // false
arr.includes('c', 100); // false

Computed index is less than 0

If fromIndex is negative, the computed index is calculated to be used as a position in the array at which to begin searching for searchElement. If the computed index is less or equal than -1 * array.length, the entire array will be searched.

// array length is 3
// fromIndex is -100
// computed index is 3 + (-100) = -97

var arr = ['a', 'b', 'c'];

arr.includes('a', -100); // true
arr.includes('b', -100); // true
arr.includes('c', -100); // true
arr.includes('a', -2); // false

includes() used as a generic method

includes() method is intentionally generic. It does not require this value to be an Array object, so it can be applied to other kinds of objects (e.g. array-like objects). The example below illustrates includes() method called on the function's arguments object.

(function() {
  console.log([].includes.call(arguments, 'a')); // true
  console.log([].includes.call(arguments, 'd')); // false
})('a','b','c');

Polyfill

// https://tc39.github.io/ecma262/#sec-array.prototype.includes
if (!Array.prototype.includes) {
  Object.defineProperty(Array.prototype, 'includes', {
    value: function(searchElement, fromIndex) {

      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      // 1. Let O be ? ToObject(this value).
      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. If len is 0, return false.
      if (len === 0) {
        return false;
      }

      // 4. Let n be ? ToInteger(fromIndex).
      //    (If fromIndex is undefined, this step produces the value 0.)
      var n = fromIndex | 0;

      // 5. If n ≥ 0, then
      //  a. Let k be n.
      // 6. Else n < 0,
      //  a. Let k be len + n.
      //  b. If k < 0, let k be 0.
      var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

      function sameValueZero(x, y) {
        return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
      }

      // 7. Repeat, while k < len
      while (k < len) {
        // a. Let elementK be the result of ? Get(O, ! ToString(k)).
        // b. If SameValueZero(searchElement, elementK) is true, return true.
        if (sameValueZero(o[k], searchElement)) {
          return true;
        }
        // c. Increase k by 1. 
        k++;
      }

      // 8. Return false
      return false;
    }
  });
}

If you need to support truly obsolete JavaScript engines that don't support Object.defineProperty(), it's best not to polyfill Array.prototype methods at all, as you can't make them non-enumerable.


-----------------------------------------------------------
array.indexOf

The indexOf() method returns the first index at which a given element can be found in the array, or -1 if it is not present.

Note: For the String method, see String.prototype.indexOf().

var beasts = ['ant', 'bison', 'camel', 'duck', 'bison'];

console.log(beasts.indexOf('bison'));
// expected output: 1

// start from index 2
console.log(beasts.indexOf('bison', 2));
// expected output: 4

console.log(beasts.indexOf('giraffe'));
// expected output: -1

Syntax

arr.indexOf(searchElement[, fromIndex])

Parameters

searchElement
    Element to locate in the array.
fromIndex Optional
    The index to start the search at. If the index is greater than or equal to the array's length, -1 is returned, which means the array will not be searched. If the provided index value is a negative number, it is taken as the offset from the end of the array. Note: if the provided index is negative, the array is still searched from front to back. If the provided index is 0, then the whole array will be searched. Default: 0 (entire array is searched).

Return value

The first index of the element in the array; -1 if not found.
Description

indexOf() compares searchElement to elements of the Array using strict equality (the same method used by the === or triple-equals operator).
Examples
Using indexOf()

The following example uses indexOf() to locate values in an array.

var array = [2, 9, 9];
array.indexOf(2);     // 0
array.indexOf(7);     // -1
array.indexOf(9, 2);  // 2
array.indexOf(2, -1); // -1
array.indexOf(2, -3); // 0

Finding all the occurrences of an element

var indices = [];
var array = ['a', 'b', 'a', 'c', 'a', 'd'];
var element = 'a';
var idx = array.indexOf(element);
while (idx != -1) {
  indices.push(idx);
  idx = array.indexOf(element, idx + 1);
}
console.log(indices);
// [0, 2, 4]

Finding if an element exists in the array or not and updating the array

function updateVegetablesCollection (veggies, veggie) {
    if (veggies.indexOf(veggie) === -1) {
        veggies.push(veggie);
        console.log('New veggies collection is : ' + veggies);
    } else if (veggies.indexOf(veggie) > -1) {
        console.log(veggie + ' already exists in the veggies collection.');
    }
}

var veggies = ['potato', 'tomato', 'chillies', 'green-pepper'];

updateVegetablesCollection(veggies, 'spinach'); 
// New veggies collection is : potato,tomato,chillies,green-pepper,spinach
updateVegetablesCollection(veggies, 'spinach'); 
// spinach already exists in the veggies collection.

Polyfill

indexOf() was added to the ECMA-262 standard in the 5th edition; as such it may not be present in all browsers. You can work around this by utilizing the following code at the beginning of your scripts. This will allow you to use indexOf() when there is still no native support. This algorithm matches the one specified in ECMA-262, 5th edition, assuming TypeError and Math.abs() have their original values.

if (!Array.prototype.indexOf)  Array.prototype.indexOf = (function(Object, max, min){
  "use strict";
  return function indexOf(member, fromIndex) {
    if(this===null||this===undefined)throw TypeError("Array.prototype.indexOf called on null or undefined");
    
    var that = Object(this), Len = that.length >>> 0, i = min(fromIndex | 0, Len);
    if (i < 0) i = max(0, Len+i); else if (i >= Len) return -1;
    
    if(member===void 0){ for(; i !== Len; ++i) if(that[i]===void 0 && i in that) return i; // undefined
    }else if(member !== member){   for(; i !== Len; ++i) if(that[i] !== that[i]) return i; // NaN
    }else                           for(; i !== Len; ++i) if(that[i] === member) return i; // all else

    return -1; // if the value was not found, then return -1
  };
})(Object, Math.max, Math.min);

However, if you are more interested in all the little technical bits defined by the ECMA standard, and are less concerned about performance or conciseness, then you may find this more descriptive polyfill to be more useful.

// Production steps of ECMA-262, Edition 5, 15.4.4.14
// Reference: http://es5.github.io/#x15.4.4.14
if (!Array.prototype.indexOf) {
  Array.prototype.indexOf = function(searchElement, fromIndex) {

    var k;

    // 1. Let o be the result of calling ToObject passing
    //    the this value as the argument.
    if (this == null) {
      throw new TypeError('"this" is null or not defined');
    }

    var o = Object(this);

    // 2. Let lenValue be the result of calling the Get
    //    internal method of o with the argument "length".
    // 3. Let len be ToUint32(lenValue).
    var len = o.length >>> 0;

    // 4. If len is 0, return -1.
    if (len === 0) {
      return -1;
    }

    // 5. If argument fromIndex was passed let n be
    //    ToInteger(fromIndex); else let n be 0.
    var n = fromIndex | 0;

    // 6. If n >= len, return -1.
    if (n >= len) {
      return -1;
    }

    // 7. If n >= 0, then Let k be n.
    // 8. Else, n<0, Let k be len - abs(n).
    //    If k is less than 0, then let k be 0.
    k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

    // 9. Repeat, while k < len
    while (k < len) {
      // a. Let Pk be ToString(k).
      //   This is implicit for LHS operands of the in operator
      // b. Let kPresent be the result of calling the
      //    HasProperty internal method of o with argument Pk.
      //   This step can be combined with c
      // c. If kPresent is true, then
      //    i.  Let elementK be the result of calling the Get
      //        internal method of o with the argument ToString(k).
      //   ii.  Let same be the result of applying the
      //        Strict Equality Comparison Algorithm to
      //        searchElement and elementK.
      //  iii.  If same is true, return k.
      if (k in o && o[k] === searchElement) {
        return k;
      }
      k++;
    }
    return -1;
  };
}
--------------------------------------------------------------------------------

Array.isArray

The Array.isArray() method determines whether the passed value is an Array.

Array.isArray([1, 2, 3]);  // true
Array.isArray({foo: 123}); // false
Array.isArray('foobar');   // false
Array.isArray(undefined);  // false

Syntax

Array.isArray(value)

Parameters

value
    The value to be checked.

Return value

true if the value is an Array; otherwise, false.
Description

If the value is an Array, true is returned; otherwise, false is.

See the article “Determining with absolute accuracy whether or not a JavaScript object is an array” for more details. Given a TypedArray instance, false is always returned.
Examples

// all following calls return true
Array.isArray([]);
Array.isArray([1]);
Array.isArray(new Array());
Array.isArray(new Array('a', 'b', 'c', 'd'));
Array.isArray(new Array(3));
// Little known fact: Array.prototype itself is an array:
Array.isArray(Array.prototype); 

// all following calls return false
Array.isArray();
Array.isArray({});
Array.isArray(null);
Array.isArray(undefined);
Array.isArray(17);
Array.isArray('Array');
Array.isArray(true);
Array.isArray(false);
Array.isArray({ __proto__: Array.prototype });

instanceof vs isArray

When checking for Array instance, Array.isArray is preferred over instanceof because it works through iframes.

var iframe = document.createElement('iframe');
document.body.appendChild(iframe);
xArray = window.frames[window.frames.length-1].Array;
var arr = new xArray(1,2,3); // [1,2,3]

// Correctly checking for Array
Array.isArray(arr);  // true
// Considered harmful, because doesn't work through iframes
arr instanceof Array; // false

Polyfill

Running the following code before any other code will create Array.isArray() if it's not natively available.

if (!Array.isArray) {
  Array.isArray = function(arg) {
    return Object.prototype.toString.call(arg) === '[object Array]';
  };
}
-----------------------------------------------------------------------------------------

array.join

The join() method creates and returns a new string by concatenating all of the elements in an array (or an array-like object), separated by commas or a specified separator string.

var elements = ['Fire', 'Wind', 'Rain'];

console.log(elements.join());
// expected output: Fire,Wind,Rain

console.log(elements.join(''));
// expected output: FireWindRain

console.log(elements.join('-'));
// expected output: Fire-Wind-Rain


Syntax

arr.join([separator])

Parameters

separator Optional
    Specifies a string to separate each pair of adjacent elements of the array. The separator is converted to a string if necessary. If omitted, the array elements are separated with a comma (","). If separator is an empty string, all elements are joined without any characters in between them.

Return value

A string with all array elements joined. If arr.length is 0, the empty string is returned.
Description

The string conversions of all array elements are joined into one string.

If an element is undefined or null, it is converted to the empty string.
Examples
Joining an array four different ways

The following example creates an array, a, with three elements, then joins the array four times: using the default separator, then a comma and a space, then a plus and an empty string.

var a = ['Wind', 'Rain', 'Fire'];
a.join();      // 'Wind,Rain,Fire'
a.join(', ');  // 'Wind, Rain, Fire'
a.join(' + '); // 'Wind + Rain + Fire'
a.join('');    // 'WindRainFire'

Joining an array-like object

The following example joins array-like object (arguments), by calling Function.prototype.call on Array.prototype.join.

function f(a, b, c) {
  var s = Array.prototype.join.call(arguments);
  console.log(s); // '1,a,true'
}
f(1, 'a', true);
//expected output: "1,a,true"


-------------------------------------------------------------
array.keys

The keys() method returns a new Array Iterator object that contains the keys for each index in the array.

var array1 = ['a', 'b', 'c'];
var iterator = array1.keys(); 
  
for (let key of iterator) {
  console.log(key); // expected output: 0 1 2
}

Syntax

arr.keys()

Return value

A new Array iterator object.
Examples
Key iterator doesn't ignore holes

var arr = ['a', , 'c'];
var sparseKeys = Object.keys(arr);
var denseKeys = [...arr.keys()];
console.log(sparseKeys); // ['0', '2']
console.log(denseKeys);  // [0, 1, 2]

----------------------------------------------------

array.lastIndexOf

The lastIndexOf() method returns the last index at which a given element can be found in the array, or -1 if it is not present. The array is searched backwards, starting at fromIndex.

var animals = ['Dodo', 'Tiger', 'Penguin', 'Dodo'];

console.log(animals.lastIndexOf('Dodo'));
// expected output: 3

console.log(animals.lastIndexOf('Tiger'));
// expected output: 1


Syntax

arr.lastIndexOf(searchElement)
arr.lastIndexOf(searchElement, fromIndex)

Parameters

searchElement
    Element to locate in the array.
fromIndex Optional
    The index at which to start searching backwards. Defaults to the array's length minus one (arr.length - 1), i.e. the whole array will be searched. If the index is greater than or equal to the length of the array, the whole array will be searched. If negative, it is taken as the offset from the end of the array. Note that even when the index is negative, the array is still searched from back to front. If the calculated index is less than 0, -1 is returned, i.e. the array will not be searched.

Return value

The last index of the element in the array; -1 if not found.
Description

lastIndexOf compares searchElement to elements of the Array using strict equality (the same method used by the ===, or triple-equals, operator).
Examples
Using lastIndexOf

The following example uses lastIndexOf to locate values in an array.

var numbers = [2, 5, 9, 2];
numbers.lastIndexOf(2);     // 3
numbers.lastIndexOf(7);     // -1
numbers.lastIndexOf(2, 3);  // 3
numbers.lastIndexOf(2, 2);  // 0
numbers.lastIndexOf(2, -2); // 0
numbers.lastIndexOf(2, -1); // 3

Finding all the occurrences of an element

The following example uses lastIndexOf to find all the indices of an element in a given array, using push to add them to another array as they are found.

var indices = [];
var array = ['a', 'b', 'a', 'c', 'a', 'd'];
var element = 'a';
var idx = array.lastIndexOf(element);
while (idx != -1) {
  indices.push(idx);
  idx = (idx > 0 ? array.lastIndexOf(element, idx - 1) : -1);
}

console.log(indices);
// [4, 2, 0]

Note that we have to handle the case idx == 0 separately here because the element will always be found regardless of the fromIndex parameter 
if it is the first element of the array. This is different from the indexOf method.
Polyfill

lastIndexOf was added to the ECMA-262 standard in the 5th edition; as such it may not be present in other implementations of the standard. You can work around this by inserting the following code 
at the beginning of your scripts, allowing use of lastIndexOf in implementations which do not natively support it. This algorithm is exactly the one specified in ECMA-262, 5th edition, assuming
 Object, TypeError, Number, Math.floor, Math.abs, and Math.min have their original values.

// Production steps of ECMA-262, Edition 5, 15.4.4.15
// Reference: http://es5.github.io/#x15.4.4.15
if (!Array.prototype.lastIndexOf) {
  Array.prototype.lastIndexOf = function(searchElement /*, fromIndex*/) {
    'use strict';

    if (this === void 0 || this === null) {
      throw new TypeError();
    }

    var n, k,
      t = Object(this),
      len = t.length >>> 0;
    if (len === 0) {
      return -1;
    }

    n = len - 1;
    if (arguments.length > 1) {
      n = Number(arguments[1]);
      if (n != n) {
        n = 0;
      }
      else if (n != 0 && n != (1 / 0) && n != -(1 / 0)) {
        n = (n > 0 || -1) * Math.floor(Math.abs(n));
      }
    }

    for (k = n >= 0 ? Math.min(n, len - 1) : len - Math.abs(n); k >= 0; k--) {
      if (k in t && t[k] === searchElement) {
        return k;
      }
    }
    return -1;
  };
}

Again, note that this implementation aims for absolute compatibility with lastIndexOf in Firefox and the SpiderMonkey JavaScript engine, including in several cases which are
 arguably edge cases. If you intend to use this in real-world applications, you may be able to calculate from with less complicated code if you ignore those cases.



-------------------------------------------------------------------------------------------

Array.length

The length property of an object which is an instance of type Array sets or returns the number of elements in that array. The value is an unsigned, 32-bit integer that is always numerically greater than the highest index in the array.

var clothing = ['shoes', 'shirts', 'socks', 'sweaters'];

console.log(clothing.length);
// expected output: 4


Description

The value of the length property is an integer with a positive sign and a value less than 2 to the 32nd power (232).

var namelistA = new Array(4294967296); //2 to the 32nd power = 4294967296 
var namelistC = new Array(-100) //negative sign

console.log(namelistA.length); //RangeError: Invalid array length 
console.log(namelistC.length); //RangeError: Invalid array length 



var namelistB = []; 
namelistB.length = Math.pow(2,32)-1; //set array length less than 2 to the 32nd power 
console.log(namelistB.length); 

//4294967295

You can set the length property to truncate an array at any time. When you extend an array by changing its length property, the number of actual elements increases; for example, if you set length to 3 when it is currently 2, the array now contains 3 elements, which causes the third element to be undefined.

var arr = [1, 2, 3];
printEntries(arr);

arr.length = 5; // set array length to 5 while currently 3.
printEntries(arr);

function printEntries(arr) {
  var length = arr.length;
  for (var i = 0; i < length; i++) {
    console.log(arr[i]);
  }
  console.log('=== printed ===');
}

// 1
// 2
// 3
// === printed ===
// 1
// 2
// 3
// undefined
// undefined
// === printed ===

But, the length property does not necessarily indicate the number of defined values in the array. See also Relationship between length and numerical properties.
Property attributes of Array.length
Writable 	yes
Enumerable 	no
Configurable 	no

    Writable: If this attribute set to false, the value of the property cannot be changed.
    Configurable: If this attribute set to false, any attempts to delete the property or change its attributes (Writable, Configurable, or Enumerable) will fail.
    Enumerable: If this attribute set to true, the property will be iterated over during for or for..in loops.

Examples
Iterating over an array

In the following example, the array numbers is iterated through by looking at the length property. The value in each element is then doubled.

var numbers = [1, 2, 3, 4, 5];
var length = numbers.length;
for (var i = 0; i < length; i++) {
  numbers[i] *= 2;
}
// numbers is now [2, 4, 6, 8, 10]

Shortening an array

The following example shortens the array numbers to a length of 3 if the current length is greater than 3.

var numbers = [1, 2, 3, 4, 5];

if (numbers.length > 3) {
  numbers.length = 3;
}

console.log(numbers); // [1, 2, 3]
console.log(numbers.length); // 3
------------------------------------------------------------


array.map

The map() method creates a new array with the results of calling a provided function on every element in the calling array.

var array1 = [1, 4, 9, 16];

// pass a function to map
const map1 = array1.map(x => x * 2);

console.log(map1);
// expected output: Array [2, 8, 18, 32]

Syntax

var new_array = arr.map(function callback(currentValue[, index[, array]]) {
    // Return element for new_array
}[, thisArg])

Parameters

callback
    Function that produces an element of the new Array, taking three arguments:

    currentValue
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array map was called upon.

thisArgOptional
    Value to use as this when executing callback.

Return value

A new array with each element being the result of the callback function.
Description

map calls a provided callback function once for each element in an array, in order, and constructs a new array from the results. callback is invoked only for indexes of the array which have assigned values, including undefined. It is not called for missing elements of the array (that is, indexes that have never been set, which have been deleted or which have never been assigned a value).

Since map builds a new array, using it when you aren't using the returned array is an anti-pattern; use forEach or for-of instead. Signs you shouldn't be using map: A) You're not using the array it returns, and/or B) You're not returning a value from the callback.

callback is invoked with three arguments: the value of the element, the index of the element, and the Array object being traversed.

If a thisArg parameter is provided to map, it will be used as callback's this value. Otherwise, the value undefined will be used as its this value. The this value ultimately observable by callback is determined according to the usual rules for determining the this seen by a function.

map does not mutate the array on which it is called (although callback, if invoked, may do so).

The range of elements processed by map is set before the first invocation of callback. Elements which are appended to the array after the call to map begins will not be visited by callback. If existing elements of the array are changed, their value as passed to callback will be the value at the time map visits them. Elements that are deleted after the call to map begins and before being visited are not visited.

Due to the algorithm defined in the specification if the array which map was called upon is sparse, resulting array will also be sparse keeping same indices blank.
Examples
Mapping an array of numbers to an array of square roots

The following code takes an array of numbers and creates a new array containing the square roots of the numbers in the first array.

var numbers = [1, 4, 9];
var roots = numbers.map(Math.sqrt);
// roots is now [1, 2, 3]
// numbers is still [1, 4, 9]

Using map to reformat objects in an array

The following code takes an array of objects and creates a new array containing the newly reformatted objects.

var kvArray = [{key: 1, value: 10}, 
               {key: 2, value: 20}, 
               {key: 3, value: 30}];

var reformattedArray = kvArray.map(obj =>{ 
   var rObj = {};
   rObj[obj.key] = obj.value;
   return rObj;
});
// reformattedArray is now [{1: 10}, {2: 20}, {3: 30}], 

// kvArray is still: 
// [{key: 1, value: 10}, 
//  {key: 2, value: 20}, 
//  {key: 3, value: 30}]

Mapping an array of numbers using a function containing an argument

The following code shows how map works when a function requiring one argument is used with it. The argument will automatically be assigned from each element of the array as map loops through the original array.

var numbers = [1, 4, 9];
var doubles = numbers.map(function(num) {
  return num * 2;
});

// doubles is now [2, 8, 18]
// numbers is still [1, 4, 9]

Using map generically

This example shows how to use map on a String to get an array of bytes in the ASCII encoding representing the character values:

var map = Array.prototype.map;
var a = map.call('Hello World', function(x) { 
  return x.charCodeAt(0); 
});
// a now equals [72, 101, 108, 108, 111, 32, 87, 111, 114, 108, 100]

Using map generically querySelectorAll

This example shows how to iterate through a collection of objects collected by querySelectorAll. In this case we get all selected options on the screen and printed on the console:

var elems = document.querySelectorAll('select option:checked');
var values = Array.prototype.map.call(elems, function(obj) {
  return obj.value;
});

Easier way would be using Array.from() method.
Tricky use case

(inspired by this blog post)

It is common to use the callback with one argument (the element being traversed). Certain functions are also commonly used with one argument, even though they take additional optional arguments. These habits may lead to confusing behaviors.

// Consider:
['1', '2', '3'].map(parseInt);
// While one could expect [1, 2, 3]
// The actual result is [1, NaN, NaN]

// parseInt is often used with one argument, but takes two.
// The first is an expression and the second is the radix.
// To the callback function, Array.prototype.map passes 3 arguments: 
// the element, the index, the array
// The third argument is ignored by parseInt, but not the second one,
// hence the possible confusion. See the blog post for more details
// If the link doesn't work
// here is concise example of the iteration steps:
// parseInt(string, radix) -> map(parseInt(value, index))
// first iteration (index is 0): parseInt('1', 0) // results in parseInt('1', 0) -> 1
// second iteration (index is 1): parseInt('2', 1) // results in parseInt('2', 1) -> NaN
// third iteration (index is 2): parseInt('3', 2) // results in parseInt('3', 2) -> NaN

function returnInt(element) {
  return parseInt(element, 10);
}

['1', '2', '3'].map(returnInt); // [1, 2, 3]
// Actual result is an array of numbers (as expected)

// Same as above, but using the concise arrow function syntax
['1', '2', '3'].map( str => parseInt(str) );

// A simpler way to achieve the above, while avoiding the "gotcha":
['1', '2', '3'].map(Number); // [1, 2, 3]
// but unlike `parseInt` will also return a float or (resolved) exponential notation:
['1.1', '2.2e2', '3e300'].map(Number); // [1.1, 220, 3e+300]

One alternative output of the map method being called with parseInt as a parameter runs as follows:

var xs = ['10', '10', '10'];

xs = xs.map(parseInt);

console.log(xs);
// Actual result of 10,NaN,2 may be unexpected based on the above description.

Polyfill

map was added to the ECMA-262 standard in the 5th edition; as such it may not be present in all implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of map in implementations which do not natively support it. This algorithm is exactly the one specified in ECMA-262, 5th edition, assuming Object, TypeError, and Array have their original values and that callback.call evaluates to the original value of Function.prototype.call.

// Production steps of ECMA-262, Edition 5, 15.4.4.19
// Reference: http://es5.github.io/#x15.4.4.19
if (!Array.prototype.map) {

  Array.prototype.map = function(callback/*, thisArg*/) {

    var T, A, k;

    if (this == null) {
      throw new TypeError('this is null or not defined');
    }

    // 1. Let O be the result of calling ToObject passing the |this| 
    //    value as the argument.
    var O = Object(this);

    // 2. Let lenValue be the result of calling the Get internal 
    //    method of O with the argument "length".
    // 3. Let len be ToUint32(lenValue).
    var len = O.length >>> 0;

    // 4. If IsCallable(callback) is false, throw a TypeError exception.
    // See: http://es5.github.com/#x9.11
    if (typeof callback !== 'function') {
      throw new TypeError(callback + ' is not a function');
    }

    // 5. If thisArg was supplied, let T be thisArg; else let T be undefined.
    if (arguments.length > 1) {
      T = arguments[1];
    }

    // 6. Let A be a new array created as if by the expression new Array(len) 
    //    where Array is the standard built-in constructor with that name and 
    //    len is the value of len.
    A = new Array(len);

    // 7. Let k be 0
    k = 0;

    // 8. Repeat, while k < len
    while (k < len) {

      var kValue, mappedValue;

      // a. Let Pk be ToString(k).
      //   This is implicit for LHS operands of the in operator
      // b. Let kPresent be the result of calling the HasProperty internal 
      //    method of O with argument Pk.
      //   This step can be combined with c
      // c. If kPresent is true, then
      if (k in O) {

        // i. Let kValue be the result of calling the Get internal 
        //    method of O with argument Pk.
        kValue = O[k];

        // ii. Let mappedValue be the result of calling the Call internal 
        //     method of callback with T as the this value and argument 
        //     list containing kValue, k, and O.
        mappedValue = callback.call(T, kValue, k, O);

        // iii. Call the DefineOwnProperty internal method of A with arguments
        // Pk, Property Descriptor
        // { Value: mappedValue,
        //   Writable: true,
        //   Enumerable: true,
        //   Configurable: true },
        // and false.

        // In browsers that support Object.defineProperty, use the following:
        // Object.defineProperty(A, k, {
        //   value: mappedValue,
        //   writable: true,
        //   enumerable: true,
        //   configurable: true
        // });

        // For best browser support, use the following:
        A[k] = mappedValue;
      }
      // d. Increase k by 1.
      k++;
    }

    // 9. return A
    return A;
  };
}

------------------------------------------------------------------------

Array.of

The Array.of() method creates a new Array instance with a variable number of arguments, regardless of number or type of the arguments.

The difference between Array.of() and the Array constructor is in the handling of integer arguments: Array.of(7) creates an array with a single element, 7, whereas Array(7) creates an empty array with a length property of 7 (Note: this implies an array of 7 empty slots, not slots with actual undefined values).

Array.of(7);       // [7] 
Array.of(1, 2, 3); // [1, 2, 3]

Array(7);          // [ , , , , , , ]
Array(1, 2, 3);    // [1, 2, 3]

Syntax

Array.of(element0[, element1[, ...[, elementN]]])

Parameters

elementN
    Elements of which to create the array.

Return value

A new Array instance.
Description

This function is part of the ECMAScript 2015 standard. For more information see Array.of and Array.from proposal and Array.of polyfill.
Examples

Array.of(1);         // [1]
Array.of(1, 2, 3);   // [1, 2, 3]
Array.of(undefined); // [undefined]

Polyfill

Running the following code before any other code will create Array.of() if it's not natively available.

if (!Array.of) {
  Array.of = function() {
    return Array.prototype.slice.call(arguments);
  };
}
--------------------------------------------------------------------------------------

array.pop

The pop() method removes the last element from an array and returns that element. This method changes the length of the array.

var plants = ['broccoli', 'cauliflower', 'cabbage', 'kale', 'tomato'];

console.log(plants.pop());
// expected output: "tomato"

console.log(plants);
// expected output: Array ["broccoli", "cauliflower", "cabbage", "kale"]

plants.pop();

console.log(plants);
// expected output: Array ["broccoli", "cauliflower", "cabbage"]


Syntax

arr.pop()

Return value

The removed element from the array; undefined if the array is empty.
Description

The pop method removes the last element from an array and returns that value to the caller.

pop is intentionally generic; this method can be called or applied to objects resembling arrays. Objects which do not contain a length property reflecting the last in a series of consecutive, zero-based numerical properties may not behave in any meaningful manner.

If you call pop() on an empty array, it returns undefined.
Examples
Removing the last element of an array

The following code creates the myFish array containing four elements, then removes its last element.

var myFish = ['angel', 'clown', 'mandarin', 'sturgeon'];

var popped = myFish.pop();

console.log(myFish); // ['angel', 'clown', 'mandarin' ] 

console.log(popped); // 'sturgeon'
-----------------------------------------------------------------------------------------------------------------------------
Array.prototype
Description

Array instances inherit from Array.prototype. As with all constructors, you can change the constructor's prototype object to make changes to all Array instances. For example, you can add new methods and properties to extend all Array objects. This is used for polyfilling, for example.

However, adding non-standard methods to the array object can cause issues later, either with your own code, or when adding features to JavaScript.

Little known fact: Array.prototype itself is an Array:

Array.isArray(Array.prototype); // true

Property attributes of Array.prototype
Writable 	no
Enumerable 	no
Configurable 	no
Properties

Array.prototype.constructor
    Specifies the function that creates an object's prototype.
Array.prototype.length
    Reflects the number of elements in an array.
Array.prototype[@@unscopables]
    A symbol containing property names to exclude from a with binding scope.

Methods
Mutator methods

These methods modify the array:

Array.prototype.copyWithin()
    Copies a sequence of array elements within the array.
Array.prototype.fill()
    Fills all the elements of an array from a start index to an end index with a static value.
Array.prototype.pop()
    Removes the last element from an array and returns that element.
Array.prototype.push()
    Adds one or more elements to the end of an array and returns the new length of the array.
Array.prototype.reverse()
    Reverses the order of the elements of an array in place — the first becomes the last, and the last becomes the first.
Array.prototype.shift()
    Removes the first element from an array and returns that element.
Array.prototype.sort()
    Sorts the elements of an array in place and returns the array.
Array.prototype.splice()
    Adds and/or removes elements from an array.
Array.prototype.unshift()
    Adds one or more elements to the front of an array and returns the new length of the array.

Accessor methods

These methods do not modify the array and return some representation of the array.

Array.prototype.concat()
    Returns a new array comprised of this array joined with other array(s) and/or value(s).
Array.prototype.includes()
    Determines whether an array contains a certain element, returning true or false as appropriate.
Array.prototype.indexOf()
    Returns the first (least) index of an element within the array equal to the specified value, or -1 if none is found.
Array.prototype.join()
    Joins all elements of an array into a string.
Array.prototype.lastIndexOf()
    Returns the last (greatest) index of an element within the array equal to the specified value, or -1 if none is found.
Array.prototype.slice()
    Extracts a section of an array and returns a new array.
Array.prototype.toSource()
    Returns an array literal representing the specified array; you can use this value to create a new array. Overrides the Object.prototype.toSource() method.
Array.prototype.toString()
    Returns a string representing the array and its elements. Overrides the Object.prototype.toString() method.
Array.prototype.toLocaleString()
    Returns a localized string representing the array and its elements. Overrides the Object.prototype.toLocaleString() method.

Iteration methods

Several methods take as arguments functions to be called back while processing the array. When these methods are called, the length of the array is sampled, and any element added beyond this length from within the callback is not visited. Other changes to the array (setting the value of or deleting an element) may affect the results of the operation if the method visits the changed element afterwards. While the specific behavior of these methods in such cases is well-defined, you should not rely upon it so as not to confuse others who might read your code. If you must mutate the array, copy into a new array instead.

Array.prototype.entries()
    Returns a new Array Iterator object that contains the key/value pairs for each index in the array.
Array.prototype.every()
    Returns true if every element in this array satisfies the provided testing function.
Array.prototype.filter()
    Creates a new array with all of the elements of this array for which the provided filtering function returns true.
Array.prototype.find()
    Returns the found value in the array, if an element in the array satisfies the provided testing function or undefined if not found.
Array.prototype.findIndex()
    Returns the found index in the array, if an element in the array satisfies the provided testing function or -1 if not found.
Array.prototype.forEach()
    Calls a function for each element in the array.
Array.prototype.keys()
    Returns a new Array Iterator that contains the keys for each index in the array.
Array.prototype.map()
    Creates a new array with the results of calling a provided function on every element in this array.
Array.prototype.reduce()
    Apply a function against an accumulator and each value of the array (from left-to-right) as to reduce it to a single value.
Array.prototype.reduceRight()
    Apply a function against an accumulator and each value of the array (from right-to-left) as to reduce it to a single value.
Array.prototype.some()
    Returns true if at least one element in this array satisfies the provided testing function.
Array.prototype.values()
    Returns a new Array Iterator object that contains the values for each index in the array.
Array.prototype[@@iterator]()
    Returns a new Array Iterator object that contains the values for each index in the array.

Generic methods (non-standard)

Many methods on the JavaScript Array object are designed to be generally applied to all objects which “look like” Arrays. That is, they can be used on any object which has a length property, and which can usefully be accessed using numeric property names (as with array[5] indexing). Some methods, such as join, only read the length and numeric properties of the object they are called on. Others, like reverse, require that the object's numeric properties and length be mutable; these methods can therefore not be called on objects like String, which does not permit its length property or synthesized numeric properties to be set.
---------------------------------------------------------------------------------------------------------

array.push

The push() method adds one or more elements to the end of an array and returns the new length of the array.

var animals = ['pigs', 'goats', 'sheep'];

console.log(animals.push('cows'));
// expected output: 4

console.log(animals);
// expected output: Array ["pigs", "goats", "sheep", "cows"]

animals.push('chickens');

console.log(animals);
// expected output: Array ["pigs", "goats", "sheep", "cows", "chickens"]


Syntax

arr.push(element1[, ...[, elementN]])

Parameters

elementN
    The elements to add to the end of the array.

Return value

The new length property of the object upon which the method was called.
Description

The push method appends values to an array.

push is intentionally generic. This method can be used with call() or apply() on objects resembling arrays. The push method relies on a length property to determine where to start inserting the given values. If the length property cannot be converted into a number, the index used is 0. This includes the possibility of length being nonexistent, in which case length will also be created.

Although strings are native, Array-like objects, they are not suitable in applications of this method, as strings are immutable. Similarly for the native, Array-like object arguments.
Examples
Adding elements to an array

The following code creates the sports array containing two elements, then appends two elements to it. The total variable contains the new length of the array.

var sports = ['soccer', 'baseball'];
var total = sports.push('football', 'swimming');

console.log(sports); // ['soccer', 'baseball', 'football', 'swimming']
console.log(total);  // 4

Merging two arrays

This example uses apply() to push all elements from a second array.

Do not use this method if the second array (moreVegs in the example) is very large, because the maximum number of parameters that one function can take is limited in practice. See apply() for more details.

var vegetables = ['parsnip', 'potato'];
var moreVegs = ['celery', 'beetroot'];

// Merge the second array into the first one
// Equivalent to vegetables.push('celery', 'beetroot');
Array.prototype.push.apply(vegetables, moreVegs);

console.log(vegetables); // ['parsnip', 'potato', 'celery', 'beetroot']

Using an object in an array-like fashion

As mentioned above, push is intentionally generic, and we can use that to our advantage. Array.prototype.push can work on an object just fine, as this example shows. Note that we don't create an array to store a collection of objects. Instead, we store the collection on the object itself and use call on Array.prototype.push to trick the method into thinking we are dealing with an array, and it just works, thanks to the way JavaScript allows us to establish the execution context however we please.

var obj = {
    length: 0,

    addElem: function addElem(elem) {
        // obj.length is automatically incremented 
        // every time an element is added.
        [].push.call(this, elem);
    }
};

// Let's add some empty objects just to illustrate.
obj.addElem({});
obj.addElem({});
console.log(obj.length);
// → 2

Note that although obj is not an array, the method push successfully incremented obj's length property just like if we were dealing with an actual array.
--------------------------------------------------------

array.reduce

The reduce() method executes a reducer function (that you provide) on each member of the array resulting in a single output value.

const array1 = [1, 2, 3, 4];
const reducer = (accumulator, currentValue) => accumulator + currentValue;

// 1 + 2 + 3 + 4
console.log(array1.reduce(reducer));
// expected output: 10

// 5 + 1 + 2 + 3 + 4
console.log(array1.reduce(reducer, 5));
// expected output: 15

The reducer function is fed four parameters:

    Accumulator (acc)
    Current Value (cur)
    Current Index (idx)
    Source Array (src)

Your reducer function's returned value is assigned to the accumulator, whose value is remembered across each iteration throughout the array and ultimately becomes the final, single resulting value.
Syntax

arr.reduce(callback[, initialValue])

Parameters

callback
    Function to execute on each element in the array, taking four arguments:

    accumulator
        The accumulator accumulates the callback's return values; it is the accumulated value previously returned in the last invocation of the callback, or initialValue, if supplied (see below).
    currentValue
        The current element being processed in the array.
    currentIndexOptional
        The index of the current element being processed in the array. Starts at index 0, if an initialValue is provided, and at index 1 otherwise.
    arrayOptional
        The array reduce() was called upon.

initialValueOptional
    Value to use as the first argument to the first call of the callback. If no initial value is supplied, the first element in the array will be used. Calling reduce() on an empty array without an initial value is an error.

Return value

The value that results from the reduction.
Description

reduce() executes the callback function once for each element present in the array, excluding holes in the array, receiving four arguments:

    accumulator
    currentValue
    currentIndex
    array

The first time the callback is called, accumulator and currentValue can be one of two values. If initialValue is provided in the call to reduce(), then accumulator will be equal to initialValue, and currentValue will be equal to the first value in the array. If no initialValue is provided, then accumulator will be equal to the first value in the array, and currentValue will be equal to the second.

Note: If initialValue isn't provided, reduce() will execute the callback function starting at index 1, skipping the first index. If initialValue is provided, it will start at index 0.

If the array is empty and no initialValue is provided, TypeError will be thrown. If the array has only one element (regardless of position) and no initialValue is provided, or if initialValue is provided but the array is empty, the solo value will be returned without calling callback.

It is usually safer to provide an initial value because there are three possible outputs without initialValue, as shown in the following example.

var maxCallback = ( acc, cur ) => Math.max( acc.x, cur.x );
var maxCallback2 = ( max, cur ) => Math.max( max, cur );

// reduce() without initialValue
[ { x: 22 }, { x: 42 } ].reduce( maxCallback ); // 42
[ { x: 22 }            ].reduce( maxCallback ); // { x: 22 }
[                      ].reduce( maxCallback ); // TypeError

// map/reduce; better solution, also works for empty or larger arrays
[ { x: 22 }, { x: 42 } ].map( el => el.x )
                        .reduce( maxCallback2, -Infinity );

How reduce() works

Suppose the following use of reduce() occurred:

[0, 1, 2, 3, 4].reduce(function(accumulator, currentValue, currentIndex, array) {
  return accumulator + currentValue;
});

The callback would be invoked four times, with the arguments and return values in each call being as follows:
callback 	accumulator 	currentValue 	currentIndex 	array 	return value
first call 	0 	1 	1 	[0, 1, 2, 3, 4] 	1
second call 	1 	2 	2 	[0, 1, 2, 3, 4] 	3
third call 	3 	3 	3 	[0, 1, 2, 3, 4] 	6
fourth call 	6 	4 	4 	[0, 1, 2, 3, 4] 	10

The value returned by reduce() would be that of the last callback invocation (10).

You can also provide an Arrow Function in lieu of a full function. The code below will produce the same output as the code in the block above:

[0, 1, 2, 3, 4].reduce( (accumulator, currentValue, currentIndex, array) => accumulator + currentValue );

If you were to provide an initial value as the second argument to reduce(), the result would look like this:

[0, 1, 2, 3, 4].reduce((accumulator, currentValue, currentIndex, array) => {
    return accumulator + currentValue;
}, 10);

callback 	accumulator 	currentValue 	currentIndex 	array 	return value
first call 	10 	0 	0 	[0, 1, 2, 3, 4] 	10
second call 	10 	1 	1 	[0, 1, 2, 3, 4] 	11
third call 	11 	2 	2 	[0, 1, 2, 3, 4] 	13
fourth call 	13 	3 	3 	[0, 1, 2, 3, 4] 	16
fifth call 	16 	4 	4 	[0, 1, 2, 3, 4] 	20

The value returned by reduce() in this case would be 20.
Examples
Sum all the values of an array

var sum = [0, 1, 2, 3].reduce(function (accumulator, currentValue) {
  return accumulator + currentValue;
}, 0);
// sum is 6

Alternatively, written with an arrow function:

var total = [ 0, 1, 2, 3 ].reduce(
  ( accumulator, currentValue ) => accumulator + currentValue,
  0
);

Sum of values in an object array

To sum up values contained in an array of objects you must supply an initial value so that each item passes through your function.

var initialValue = 0;
var sum = [{x: 1}, {x:2}, {x:3}].reduce(function (accumulator, currentValue) {
    return accumulator + currentValue.x;
},initialValue)

console.log(sum) // logs 6

Alternatively, written with an arrow function:

var initialValue = 0;
var sum = [{x: 1}, {x:2}, {x:3}].reduce(
    (accumulator, currentValue) => accumulator + currentValue.x
    ,initialValue
);

console.log(sum) // logs 6

Flatten an array of arrays

var flattened = [[0, 1], [2, 3], [4, 5]].reduce(
  function(accumulator, currentValue) {
    return accumulator.concat(currentValue);
  },
  []
);
// flattened is [0, 1, 2, 3, 4, 5]

Alternatively, written with an arrow function:

var flattened = [[0, 1], [2, 3], [4, 5]].reduce(
  ( accumulator, currentValue ) => accumulator.concat(currentValue),
  []
);

Counting instances of values in an object

var names = ['Alice', 'Bob', 'Tiff', 'Bruce', 'Alice'];

var countedNames = names.reduce(function (allNames, name) { 
  if (name in allNames) {
    allNames[name]++;
  }
  else {
    allNames[name] = 1;
  }
  return allNames;
}, {});
// countedNames is:
// { 'Alice': 2, 'Bob': 1, 'Tiff': 1, 'Bruce': 1 }

Grouping objects by a property

var people = [
  { name: 'Alice', age: 21 },
  { name: 'Max', age: 20 },
  { name: 'Jane', age: 20 }
];

function groupBy(objectArray, property) {
  return objectArray.reduce(function (acc, obj) {
    var key = obj[property];
    if (!acc[key]) {
      acc[key] = [];
    }
    acc[key].push(obj);
    return acc;
  }, {});
}

var groupedPeople = groupBy(people, 'age');
// groupedPeople is:
// { 
//   20: [
//     { name: 'Max', age: 20 }, 
//     { name: 'Jane', age: 20 }
//   ], 
//   21: [{ name: 'Alice', age: 21 }] 
// }

Bonding arrays contained in an array of objects using the spread operator and initialValue

// friends - an array of objects 
// where object field "books" - list of favorite books 
var friends = [{
  name: 'Anna',
  books: ['Bible', 'Harry Potter'],
  age: 21
}, {
  name: 'Bob',
  books: ['War and peace', 'Romeo and Juliet'],
  age: 26
}, {
  name: 'Alice',
  books: ['The Lord of the Rings', 'The Shining'],
  age: 18
}];

// allbooks - list which will contain all friends' books +  
// additional list contained in initialValue
var allbooks = friends.reduce(function(accumulator, currentValue) {
  return [...accumulator, ...currentValue.books];
}, ['Alphabet']);

// allbooks = [
//   'Alphabet', 'Bible', 'Harry Potter', 'War and peace', 
//   'Romeo and Juliet', 'The Lord of the Rings',
//   'The Shining'
// ]

Remove duplicate items in array

let arr = [1, 2, 1, 2, 3, 5, 4, 5, 3, 4, 4, 4, 4];
let result = arr.sort().reduce((accumulator, current) => {
    const length = accumulator.length
    if (length === 0 || accumulator[length - 1] !== current) {
        accumulator.push(current);
    }
    return accumulator;
}, []);
console.log(result); //[1,2,3,4,5]

Running Promises in Sequence

/**
 * Runs promises from array of functions that can return promises
 * in chained manner
 *
 * @param {array} arr - promise arr
 * @return {Object} promise object
 */
function runPromiseInSequence(arr, input) {
  return arr.reduce(
    (promiseChain, currentFunction) => promiseChain.then(currentFunction),
    Promise.resolve(input)
  );
}

// promise function 1
function p1(a) {
  return new Promise((resolve, reject) => {
    resolve(a * 5);
  });
}

// promise function 2
function p2(a) {
  return new Promise((resolve, reject) => {
    resolve(a * 2);
  });
}

// function 3  - will be wrapped in a resolved promise by .then()
function f3(a) {
 return a * 3;
}

// promise function 4
function p4(a) {
  return new Promise((resolve, reject) => {
    resolve(a * 4);
  });
}

const promiseArr = [p1, p2, f3, p4];
runPromiseInSequence(promiseArr, 10)
  .then(console.log);   // 1200

Function composition enabling piping

// Building-blocks to use for composition
const double = x => x + x;
const triple = x => 3 * x;
const quadruple = x => 4 * x;

// Function composition enabling pipe functionality
const pipe = (...functions) => input => functions.reduce(
    (acc, fn) => fn(acc),
    input
);

// Composed functions for multiplication of specific values
const multiply6 = pipe(double, triple);
const multiply9 = pipe(triple, triple);
const multiply16 = pipe(quadruple, quadruple);
const multiply24 = pipe(double, triple, quadruple);

// Usage
multiply6(6); // 36
multiply9(9); // 81
multiply16(16); // 256
multiply24(10); // 240

write map using reduce

if (!Array.prototype.mapUsingReduce) {
  Array.prototype.mapUsingReduce = function(callback, thisArg) {
    return this.reduce(function(mappedArray, currentValue, index, array) {
      mappedArray[index] = callback.call(thisArg, currentValue, index, array);
      return mappedArray;
    }, []);
  };
}

[1, 2, , 3].mapUsingReduce(
  (currentValue, index, array) => currentValue + index + array.length
); // [5, 7, , 10]

Polyfill

// Production steps of ECMA-262, Edition 5, 15.4.4.21
// Reference: http://es5.github.io/#x15.4.4.21
// https://tc39.github.io/ecma262/#sec-array.prototype.reduce
if (!Array.prototype.reduce) {
  Object.defineProperty(Array.prototype, 'reduce', {
    value: function(callback /*, initialValue*/) {
      if (this === null) {
        throw new TypeError( 'Array.prototype.reduce ' + 
          'called on null or undefined' );
      }
      if (typeof callback !== 'function') {
        throw new TypeError( callback +
          ' is not a function');
      }

      // 1. Let O be ? ToObject(this value).
      var o = Object(this);

      // 2. Let len be ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0; 

      // Steps 3, 4, 5, 6, 7      
      var k = 0; 
      var value;

      if (arguments.length >= 2) {
        value = arguments[1];
      } else {
        while (k < len && !(k in o)) {
          k++; 
        }

        // 3. If len is 0 and initialValue is not present,
        //    throw a TypeError exception.
        if (k >= len) {
          throw new TypeError( 'Reduce of empty array ' +
            'with no initial value' );
        }
        value = o[k++];
      }

      // 8. Repeat, while k < len
      while (k < len) {
        // a. Let Pk be ! ToString(k).
        // b. Let kPresent be ? HasProperty(O, Pk).
        // c. If kPresent is true, then
        //    i.  Let kValue be ? Get(O, Pk).
        //    ii. Let accumulator be ? Call(
        //          callbackfn, undefined,
        //          « accumulator, kValue, k, O »).
        if (k in o) {
          value = callback(value, o[k], k, o);
        }

        // d. Increase k by 1.      
        k++;
      }

      // 9. Return accumulator.
      return value;
    }
  });
}

If you need to support truly obsolete JavaScript engines that don't support Object.defineProperty(), it's best not to polyfill Array.prototype methods at all, as you can't make them non-enumerable.
----------------------------------------------------------

array.reduceRight

The reduceRight() method applies a function against an accumulator and each value of the array (from right-to-left) to reduce it to a single value.

const array1 = [[0, 1], [2, 3], [4, 5]].reduceRight(
  (accumulator, currentValue) => accumulator.concat(currentValue)
);

console.log(array1);
// expected output: Array [4, 5, 2, 3, 0, 1]


See also Array.prototype.reduce() for left-to-right.
Syntax

arr.reduceRight(callback[, initialValue])

Parameters

callback
    Function to execute on each value in the array, taking four arguments:

    accumulator
        The value previously returned in the last invocation of the callback, or initialValue, if supplied. (See below.)
    currentValue
        The current element being processed in the array.
    indexOptional
        The index of the current element being processed in the array.
    arrayOptional
        The array reduce was called upon.

initialValueOptional
    Object to use as the first argument to the first call of the callback. If no initial value is supplied, the last element in the array will be used. Calling reduce on an empty array without an initial value is an error.

Return value

The value that results from the reduction.
Description

reduceRight executes the callback function once for each element present in the array, excluding holes in the array, receiving four arguments: the initial value (or value from the previous callback call), the value of the current element, the current index, and the array over which iteration is occurring.

The call to the reduceRight callback would look something like this:

array.reduceRight(function(accumulator, currentValue, index, array) {
  // ...
});

The first time the function is called, the accumulator and currentValue can be one of two values. If an initialValue was provided in the call to reduceRight, then accumulator will be equal to initialValue and currentValue will be equal to the last value in the array. If no initialValue was provided, then accumulator will be equal to the last value in the array and currentValue will be equal to the second-to-last value.

If the array is empty and no initialValue was provided, TypeError would be thrown. If the array has only one element (regardless of position) and no initialValue was provided, or if initialValue is provided but the array is empty, the solo value would be returned without calling callback.

Some example run-throughs of the function would look like this:

[0, 1, 2, 3, 4].reduceRight(function(accumulator, currentValue, index, array) {
  return accumulator + currentValue;
});

The callback would be invoked four times, with the arguments and return values in each call being as follows:
callback 	accumulator 	currentValue 	index 	array 	return value
first call 	4 	3 	3 	[0, 1, 2, 3, 4] 	7
second call 	7 	2 	2 	[0, 1, 2, 3, 4] 	9
third call 	9 	1 	1 	[0, 1, 2, 3, 4] 	10
fourth call 	10 	0 	0 	[0, 1, 2, 3, 4] 	10

The value returned by reduceRight would be that of the last callback invocation (10).

And if you were to provide an initialValue, the result would look like this:

[0, 1, 2, 3, 4].reduceRight(function(accumulator, currentValue, index, array) {
  return accumulator + currentValue;
}, 10);

callback 	accumulator 	currentValue 	index 	array 	return value
first call 	10 	4 	4 	[0, 1, 2, 3, 4] 	14
second call 	14 	3 	3 	[0, 1, 2, 3, 4] 	17
third call 	17 	2 	2 	[0, 1, 2, 3, 4] 	19
fourth call 	19 	1 	1 	[0, 1, 2, 3, 4] 	20
fifth call 	20 	0 	0 	[0, 1, 2, 3, 4] 	20

The value returned by reduceRight this time would be, of course, 20.
Examples
Sum up all values within an array

var sum = [0, 1, 2, 3].reduceRight(function(a, b) {
  return a + b;
});
// sum is 6

Flatten an array of arrays

var flattened = [[0, 1], [2, 3], [4, 5]].reduceRight(function(a, b) {
    return a.concat(b);
}, []);
// flattened is [4, 5, 2, 3, 0, 1]

Run a list of asynchronous functions with callbacks in series each passing their results to the next

const waterfall = (...functions) => (callback, ...args) =>
  functions.reduceRight(
    (composition, fn) => (...results) => fn(composition, ...results),
    callback
  )(...args);

const randInt = max => Math.floor(Math.random() * max)

const add5 = (callback, x) => {
  setTimeout(callback, randInt(1000), x + 5);
};
const mult3 = (callback, x) => {
  setTimeout(callback, randInt(1000), x * 3);
};
const sub2 = (callback, x) => {
  setTimeout(callback, randInt(1000), x - 2);
};
const split = (callback, x) => {
  setTimeout(callback, randInt(1000), x, x);
};
const add = (callback, x, y) => {
  setTimeout(callback, randInt(1000), x + y);
};
const div4 = (callback, x) => {
  setTimeout(callback, randInt(1000), x / 4);
};

const computation = waterfall(add5, mult3, sub2, split, add, div4);
computation(console.log, 5) // -> 14

// same as:

const computation2 = (input, callback) => {
  const f6 = x=> div4(callback, x);
  const f5 = (x, y) => add(f6, x, y);
  const f4 = x => split(f5, x);
  const f3 = x => sub2(f4, x);
  const f2 = x => mult3(f3, x);
  add5(f2, input);
}

​​​​​​Difference between reduce and reduceRight

var a = ['1', '2', '3', '4', '5']; 
var left  = a.reduce(function(prev, cur)      { return prev + cur; }); 
var right = a.reduceRight(function(prev, cur) { return prev + cur; }); 

console.log(left);  // "12345"
console.log(right); // "54321"

Polyfill

reduceRight was added to the ECMA-262 standard in the 5th edition; as such it may not be present in all implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of reduceRight in implementations which do not natively support it.

// Production steps of ECMA-262, Edition 5, 15.4.4.22
// Reference: http://es5.github.io/#x15.4.4.22
if ('function' !== typeof Array.prototype.reduceRight) {
  Array.prototype.reduceRight = function(callback /*, initialValue*/) {
    'use strict';
    if (null === this || 'undefined' === typeof this) {
      throw new TypeError('Array.prototype.reduce called on null or undefined');
    }
    if ('function' !== typeof callback) {
      throw new TypeError(callback + ' is not a function');
    }
    var t = Object(this), len = t.length >>> 0, k = len - 1, value;
    if (arguments.length >= 2) {
      value = arguments[1];
    } else {
      while (k >= 0 && !(k in t)) {
        k--;
      }
      if (k < 0) {
        throw new TypeError('Reduce of empty array with no initial value');
      }
      value = t[k--];
    }
    for (; k >= 0; k--) {
      if (k in t) {
        value = callback(value, t[k], k, t);
      }
    }
    return value;
  };
}

--------------------------------------------

array.reverse

The reverse() method reverses an array in place. The first array element becomes the last, and the last array element becomes the first.


var array1 = ['one', 'two', 'three'];
console.log('array1: ', array1);
// expected output: Array ['one', 'two', 'three']

var reversed = array1.reverse(); 
console.log('reversed: ', reversed);
// expected output: Array ['three', 'two', 'one']

/* Careful: reverse is destructive. It also changes
the original array */ 
console.log('array1: ', array1);
// expected output: Array ['three', 'two', 'one']


Syntax

a.reverse()

Return value

The reversed array.
Description

The reverse method transposes the elements of the calling array object in place, mutating the array, and returning a reference to the array.
Examples
Reversing the elements in an array

The following example creates an array a, containing three elements, then reverses the array. The call to reverse() returns a reference to the reversed array a.

const a = [1, 2, 3];

console.log(a); // [1, 2, 3]

a.reverse();

console.log(a); // [3, 2, 1]


--------------------------------------------------------

array.shift

The shift() method removes the first element from an array and returns that removed element. This method changes the length of the array.

var array1 = [1, 2, 3];

var firstElement = array1.shift();

console.log(array1);
// expected output: Array [2, 3]

console.log(firstElement);
// expected output: 1


Syntax

arr.shift()

Return value

The removed element from the array; undefined if the array is empty.
Description

The shift method removes the element at the zeroeth index and shifts the values at consecutive indexes down, then returns the removed value. If the length property is 0, undefined is returned.

shift is intentionally generic; this method can be called or applied to objects resembling arrays. Objects which do not contain a length property reflecting the last in a series of consecutive, zero-based numerical properties may not behave in any meaningful manner.
Examples
Removing an element from an array

The following code displays the myFish array before and after removing its first element. It also displays the removed element:

var myFish = ['angel', 'clown', 'mandarin', 'surgeon'];

console.log('myFish before:', JSON.stringify(myFish));
// myFish before: ['angel', 'clown', 'mandarin', 'surgeon']

var shifted = myFish.shift(); 

console.log('myFish after:', myFish); 
// myFish after: ['clown', 'mandarin', 'surgeon']

console.log('Removed this element:', shifted); 
// Removed this element: angel

Using shift() method in while loop

The shift() method is often used in condition inside while loop. In the following example every iteration will remove the next element from an array, until it is empty:

var names = ["Andrew", "Edward", "Paul", "Chris" ,"John"];

while( (i = names.shift()) !== undefined ) {
    console.log(i);
}
// Andrew, Edward, Paul, Chris, John

----------------------------------------------------------------------------------

array.slice

The slice() method returns a shallow copy of a portion of an array into a new array object selected from begin to end (end not included). The original array will not be modified.

var animals = ['ant', 'bison', 'camel', 'duck', 'elephant'];

console.log(animals.slice(2));
// expected output: Array ["camel", "duck", "elephant"]

console.log(animals.slice(2, 4));
// expected output: Array ["camel", "duck"]

console.log(animals.slice(1, 5));
// expected output: Array ["bison", "camel", "duck", "elephant"]


Syntax

arr.slice([begin[, end]])

Parameters

begin Optional
    Zero-based index at which to begin extraction.
    A negative index can be used, indicating an offset from the end of the sequence. slice(-2) extracts the last two elements in the sequence.
    If begin is undefined, slice begins from index 0.
    If begin is greater than the length of the sequence, an empty array is returned.
end Optional
    Zero-based index before which to end extraction. slice extracts up to but not including end.
    For example, slice(1,4) extracts the second element through the fourth element (elements indexed 1, 2, and 3).
    A negative index can be used, indicating an offset from the end of the sequence. slice(2,-1) extracts the third element through the second-to-last element in the sequence.
    If end is omitted, slice extracts through the end of the sequence (arr.length).
    If end is greater than the length of the sequence, slice extracts through to the end of the sequence (arr.length).

Return value

A new array containing the extracted elements.
Description

slice does not alter the original array. It returns a shallow copy of elements from the original array. Elements of the original array are copied into the returned array as follows:

    For object references (and not the actual object), slice copies object references into the new array. Both the original and new array refer to the same object. If a referenced object changes, the changes are visible to both the new and original arrays.
    For strings, numbers and booleans (not String, Number and Boolean objects), slice copies the values into the new array. Changes to the string, number or boolean in one array do not affect the other array.

If a new element is added to either array, the other array is not affected.
Examples
Return a portion of an existing array

var fruits = ['Banana', 'Orange', 'Lemon', 'Apple', 'Mango'];
var citrus = fruits.slice(1, 3);

// fruits contains ['Banana', 'Orange', 'Lemon', 'Apple', 'Mango']
// citrus contains ['Orange','Lemon']

Using slice

In the following example, slice creates a new array, newCar, from myCar. Both include a reference to the object myHonda. When the color of myHonda is changed to purple, both arrays reflect the change.

// Using slice, create newCar from myCar.
var myHonda = { color: 'red', wheels: 4, engine: { cylinders: 4, size: 2.2 } };
var myCar = [myHonda, 2, 'cherry condition', 'purchased 1997'];
var newCar = myCar.slice(0, 2);

// Display the values of myCar, newCar, and the color of myHonda
//  referenced from both arrays.
console.log('myCar = ' + JSON.stringify(myCar));
console.log('newCar = ' + JSON.stringify(newCar));
console.log('myCar[0].color = ' + myCar[0].color);
console.log('newCar[0].color = ' + newCar[0].color);

// Change the color of myHonda.
myHonda.color = 'purple';
console.log('The new color of my Honda is ' + myHonda.color);

// Display the color of myHonda referenced from both arrays.
console.log('myCar[0].color = ' + myCar[0].color);
console.log('newCar[0].color = ' + newCar[0].color);

This script writes:

myCar = [{color: 'red', wheels: 4, engine: {cylinders: 4, size: 2.2}}, 2,
         'cherry condition', 'purchased 1997']
newCar = [{color: 'red', wheels: 4, engine: {cylinders: 4, size: 2.2}}, 2]
myCar[0].color = red 
newCar[0].color = red
The new color of my Honda is purple
myCar[0].color = purple
newCar[0].color = purple

Array-like objects

slice method can also be called to convert Array-like objects / collections to a new Array. You just bind the method to the object. The arguments inside a function is an example of an 'array-like object'.

function list() {
  return Array.prototype.slice.call(arguments);
}

var list1 = list(1, 2, 3); // [1, 2, 3]

Binding can be done with the .call function of Function.prototype and it can also be reduced using [].slice.call(arguments) instead of Array.prototype.slice.call. Anyway, it can be simplified using bind.

var unboundSlice = Array.prototype.slice;
var slice = Function.prototype.call.bind(unboundSlice);

function list() {
  return slice(arguments);
}

var list1 = list(1, 2, 3); // [1, 2, 3]

Streamlining cross-browser behavior

Although host objects (such as DOM objects) are not required by spec to follow the Mozilla behavior when converted by Array.prototype.slice and IE < 9 does not do so, versions of IE starting with version 9 do allow this. “Shimming” it can allow reliable cross-browser behavior. As long as other modern browsers continue to support this ability, as currently do IE, Mozilla, Chrome, Safari, and Opera, developers reading (DOM-supporting) slice code relying on this shim will not be misled by the semantics; they can safely rely on the semantics to provide the now apparently de facto standard behavior. (The shim also fixes IE to work with the second argument of slice() being an explicit null/undefined value as earlier versions of IE also did not allow but all modern browsers, including IE >= 9, now do.)

/**
 * Shim for "fixing" IE's lack of support (IE < 9) for applying slice
 * on host objects like NamedNodeMap, NodeList, and HTMLCollection
 * (technically, since host objects have been implementation-dependent,
 * at least before ES2015, IE hasn't needed to work this way).
 * Also works on strings, fixes IE < 9 to allow an explicit undefined
 * for the 2nd argument (as in Firefox), and prevents errors when
 * called on other DOM objects.
 */
(function () {
  'use strict';
  var _slice = Array.prototype.slice;

  try {
    // Can't be used with DOM elements in IE < 9
    _slice.call(document.documentElement);
  } catch (e) { // Fails in IE < 9
    // This will work for genuine arrays, array-like objects, 
    // NamedNodeMap (attributes, entities, notations),
    // NodeList (e.g., getElementsByTagName), HTMLCollection (e.g., childNodes),
    // and will not fail on other DOM objects (as do DOM elements in IE < 9)
    Array.prototype.slice = function(begin, end) {
      // IE < 9 gets unhappy with an undefined end argument
      end = (typeof end !== 'undefined') ? end : this.length;

      // For native Array objects, we use the native slice function
      if (Object.prototype.toString.call(this) === '[object Array]'){
        return _slice.call(this, begin, end); 
      }

      // For array like object we handle it ourselves.
      var i, cloned = [],
        size, len = this.length;

      // Handle negative value for "begin"
      var start = begin || 0;
      start = (start >= 0) ? start : Math.max(0, len + start);

      // Handle negative value for "end"
      var upTo = (typeof end == 'number') ? Math.min(end, len) : len;
      if (end < 0) {
        upTo = len + end;
      }

      // Actual expected size of the slice
      size = upTo - start;

      if (size > 0) {
        cloned = new Array(size);
        if (this.charAt) {
          for (i = 0; i < size; i++) {
            cloned[i] = this.charAt(start + i);
          }
        } else {
          for (i = 0; i < size; i++) {
            cloned[i] = this[start + i];
          }
        }
      }

      return cloned;
    };
  }
}());

-----------------------------------------------------------------------


array.some

The some() method tests whether at least one element in the array passes the test implemented by the provided function.

Note: This method returns false for any condition put on an empty array.


var array = [1, 2, 3, 4, 5];

var even = function(element) {
  // checks whether an element is even
  return element % 2 === 0;
};

console.log(array.some(even));
// expected output: true


Syntax

arr.some(callback(element[, index[, array]])[, thisArg])

Parameters

callback
    Function to test for each element, taking three arguments:

    element
        The current element being processed in the array.
    index Optional
        The index of the current element being processed in the array.
    arrayOptional
        The array some() was called upon.

thisArgOptional
    Value to use as this when executing callback.

Return value

true if the callback function returns a truthy value for any array element; otherwise, false.
Description

some() executes the callback function once for each element present in the array until it finds one where callback returns a truthy value (a value that becomes true when converted to a Boolean). If such an element is found, some() immediately returns true. Otherwise, some() returns false. callback is invoked only for indexes of the array which have assigned values; it is not invoked for indexes which have been deleted or which have never been assigned values.

callback is invoked with three arguments: the value of the element, the index of the element, and the array object being traversed.

If a thisArg parameter is provided to some(), it will be used as callbacks' this value. Otherwise, the value undefined will be used as its this value. The this value ultimately observable by callback is determined according to the usual rules for determining the this seen by a function.

some() does not mutate the array on which it is called.

The range of elements processed by some() is set before the first invocation of callback. Elements that are appended to the array after the call to some() begins will not be visited by callback. If an existing, unvisited element of the array is changed by callback, its value passed to the visiting callback will be the value at the time that some() visits that element's index; elements that are deleted are not visited.
Examples
Testing value of array elements

The following example tests whether any element in the array is bigger than 10.

function isBiggerThan10(element, index, array) {
  return element > 10;
}

[2, 5, 8, 1, 4].some(isBiggerThan10);  // false
[12, 5, 8, 1, 4].some(isBiggerThan10); // true

Testing array elements using arrow functions

Arrow functions provide a shorter syntax for the same test.

[2, 5, 8, 1, 4].some(x => x > 10);  // false
[12, 5, 8, 1, 4].some(x => x > 10); // true

Checking whether a value exists in an array

To mimic the function of the includes() method, this custom function returns true if the element exists in the array:

var fruits = ['apple', 'banana', 'mango', 'guava'];

function checkAvailability(arr, val) {
  return arr.some(function(arrVal) {
    return val === arrVal;
  });
}

checkAvailability(fruits, 'kela');   // false
checkAvailability(fruits, 'banana'); // true

Checking whether a value exists using an arrow function

var fruits = ['apple', 'banana', 'mango', 'guava'];

function checkAvailability(arr, val) {
  return arr.some(arrVal => val === arrVal);
}

checkAvailability(fruits, 'kela');   // false
checkAvailability(fruits, 'banana'); // true

Converting any value to Boolean

var TRUTHY_VALUES = [true, 'true', 1];

function getBoolean(value) {
  'use strict';
   
  if (typeof value === 'string') { 
    value = value.toLowerCase().trim();
  }

  return TRUTHY_VALUES.some(function(t) {
    return t === value;
  });
}

getBoolean(false);   // false
getBoolean('false'); // false
getBoolean(1);       // true
getBoolean('true');  // true

Polyfill

some() was added to the ECMA-262 standard in the 5th edition; as such it may not be present in all implementations of the standard. You can work around this by inserting the following code at the beginning of your scripts, allowing use of some() in implementations which do not natively support it. This algorithm is exactly the one specified in ECMA-262, 5th edition, assuming Object and TypeError have their original values and that fun.call evaluates to the original value of Function.prototype.call().

// Production steps of ECMA-262, Edition 5, 15.4.4.17
// Reference: http://es5.github.io/#x15.4.4.17
if (!Array.prototype.some) {
  Array.prototype.some = function(fun, thisArg) {
    'use strict';

    if (this == null) {
      throw new TypeError('Array.prototype.some called on null or undefined');
    }

    if (typeof fun !== 'function') {
      throw new TypeError();
    }

    var t = Object(this);
    var len = t.length >>> 0;

    for (var i = 0; i < len; i++) {
      if (i in t && fun.call(thisArg, t[i], i, t)) {
        return true;
      }
    }

    return false;
  };
}


----------------------------------------------------------------------------------------

array.sort

The sort() method sorts the elements of an array in place and returns the array. The default sort order is built upon converting the elements into strings, then comparing their sequences of UTF-16 code units values.

The time and space complexity of the sort cannot be guaranteed as it is implementation dependent.

var months = ['March', 'Jan', 'Feb', 'Dec'];
months.sort();
console.log(months);
// expected output: Array ["Dec", "Feb", "Jan", "March"]

var array1 = [1, 30, 4, 21];
array1.sort();
console.log(array1);
// expected output: Array [1, 21, 30, 4]


Syntax

arr.sort([compareFunction])

Parameters

compareFunction Optional
    Specifies a function that defines the sort order. If omitted, the array is sorted according to each character's Unicode code point value, according to the string conversion of each element.

Return value

The sorted array. Note that the array is sorted in place, and no copy is made.
Description

If compareFunction is not supplied, all non-undefined array elements are sorted by converting them to strings and comparing strings in UTF-16 code units order. For example, "Banana" comes before "cherry". In a numeric sort, 9 comes before 80, but because numbers are converted to strings, "80" comes before "9" in Unicode order. All undefined elements are sorted to the end of the array.

Note : In UTF-16, Unicode characters above \uFFFF are encoded as two surrogate code units, of the range \uD800-\uDFFF. The value of each code unit is taken separately into account for the comparison. Thus the character formed by the surrogate pair \uD655\uDE55 will be sorted before the character \uFF3A.

If compareFunction is supplied, all non-undefined array elements are sorted according to the return value of the compare function (all undefined elements are sorted to the end of the array, with no call to compareFunction). If a and b are two elements being compared, then:

    If compareFunction(a, b) is less than 0, sort a to an index lower than b, i.e. a comes first.
    If compareFunction(a, b) returns 0, leave a and b unchanged with respect to each other, but sorted with respect to all different elements. Note: the ECMAscript standard does not guarantee this behaviour, and thus not all browsers (e.g. Mozilla versions dating back to at least 2003) respect this.
    If compareFunction(a, b) is greater than 0, sort b to an index lower than a, i.e. b comes first.
    compareFunction(a, b) must always return the same value when given a specific pair of elements a and b as its two arguments. If inconsistent results are returned then the sort order is undefined.

So, the compare function has the following form:

function compare(a, b) {
  if (a is less than b by some ordering criterion) {
    return -1;
  }
  if (a is greater than b by the ordering criterion) {
    return 1;
  }
  // a must be equal to b
  return 0;
}

To compare numbers instead of strings, the compare function can simply subtract b from a. The following function will sort the array ascending (if it doesn't contain Infinity and NaN):

function compareNumbers(a, b) {
  return a - b;
}

The sort method can be conveniently used with function expressions:

var numbers = [4, 2, 5, 1, 3];
numbers.sort(function(a, b) {
  return a - b;
});
console.log(numbers);

// [1, 2, 3, 4, 5]

Objects can be sorted given the value of one of their properties.

var items = [
  { name: 'Edward', value: 21 },
  { name: 'Sharpe', value: 37 },
  { name: 'And', value: 45 },
  { name: 'The', value: -12 },
  { name: 'Magnetic', value: 13 },
  { name: 'Zeros', value: 37 }
];

// sort by value
items.sort(function (a, b) {
  return a.value - b.value;
});

// sort by name
items.sort(function(a, b) {
  var nameA = a.name.toUpperCase(); // ignore upper and lowercase
  var nameB = b.name.toUpperCase(); // ignore upper and lowercase
  if (nameA < nameB) {
    return -1;
  }
  if (nameA > nameB) {
    return 1;
  }

  // names must be equal
  return 0;
});

Examples
Creating, displaying, and sorting an array

The following example creates four arrays and displays the original array, then the sorted arrays. The numeric arrays are sorted without, then with, a compare function.

var stringArray = ['Blue', 'Humpback', 'Beluga'];
var numericStringArray = ['80', '9', '700'];
var numberArray = [40, 1, 5, 200];
var mixedNumericArray = ['80', '9', '700', 40, 1, 5, 200];

function compareNumbers(a, b) {
  return a - b;
}

console.log('stringArray:', stringArray.join());
console.log('Sorted:', stringArray.sort());

console.log('numberArray:', numberArray.join());
console.log('Sorted without a compare function:', numberArray.sort());
console.log('Sorted with compareNumbers:', numberArray.sort(compareNumbers));

console.log('numericStringArray:', numericStringArray.join());
console.log('Sorted without a compare function:', numericStringArray.sort());
console.log('Sorted with compareNumbers:', numericStringArray.sort(compareNumbers));

console.log('mixedNumericArray:', mixedNumericArray.join());
console.log('Sorted without a compare function:', mixedNumericArray.sort());
console.log('Sorted with compareNumbers:', mixedNumericArray.sort(compareNumbers));

This example produces the following output. As the output shows, when a compare function is used, numbers sort correctly whether they are numbers or numeric strings.

stringArray: Blue,Humpback,Beluga
Sorted: Beluga,Blue,Humpback

numberArray: 40,1,5,200
Sorted without a compare function: 1,200,40,5
Sorted with compareNumbers: 1,5,40,200

numericStringArray: 80,9,700
Sorted without a compare function: 700,80,9
Sorted with compareNumbers: 9,80,700

mixedNumericArray: 80,9,700,40,1,5,200
Sorted without a compare function: 1,200,40,5,700,80,9
Sorted with compareNumbers: 1,5,9,40,80,200,700

Sorting non-ASCII characters

For sorting strings with non-ASCII characters, i.e. strings with accented characters (e, é, è, a, ä, etc.), strings from languages other than English: use String.localeCompare. This function can compare those characters so they appear in the right order.

var items = ['réservé', 'premier', 'cliché', 'communiqué', 'café', 'adieu'];
items.sort(function (a, b) {
  return a.localeCompare(b);
});

// items is ['adieu', 'café', 'cliché', 'communiqué', 'premier', 'réservé']

Sorting with map

The compareFunction can be invoked multiple times per element within the array. Depending on the compareFunction's nature, this may yield a high overhead. The more work a compareFunction does and the more elements there are to sort, the wiser it may be to consider using a map for sorting. The idea is to traverse the array once to extract the actual values used for sorting into a temporary array, sort the temporary array and then traverse the temporary array to achieve the right order.

// the array to be sorted
var list = ['Delta', 'alpha', 'CHARLIE', 'bravo'];

// temporary array holds objects with position and sort-value
var mapped = list.map(function(el, i) {
  return { index: i, value: el.toLowerCase() };
})

// sorting the mapped array containing the reduced values
mapped.sort(function(a, b) {
  if (a.value > b.value) {
    return 1;
  }
  if (a.value < b.value) {
    return -1;
  }
  return 0;
});

// container for the resulting order
var result = mapped.map(function(el){
  return list[el.index];
});


---------------------------------------------------------------------------

array.splice

The splice() method changes the contents of an array by removing existing elements and/or adding new elements.


var months = ['Jan', 'March', 'April', 'June'];
months.splice(1, 0, 'Feb');
// inserts at 1st index position
console.log(months);
// expected output: Array ['Jan', 'Feb', 'March', 'April', 'June']

months.splice(4, 1, 'May');
// replaces 1 element at 4th index
console.log(months);
// expected output: Array ['Jan', 'Feb', 'March', 'April', 'May']



Syntax

array.splice(start[, deleteCount[, item1[, item2[, ...]]]])

Parameters

start
    Index at which to start changing the array (with origin 0). If greater than the length of the array, actual starting index will be set to the length of the array. If negative, will begin that many elements from the end of the array (with origin -1) and will be set to 0 if absolute value is greater than the length of the array.
deleteCount Optional
    An integer indicating the number of old array elements to remove.
    If deleteCount is omitted, or if its value is larger than array.length - start (that is, if it is greater than the number of elements left in the array, starting at start), then all of the elements from start through the end of the array will be deleted.
    If deleteCount is 0 or negative, no elements are removed. In this case, you should specify at least one new element (see below).
item1, item2, ... Optional
    The elements to add to the array, beginning at the start index. If you don't specify any elements, splice() will only remove elements from the array.

Return value

An array containing the deleted elements. If only one element is removed, an array of one element is returned. If no elements are removed, an empty array is returned.
Description

If you specify a different number of elements to insert than the number you're removing, the array will have a different length at the end of the call.
Examples
Remove 0 (zero) elements from index 2, and insert "drum"

var myFish = ['angel', 'clown', 'mandarin', 'sturgeon'];
var removed = myFish.splice(2, 0, 'drum');

// myFish is ["angel", "clown", "drum", "mandarin", "sturgeon"] 
// removed is [], no elements removed

Remove 1 element from index 3

var myFish = ['angel', 'clown', 'drum', 'mandarin', 'sturgeon'];
var removed = myFish.splice(3, 1);

// removed is ["mandarin"]
// myFish is ["angel", "clown", "drum", "sturgeon"] 

Remove 1 element from index 2, and insert "trumpet"

var myFish = ['angel', 'clown', 'drum', 'sturgeon'];
var removed = myFish.splice(2, 1, 'trumpet');

// myFish is ["angel", "clown", "trumpet", "sturgeon"]
// removed is ["drum"]

Remove 2 elements from index 0, and insert "parrot", "anemone" and "blue"

var myFish = ['angel', 'clown', 'trumpet', 'sturgeon'];
var removed = myFish.splice(0, 2, 'parrot', 'anemone', 'blue');

// myFish is ["parrot", "anemone", "blue", "trumpet", "sturgeon"] 
// removed is ["angel", "clown"]

Remove 2 elements from index 2

var myFish = ['parrot', 'anemone', 'blue', 'trumpet', 'sturgeon'];
var removed = myFish.splice(myFish.length - 3, 2);

// myFish is ["parrot", "anemone", "sturgeon"] 
// removed is ["blue", "trumpet"]

Remove 1 element from index -2

var myFish = ['angel', 'clown', 'mandarin', 'sturgeon'];
var removed = myFish.splice(-2, 1);

// myFish is ["angel", "clown", "sturgeon"] 
// removed is ["mandarin"]

Remove all elements after index 2 (incl.)

var myFish = ['angel', 'clown', 'mandarin', 'sturgeon'];
var removed = myFish.splice(2);

// myFish is ["angel", "clown"] 
// removed is ["mandarin", "sturgeon"]


-----------------------------------------------
array.toLocaleString

The toLocaleString() method returns a string representing the elements of the array. The elements are converted to Strings using their toLocaleString methods and these Strings are separated by a locale-specific String (such as a comma “,”).

var array1 = [1, 'a', new Date('21 Dec 1997 14:12:00 UTC')];
var localeString = array1.toLocaleString('en', {timeZone: "UTC"});

console.log(localeString);
// expected output: "1,a,12/21/1997, 2:12:00 PM",
// This assumes "en" locale and UTC timezone - your results may vary


Syntax

arr.toLocaleString([locales[, options]]);

Parameters

locales Optional
    A string with a BCP 47 language tag, or an array of such strings. For the general form and interpretation of the locales argument, see the Intl page.
options Optional
    An object with configuration properties, for numbers see Number.prototype.toLocaleString(), and for dates see Date.prototype.toLocaleString().

Return value

A string representing the elements of the array.
Examples
Using locales and options

The elements of the array are converted to strings using their toLocaleString methods.

    Object: Object.prototype.toLocaleString()
    Number: Number.prototype.toLocaleString()
    Date: Date.prototype.toLocaleString()

Always display the currency for the strings and numbers in the prices array:

var prices = ['￥7', 500, 8123, 12]; 
prices.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY' });

// "￥7,￥500,￥8,123,￥12"

For more examples, see also the Intl, NumberFormat, and DateTimeFormat pages.
Polyfill

// https://tc39.github.io/ecma402/#sup-array.prototype.tolocalestring
if (!Array.prototype.toLocaleString) {
  Object.defineProperty(Array.prototype, 'toLocaleString', {
    value: function(locales, options) {
      // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }

      var a = Object(this);

      // 2. Let len be ? ToLength(? Get(A, "length")).
      var len = a.length >>> 0;

      // 3. Let separator be the String value for the 
      //    list-separator String appropriate for the 
      //    host environment's current locale (this is 
      //    derived in an implementation-defined way).
      // NOTE: In this case, we will use a comma
      var separator = ',';

      // 4. If len is zero, return the empty String.
      if (len === 0) {
        return '';
      }

      // 5. Let firstElement be ? Get(A, "0").
      var firstElement = a[0];
      // 6. If firstElement is undefined or null, then
      //  a.Let R be the empty String.
      // 7. Else,
      //  a. Let R be ? 
      //     ToString(? 
      //       Invoke(
      //        firstElement, 
      //        "toLocaleString", 
      //        « locales, options »
      //       )
      //     )
      var r = firstElement == null ? 
        '' : firstElement.toLocaleString(locales, options);

      // 8. Let k be 1.
      var k = 1;

      // 9. Repeat, while k < len
      while (k < len) {
        // a. Let S be a String value produced by 
        //   concatenating R and separator.
        var s = r + separator;

        // b. Let nextElement be ? Get(A, ToString(k)).
        var nextElement = a[k];

        // c. If nextElement is undefined or null, then
        //   i. Let R be the empty String.
        // d. Else,
        //   i. Let R be ? 
        //     ToString(? 
        //       Invoke(
        //        nextElement, 
        //        "toLocaleString", 
        //        « locales, options »
        //       )
        //     )
        r = nextElement == null ? 
          '' : nextElement.toLocaleString(locales, options);

        // e. Let R be a String value produced by 
        //   concatenating S and R.
        r = s + r;

        // f. Increase k by 1.
        k++;
      }

      // 10. Return R.
      return r;
    }
  });
}

If you need to support truly obsolete JavaScript engines that don't support Object.defineProperty, it's best not to polyfill Array.prototype methods at all, as you can't make them non-enumerable.

----------------------------------------------


array.toString

The toString() method returns a string representing the specified array and its elements.


var array1 = [1, 2, 'a', '1a'];

console.log(array1.toString());
// expected output: "1,2,a,1a"


Syntax

arr.toString()

Return value

A string representing the elements of the array.
Description

The Array object overrides the toString method of Object. For Array objects, the toString method joins the array and returns one string containing each array element separated by commas.

JavaScript calls the toString method automatically when an array is to be represented as a text value or when an array is referred to in a string concatenation.
ECMAScript 5 semantics

Starting in JavaScript 1.8.5 (Firefox 4), and consistent with ECMAScript 5th edition semantics, the toString() method is generic and can be used with any object. Object.prototype.toString() will be called, and the resulting value will be returned.

-----------------------------------------------------------------

array.unshift

The unshift() method adds one or more elements to the beginning of an array and returns the new length of the array.

var array1 = [1, 2, 3];

console.log(array1.unshift(4, 5));
// expected output: 5

console.log(array1);
// expected output: Array [4, 5, 1, 2, 3]


Syntax

arr.unshift(element1[, ...[, elementN]])

Parameters

elementN
    The elements to add to the front of the array.

Return value

The new length property of the object upon which the method was called.
Description

The unshift method inserts the given values to the beginning of an array-like object.

unshift is intentionally generic; this method can be called or applied to objects resembling arrays. Objects which do not contain a length property reflecting the last in a series of consecutive, zero-based numerical properties may not behave in any meaningful manner.
Examples

var arr = [1, 2];

arr.unshift(0); // result of call is 3, the new array length
// arr is [0, 1, 2]

arr.unshift(-2, -1); // = 5
// arr is [-2, -1, 0, 1, 2]

arr.unshift([-3]);
// arr is [[-3], -2, -1, 0, 1, 2]

--------------------------------------

array.values

The values() method returns a new Array Iterator object that contains the values for each index in the array.

const array1 = ['a', 'b', 'c'];
const iterator = array1.values();

for (const value of iterator) {
  console.log(value); // expected output: "a" "b" "c"
}

var a = ['w', 'y', 'k', 'o', 'p']; 
var iterator = a.values();

console.log(iterator.next().value); // w 
console.log(iterator.next().value); // y 
console.log(iterator.next().value); // k 
console.log(iterator.next().value); // o 
console.log(iterator.next().value); // p

Syntax

arr.values()

Return value

A new Array iterator object.
Examples
Iteration using for...of loop

var arr = ['w', 'y', 'k', 'o', 'p'];
var iterator = arr.values();

for (let letter of iterator) {
  console.log(letter);
}

Array.prototype.values is default implementation of Array.prototype[Symbol.iterator].

Array.prototype.values === Array.prototype[Symbol.iterator]      //true

TODO please write about why we need it, usecases.
------------------------------------------------------------------------------END