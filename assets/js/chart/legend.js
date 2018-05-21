function legend(parent, data) {

  var datas = data.hasOwnProperty('datasets') ? data.datasets : data;

  jQuery(parent).empty();

  for (var i = 0; i < datas.length; i++) {

    var span = jQuery('<div></div>')
        .html(datas[i].label)
        .addClass('weblator-label')
        .css({
          fontSize: jQuery(parent).attr('data-font-size') + 'px',
        });

    var title = jQuery('<li></li>')
        .attr('class', 'weblator-chart-legend-title')
        .append(span);

    var box = jQuery('<div></div>')
        .addClass('weblator-chart-legend-box')
        .css({
          backgroundColor: datas[i].color,
        });

    if (jQuery(parent).hasClass('tr'))
        title.append(box);
    else
        title.prepend(box);

    jQuery(parent).append(title);

  };
}

function dataSetLegend(data, id, width, chartType) {

  if (!jQuery('[data-chart-id="' + id + '"] ul.data-set-legend').length) {

    var list = jQuery('<ul></ul>')
        .addClass('data-set-legend')
        .css('width', '100%');

    for (var i = 0; i < data.datasets.length; i++) {

      if (data.datasets[i].title != null) {

        var span = jQuery('<div></div>')
            .html(data.datasets[i].title)
            .addClass('weblator-label');

        var title = jQuery('<li></li>')
            .attr('class', 'weblator-chart-legend-title')
            .append(span);

        var box = jQuery('<div></div>')
            .addClass('weblator-chart-legend-box')
            .css({
              backgroundColor: (chartType == 1) ? data.datasets[i].fillColor : data.datasets[i].pointColor,
              border: '1px solid ' + data.datasets[i].strokeColor,
              height:15,
              width:15,
            });

        title.append(box);

        list.append(title);

      }

    };

    jQuery('[data-chart-id="' + id + '"]').append(list);

  }

}
