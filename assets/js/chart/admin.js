(function($) {
'use strict';

	$(function () {

		var Chart = function() {

            var chart = this;

            this.options = {
                chartType : $("#weblator_charts_chart_type")
            }

            function init(){

                showLegendOption();
                showLegendOptionsSecondary();
                showPercentageOptions();
								showDataSets();
								reorderOptions();
								sortable();


                //Load Style Options
                if ($(".new-chart").length)
                loadStyleSettings(chart.options.chartType.val());

                chart.options.chartType.change(function(){
                    loadStyleSettings(chart.options.chartType.val());
                    showLegendOption();
                    showPercentageOptions();
										showDataSets();

                });

                $("button.add-option").click(function(e){
					e.preventDefault();
                    addNewOption(this);
                });



                $(".save-button").click(function(){
                    saveChart(this);
                });

                $("body").on("change", "input[type='checkbox']", function(){
                    $(this).val((Number(this.checked)));
                });

                $(".delete_chart").click(function(e){
                    e.preventDefault();
                   deleteChart(this);
                });

                $("table.chart-options").on("click", ".poll-option-remove", function(){
                    deletePollOption(this);
                });

				$("body").on("click", ".add-data-set", function(){
                    addDataSet(this);
                });

                $("body").on("change", "input.default-styles", function(){
                    showOverrideStyles(this);
                });

                $("body").on("click", ".close-data-set", function(){
                    deleteDataSet(this);
                });

                $("body").on("keyup", ".poll-option", function(){
                    updateChartOptionsValue(this);
                });


                $("#chart_legend").change(function(){
                   showLegendOptionsSecondary();
                });

				$(".main-data-set .import-button").click(function(e){
					e.preventDefault();
					$(".csv-import-container").slideDown();
				});

                if ($(".new-chart").length){
                	reorderOptions();
                	showPickers();
                }

				$(".main-data-set table.chart-options tr").each(function(i){

					var order_id = $(this).attr("data-sort-id");

					$(".hide-data-set table.chart-options tr:nth-child("+(i+1)+")").attr("data-sort-id", order_id);

				});

				$(".file-select-button").click(function(){
					$("#chooseFile").trigger("click");
				})

				$('#chooseFile').bind('change', function () {
					chooseUploadFile();
				});

				$(".download-csv").click(function(e){
					e.preventDefault();

					window.location = csv_path;

				});

				//$("body").on("click", ".file-select-upload", function(e){

					//e.preventDefault();
					var form = document.getElementById('csv-upload');
					form.onsubmit = function() {
	  				    var formData = new FormData(form);

	  				    sendXHRequest(formData);
	  				    return false;
	  				}

				//});
            }

			function sendXHRequest(formData) {

				var xhr = new XMLHttpRequest();

				xhr.upload.addEventListener('progress', onprogressHandler, false);
				xhr.addEventListener('readystatechange', onreadystatechangeHandler, false);

				formData.append('action', 'importCSV');
				formData.append('first_row', ( $(".file-select-first-row input").is(":checked") ) ? true : false );

				xhr.open("POST", ajaxurl, true);

				xhr.onload = function () {

					var json = $.parseJSON(this.responseText);

					if ( json.error ) {

						$(".file-upload").removeClass('active').addClass('file-error');
						$(".file-select-upload").remove();
						$(".import-progress-bar .bg-color").css("width", 0);
						$("#noFile").text(json.error);

					}else {

						//Remove exsisting data first
						$(".response-settings:not(.main-data-set)").remove();
						$(".main-data-set tr:not(:first-child)").remove();

						var titles = [];
						//If first line as title is set then add them to the data set title inputs
						if ( $(".file-select-first-row input").is(":checked") ) {

							var i = 0;
							$.each(json[0], function(d, e){

								if ( i > 0 )
									titles.push(d);
								i++;
							});

						}

						for ( var i = 0; i < json.length; i++ ){

							var x = 0;
							$.each(json[i], function(idx, value){

								//Check and see if we should add a new dataset
								if ( i == 0 ) {

									if ( $(".file-select-first-row input").is(":checked") ){

										var count = 0;
										var co;

										for (co in json[i]) {
										    if (json[i].hasOwnProperty(co)) {
										        count++;
										    }
										}

									}else {
										var count = json[i].length;
									}

									if (chart.options.chartType.val() == 1 || chart.options.chartType.val() == 4 || chart.options.chartType.val() == 5){

										if ( (count - 1) == x  ){

											var datasetLength = count - 2;

											for ( var c = 0; c < datasetLength; c++ )
												$(".add-data-set").trigger("click");

										}
									}
								}

								if ( $(".file-select-first-row input").is(":checked") ) {

									$(".response-settings").each(function(ind){
										$(this).find(".data-set-title").val(titles[ind])
									});
								}

								if ( x == 0 ){

									//Add Rows
									$(".main-data-set tr:last").each(function(){
										$(this).find("[name='chart_option']").val(json[i][idx]);
										$(this).find("[name='chart_option']").trigger("keyup");
									});

									if ( i != (json.length - 1) )
										$("button.add-option").trigger("click");

								} else {

									$(".response-settings").each(function(index){

										$(this).find("tr td input[name='chart_value']").each(function(aidx){

											if ( $(".file-select-first-row input").is(":checked") ){
												var keys = Object.keys( json[aidx] );
												var val = keys[index + 1];
												$(this).val(json[aidx][val]);

											} else
												$(this).val(json[aidx][index + 1]);
										});



									});
								}

								x++;
							});

						}


					}


				};
				xhr.send(formData);
			}

			function doImport(){

			}

			function onprogressHandler(evt) {

				var percent = evt.loaded/evt.total*100;
				$(".import-progress-bar .bg-color").css("width", percent + "%");

			}



			function onreadystatechangeHandler(evt) {

				$("#noFile").text("Import Complete");

				setTimeout(function(){

					$(".file-upload").removeClass('active').removeClass('file-error');
					$(".file-select-upload").remove();
					$(".import-progress-bar .bg-color").css("width", 0);

					$("#noFile").text("");

				}, 2000);

			}

			function setUpProgressBar() {

				var pb = $(".import-progress-bar"),
					formWidth = $(".file-select").outerWidth(),
					chooseButtonWidth = $(".file-select-button").outerWidth(),
					uploadButtonWidth = $(".file-select-upload").outerWidth(),
					pbLeft = parseInt(pb.css("left").replace("px"));

				pb.css({
					left : pbLeft + "px",
					width : (formWidth - uploadButtonWidth - pbLeft) + "px"
				});

			}

			function chooseUploadFile() {

				$(".file-upload").removeClass('active').removeClass('file-error');
				$(".file-select-upload").remove();
				$(".import-progress-bar .bg-color").css("width", 0);

				var filename = $("#chooseFile").val();

				if (/^\s*$/.test(filename)) {

					$(".file-upload").removeClass('active');
					$("#noFile").text("No file chosen...");

				} else {

					filename = filename.replace("C:\\fakepath\\", "");

					if ( validateFile( filename ) ) {

						$(".file-upload").addClass('active');
					    $("#noFile").text( filename );

						var uploadButton = $("<input>")
							.addClass("file-select-upload")
							.attr("id", "upload")
							.attr("type", "submit")
							.val("Upload File");

						$("#noFile").after(uploadButton);

						setUpProgressBar();

					} else {

						$(".file-upload").addClass('file-error');
						$("#noFile").text("File must be a CSV");
					}


				}

			}

			function validateFile(fileName) {

			    var allowed_extensions = new Array("csv");
			    var file_extension = fileName.split('.').pop();

			    for(var i = 0; i <= allowed_extensions.length; i++)
			    {
			        if(allowed_extensions[i]==file_extension)
			        {
			            return true;
			        }
			    }

			    return false;
			}

            function showPercentageOptions(){

                if (chart.options.chartType.val() == 7){
                    $(".percentage-options").css("display", "table-row");
                }else {
                    $(".percentage-options").css("display", "none");
                }

            }


            function deletePollOption(e){

                if ($(".poll-option-remove:visible").length > 1){
					var sortID = $(e).closest("tr").attr("data-sort-id");
					$("[data-sort-id='"+ sortID +"']").remove();

				}


                reorderOptions();
            }

            function showLegendOption(){

                if (chart.options.chartType.val() == 2 || chart.options.chartType.val() == 3 || chart.options.chartType.val() == 6){
                    $(".legend-option").css("display", "table-row");
                }else {
                    $(".legend-option").css("display", "none");

                }

                showLegendOptionsSecondary();
            }

            function showLegendOptionsSecondary(){


                if ($(".legend-option:visible").length){


                    if ($("#chart_legend").is(":checked")){
                        $(".legend-option-secondary").css("display", "table-row");

                    }else{
                        $(".legend-option-secondary").css("display", "none");

                    }


                }else {

                    $(".legend-option-secondary").css("display", "none");

                }
            }

            function deleteChart(e) {

                var id = $(e).attr("data-chart-id");

                var data = {
                    action: "delete_chart",
                    chart_id : id
                };

                if (confirm('Are you sure you want to delete this chart?')) {
                    $.post(ajaxurl, data, function(response){
                        window.location = "?page=charts";
                    });
                }

            }

            function showColorSettings(chartTypeID){

                switch (parseInt(chartTypeID)) {

                    case 6:
                    case 2:
                    case 3:
                    case 7:
                        $("td.colour-option").css("display", "table-cell");
                        break;

                    default:
                        $("table:not(.override-styles) td.colour-option").css("display", "none");


                }

            }

            function loadStyleSettings(chartTypeID){

                showColorSettings(chartTypeID);

                $.post(ajaxurl, {action:"loadStyleSettings", chartTypeID:chartTypeID, chartID:$("input[name='save']").attr("data-chart-id")}, function(data){

                    var json = $.parseJSON(data);

                    for(var i = 0; i < json.length; i++){

                        var template = Handlebars.compile($("#optionRow").html());
                        var html = html + template(json[i]);
                    }


                    $(".chart-settings tbody").html(html);

                    showPickers();

                });
            }



            function showPercentageOptions(){

                if (chart.options.chartType.val() == 7){
                    $(".percentage-options").css("display", "table-row");
                }else {
                    $(".percentage-options").css("display", "none");
                }

            }

            function addNewOption(e){

				var template = Handlebars.compile($("#optionTmpl").html());
                var html = template();
                var randomnumber = Math.floor(Math.random() * (99999 - 11111 + 1)) + 11111;

                $(e).parent().find("table.chart-options tbody").append(html);
                $(e).parent().find("table.chart-options tbody tr:last-child").attr("data-sort-id", randomnumber);

                $(".hide-data-set").find(".chart-options tbody").append(html);
                $(".hide-data-set").find(".chart-options tbody tr:last-child").attr("data-sort-id", randomnumber);

                $(".hide-data-set").find(".poll-option, .poll-option-remove").prop("disabled", true);
                $(".hide-data-set").find(".drag").removeClass("drag").addClass("draged");

                showColorSettings(chart.options.chartType.val());
                destroyPickers();
                showPickers();
                reorderOptions();
            }

            function showPickers(){

                $(".fill input").spectrum({
                    showAlpha:true,
                    preferredFormat: "rgb",
                    showInput: true
                });

                $(".fill input").show();

            }

            function destroyPickers(){

                $(".fill input").spectrum("destroy");
            }

            function reorderOptions () {

                $("table.chart-options tr").each(function(i){

                    $(this).attr("data-order", i+1);

                });

                destroyPickers();
                showPickers();
            }

            function saveChart(e){


                var action = ($(e).hasClass("edit") ? "update_chart" : "save_chart");

                //Disable Update Button
                $(e).attr("disabled", "disabled");

                //If a message is visible then slide it up
                if ($("#message").is(':visible')){
                    $("#message").slideUp();
                }

                //Show the animated Spinner
                $(".delete-action").css("visibility", "visible");
                $(".delete-action span.spinner").css("display", "inline-block");

                //Get Poll Options
				var options = [];
                $("table.chart-options").each(function(i){
                    var self = this;

                    options[i] = [];
                    $(self).find("tr:visible").each(function(idx){

                        options[i].push([
                            parseInt($(this).attr("data-order")),
                            $(this).find("input[name='chart_option']").val(),
                            (idx + 1),
                            $(this).find("input[name='chart_colour']").val(),
                            $(this).find("input[name='chart_value']").val()
                        ]);

                    });

                });

				var over_styles = [];
				$(".override-styles").each(function(i){

					over_styles[i] = [
						$(this).find("[name='fill-color']").val(),
						$(this).find("[name='stroke-color']").val(),
						$(this).find("[name='point-color']").val(),
						$(this).find("[name='point-stroke-color']").val(),
						$(this).closest(".response-settings").find(".data-set-title").val()
					];

				});

				for (var i=0; i < options.length; i++){

                    for (var x=0; x < options[i].length; x++){

                        if (isNaN(parseInt(options[i][x][4]))){

                            //There was an error adding the chart so show error message
                            $("#message").removeClass("updated").addClass("error")
                                .html("<p>Option Values must be an Integer</p>");

                            $("#message").slideDown();

                            //Remove disabled attribute from update button
                            $(e).removeAttr("disabled");

                            $(".delete-action span.spinner").css("display", "none");
                            return;
                        }

                        if (chart.options.chartType.val() == 7 && parseInt(options[i][x][4]) > 100 && $("[name='chart_percentage_values']").val() == 1){

                            $("#message").removeClass("updated").addClass("error")
                                .html("<p>Option Values must be 100 or below</p>");

                            $("#message").slideDown();

                            //Remove disabled attribute from update button
                            $(e).removeAttr("disabled");

                            $(".delete-action span.spinner").css("display", "none");
                            return;
                        }
                    }
                }


                //Make sure all input that is necessary is complete
                if (!validateInput(options)){
                    $(e).removeAttr("disabled");
                    $(".delete-action span.spinner").css("display", "none");
                    return;
                }


                var styleValues = getStyleValues();
                var data = getPollData(e, action, options, styleValues, over_styles);

                //Post data to server
                $.post(ajaxurl, data, function(r){

                    if (r == 0){

                        //There was an error adding the chart so show error message
                        $("#message").removeClass("updated").addClass("error")
                            .html("<p>There was an error adding your chart please try again</p>");

                        $("#message").slideDown();

                        //Remove disabled attribute from update button
                        $(e).removeAttr("disabled");

                        $(".delete-action span.spinner").css("display", "none");

                    } else {

                        if (action == "save_chart")
                            window.location = "?page=charts&action=edit&m=1&edit_chart="+r;
                        else
                            window.location = "?page=charts&action=edit&m=1&edit_chart="+$(e).attr("data-chart-id");

                    }

                });
            }

            function validateInput(options){

                if ($("[name='weblator_chart_name']").val() == ""){

                    $("#message").removeClass("updated").addClass("error")
                        .html("<p>Please give your chart a title</p>").slideDown();

                    $(".delete-action i").css("visibility", "hidden");
                    $(self).removeAttr("disabled");
                    return false;
                }

                if (options.length == 1 && options[0][1] == ""){

                    $("#message").removeClass("updated").addClass("error")
                        .html("<p>Please add some options</p>");

                    $(".delete-action i").css("visibility", "hidden");
                    $(self).removeAttr("disabled");

                    $("#message").slideDown();
                    return false;
                }

                for(var i = 0; i < options.length; i++){

                    if (options[i][1] == ""){
                        $("#message").removeClass("updated").addClass("error")
                            .html("<p>Please do not leave any options blank</p>");

                        $(".delete-action i").css("visibility", "hidden");
                        $(self).removeAttr("disabled");

                        $("#message").slideDown();
                        return false;

                    }

                }


                return true;

            }

            function getStyleValues(){

                var values = [];
                $(".chart-settings input, .chart-settings select").each(function(){

                    var obj = {
                        key: $(this).attr("name"),
                        value: $(this).val(),
                        id: $(this).attr("data-style-id")
                    };

                    values.push(obj);

                });

                return values;
            }

            function getPollData(e, action, options, style, over_styles){

                return {

                    chart_id : $(e).attr("data-chart-id"),
                    action : action,
                    options : options,
					'_wpnonce': jQuery('#_wpnonce').val(),
					over_style : over_styles,
                    name : $("[name='weblator_chart_name']").val(),
                    chart : $("[name='weblator_charts_chart_type']").val(),
                    is_live : $('input[name="poll_status"]:checked').val(),
                    legend : $("[name='chart_legend']").val(),
                    legend_position : $("[name='weblator_charts_legend_position']").val(),
                    legend_font_size : $("[name='weblator_charts_legend_font_size']").val(),
                    legend_font_style : $("[name='weblator_charts_chart_legend_font_style']").val(),
                    legend_font_colour : $("[name='chart_legend_font_colour']").val(),
                    chart_percentage_values : $("[name='chart_percentage_values']").val(),
                    maxWidth : $('input[name="chart_max_width"]').val(),
					main_data_set_title : $(".main_data_set_title").val(),
					scale_label_append : $("#scale_label_append").val(),
					scale_label_prepend : $("#scale_label_prepend").val(),
                    styles : style
                }
            }

			function updateChartOptionsValue(e){

                var newVal = $(e).val();
                var orderID = $(e).closest("tr").attr("data-sort-id");

                $("tr[data-sort-id='"+ orderID +"']").find(".poll-option").val(newVal);
            }

			function showDataSets(){
                if (chart.options.chartType.val() == 1 || chart.options.chartType.val() == 4 || chart.options.chartType.val() == 5){
                    $("button.add-data-set").css("display", "block");
                    $(".hide-data-set").css("display", "block");
                }else {
                    $("button.add-data-set").css("display", "none");
                    $(".hide-data-set").css("display", "none");
                }
            }

			function addDataSet(e){

                var inputVals = [];
                $(".main-data-set").find("[name='chart_option']").each(function(){
                    var arr = {
                        option : $(this).val(),
                        sort : $(this).closest("tr").attr("data-sort-id")
                    };
                    inputVals.push(arr);
                });

                var html = Handlebars.compile($("#dataSet").html());
                var template = html(inputVals);

                $(e).before(template);
                $(".hide-data-set").css("display", "block");
				reorderOptions();
                sortable();
                showPickers();
            }

            function showOverrideStyles(e){

                // if ($(e).is(":checked")){
                //     $(e).parent().find(".override-styles").css("display", "table");
                //     showPickers();
                // }else {
                //     $(e).parent().find(".override-styles").css("display", "none");
                // }
            }

			function sortable(){

                $("table.chart-options tbody").sortable({

                    handle: ".drag",
                    placeholder: "ui-state-highlight",
                    update: reorderOptions,
                    items: "tr",
                    activate : function(event, ui){
                        chart.options.optionRowStart = ui.item.context.rowIndex;
                    },
                    deactivate : function(event, ui){

                        chart.options.optionRowEnd = ui.item.context.rowIndex;

                        var rowOrder = [];
                        $(".main-data-set table.chart-options tr").each(function(){
                           rowOrder.push($(this).attr("data-sort-id"));
                        });

                        $(".hide-data-set .chart-options").each(function(){

                            var self = this;

                            var rows = [];
                            for (var i = 0; i < rowOrder.length; i++)
                                rows.push($(self).find("tr[data-sort-id='" + rowOrder[i] +"']")[0]);

                            $(self).find("tbody").empty();


                            for (var i = 0; i < rows.length; i++){
                                $(self).find("tbody").append(rows[i]);
                            }


                        });

                    }

                });
            }

			function deleteDataSet(e){

                $(e).closest(".hide-data-set").slideUp(function(){
                    $(this).remove();
                });

            }


            init();
        };

				if ($('.style-settings').length) {
					var c = new Chart();
				}


		$('.row-actions span.duplicate').click(function(e){
			e.preventDefault();

			var id = $(this).find("a").attr("data-id");
			var wpnonce = $(this).find("a").attr("data-_wpnonce");

			$.post(ajaxurl, {action:'duplicate', id:id, '_wpnonce': wpnonce}, function(data) {
				// console.log(data);
				location.reload();
			});

		});

		$('.row-actions span.delete').click(function(e){
			e.preventDefault();
			var id = $(this).find("a").attr("data-id");
			var wpnonce = $(this).find("a").attr("data-_wpnonce");

			$.post(ajaxurl, {action:'delete_chart', id:id, '_wpnonce': wpnonce}, function(data) {
				// console.log(data);
				location.reload();
			});

		});

	});

}(jQuery));
