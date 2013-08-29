String.prototype.rot13 = rot13 = function(s)
{
    return s.replace(/[a-zA-Z]/g, function(c) {
        return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
    });
};


function rot(t, u, v)
{
	return String.fromCharCode(((t-u+v)%(v*2))+u);
}

function rot5(text)
{
	var b = [], c, i = text.length,
	zero = '0'.charCodeAt(), nine = '9'.charCodeAt();
	
	while(i--)
	{
		c = text.charCodeAt(i);
		if (c>=zero && c<=nine)
			b[i] = rot(c, zero, 5);
		else
			b[i] = text.charAt(i);
	}
	return b.join('');
}

function rot13(text)
{
	var b = [], c, i = text.length,
	a = 'a'.charCodeAt(), z = a + 26,
	A = 'A'.charCodeAt(), Z = A + 26;
	
	while(i--)
	{
		c = text.charCodeAt(i);
		if (c>=a && c<z)
			b[i] = rot(c, a, 13);
		else if(c>=A && c<Z)
			b[i] = rot(c, A, 13);
		else
			b[i] = text.charAt(i);
	}
	return b.join('');
}

function rot18(text)
{
	var b = [], c, i = text.length,
	a = 'a'.charCodeAt(), z = a + 26,
	A = 'A'.charCodeAt(), Z = A + 26,
	zero = '0'.charCodeAt(), nine = '9'.charCodeAt();
	
	while(i--)
	{
		c = text.charCodeAt(i);
		if (c>=a && c<z)
			b[i] = rot(c, a, 13);
		else if(c>=A && c<Z)
			b[i] = rot(c, A, 13);
		else if (c>=zero && c<=nine)
			b[i] = rot(c, zero, 5);
		else
			b[i] = text.charAt(i);
	}
	return b.join('');
}

function rot47(text)
{
	var b = [], c, i = text.length,
	first = '!'.charCodeAt(), last = '~'.charCodeAt();
	
	while(i--)
	{
		c = text.charCodeAt(i);
		if (c>=first && c<=last)
			b[i] = rot(c, first, 47);
		else
			b[i] = text.charAt(i);
	}
	return b.join('');
}