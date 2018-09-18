/*!
 * Open source CAD system for RolePlaying Communities.
 * Copyright (C) 2017 Shane Gill
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.

 * This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
 */

// Full Screen Functionality
var href = window.location.href;
var hdir = href.substring(0, href.lastIndexOf('/')) + "/";

function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
    (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
        document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
        }
    }
}

// When the user presses enter in ncic_name it does a search
$("#ncic_name").keyup(function(event){
    if(event.keyCode == 13){
        $("#ncic_name_btn").click();
    }
});

// When the user presses enter in ncic_plate it does a search
$("#ncic_plate").keyup(function(event){
    if(event.keyCode == 13){
        $("#ncic_plate_btn").click();
    }
});

// When the user presses enter in ncic_weapon it does a search
$("#ncic_weapon").keyup(function(event){
    if(event.keyCode == 13){
        $("#ncic_weapon_btn").click();
    }
});

// Handles the NCIC Plate Lookup on cad.php
$('#ncic_plate_btn').on('click', function(e) {
    var plate = document.getElementById('ncic_plate').value;
    $('#ncic_plate_return').empty();

    $.ajax({
        cache: false,
        type: 'POST',
        url: hdir + '/actions/ncic.php',
        data: {'ncicPlate': 'yes',
                'ncic_plate' : plate},

        success: function(result)
        {
        console.log(result);
        data = JSON.parse(result);

        if (data['noResult'] == "true")
        {
            $('#ncic_plate_return').append("<p style=\"color:red;\">PLATE NOT FOUND");
        }
        else
        {
            var insurance_status = "";
            if (data['veh_insurance'] == "VALID")
            {
                insurance_status = "<span style=\"color: green;\">Valid</span>";
            }
            else
            {
            insurance_status = "<span style=\"color: red;\">"+data['veh_insurance']+"</span>";
            }

            var notes = "";
            if (data['notes'] == "")
            {
                notes = "NO VEHICLE NOTES";
            }
            else
            {
            notes = "<span style=\"font-weight: bold;\">"+data['notes']+"</span>";
            }

            var flags = "";
            if (data['flags'] == "NONE")
            {
                flags = "<span style=\"color: green;\">None</span>";
            }
            else
            {
            flags = "<span style=\"color: red;\">"+data['flags']+"</span>";
            }

            //Convert plate to phoentic
            var phoentic = "";
            var text = data['plate'];
            var result = '';

            text = text.toUpperCase();

            for (var i=0; i < text.length; i++)
            {
                switch (text.charAt(i))
                {
                    case 'A': result = result + 'ALPHA '; break;
                    case 'B': result = result + 'BRAVO '; break;
                    case 'C': result = result + 'CHARLIE '; break;
                    case 'D': result = result + 'DELTA '; break;
                    case 'E': result = result + 'ECHO '; break;
                    case 'F': result = result + 'FOXTROT '; break;
                    case 'G': result = result + 'GOLF '; break;
                    case 'H': result = result + 'HOTEL '; break;
                    case 'I': result = result + 'INDIA '; break;
                    case 'J': result = result + 'JULIET '; break;
                    case 'K': result = result + 'KILO '; break;
                    case 'L': result = result + 'LIMA '; break;
                    case 'M': result = result + 'MIKE '; break;
                    case 'N': result = result + 'NOVEMBER '; break;
                    case 'O': result = result + 'OSCAR '; break;
                    case 'P': result = result + 'PAPA '; break;
                    case 'Q': result = result + 'QUEBEC '; break;
                    case 'R': result = result + 'ROMEO '; break;
                    case 'S': result = result + 'SIERRA '; break;
                    case 'T': result = result + 'TANGO '; break;
                    case 'U': result = result + 'UNIFORM '; break;
                    case 'V': result = result + 'VICTOR '; break;
                    case 'W': result = result + 'WHISKEY '; break;
                    case 'X': result = result + 'X-RAY '; break;
                    case 'Y': result = result + 'YANKEE '; break;
                    case 'Z': result = result + 'ZULU '; break;
                    case ' ': result = result + newline + newline; break;
                    default: result = result + text.charAt(i) + ' ';
                }
            }

            phoentic = result;

            $('#ncic_plate_return').append("Plate: "+data['plate']+"<br/>Phoenetic: "+phoentic+"<br/>Primary Color: "+data['veh_pcolor']+"<br/>Secondary Color: "+data['veh_scolor']+"<br/>Make: "+data['veh_make']+"<br/>Model: "+data['veh_model']+"<br/>Owner: "+data['veh_ro']
            +"<br/>Insurance: "+insurance_status+"<br/>Flags: "+flags+"<br/><br/>Notes: "+notes);

            $("#ncic_plate_return").attr("tabindex",-1).focus();
        }
        },

        error:function(exception){alert('Exeption:'+exception);}
    });
});

