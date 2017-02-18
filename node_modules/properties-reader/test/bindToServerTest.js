
var Assertions = require('unit-test').Assertions,
    Sinon = require('unit-test').Sinon,
    TestCase = require('unit-test').TestCase,
    FileSystem = require('fs'),
    propertiesReader = require('../src/PropertiesReader.js'),
    properties;

function tempFile(content) {
   tempFile.nextName = (tempFile.nextName || 0) + 1;
   tempFile.files.push(__dirname + '/temp_file_' + tempFile.nextName + '.properties');
   FileSystem.writeFileSync(tempFile.files[tempFile.files.length - 1], content, 'utf-8');
}

tempFile.pushDir = function (path) {
   tempFile.dirs.push(path);
   return path;
};

function givenFilePropertiesReader(content) {
   tempFile(content);
   properties = propertiesReader(tempFile.files[tempFile.files.length - 1]);
   return properties;
}

module.exports = new TestCase("Bind properties to a server", {

   setUp: function() {
      tempFile.files = tempFile.files || [];
      tempFile.dirs = tempFile.dirs || [];
   },

   tearDown: function() {
      while(tempFile.files && tempFile.files.length) {
         var filePath = tempFile.files.pop();
         try {
            FileSystem.unlink(filePath);
         }
         catch(e) {}
      }
      while(tempFile.dirs && tempFile.dirs.length) {
         var dirPath = tempFile.dirs.pop();
         try {
            FileSystem.rmdirSync(dirPath);
         }
         catch(e) {}
      }
   },

   'test Creates directories when necessary - absolute paths': function () {
      var dirPath = tempFile.pushDir('/tmp/' + Math.floor(Math.random() * 1e10).toString(16));
      var app = {set: Sinon.spy()};
      givenFilePropertiesReader('\n\nsome.property.dir=' + dirPath + '\n\nfoo.bar = A Value').bindToExpress(app, null, true);

      Assertions.assert(require('fs').statSync(dirPath).isDirectory(), 'Should have created the absolute path directory');
   },

   'test Creates directories when necessary - relative paths': function () {
      var dirName = Math.floor(Math.random() * 1e10).toString(16);
      var dirBase = process.cwd();
      var dirPath = tempFile.pushDir(dirBase + '/' + dirName);
      var app = {set: Sinon.spy()};

      givenFilePropertiesReader('\n\nsome.property.dir=' + dirName + '\n\nfoo.bar = A Value').bindToExpress(app, dirBase, true);

      Assertions.assert(require('fs').statSync(dirPath).isDirectory(), 'Should have created the relative path directory');
   }
});
