<script src="<?= base_url('') ?>asset/js/vendor.min.js"></script>

<script src="<?= base_url('') ?>asset/libs/sweetalert2/sweetalert2.min.js"></script>

<script src="<?= base_url('') ?>asset/js/pages/scrollbar.init.js"></script>

<script src="<?= base_url('') ?>asset/libs/select2/select2.min.js"></script>

<script src="<?= base_url('') ?>asset/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<!-- Boostrap select  -->
<script src="<?= base_url('') ?>asset/libs/bootstrap-select/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {
        // insert loader when begin load page
        $('.content div.begin_loader').find('.card-box').parent('div').prepend(loader)
        $('.content div.begin_loader').find('.card-box').css('display', 'none')

        // datatable change size on web
        function ScaleSlider() {
            $('#datatable').dataTable().fnAdjustColumnSizing();
        }
        // $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);

        // inisialize datepicker
        $("#datestart-autoclose").datepicker({
            autoclose: !0,
            todayHighlight: !0,
            format: 'dd-mm-yyyy',
        })
        $("#dateend-autoclose").datepicker({
            autoclose: !0,
            todayHighlight: !0,
            format: 'dd-mm-yyyy'
        })
        /* var dateTypeVar = $('#datestart-autoclose').datepicker('getDate');
        $.datepicker.formatDate('Y-m-d', dateTypeVar); */

        $(document).on('click', '.button_search', function(reload = true) {
            if (reload == false) {
                $('#datatable').DataTable().ajax.reload(false);
            } else {
                $('#datatable').DataTable().ajax.reload();
            }
        })
    })

    function showIconProfile(name, lastname) {
        let one_name = ""
        let one_lastname = ""
        if (name) {
            one_name = name.charAt(0)
        }
        if (lastname) {
            one_lastname = lastname.charAt(0)
        }
        var intials = one_name.toUpperCase() + one_lastname.toUpperCase();
        $('[data-profileImage]').text(intials);

        // profileImage color
        let profileImage = $('[data-profileImage]')

        if (profileImage.length) {
            let textLowerCase = profileImage.text().toLowerCase()

            /**
             * #64c5b1
             * #00aced
             * #32c861
             * #5553ce
             * #ffa91c
             * #cb2027
             * #f06292
             * #6c757d
             * #ccc
             */
            let codeColorProfile = "#ccc";
            switch(textLowerCase){
                case 'a'||'j'||'s' : codeColorProfile = "#64c5b1"
                    break
                case 'b'||'k'||'t' : codeColorProfile = "#00aced"
                    break
                case 'c'||'l'||'u' : codeColorProfile = "#32c861"
                    break
                case 'd'||'m'||'v' : codeColorProfile = "#5553ce"
                    break
                case 'e'||'n'||'w' : codeColorProfile = "#ffa91c"
                    break
                case 'f'||'o'||'x' : codeColorProfile = "#cb2027"
                    break
                case 'g'||'p'||'y' : codeColorProfile = "#f06292"
                    break
                case 'h'||'q'||'z' : codeColorProfile = "#6c757d"
                    break   
            }

            profileImage.css('background', codeColorProfile)
        }
    }

    function dataFillterFunc(dataarray = []) {
        let d = []

        return function(d) {
            if ($('#hidden_datestart').length) {
                d.hidden_datestart = document.getElementById('hidden_datestart').value;
            }
            if ($('#hidden_dateend').length) {
                d.hidden_dateend = document.getElementById('hidden_dateend').value;
            }

            if ($('#item_operator_id').length) {
                d.hidden_operator_id = document.getElementById('item_operator_id').value
            }

            if ($('#item_statusbill').length) {
                d.hidden_statusbill = document.getElementById('item_statusbill').value
            }
            if (dataarray) {
                dataarray.forEach(function(item, index) {
                    let item_name = item.name
                    if (item_name == 'column') {
                        d.item_name = item.value
                    } else {
                        d[item_name] = document.getElementById(item_name).value
                    }
                })
            }
        }
    }

    function convertDateDatabase(dateDMY) {
        let result

        if (dateDMY) {
            var dateData = dateDMY
            dateData = dateData.split('-')
            result = dateData[2] + "-" + dateData[1] + "-" + dateData[0]
        }

        return result
    }
</script>