// Handles the NCIC Name Lookup on cad.php
$('#ncic_name_btn').on('click', function(e) {
    var name = document.getElementById('ncic_name').value;
    $('#ncic_name_return').empty();

    $.ajax({
        cache: false,
        type: 'POST',
        url: hdir + "/actions/ncic.php",
        data: {'ncicName': 'yes',
                'ncic_name' : name},

        success: function(result)
        {
        console.log(result);
        data = JSON.parse(result);

        var textarea = document.getElementById("ncic_name_return");

        if (data['noResult'] == "true")
        {
            $('#ncic_name_return').append("<p style=\"color:red;\">NAME NOT FOUND");
        }
        else
        {
            if (data['noWarrants'] == "true")
            {
            var warrantText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">NO WARRANTS</span><br/>";
            }
            else
            {
            var warrantText = "";
            warrantText += "    Count: "+data.warrant_name.length+"<br/>";
            for (i=0; i<data.warrant_name.length; i++)
            {
                warrantText += "<span style=\"color:red\">&nbsp;&nbsp;&nbsp;&nbsp;"+data.warrant_name[i] + "</span><br/>";
            }
            }

            if (data['noCitations'] == "true")
            {
            var citationText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">NO CITATIONS</span><br/>";
            }
            else
            {
            var citationText = "";
            citationText += "    Count: "+data.citation_name.length+"<br/>";
            for (i=0; i<data.citation_name.length; i++)
            {
                citationText += "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: #F78F2B\">"+data.citation_name[i]+"</span><br/>";
            }
            }
			
            if (data['noArrests'] == "true")
            {
            var arrestText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">NO ARRESTS</span><br/>";
            }
            else
            {
            var arrestText = "";
            arrestText += "    Count: "+data.arrest_reason.length+"<br/>";
            for (i=0; i<data.arrest_reason.length; i++)
            {
                arrestText += "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: #F78F2B\">"+data.arrest_reason[i]+"</span><br/>";
            }
            }
			
            if (data['noWarnings'] == "true")
            {
            var warningText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">NO WARNINGS</span>";
            }
            else
            {
            var warningText = "";
            warningText += "    Count: "+data.warning_name.length+"<br/>";
            for (i=0; i<data.warning_name.length; i++)
            {
                warningText += "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: #F78F2B\">"+data.warning_name[i]+"</span><br/>";
            }
            }

            var dl_status_text = "";
            if (data['dl_status'] == "Valid")
            {
                dl_status_text = "<span style=\"color: green;\">Valid</span>";
            }
            else
            {
            dl_status_text = "<span style=\"color: red;\">"+data['dl_status']+"</span>";
            }
			
            var weapon_permit_text = "";
            if (data['weapon_permit'] == "Obtained")
            {
                weapon_permit_text = "<span style=\"color: green;\">Obtained</span>";
            }
            else
            {
            weapon_permit_text = "<span style=\"color: red;\">"+data['weapon_permit']+"</span>";
            }
			
            var deceased_text = "";
            if (data['deceased'] == "No")
            {
                deceased_text = "<span style=\"color: green;\">No</span>";
            }
            else
            {
            deceased_text = "<span style=\"color: red;\">"+data['deceased']+"</span>";
            }

            $('#ncic_name_return').append("Name: "+data['name']+"<br/>DOB: "+data['dob']+"<br/>Age: "+data['age']+"<br/>Sex: "+data['sex']
            +"<br/>Race: "+data['race']+"<br/>Hair Color: "+data['hair_color']
            +"<br/>Build: "+data['build']
            +"<br/>Address: "+data['address']
            +"<br/>DL Status: "+dl_status_text
			+"<br/>Weapon Permit: "+weapon_permit_text
			+"<br/>Deceased: "+deceased_text
			+"<br/><br/>Warnings:<br/>"+warningText+"<br/><br/>Citations:<br/>"+citationText+"<br/>Arrests:<br/>"+arrestText+"<br/>Warrants:<br/>"+warrantText);

            $("#ncic_name_return").attr("tabindex",-1).focus();
        }
        },

        error:function(exception){alert('Exeption:'+exception);}
    });
});


