/**
 * Calc diff between arrays
 * 
 * @param Array a 
 */
Array.prototype.diff = function(a) 
{
    return this.filter(function(i) 
    {
        return a.indexOf(i) < 0;
    });
};