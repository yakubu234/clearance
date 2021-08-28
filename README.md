# clearance_system


/* base url fetcher */ 
function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
    }else{
        var url = location.origin+'/'; // http://myurl.com
    }
    return url;
}
var base_url = base_url();

new readme to add to check whatsup