$('#ncic_weapon_btn').on('click', function(e) {
    var name = document.getElementById('ncic_weapon').value;
    $('#ncic_weapon_return').empty();

    $.ajax({
        cache: false,
        type: 'POST',
        url: hdir + "/actions/ncic.php",
        data: {'ncicWeapon': 'yes',
                'ncic_weapon' : name},

        success: function(result)
        {
        console.log(result);
        data = JSON.parse(result);

        var textarea = document.getElementById("ncic_weapon_return");

        if (data['noResult'] == "true")
        {
            $('#ncic_weapon_return').append("<p style=\"color:red;\">NAME NOT FOUND");
        }
        else
        {
            if (data['noWeapons'] == "true")
            {
            var weaponText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">No weapons</span><br/>";
            }
            else
            {
            var weaponText = "";
            for (i=0; i<data.weapon_name.length; i++)
            {
                weaponText += "<span style=\"color:red\">&nbsp;&nbsp;&nbsp;&nbsp;"+data.weapon_name[i] + "</span><br/>";
            }
            }
            var weapon_permit_text = "";
            if (data['weapon_permit'] == "Obtained")
            {
                weapon_permit_text = "<span style=\"color: green;\">Obtained</span>";
            }
            else
            {
            weapon_permit_text = "<span style=\"color: red;\">"+data['weapon_permit']+"</span>";
            }


            $('#ncic_weapon_return').append("Name: "+data['first_name']+" "+data['last_name']+"<br/>Weapon Permit: "+weapon_permit_text
            +"<br/><br/>Weapons: <br/>"+weaponText);

            $("#ncic_weapon_return").attr("tabindex",-1).focus();
        }
        },

        error:function(exception){alert('Exeption:'+exception);}
    });
});


// Handles autocompletion on the new call form
$( ".txt-auto" ).autocomplete({
    source: hdir + "actions/dispatchActions.php",
    minLength: 2
});
$( ".txt-auto" ).autocomplete( "option", "appendTo", ".newCallForm" );

$( ".txt-auto2" ).autocomplete({
    source: hdir + "actions/dispatchActions.php",
    minLength: 2
});
$( ".txt-auto2" ).autocomplete( "option", "appendTo", ".newCallForm" );

// Handles submission of the new call form
$(function() {
    $('.newCallForm').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            type: "POST",
            url: hdir + "actions/dispatchActions.php",
            data: {
                newCall: 'yes',
                details: $("#"+this.id).serialize()
            },
            success: function(response)
            {
            console.log(response);
            if (response == "SUCCESS")
            {

                $('#closeNewCall').trigger('click');

                new PNotify({
                title: 'Success',
                text: 'Successfully created call',
                type: 'success',
                styling: 'bootstrap3'
                });

                //Reset the form
                $('.newCallForm').find('input:text, textarea').val('');
                $('.newCallForm').find('select').val('').selectpicker('refresh');

                getCalls();
            }

            },
            error : function(XMLHttpRequest, textStatus, errorThrown)
            {
            console.log("Error");
            }

        });
    });
});

// Handles submission of the add narrative form
$(function() {
    $('.callDetailsForm').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            type: "POST",
            url: hdir + "actions/dispatchActions.php",
            data: {
                addNarrative: 'yes',
                callId: $('#call_id_det').val(),
                details: $("#"+this.id).serialize()
            },
            success: function(response)
            {
            console.log(response);
            if (response == "SUCCESS")
            {

                new PNotify({
                title: 'Success',
                text: 'Successfully added call narrative',
                type: 'success',
                styling: 'bootstrap3'
                });

                $('#callDetails').modal('toggle');

                $('.callDetailsForm').find('textarea').val('');
            }

            },
            error : function(XMLHttpRequest, textStatus, errorThrown)
            {
            console.log("Error");
            }


        });
    });
});

