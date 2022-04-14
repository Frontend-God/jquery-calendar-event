<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <script>
        // Ignore this in your implementation
        window.isMbscDemo = true;
    </script>

    <title>Add/edit/delete events</title>

    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="css/mobiscroll.javascript.min.css">
    <script src="js/mobiscroll.javascript.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style type="text/css">
    body {
        margin: 0;
        padding: 0;
    }

    body,
    html {
        height: 100%;
    }

    .event-color-c {
        display: flex;
        margin: 16px;
        align-items: center;
        cursor: pointer;
    }
    
    .event-color-label {
        flex: 1 0 auto;
    }
    
    .event-color {
        width: 30px;
        height: 30px;
        border-radius: 15px;
        margin-right: 10px;
        margin-left: 240px;
        background: #5ac8fa;
    }
    
    .crud-color-row {
        display: flex;
        justify-content: center;
        margin: 5px;
    }
    
    .crud-color-c {
        padding: 3px;
        margin: 2px;
    }
    
    .crud-color {
        position: relative;
        min-width: 46px;
        min-height: 46px;
        margin: 2px;
        cursor: pointer;
        border-radius: 23px;
        background: #5ac8fa;
    }
    
    .crud-color-c.selected,
    .crud-color-c:hover {
        box-shadow: inset 0 0 0 3px #007bff;
        border-radius: 48px;
    }
    
    .crud-color:before {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -10px;
        margin-left: -10px;
        color: #f7f7f7;
        font-size: 20px;
        text-shadow: 0 0 3px #000;
        display: none;
    }
    
    .crud-color-c.selected .crud-color:before {
        display: block;
    }
    </style>

</head>
<body>

