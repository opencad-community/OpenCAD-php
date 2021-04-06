var href = window.location.href;
var hdir = href.substring(0, href.lastIndexOf('/')) + "/";

$('#civilianDetailsModal').on('show.bs.modal', function(e) {
    var $modal = $(this),
        civId = e.relatedTarget.id;


    $.ajax({
        cache: false,
        type: 'GET',
        url: '../../../../oc-includes/civActions.php',
        data: {
            'getCivilianDetails': 'yes',
            'nameId': civId
        },
        success: function(result) {
            console.log(result);
            data = JSON.parse(result);

            $('input[name="civName"]').val(data['name']);
            $('input[name="civDob"]').val(data['dob']);
            $('input[name="civAddress"]').val(data['address']);
            $('input[name="civSex"]').val(data['sex']);
            $('input[name="civRace"]').val(data['race']);
            $('input[name="civHair"]').val(data['hair_color']);
            $('input[name="civBuild"]').val(data['build']);
            $('input[name="civPlate"]').val(data['veh_plate']);
            $('input[name="civMake"]').val(data['veh_make']);
            $('input[name="civModel"]').val(data['veh_model']);
            $('input[name="civColor"]').val(data['veh_color']);


        },

        error: function(exception) {
            alert('Exeption:' + exception);
        }
    });
});

$('.datepicker').datepicker();

$(function() {
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});


$(function() {
    $(document).on('click', '#edit_nameBtn', function(e) {
        e.preventDefault();
        var edit_id = $(this).data('id');
        console.log(edit_id);
        $.ajax({
                url: '../../../../oc-includes/civActions.php',
                type: 'POST',
                data: 'editid=' + edit_id,
                dataType: 'json',
                cache: false
            })
            .done(function(data) {
                $('#IdentityEditModal #civNameReq').val(data.name);
                $('#IdentityEditModal #datepicker2').datepicker({
                    dateFormat: 'yy-mm-dd'
                }).datepicker('setDate', new Date(data.dob));
                $('#IdentityEditModal #civAddressReq').val(data.address);
                $('.selectpicker3').selectpicker('val', data.gender);
                $('.civRaceReq_picker').selectpicker('val', data.race);
                $('.civDL_picker').selectpicker('val', data.dl_status);
                $('.civHairReq_picker').selectpicker('val', data.hairColor);
                $('.civBuildReq_picker').selectpicker('val', data.build);
                $('.civWepStat_picker').selectpicker('val', data.weapon_permit);
                $('.civDec_picker').selectpicker('val', data.deceased);
                $('#IdentityEditModal .Editdataid').val(data.id);
            });

    })
    /* Edit Plate */
    $(document).on('click', '#edit_plateBtn', function(e) {
        e.preventDefault();
        var edit_id = $(this).data('id');
        console.log(edit_id);
        $.ajax({
                url:  '../../../../oc-includes/civActions.php',
                type: 'POST',
                data: 'edit_plateid=' + edit_id,
                dataType: 'json',
                cache: false
            })
            .done(function(data) {
                $('.civilian_names').selectpicker('val', data.nameId);
                $('.veh_plate').val(data.veh_plate);
                $('.veh_makemodel').selectpicker('val', data.veh_make + ' ' + data
                    .veh_model);
                $('.veh_pcolor').selectpicker('val', data.veh_pcolor);
                $('.veh_scolor').selectpicker('val', data.veh_scolor);
                $('.notes').val(data.notes);
                $('.veh_reg_state').val(data.veh_reg_state);
                $('.editplateid').val(data.id);
            });
    });
})