// Handles assigning a unit to a call
$(function() {
    $('.assignUnitForm').submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            type: "POST",
            url: hdir + "actions/dispatchActions.php",
            data: {
                assignUnit: 'yes',
                details: $("#"+this.id).serialize(),
            },
            success: function(response)
            {
            console.log(response);
            if (response == "SUCCESS")
            {
                $('#closeAssign').trigger('click');

                new PNotify({
                    title: 'Success',
                    text: 'Successfully assigned unit to call',
                    type: 'success',
                    styling: 'bootstrap3'
                });

                getCalls();
            }

            if (response == "ERROR")
            {
                $('#closeAssign').trigger('click');

                new PNotify({
                    title: 'Error',
                    text: 'You must select a unit to assign',
                    type: 'error',
                    styling: 'bootstrap3'
                });

                getCalls();
            }

            },
            error : function(XMLHttpRequest, textStatus, errorThrown)
            {
                console.log("Error");
            }

        });
    });
});

// Handles the active dispatchers for the dispatch page
function getActiveDispatchers() {
$.ajax({
        type: "GET",
        url: hdir + "actions/api.php",
        data: {
            getDispatchers: 'yes'
        },
        success: function(response)
        {
        $('#dispatchers').html(response);
        $('#dispatchersTable').DataTable({
            paging: false,
            searching: false
        });

        setTimeout(getActiveDispatchers, 5000);

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    });
}

// Handles the unavailable unit poller for the dispatch page
function getUnAvailableUnits() {
$.ajax({
        type: "GET",
        url: hdir + "actions/api.php",
        data: {
            getUnAvailableUnits: 'yes'
        },
        success: function(response)
        {
        $('#unAvailableUnits').html(response);

        // SG - Removed until the node/real time services come available. having datatables messes things up.
        /*$('#unAvailableUnitsTable').DataTable({
            searching: false,
            scrollY: "200px",
            lengthMenu: [[4, -1], [4, "All"]]
                });
        */
        setTimeout(getUnAvailableUnits, 5000);

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    });
}

// Handles the ajax query to auto populate the new call modal with available units
$('#newCall').on('show.bs.modal', function(e) {
    var $modal = $(this), userId = e.relatedTarget.id;

    $.ajax({
        cache: false,
        type: 'GET',
        url: hdir + 'actions/api.php',
        data: {'getActiveUnits': 'yes'},
        success: function(result)
        {
        data = JSON.parse(result);

        var mymodal = $('#newCallForm');
        var select = mymodal.find('#unit_1');
        select.empty();
        var select2 = mymodal.find('#unit_2');
        select2.empty();

        $.each(data, function(key, value) {
            select.append($("<option/>")
                        .val(key)
                        .text(value));

            select2.append($("<option/>")
                        .val(key)
                        .text(value));
        });

        select.selectpicker('refresh');
        select2.selectpicker('refresh');
        },

        error:function(exception){alert('Exeption:'+exception);}
    });
});

//Disables enter key in the call narrative textarea
$('#narrative').keypress(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
})

//Disables enter key in the add narrative textarea
$('#narrative_add').keypress(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
})

// Handles the ajax query to auto populate the assign modal with available units
$('#assign').on('show.bs.modal', function(e) {
    var $modal = $(this), callId = e.relatedTarget.id;

    callIdInput = $modal.find('input[name="callId"]');
    callIdInput.val(callId);

    $.ajax({
        cache: false,
        type: 'GET',
        url: hdir + 'actions/api.php',
        data: {'getActiveUnitsModal': 'yes'},
        success: function(result)
        {
        //console.log(result);
        data = JSON.parse(result);

        var mymodal = $('#assign');
        var select = mymodal.find('#unit');
        select.empty();

        $.each(data, function(key, value) {
            select.append($("<option/>")
                        .val(key)
                        .text(value));
        });

        select.selectpicker('refresh');
        },

        error:function(exception){alert('Exeption:'+exception);}
    });
});


