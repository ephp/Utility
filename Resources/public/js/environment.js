function is_int(input) {
    return typeof(input) === 'number' && parseInt(input) === input;
}

function is_string(input) {
    return typeof(input) === 'string';
}

function is_array(input) {
    return typeof(input) === 'object';
}

function testaVariabile(variabile) {
    return !(eval('window.' + variabile) === undefined);
}

function testFunction(funzione) {
    fx = eval('window.' + funzione);
    if (fx === undefined) {
        return false;
    }
    return typeof(fx) === 'function';
}

function checkVariabili(exist) {
    if (!(testVariabile('noCheck') && noCheck)) {
        if (typeof exist === 'string') {
            if (eval('window.' + exist) === undefined) {
                alert("Definire '" + exist + "' per continuare");
            }
        }
        if (typeof exist === 'object') {
            exist.forEach(function(variabile) {
                if (eval('window.' + variabile) === undefined) {
                    alert("Definire '" + variabile + "' per continuare");
                }
            });
        }
    }
}

function serialize(_obj) {
    if (_obj === null) {
        return 'null';
    }
    // Let Gecko browsers do this the easy way
    if (typeof _obj.toSource !== 'undefined' && typeof _obj.callee === 'undefined') {
        return _obj.toSource();
    }
    // Other browsers must do it the hard way
    switch (typeof _obj) {
        // numbers, booleans, and functions are trivial:
        // just return the object itself since its default .toString()
        // gives us exactly what we want
        case 'number':
        case 'boolean':
        case 'function':
            return _obj;
            break;

            // for JSON format, strings need to be wrapped in quotes
        case 'string':
            return '\'' + _obj + '\'';
            break;

        case 'object':
            var str;
            if (_obj.constructor === Array || typeof _obj.callee !== 'undefined') {
                str = '[';
                var i, len = _obj.length;
                for (i = 0; i < len - 1; i++) {
                    str += serialize(_obj[i]) + ',';
                }
                str += serialize(_obj[i]) + ']';
            } else {
                str = '{';
                var key;
                for (key in _obj) {
                    str += key + ':' + serialize(_obj[key]) + ',';
                }
                str = str.replace(/\,$/, '') + '}';
            }
            return str;
            break;

        default:
            return 'UNKNOWN';
            break;
    }
}
