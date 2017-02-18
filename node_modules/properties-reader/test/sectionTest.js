var Assertions = require('unit-test').Assertions,
    Sinon = require('unit-test').Sinon,
    TestCase = require('unit-test').TestCase,
    FileSystem = require('fs'),
    propertiesReader = require('../src/PropertiesReader.js'),
    properties;

function tempFile(content) {
    tempFile.nextName = (tempFile.nextName || 0) + 1;
    (tempFile.files = tempFile.files || []).push(__dirname + '/temp_file_' + tempFile.nextName + '.properties');
    FileSystem.writeFileSync(tempFile.files[tempFile.files.length - 1], content, 'utf-8');
}

function givenFilePropertiesReader(content) {
    tempFile(content);
    properties = propertiesReader(tempFile.files[tempFile.files.length - 1]);
}

module.exports = new TestCase("Section", {

    setUp: function() {
    },

    tearDown: function() {
        while (tempFile.files && tempFile.files.length) {
            var filePath = tempFile.files.pop();
            try {
                FileSystem.unlink(filePath);
            }
            catch (e) {
            }
        }
    },

    'test Able to read file with sections that are already properties': function () {
        givenFilePropertiesReader([
           'some = thing',
           'section = value',
           '[section]',
           'sub = property'
        ].join('\n'));

        Assertions.assertEquals(properties.get('section'), 'value', 'give precedence to the name');
        Assertions.assertEquals(properties.get('section.sub'), 'property', 'gets the child property');
        Assertions.assert(Sinon.match({'': 'value', 'sub': 'property'}).test(properties.path().section),
           'gets an object with the empty string property equal to outer section value');
    },

    'test Ignores comment blocks': function () {
        givenFilePropertiesReader([
           'some = thing',
           ' # section = value',
           'section = another value'
        ].join('\n'));

        Assertions.assertEquals(properties.get('section'), 'another value', 'ignores the comment');
    },

    'test Able to read from a file with sections': function() {
        givenFilePropertiesReader('some.property = Value\n\n' +
            '[section]\n another.property = Something\n\n' +
            '[blah]\n another.property = Something Else');

        Assertions.assertEquals(properties.get('some.property'), 'Value', 'Values are read into the properties object');
        Assertions.assertEquals(properties.get('section.another.property'), 'Something', 'Values are read into the properties object');
        Assertions.assertEquals(properties.path().blah.another.property, 'Something Else', 'Values are read into the properties object');
    },

    'test Able use section names with white space': function() {
        givenFilePropertiesReader('some.property = Value\n\n' +
            '[submodule foo]\n another.property = Something\n\n' +
            '[some thing in here]\n another.property = Something Else');
        Assertions.assertEquals(properties.path()['submodule foo'].another.property, 'Something', 'Values are read into the properties object');
    }
});
