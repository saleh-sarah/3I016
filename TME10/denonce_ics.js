function saisieFiable(input, re)
{
    if ( typeof(saisieFiable.counter) == 'undefined' ) {
        // Init
        saisieFiable.counter = 1;
    }

    var t = re.test(input.value);
    if (t)
	input.className = '';
    else {
	var s = document.getElementsByTagName('style')[0].sheet.cssRules.item(0);
	s.style.setProperty('border-width', (++saisieFiable.counter) +'px')
    }
    return t;
}