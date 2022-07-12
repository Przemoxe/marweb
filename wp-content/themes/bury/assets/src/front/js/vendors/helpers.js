/**
* Swap array / object key values 
*/
function flip(json)
{
  var ret = {};
  
  for(var key in json)
  {
    ret[json[key]] = key;
  }
  
  return ret;
}

/**
* Shortcut for console log
* 
* @param {*} variable 
*/
function dump(variable)
{
  console.log(variable);
}

var debounceTimeout;
function debounce(func, wait, immediate) {
  var context = this, args = arguments;
  var later = function() {
    debounceTimeout = null;
    if (!immediate) func.apply(context, args);
  };
  var callNow = immediate && !debounceTimeout;
  clearTimeout(debounceTimeout);
  
  debounceTimeout = setTimeout(later, wait);
  if (callNow) func.apply(context, args);
}

var ScriptTag = {
  load: function(id, src, callback, parent) {
    var script = document.createElement('script'),
    loaded;
    script.setAttribute('src', src);
    script.setAttribute('id', id);
    if (callback) {
      script.onreadystatechange = script.onload = function() {
        if (!loaded) {
          setTimeout(function () {
            callback();
          }, 300);
        }
        loaded = true;
      };
    }
    if (parent) {
      parent.appendChild(script);
    }
    else {
      document.getElementsByTagName('body')[0].appendChild(script);
    }
  }
};

var cloneAttributes = function(element, sourceNode) 
{
  var  attributes = sourceNode.attributes;
  
  for (var index = 0; index < attributes.length; index++)
  {
    const attr = attributes[index];
    element.setAttribute(attr.name, attr.value);
  }
}

var insertAfter = function(newNode, referenceNode) 
{
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}