// Handles the call details panel for the dispatch and responder pages
$('#callDetails').on('show.bs.modal', function(e) {
    var $modal = $(this), callId = e.relatedTarget.id;

    $.ajax({
        cache: false,
        type: 'GET',
        url: hdir + 'actions/api.php',
        data: {'getCallDetails': 'yes',
                'callId' : callId},
        success: function(result)
        {

        data = JSON.parse(result);

        var mymodal = $('#callDetails');
        mymodal.find('input[name="call_id_det"]').val(data['call_id']);
        mymodal.find('input[name="call_type_det"]').val(data['call_type']);
        mymodal.find('input[name="call_street1_det"]').val(data['call_street1']);
        mymodal.find('input[name="call_street2_det"]').val(data['call_street2']);
        mymodal.find('input[name="call_street3_det"]').val(data['call_street3']);
        mymodal.find('div[name="call_narrative"]').html('');
        mymodal.find('div[name="call_narrative"]').append(data['narrative']);

        },

        error:function(exception){alert('Exeption:'+exception);}
    });
});

function deleteUser(uid) {
    var $tr = $(this).closest('tr');
    var r = confirm("Are you sure you want to delete this user? This cannot be undone!");

    if (r == true)
    {
        $.ajax({
        type: "POST",
        url: hdir + "actions/dispatchActions.php",
        data: {
            deleteUser: 'yes',
            uid: uid
        },
        success: function(response)
        {
            console.log(response);
            $tr.find('td').fadeOut(1000,function(){
                $tr.remove();
            });

            new PNotify({
            title: 'Success',
            text: 'Successfully deleted user',
            type: 'success',
            styling: 'bootstrap3'
            });

            getCalls();
        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
            console.log("Error");
        }

        });
    }
    else
    {
        return; // Do nothing
    }
}

// Clears calls
function clearCall(btn_id) {
    var $tr = $(this).closest('tr');
    var r = confirm("Are you sure you want to clear this call? This will mark all assigned units on call active.");

    if (r == true)
    {
        $.ajax({
        type: "POST",
        url: hdir + "actions/dispatchActions.php",
        data: {
            clearCall: 'yes',
            callId: btn_id
        },
        success: function(response)
        {
            console.log(response);
            $tr.find('td').fadeOut(1000,function(){
                $tr.remove();
            });

            new PNotify({
            title: 'Success',
            text: 'Successfully cleared call',
            type: 'success',
            styling: 'bootstrap3'
            });

            getCalls();
        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
            console.log("Error");
        }

        });
    }
    else
    {
        return; // Do nothing
    }
}

