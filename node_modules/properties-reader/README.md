Properties-Reader
=================

An ini file compatible properties reader for [Node.JS](http://nodejs.org)

Installation
============

The easiest installation is through [NPM](http://npmjs.org):

    npm install properties-reader

Or clone the repo https://github.com/steveukx/properties and include the `/src/PropertiesReader.js` script.

API
===

Read properties from a file:

    var PropertiesReader = require('properties-reader');
    var properties = PropertiesReader('/path/to/properties.file');

The properties are then accessible either by fully qualified name, or if the property names are in dot-delimited
notation, they can be access as an object:

    // fully qualified name
    var property = properties.get('some.property.name');

    // by object path
    var property = properties.path().some.property.name;

To read more than one file, chain calls to the `.append()` method:

    properties.append('/another.file').append('/yet/another.file');

To read properties from a string, use the `.read()` method:

    properties.read('some.property = Value \n another.property = Another Value');

To set a single property into the properties object, use `.set()`:

    properties.set('property.name', 'Property Value');

When reading a `.ini` file, sections are created by having a line that contains just a section name in square
brackets. The section name is then prefixed to all property names that follow it until another section name is found
to replace the current section.

    # contents of properties file
    [main]
    some.thing = foo

    [blah]
    some.thing = bar

    // reading these back from the properties reader
    properties.get('main.some.thing') == 'foo';
    properties.get('blah.some.thing') == 'bar';

Checking for the current number of properties that have been read into the reader:

    var propertiesCount = properties.length;

The length is calculated on request, so if accessing this in a loop an efficiency would be achieved by caching the
value.

When duplicate names are found in the properties, the first one read will be replaced with the later one.

To get the complete set of properties, either loop through them with the `.each((key, value) => {})` iterator or
use the convenience method `getAllProperties` to return the complete set of flattened properties. 

Data Types
==========

Properties will automatically be converted to their regular data types when they represent true/false or numeric
values. To get the original value without any parsing / type coercion applied, use `properties.getRaw('path.to.prop')`.

Contributions
=============

If you find bugs or want to change functionality, feel free to fork and pull request.

