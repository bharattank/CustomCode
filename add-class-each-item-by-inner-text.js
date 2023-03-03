jQuery(document).ready(function($){
    $('.tagcloud .tagcloud--item').each(function(index, value) {
      $(this).addClass(makeSafeForCSS($(this).text()));
      console.log($(this.classList)); 
    }); 
});
function makeSafeForCSS(name) {
    return name.replace(/[^a-z0-9]/g, function(s) {
        var c = s.charCodeAt(0);
        if (c == 32) return '-';
        if (c >= 65 && c <= 90) return s.toLowerCase();
        return ('000' + c.toString(16)).slice(-4);
    });
}