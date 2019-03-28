var notificationHelper = {
    base_url: "",
    url: '',
    title: '',
    pagename: 'default',
    AllEvents: [],
    tempObject: {},
    mkConfig: {},
    init: function () {
//        this.initNotification();
//        this.callNotification();
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
        notificationHelper.title = value;
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
        var notice = new PNotify({
            text: 'New lead from : ' + value.website + '',
            type: 'success',
            icon: 'fa fa-check',
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
                notificationHelper.createNotification(returndata);
                notificationHelper.updateNotification(returndata);
            },
            beforeSend: function () {
//                helAddEvent.enableWaitCursor();
            },
            complete: function () {
            }
        });//end ajax
    }, updateNotification: function (eventObj) {
        $.each(eventObj, function (index, value) {

            $.ajax({
                url: $("#base_url").val() + '/updatestatus',
                type: "POST",
                data: {data_id: value.id},
                dataType: "json",
                success: function (returndata) {
                    console.log(returndata);
                },
                beforeSend: function () {
//                helAddEvent.enableWaitCursor();
                },
                complete: function () {
//                    helAddEvent.updateNotification(returndata);
                }
            });//end ajax

        });

    }, createNotification: function (eventObj) {
        $.each(eventObj, function (index, value) {
            notificationHelper.setupdatedPopup(value);

        });

    }, appendNotification: function (data) {
        $('#filterdiv').html('');
        if (data.length > 0)
        {
            $("#filterdiv").html(data);
        }

    }, redirectToCategoryList: function () {

    }, setleadlist: function () {

        var statusVal = $("#status").val();
        $('#leadsdata').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": $("#base_url").val() + "sales_lead",
                "dataType": "json",
                "type": "POST",
                "data": {statusVal: statusVal, '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'}
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "country"},
                {"data": "message"},
                {"data": "report"},
                {"data": "website"},
                {"data": "created_at"},
                {"data": "status"},
                {"data": "action"}
            ]

        });
    }

};

/*----------------END method for add user  code-----------------------*/
$(document).on('keyup change', '#search', function () {

});

$(document).on('click', '#subfilter', function () {

});
$(document).on('change', '#categoryId', function () {

});


$(document).on('click', '.details', function () {
    var id = $(this).attr('data-id');
    var stat = $(this).attr('data-status');

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
});
$(document).on('click', '.edit', function () {
    var id = $(this).attr('data-id');
    window.location = $("#base_url").val() + "sales_exc/edit/" + id;
});
$(document).ready(function () {
    notificationHelper.setbaseURL();
    notificationHelper.setleadlist();
    notificationHelper.init();
    setInterval(function () {
        notificationHelper.getNotification();
    }, 20000);
});