var adminHelper = {
    base_url: "",
    url: '',
    title: '',
    pagename: 'default',
    AllEvents: [],
    tempObject: {},
    mkConfig: {},
    init: function () {
        this.createNotification();
    },
    setbaseURL: function () {
        this.base_url = $("#base_url").val();
    },
    initNotification: function () {
        this.mkConfig = {
            positionY: 'bottom',
            positionX: 'right',
            max: 5,
            scrollable: true
        };
    },
    callNotification: function () {
        mkNotifications(this.mkConfig);
    }, setTitle: function (value) {
        adminHelper.title = value;
    },
    updateNotification: function (value) {
        mkNoti(
                'New lead from : ' + value.website + '',
                '' + value.name + ' from ' + value.country + ' asked for ' + value.report.substr(0, 50) + '..',
                {

                    // Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
                    status: 'light',
                    // Custom icon
                    icon: {
                        class: null,
                        color: null,
                        background: null
                    },
// Linkify the notification box
                    link: {
                        url: null,
                        target: '_self',
                        function: null
                    },
// Is dismissable?
                    dismissable: true,
// Auto dismisses after 7 seconds
                    duration: 20000,
// Callback function
                    callback: null,
// Enable sounds
                    sound: false,
// Custom sound files
                    customSound: null,
                }
        );
    }, setupdatedPopup: function (value) {
        var percent = 0;
        if (value.status == 1) {
            var type = "success";
            var typebtn = "fa fa-check";
        } else {
            var type = "info";
            var typebtn = "fa fa-info";
        }
        var notice = new PNotify({
            text: 'New lead from : ' + value.website + '',
            type: type,
            icon: typebtn,
            hide: false,
            text: '<a class="details" href="javascript:void(0);" data-id="' + value.id + '" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' + value.report + '"> <b>' + value.name + ' </b> <br/>From <b>' + value.country + '</b> <br/>Asked for <b>' + value.report + '</b></a>',
            buttons: {
                closer: true,
                sticker: true
            },
            shadow: true,
            width: "250px"
        });
//        setTimeout(function () {
//            notice.update({
//                title: false
//            });
//            var interval = setInterval(function () {
//                percent += 2;
//                var options = {
////                    text: percent + "% complete."
//                    text: '<a class="details" href="javascript:void(0);" data-id="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Riley VanHorn From United States asked for Global Jail Management Software Market Size, Status and Forecast 2025">VanHorn From United States asked for Global Jail Management Software Market Size, Status and Forecast 2025</a>'
//                };
////                if (percent == 80)
////                    options.title = "Almost There";
//                if (percent >= 100) {
//                    window.clearInterval(interval);
//                    options.title = "Done!";
//                    options.type = "success";
//                    options.hide = true;
//                    options.buttons = {
//                        closer: true,
//                        sticker: true
//                    };
//                    options.icon = 'fa fa-check';
//                    options.shadow = true;
//                    options.width = PNotify.prototype.options.width;
//                }
//                notice.update(options);
//            }, 120);
//        }, 200);

    }, getNotification: function () {
        $.ajax({
            url: this.base_url + '/getpopupNotification',
            type: "POST",
            data: {},
            dataType: "json",
            success: function (returndata) {
                adminHelper.createNotification(returndata);
                adminHelper.updateNotification(returndata);
            },
            beforeSend: function () {
//                helAddEvent.enableWaitCursor();
            },
            complete: function () {
            }
        }); //end ajax
    }, updateNotification: function (eventObj) {
        $.each(eventObj, function (index, value) {

            adminHelper.updateLeadStatus(value.id, "0");

        });
    }, updateLeadStatus: function (leadid, status) {
        $.ajax({
            url: $("#base_url").val() + '/updatestatus',
            type: "POST",
            data: {data_id: leadid, status: status},
            dataType: "json",
            success: function (returndata) {
//                    console.log(returndata);
            },
            beforeSend: function () {
//                helAddEvent.enableWaitCursor();
            },
            complete: function () {
//                    helAddEvent.updateNotification(returndata);
            }
        }); //end ajax
    }, createNotification: function (eventObj) {
        $.each(eventObj, function (index, value) {
            adminHelper.setupdatedPopup(value);
        });
    }, appendNotification: function (data) {
        $('#filterdiv').html('');
        if (data.length > 0)
        {
            $("#filterdiv").html(data);
        }

    }, getExecutive: function () {
        $.ajax({
            url: this.base_url + '/sales_executive',
            type: "POST",
            data: {},
            dataType: "json",
            success: function (returndata) {
                adminHelper.setExecutiveList(returndata);
            },
            beforeSend: function () {
//                helAddEvent.enableWaitCursor();
            },
            complete: function () {
            }
        }); //end ajax
    },
    makeOptionSelected: function (drp, optionToBeSelect) {
        $("." + drp).val(optionToBeSelect);
    },
    setExecutiveList: function (resource) {
        $('.executive-for-drp').empty();
        var sales_id = $('.executive-for-drp').attr('sale-id');

        $('.executive-for-drp').append($('<option value="">Select Executive</option>'));
        if (Object.keys(resource).length > 0) {
            $.each(resource, function (key, value) {

                $('.executive-for-drp').append($('<option>', {value: value.id}).text(value.name));
            });
        }
    }, assignLeadtoExe: function (val) {
        var leadid = $(val).attr('lead-id');
        var id = $(val).attr('data-id');
        var sales_id = $(val).val();
        $.ajax({
            url: $("#base_url").val() + "user/chngExc/" + sales_id + "/" + id,
            // data: {"bookID": book_id},
            type: 'get',
            success: function (result)
            {
                adminHelper.updateLeadStatus(leadid, "2");
                location.reload();
            }
        });
    }, setleadlist: function () {

        var statusVal = $("#status").val();
        $('#leadsdata').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": $("#base_url").val() + "admin_leads",
                "dataType": "json",
                "type": "POST",
                "data": {statusVal: statusVal, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                complete: function () {
                    adminHelper.getExecutive();
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "created_at"},
                {"data": "country"},
                {"data": "website"},
                {"data": "message"},
                {"data": "report"},
                {"data": "executive_list"},
//                {"data": "status"},
                {"data": "action"}
            ]

        });
    }, viewLeadDetails: function (vaL) {
        var id = $(vaL).attr('data-id');
        var stat = $(vaL).attr('data-status');
        $.ajax({
            url: $("#base_url").val() + "sales_exc/details/" + id + "/" + stat,
            // data: {"bookID": book_id},
            type: 'get',
            success: function (result)
            {
                $("#myModal").html(result);
                $('#myModal').modal('show');
            }
        });
    }

};
/*----------------END method for add user  code-----------------------*/
$(document).on('keyup change', '#search', function () {

});
$(document).on('click', '#ta3rget', function () {
});
$(document).on('change', '.target', function () {
    adminHelper.assignLeadtoExe(this);
});
$(document).on('click', '.details', function () {
    adminHelper.viewLeadDetails(this);
});
$(document).on('click', '.edit', function () {
    var id = $(this).attr('data-id');
    window.location = $("#base_url").val() + "sales_exc/edit/" + id;
});
$(document).ready(function () {
    adminHelper.setbaseURL();
    adminHelper.setleadlist();
    adminHelper.init();
    setInterval(function () {
        adminHelper.getNotification();
    }, 20000);
});