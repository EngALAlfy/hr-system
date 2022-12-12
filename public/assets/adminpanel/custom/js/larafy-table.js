$.fn.larafy = function (options) {

    // get table parent ( to add the form inside it then move table to the form)
    var parent = this.parent();

    // defaults
    var settings = $.extend({
        route: window.location.href,
    } , options);

    // create the form
    var form = $('<form>' , {action: settings.route , method:'GET'});
    // add form to parent
    parent.append(form);
    // move the table inside the form
    form.append(this);

}
