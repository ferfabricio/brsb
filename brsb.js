function showStateUnits(uf) {
    var data = {
        action: 'brsb_get_unit_by_uf',
        uf: uf
    };

    jQuery.post(ajax_object.ajax_url, data, function(response){
        var resultHtml = '';
        if(response && response.status == 'OK') {
            for (var i = 0; i < response.data.length; i++) {
                resultHtml  = '<div class="brsb-unit-city-name">' + response.data[i].name + '</div>';
                resultHtml += '<div class="brsb-unit-description">' + response.data[i].description + '</div>';
                resultHtml += '<div class="brsb-clear"></div>';
            }
        } else {
            resultHtml = response.data;
        }
        jQuery('.brsb-result').html(resultHtml);
    });
}