// Gets calls
function getCalls() {
    var file = $(location).attr('pathname').split("/")[2]

    $.ajax({
        type: "GET",
        url: hdir + "actions/api.php",
        data: {
            getCalls: 'yes',
            type: file
        },
        success: function(response)
        {
        $('#live_calls').html(response);
        setTimeout(getCalls, 5000);

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    });
}

// Gets Mycalls
function getMyCall() {
    var file = $(location).attr('pathname').split("/")[2]

    $.ajax({
        type: "GET",
        url: hdir + "actions/api.php",
        data: {
            getMyCall: 'yes',
            type: file
        },
        success: function(response)
        {
        $('#mycall').html(response);
        setTimeout(getMyCall, 5000);

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    });
}

// Handles tones buttons
function priorityTone(type)
{
    if (type == "single")
    {
        var priorityButton = $('#priorityTone');
        var value = priorityButton.val();

        if (value == "0")
        {
            priorityButton.val("1");
            priorityButton.text("10-3 Tone - ACTIVE");
            sendTone("priority", "start");
        }
        else if (value == "1")
        {
            sendTone("priority", "stop");
            priorityButton.val("0");
            priorityButton.text("10-3 Tone");
        }
    }
    else if (type == "panic")
    {
        var recurringButton = $('#panicTone');
        var value = recurringButton.val();

        if (value == "0")
        {
            recurringButton.val("1");
            recurringButton.text("Panic Button - ACTIVE");
            sendTone("panic", "start");
        }
        else if (value == "1")
        {
            sendTone("panic", "stop");
            recurringButton.val("0");
            recurringButton.text("Panic Button");
        }
    }
    else if (type == "recurring")
    {
        var recurringButton = $('#recurringTone');
        var value = recurringButton.val();

        if (value == "0")
        {
            recurringButton.val("1");
            recurringButton.text("Priority Tone - ACTIVE");
            sendTone("recurring", "start");
        }
        else if (value == "1")
        {
            sendTone("recurring", "stop");
            recurringButton.val("0");
            recurringButton.text("Priority Tone");
        }
    }

 function sendTone(name, action)
 {
    $.ajax({
        type: "POST",
        url: hdir + "actions/api.php",
        data: {
            setTone: 'yes',
            tone: name,
            action: action
        },
        success: function(response)
        {
            if (response == "SUCCESS START")
            {
                new PNotify({
                title: 'Success',
                text: 'Successfully started tone. It might take up to 7 seconds before everyone hears it.',
                type: 'success',
                styling: 'bootstrap3'
                });
                
            }

            else if (response == "SUCCESS STOP")
            {
                new PNotify({
                title: 'Success',
                text: 'Successfully stopped tone',
                type: 'success',
                styling: 'bootstrap3'
                });
            }

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    });
 }
}

// Function to check and see if there are any active tones
function checkTones()
{
    $.ajax({
        type: "GET",
        url: hdir + "actions/api.php",
        data: {
            checkTones: 'yes'
        },
        success: function(response)
        {
            var file = $(location).attr('pathname').split("/")[2]
            data = JSON.parse(response);

            if (data['recurring'] == "ACTIVE")
            {
                var tag = $('#recurringToneAudio')[0];
                tag.play();

                priorityNotification.remove();
                priorityNotification.open();

                if (file == "dispatch")
                {
                    $('#recurringTone').val('1');
                    $('#recurringTone').text("Priority Tone - ACTIVE");
                }

            }
            else if (data['recurring'] == "INACTIVE")
            {
                priorityNotification.remove();

                if (file == "dispatch")
                {
                    $('#recurringTone').val('0');
                    $('#recurringTone').text("Priority Tone");
                }
            }


            if (data['priority'] == "ACTIVE")
            {
                var tag = $('#priorityToneAudio')[0];
                if (document.cookie.indexOf('priority=') == '-1'){
                    document.cookie = "priority=played;";
                    tag.play();

                    $('#priorityTone').val('1');
                    $('#priorityTone').text("10-3 Tone - ACTIVE");
                } else {
                    //Do nothing
                }
            }
            else if (data['priority'] == "INACTIVE")
            {
                // Make sure the played cookie is unset
                document.cookie = "priority=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                $('#priorityTone').val('0');
                $('#priorityTone').text("10-3 Tone");

            }
			
			if (data['panic'] == "ACTIVE")
            {
                var tag = $('#panicToneAudio')[0];
                if (document.cookie.indexOf('panic=') == '-1'){
                    document.cookie = "panic=played;";
                    tag.play();

                    $('#panicTone').val('1');
                    $('#panicTone').text("Panic Button - ACTIVE");
                } else {
                    //Do nothing
                }
            }
            else if (data['panic'] == "INACTIVE")
            {
                // Make sure the played cookie is unset
                document.cookie = "panic=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                $('#panicTone').val('0');
                $('#panicTone').text("Panic Button");

            }

            setTimeout(checkTones, 7000);
        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    })
}

function responderChangeStatus(element)
{
    statusInit = element.className;
    var status = element.value;

    //If a user has a space in their username, it'll cause some problems. First, we need to split the string by spaces which will generate
    // an array. Then, we need to remove the first item from the array which is presumably an "action". Then, we join the array again via spaces
    unit = statusInit.split(" ");
    unit.shift();
    unit.shift();
    unit = unit.join(' ');


    $.ajax({
        type: "POST",
        url: hdir +"actions/api.php",
        data: {
            changeStatus: 'yes',
            unit: unit,
            status: status
        },
        success: function(response)
        {
        console.log(response);
        if (response == "SUCCESS")
        {
            new PNotify({
            title: 'Success',
            text: 'Successfully modified status',
            type: 'success',
            styling: 'bootstrap3'
        });

        $('#statusSelect').val('').selectpicker('refresh');

        }

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }

    });
}

function getMyRank(id)
{
    console.log(id);

    $.ajax({
        type: "GET",
        url: hdir + "actions/profileActions.php",
        data: {
            getMyRank: 'yes',
            unit: id
        },
        success: function(response)
        {
        console.log(response);

            $("#my_rank option").filter(function() {
                return $.trim($(this).text()) == response
            }).prop('selected', true);

            $("#my_rank").selectpicker('refresh');

        },
        error : function(XMLHttpRequest, textStatus, errorThrown)
        {
        console.log("Error");
        }
    });
}