<div mbsc-page class="demo-create-read-update-delete-CRUD">
  <div style="height:100%">
      <div id="demo-add-delete-event"></div>
    
    <div id="demo-add-popup">
        <div class="mbsc-form-group">
            <label>
                Title
                <input mbsc-input id="event-title">
            </label>
            <label>
                Description
                <textarea mbsc-textarea id="event-desc"></textarea>
            </label>
        </div>
        <div class="mbsc-form-group">
            <label>
                All-day
                <input mbsc-switch id="event-all-day" type="checkbox" />
            </label>
            <label>
                Starts
                <input mbsc-input id="start-input" />
            </label>
            <label>
                Ends
                <input mbsc-input id="end-input" />
            </label>
            <div id="event-date"></div>
            <div id="event-color-picker" class="event-color-c">
                <div class="event-color-label">Color</div>
                <div id="event-color-cont">
                    <div id="event-color" class="event-color"></div>
                </div>
            </div>
            <label>
                Show as busy
                <input id="event-status-busy" mbsc-segmented type="radio" name="event-status" value="busy">
            </label>
            <label>
                Show as free
                <input id="event-status-free" mbsc-segmented type="radio" name="event-status" value="free">
            </label>
            <div class="mbsc-button-group">
                <button class="mbsc-button-block" id="event-delete" mbsc-button data-color="danger" data-variant="outline">Delete event</button>
            </div>
        </div>
    </div>
    
    <div id="demo-event-color">
        <div class="crud-color-row">
            <div class="crud-color-c" data-value="#ffeb3c">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#ffeb3c"></div>
            </div>
            <div class="crud-color-c" data-value="#ff9900">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#ff9900"></div>
            </div>
            <div class="crud-color-c" data-value="#f44437">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#f44437"></div>
            </div>
            <div class="crud-color-c" data-value="#ea1e63">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#ea1e63"></div>
            </div>
            <div class="crud-color-c" data-value="#9c26b0">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#9c26b0"></div>
            </div>
        </div>
        <div class="crud-color-row">
            <div class="crud-color-c" data-value="#3f51b5">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#3f51b5"></div>
            </div>
            <div class="crud-color-c" data-value="">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check"></div>
            </div>
            <div class="crud-color-c" data-value="#009788">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#009788"></div>
            </div>
            <div class="crud-color-c" data-value="#4baf4f">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#4baf4f"></div>
            </div>
            <div class="crud-color-c" data-value="#7e5d4e">
                <div class="crud-color mbsc-icon mbsc-font-icon mbsc-icon-material-check" style="background:#7e5d4e"></div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    mobiscroll.setOptions({
        locale: mobiscroll.localeEn,                                  // Specify language like: locale: mobiscroll.localePl or omit setting to use default
        theme: 'ios',                                                 // Specify theme like: theme: 'ios' or omit setting to use default
        themeVariant: 'light'                                         // More info about themeVariant: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-themeVariant
    });
    
    var oldEvent,
        tempEvent = {},
        deleteEvent,
        restoreEvent,
        colorPicker,
        tempColor,
        titleInput = document.getElementById('event-title'),
        descriptionTextarea = document.getElementById('event-desc'),
        allDaySwitch = document.getElementById('event-all-day'),
        freeSegmented = document.getElementById('event-status-free'),
        busySegmented = document.getElementById('event-status-busy'),
        deleteButton = document.getElementById('event-delete'),
        colorSelect = document.getElementById('event-color-picker'),
        pickedColor = document.getElementById('event-color'),
        colorElms = document.querySelectorAll('.crud-color-c'),
        datePickerResponsive = {
            medium: {
                controls: ['calendar'],
                touchUi: false
            }
        },
        datetimePickerResponsive = {
            medium: {
                controls: ['calendar', 'time'],
                touchUi: false
            }
        },
        myData = [];

    // get all events from database when the page is loaded
    $.get('newLoad.php', function(res) {
        myData = JSON.parse(res);
        for(var i = 0; i < myData.length; i ++) {
            myData[i]['allDay'] = myData[i]['allDay'] == 'true' ? true : false;
            myData[i]['free'] = myData[i]['free'] == 'true' ? true : false;
        }

        // format date from input value
        function formatDateTime(str) {
            var d = new Date(str);
            var year = d.getFullYear();
            var month = d.getMonth();
            var date = d.getDate();
            var time = d.getHours();
            var minute = d.getMinutes();
            
            return year + '-' + (Number(month) + 1) + '-' + date + ' ' + time + ':' + minute;
        }

        function createAddPopup(elm) {
            // hide delete button inside add popup
            deleteButton.style.display = 'none';
        
            deleteEvent = true;
            restoreEvent = false;
        
            // set popup header text and buttons for adding
            popup.setOptions({
                headerText: 'New event',                                  // More info about headerText: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-headerText
                buttons: ['cancel', {                                     // More info about buttons: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-buttons
                    text: 'Add',
                    keyCode: 'enter',
                    handler: function () {
                        var start = tempEvent.start;
                        var end = tempEvent.end;
                        
                        var calendarData = {
                            id: tempEvent.id,
                            title: tempEvent.title,
                            description: tempEvent.description ? tempEvent.description : '',
                            allDay: tempEvent.allDay,
                            start: start,
                            end: end,
                            color: tempEvent.color ? tempEvent.color : '',
                            free: tempEvent.free ? tempEvent.free : false
                        }

                        // json data can be passed to api
                        var data = {
                            id: tempEvent.id,
                            title: tempEvent.title,
                            description: tempEvent.description ? tempEvent.description : '',
                            allDay: tempEvent.allDay,
                            start: formatDateTime(start),
                            end: formatDateTime(end),
                            color: tempEvent.color ? tempEvent.color : '',
                            free: tempEvent.free ? tempEvent.free : false
                        }

                        // insert new event to database
                        $.post('newInsert.php', data, function(res) {
                            calendar.updateEvent(calendarData);
        
                            // navigate the calendar to the correct view
                            calendar.navigate(tempEvent.start);
            
                            deleteEvent = false;
                            popup.close();
                        })
                    },
                    cssClass: 'mbsc-popup-button-primary'
                }]
            });
        
            // fill popup with a new event data
            mobiscroll.getInst(titleInput).value = tempEvent.title;
            mobiscroll.getInst(descriptionTextarea).value = '';
            mobiscroll.getInst(allDaySwitch).checked = true;
            range.setVal([tempEvent.start, tempEvent.end]);
            mobiscroll.getInst(busySegmented).checked = true;
            range.setOptions({ controls: ['date'], responsive: datePickerResponsive });
            pickedColor.style.background = '';
        
            // set anchor for the popup
            popup.setOptions({ anchor: elm });
        
            popup.open();
        }
        
        function createEditPopup(args) {
            var ev = args.event;
        
            // show delete button inside edit popup
            deleteButton.style.display = 'block';
        
            deleteEvent = false;
            restoreEvent = true;
        
            // set popup header text and buttons for editing
            popup.setOptions({
                headerText: 'Edit event',                                 // More info about headerText: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-headerText
                buttons: ['cancel', {                                     // More info about buttons: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-buttons
                    text: 'Save',
                    keyCode: 'enter',
                    handler: function () {
                        var date = range.getVal();

                        // json data can be passed to api
                        var data = {
                            id: ev.id,
                            title: titleInput.value,
                            description: descriptionTextarea.value,
                            allDay: mobiscroll.getInst(allDaySwitch).checked,
                            start: formatDateTime(date[0]),
                            end: formatDateTime(date[1]),
                            free: mobiscroll.getInst(freeSegmented).checked,
                            color: ev.color,
                        }

                        // update the current event in the database
                        $.post('newUpdate.php', data, function(res) {
                            calendar.updateEvent({
                                id: ev.id,
                                title: titleInput.value,
                                description: descriptionTextarea.value,
                                allDay: mobiscroll.getInst(allDaySwitch).checked,
                                start: date[0],
                                end: date[1],
                                free: mobiscroll.getInst(freeSegmented).checked,
                                color: ev.color,
                            });
            
                            // navigate the calendar to the correct view
                            calendar.navigate(date[0]);
            
                            restoreEvent = false;
                            popup.close();
                        })
                        // update event with the new properties on save button click
                    },
                    cssClass: 'mbsc-popup-button-primary'
                }]
            });
        
            // fill popup with the selected event data
            mobiscroll.getInst(titleInput).value = ev.title || '';
            mobiscroll.getInst(descriptionTextarea).value = ev.description || '';
            mobiscroll.getInst(allDaySwitch).checked = ev.allDay || false;
            range.setVal([ev.start, ev.end]);
            pickedColor.style.background = ev.color || '';
        
            if (ev.free) {
                mobiscroll.getInst(freeSegmented).checked = true;
            } else {
                mobiscroll.getInst(busySegmented).checked = true;
            }
        
            // change range settings based on the allDay
            range.setOptions({
                controls: ev.allDay ? ['date'] : ['datetime'],
                responsive: ev.allDay ? datePickerResponsive : datetimePickerResponsive
            });
        
            // set anchor for the popup
            popup.setOptions({ anchor: args.domEvent.currentTarget });
            popup.open();
        }
        
        var calendar = mobiscroll.eventcalendar('#demo-add-delete-event', {
            clickToCreate: 'double',                                      // More info about clickToCreate: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-clickToCreate
            dragToCreate: true,                                           // More info about dragToCreate: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-dragToCreate
            dragToMove: true,                                             // More info about dragToMove: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-dragToMove
            dragToResize: true,                                           // More info about dragToResize: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-dragToResize
            view: {                                                       // More info about view: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-view
                calendar: { labels: true }
            },
            data: myData,                                                 // More info about data: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-data
            onEventClick: function (args) {                               // More info about onEventClick: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#event-onEventClick
                oldEvent = Object.assign({}, args.event);
                tempEvent = args.event;
        
                if (!popup.isVisible()) {
                    createEditPopup(args);
                }
            },
            onEventCreated: function (args) {                             // More info about onEventCreated: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#event-onEventCreated
                popup.close();
                // store temporary event
                tempEvent = args.event;
                createAddPopup(args.target);
            },
            // function for dragToCreate, dragToMove, dragToResize
            onEventUpdated: function(args) {
                tempEvent = args.event;

                // json data can be passed to api
                var data = {
                    id: tempEvent.id,
                    title: tempEvent.title,
                    description: tempEvent.description,
                    allDay: tempEvent.allDay,
                    start: formatDateTime(tempEvent.start),
                    end: formatDateTime(tempEvent.end),
                    color: tempEvent.color ? tempEvent.color : '',
                    free: tempEvent.free ? tempEvent.free : false
                };
              
                // update the current event in the database
                $.post('newUpdate.php', data, function(res) {
                    calendar.updateEvent(tempEvent);
                })
            }
        });
        
        var popup = mobiscroll.popup('#demo-add-popup', {
            display: 'bottom',                                            // Specify display mode like: display: 'bottom' or omit setting to use default
            contentPadding: false,
            fullScreen: true,
            onClose: function () {                                        // More info about onClose: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#event-onClose
                if (deleteEvent) {
                    calendar.removeEvent(tempEvent);
                } else if (restoreEvent) {
                    calendar.updateEvent(oldEvent);
                }
            },
            responsive: {                                                 // More info about responsive: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-responsive
                medium: {
                    display: 'anchored',                                  // Specify display mode like: display: 'bottom' or omit setting to use default
                    width: 400,                                           // More info about width: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-width
                    fullScreen: false,
                    touchUi: false
                }
            }
        });
        
        titleInput.addEventListener('input', function (ev) {
            // update current event's title
            tempEvent.title = ev.target.value;
        });
        
        descriptionTextarea.addEventListener('change', function (ev) {
            // update current event's title
            tempEvent.description = ev.target.value;
        });
        
        allDaySwitch.addEventListener('change', function () {
            var checked = this.checked
            // change range settings based on the allDay
            range.setOptions({
                controls: checked ? ['date'] : ['datetime'],
                responsive: checked ? datePickerResponsive : datetimePickerResponsive
            });
        
            // update current event's allDay property
            tempEvent.allDay = checked;
        });
        
        var range = mobiscroll.datepicker('#event-date', {
            controls: ['date'],
            select: 'range',
            startInput: '#start-input',
            endInput: '#end-input',
            showRangeLabels: false,
            touchUi: true,
            responsive: datePickerResponsive,                             // More info about responsive: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-responsive
            onChange: function (args) {
                var date = args.value;
                // update event's start date
                tempEvent.start = date[0];
                tempEvent.end = date[1];
            }
        });
        
        document.querySelectorAll('input[name=event-status]').forEach(function (elm) {
            elm.addEventListener('change', function () {
                // update current event's free property
                tempEvent.free = mobiscroll.getInst(freeSegmented).checked;
            });
        });
        
        deleteButton.addEventListener('click', function () {
            // delete current event on button click
            $.post('newDelete.php', oldEvent, function(res) {
                calendar.removeEvent(oldEvent);
                popup.close();
            })
        
            // save a local reference to the deleted event
            var deletedEvent = tempEvent;

            // json data can be passed to api
            var data = {
                id: deletedEvent.id,
                title: deletedEvent.title,
                description: deletedEvent.description,
                allDay: deletedEvent.allDay,
                start: formatDateTime(deletedEvent.start),
                end: formatDateTime(deletedEvent.end),
                color: deletedEvent.color,
                free: deletedEvent.free
            }
            mobiscroll.snackbar({ 
                button: {
                    // restore the deleted event to database
                    action: function () {
                        $.post('newInsert.php', data, function(res) {
                            calendar.addEvent(deletedEvent);
                        })
                    },
                    text: 'Undo'
                },
                message: 'Event deleted'
            });
        });
        
        colorPicker = mobiscroll.popup('#demo-event-color', {
            display: 'bottom',                                            // Specify display mode like: display: 'bottom' or omit setting to use default
            contentPadding: false,
            showArrow: false,
            showOverlay: false,
            buttons: [                                                    // More info about buttons: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-buttons
                'cancel',
                {
                    text: 'Set',
                    keyCode: 'enter',
                    handler: function (ev) {
                        setSelectedColor();
                    },
                    cssClass: 'mbsc-popup-button-primary'
                }
            ],
            responsive: {                                                 // More info about responsive: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-responsive
                medium: {
                    display: 'anchored',                                  // Specify display mode like: display: 'bottom' or omit setting to use default
                    anchor: document.getElementById('event-color-cont'),  // More info about anchor: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-anchor
                    buttons: {}                                           // More info about buttons: https://docs.mobiscroll.com/5-12-1/javascript/eventcalendar#opt-buttons
                }
            }
        });
        
        function selectColor(color, setColor) {
            var selectedElm = document.querySelector('.crud-color-c.selected');
            var newSelected = document.querySelector('.crud-color-c[data-value="' + color + '"]');
        
            if (selectedElm) {
                selectedElm.classList.remove('selected')
            }
            if (newSelected) {
                newSelected.classList.add('selected')
            }
            if (setColor) {
                pickedColor.style.background = color || '';
            }
        }
        
        function setSelectedColor() {
            tempEvent.color = tempColor;
            pickedColor.style.background = tempColor;
            colorPicker.close();
        }
        
        colorSelect.addEventListener('click', function () {
            selectColor(tempEvent.color || '');
            colorPicker.open();
        });
        
        colorElms.forEach(function (elm) {
            elm.addEventListener('click', function () {
                tempColor = elm.getAttribute('data-value');
                selectColor(tempColor);
        
                if (!colorPicker.s.buttons.length) {
                    setSelectedColor();
                }
            });
        });
    })
</script>

</body>
</html>
