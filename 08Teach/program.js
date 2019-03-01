/*console.log("HELLO WORLD")

var result = 0
for (var i = 2; i < process.argv.length; i++)
    result += Number(process.argv[i])
console.log(result)


var fs = require('fs');
var filename = process.argv[2];
file = fs.readFileSync(filename); //read
content = file.toString();
console.log(content.split('\n').length - 1);


var fs = require('fs')
var filename = process.argv[2]
fs.readFile(filename, function callback(err, content){
console.log(content.toString().split('\n').length - 1)
})

var fs = require('fs')
var path = require('path')
var folder = process.argv[2]
var extension = '.' + process.argv[3]

fs.readdir(folder, function (err, files){
    if (err) return console.error(err)
    files.forEach(function(file){
        if(path.extname(file) === extension) {
            console.log(file)
        }              
    })
})
*/

var fs = require('fs')
var path = require('path')
var dir = process.argv[2]
var filterStr = '.' + process.argv[3]

function getFile(dir, filterStr, callback){
    fs.readdir(dir, function(err, list){
        if (err)
            return callback(err)
        list = list.filter(function (file){
            return path.extname(file) === '.' + filterStr
        })
        
        callback(null, list)
    })
}

getFiles(dir, filterStr, function(err, list){
    if(err)
        return console.error('There was an error:', err)
    
    list.forEach(function (file){
        console.log(file)
    })
})

